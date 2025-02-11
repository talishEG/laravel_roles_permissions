<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <?php
    $filePath = null;
    if (!empty($user->profile_photo)) {
        $filePath = storage_path('app/public/') . $user->profile_photo;
    }
    ?>
    @if($filePath && \Illuminate\Support\Facades\File::exists($filePath))
        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" id="uploadProfileBtn" class="mt-3 w-24 h-24 rounded-full cursor-pointer">
    @else
        <img src="{{ asset('userImage.png') }}" alt="Profile Photo" id="uploadProfileBtn" class="mt-3 w-24 h-24 rounded-full cursor-pointer">
    @endif
    <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="hidden">
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
            <x-text-input id="profilePhotoInput" class="block mt-1 w-full" type="file" name="profile_photo" :value="old('profile_photo')" autocomplete="profile_photo" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
@push('child-scripts')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#uploadProfileBtn').on('click', function () {
                $("#profilePhotoInput").click();
            });
            $('#profilePhotoInput').on('change', function (event) {
                if (event.target.files && event.target.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#uploadProfileBtn').attr('src', e.target.result);
                        $('#navProfileImage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        });
    </script>
@endpush