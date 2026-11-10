<section>
    <header class="mb-3">
        <h2 class="h4 mb-1">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-secondary mb-2">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>

        <ul class="text-secondary mb-0">
            <li>Se borran tus tareas y sesiones de enfoque.</li>
            <li>Tus testimonios y mensajes de contacto se anonimizan.</li>
            <li>Se conserva un registro de auditoría sin datos personales.</li>
            <li>La acción no se puede deshacer.</li>
        </ul>
    </header>

    <x-danger-button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#confirm-user-deletion"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="modal-header">
                <h2 class="modal-title fs-5">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <p class="text-secondary">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                @if ($errors->userDeletion->get('admin'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->userDeletion->first('admin') }}
                    </div>
                @endif

                <div class="form-check mb-3">
                    <input
                        class="form-check-input @if ($errors->userDeletion->get('confirm_deletion')) is-invalid @endif"
                        id="confirm_deletion"
                        name="confirm_deletion"
                        type="checkbox"
                        value="1"
                        required
                    >
                    <label class="form-check-label" for="confirm_deletion">
                        Entiendo que esta acción es permanente
                    </label>

                    <x-input-error :messages="$errors->userDeletion->get('confirm_deletion')" class="mt-1" />
                </div>

                <div class="mb-3">
                    <x-input-label for="password" value="{{ __('Password') }}" class="visually-hidden" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 @if ($errors->userDeletion->get('password')) is-invalid @endif"
                        placeholder="{{ __('Password') }}"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
                </div>
            </div>

            <div class="modal-footer">
                <x-secondary-button data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
