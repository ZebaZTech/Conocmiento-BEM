<section>
    <header class="mb-3">
        <h2 class="h4 mb-1">
            Foto de perfil
        </h2>

        <p class="text-secondary mb-0">
            Sube una imagen en formato JPG, JPEG, PNG o WebP de máximo 2 MB. La foto se guarda de forma privada en el
            almacenamiento de la aplicación.
        </p>
    </header>

    @if ($user->profile_photo_path)
        <img
            src="{{ $user->profile_photo_url }}"
            alt="Foto de perfil actual"
            class="rounded-circle mb-3"
            width="96"
            height="96"
            style="object-fit: cover;"
        >
    @endif

    <form method="post" action="{{ route('profile.photo') }}" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-3">
            <x-input-label for="photo" value="Nueva foto" />

            <input
                id="photo"
                name="photo"
                type="file"
                accept=".jpg,.jpeg,.png,.webp"
                class="form-control mt-1 @error('photo') is-invalid @enderror"
                required
            >

            <x-input-error class="mt-1" :messages="$errors->get('photo')" />
        </div>

        <div class="d-flex align-items-center gap-3">
            <x-primary-button>Guardar foto</x-primary-button>

            @if (session('status') === 'profile-photo-updated')
                <p class="text-success small mb-0">Foto actualizada.</p>
            @endif
        </div>
    </form>
</section>
