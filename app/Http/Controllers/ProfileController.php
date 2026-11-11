<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\AccountDeletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();
        $disk = Storage::disk('s3');

        if ($user->profile_photo_path) {
            $disk->delete($user->profile_photo_path);
        }

        $path = $request->file('photo')->store('profile-photos', 's3');

        if ($path === false) {
            throw ValidationException::withMessages([
                'photo' => 'No se pudo guardar la foto. Inténtalo de nuevo.',
            ]);
        }

        $user->update(['profile_photo_path' => $path]);

        return Redirect::route('profile.edit')->with('status', 'profile-photo-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, AccountDeletionService $deletion): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
            'confirm_deletion' => ['required', 'accepted'],
        ], [
            'confirm_deletion.accepted' => 'Debes confirmar que entiendes que esta acción es permanente.',
        ]);

        $user = $request->user();

        if ($user->is_admin && User::where('is_admin', true)->count() <= 1) {
            throw ValidationException::withMessages([
                'admin' => 'No puedes eliminar tu cuenta porque eres el único administrador. Asigna el rol de administrador a otro usuario antes de eliminarla.',
            ])->errorBag('userDeletion');
        }

        Auth::logout();

        $deletion->delete($user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Tu cuenta y tus datos personales fueron eliminados.');
    }
}
