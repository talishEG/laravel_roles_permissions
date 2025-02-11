<?php
$userName=null;
$userEmail=null;
if (isset($user)) {
    $userName = $user->name;
    $userEmail = $user->email;
}
?>
<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">{{ isset($user) ? 'Edit User' : 'Add User' }}</p>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index-2.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="all-product.html">
                        <div class="text-tiny">Users</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li><div class="text-tiny">{{ isset($user) ? 'Edit' : 'Add' }} User</div></li>
            </ul>
        </div>
        <div class="main-content-wrap">
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ $userName ? route('users.update', $user->id) : route('users.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if($userName)
                    @method('PATCH')
                    @endif
                    <fieldset class="name">
                        <div class="body-title">User Name <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="User name" name="name"
                               tabindex="0" value="{{ old('name', $userName) }}">
                    </fieldset>
                    <fieldset class="email">
                        <div class="body-title">Email <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="email" placeholder="User email" name="email"
                               tabindex="0" value="{{ old('email', $userEmail) }}">
                        @error('email')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    @if(!$userName)
                        <fieldset class="password">
                            <div class="body-title">Password <span class="tf-color-1">*</span>
                            </div>
                            <input class="flex-grow" type="text" placeholder="User name" name="email"
                                   tabindex="0" value="{{ old('password') }}">
                            @error('password')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </fieldset>
                    @endif
                    <div class="grid grid-cols-4 mb-3">
                        <div class="body-title">Roles</div>
                        @if($roles->isNotEmpty())
                        @foreach($roles as $role)
                        <div class="mt-3">
                            <input type="checkbox"
                                   name="role[]"
                                   @if(isset($hasRoles))
                                   {{ $hasRoles->contains($role->id) ? 'checked' : ''}}
                            @endif
                            id="role{{ $role->id }}"
                            class="rounded"
                            value="{{ $role->name }}">
                            <label for="role{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">{{ $userName ? __('Update') : __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('child-scripts')
    <script>
        $(document).ready(function () {
            $('#name').on('keyup', function () {
                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/ /g, '-') // Replace spaces with dashes
                    .replace(/[^\w-]+/g, ''); // Remove special characters

                $('#slug').val(slug);
            });
        });
    </script>
    @endpush

</x-app-layout>

