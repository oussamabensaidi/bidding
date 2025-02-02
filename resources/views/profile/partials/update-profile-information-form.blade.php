<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="col-span-1">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="col-span-1">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Profile Picture -->
        @if (!$user->profile_picture)
            <div class="col-span-1 md:col-span-2">
             <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <x-text-input id="profile_picture" name="profile_picture" type="file" class="mt-2 block w-full" autocomplete="profile_picture" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
            </div>
            
        @endif

        <!-- Balance -->
        <div>
            <x-input-label for="balance" :value="__('Balance')" />
            <x-text-input id="balance" name="balance" type="text" class="mt-2 block w-full" :value="old('balance', $user->balance)" required autocomplete="balance" />
            <x-input-error class="mt-2" :messages="$errors->get('balance')" />
        </div>

        <!-- Maximum Bid -->
        @if ($user->role==='client')
         <div>
            <x-input-label for="maximumbid" :value="__('Maximum Bid')" />
            <x-text-input id="maximumbid" name="maximumbid" type="text" class="mt-2 block w-full" :value="old('maximumbid', $user->maximumbid)" required autocomplete="maximumbid" />
            <x-input-error class="mt-2" :messages="$errors->get('maximumbid')" />
        </div>   
        @endif
        
        {{-- @if ($user->profile_picture)
        <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture">
    @endif --}}
    @if ($user->profile_picture)
    <div class="profile-picture">
        <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture">
        <div class="mt-4">
            <x-input-label for="profile_picture" :value="__('Do you want to change profile picture?')" />
            <x-text-input id="profile_picture" name="profile_picture" type="file" class="mt-2 block w-full" autocomplete="profile_picture" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
            {{-- <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Current: ') }} {{ basename($user->profile_picture) }}
            </p> --}}
        </div>
    </div>
@endif
        <!-- Save Button -->
        <div class="col-span-1 md:col-span-2 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>

    </form>
    <style>
        .profile-container {
            display: flex;
            align-items: flex-start;
        }
        .profile-picture {
            margin-left: 20px; /* Adjust the margin as needed */
        }
        .profile-picture img {
            max-width: 150px; 
        }
    </style>
</section>