<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profiel Informatie') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Werk je profielinformatie bij of verander het e-mailadres van je account.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_picture" :value="__('Profielfoto')" />
            <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full" accept="image/*">
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <div id="profilePicturePreview" class="mt-2">
            @if ($user->profile_picture)
                <img id="previewImage" src="{{ asset('images/'.$user->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover">
            @else
                <img id="previewImage" src="#" alt="Preview" class="w-20 h-20 rounded-full object-cover hidden">
            @endif
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const profilePictureInput = document.getElementById('profile_picture');
                const previewImage = document.getElementById('previewImage');
                
                // Event listener for profile picture change
                profilePictureInput.addEventListener('change', function (event) {
                    const input = event.target;
                    const file = input.files[0];
                    const reader = new FileReader();
                    
                    reader.onload = function () {
                        previewImage.src = reader.result;
                        previewImage.classList.remove('hidden');
                    };
                    
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        // If no file selected, hide the preview
                        previewImage.src = '#';
                        previewImage.classList.add('hidden');
                    }
                });
            });
        </script>

        <div>
            <x-input-label for="name" :value="__('Voor- en Achternaam')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Geboortedatum')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $user->birthday)" autocomplete="birthday" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="function" :value="__('Functie')" />
            @role('admin')
            <x-text-input id="function" name="function" type="text" class="mt-1 block w-full disabled:bg-gray-200 disabled:text-gray-500 dark:disabled:bg-gray-800 dark:disabled:text-gray-500" :value="old('function', $user->function)"/>
            @else
            <x-text-input id="" name="" type="text" class="mt-1 block w-full disabled:bg-gray-200 disabled:text-gray-500 dark:disabled:bg-gray-800 dark:disabled:text-gray-500" :value="old('function', $user->function)" disabled/>
            @endrole
            <x-input-error class="mt-2" :messages="$errors->get('function')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Telefoonnummer')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Je e-mailadres is niet geverifieerd.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Klik hier om de verificatie-e-mail opnieuw te verzenden.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Een nieuwe verificatielink is naar je e-mailadres gestuurd.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>