<?php
$userName=null;
$userEmail=null;
if (isset($user)) {
    $userName = $user->name;
    $userEmail = $user->email;
}
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $userName ? __('Edit User') : __('Create User') }}
            </h2>
            <x-button href="{{ route('users.index') }}" class="bg-red-700">
                {{ __('Back') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $userName ? route('users.update', $user->id) : route('users.store') }}" method="POST" class="w-full">
                    @csrf
                    @if($userName)
                        @method('PATCH')
                    @endif
                    <div>
                        <label for="name" class="text-sm font-medium">Name</label>
                        <div class="mb-3">
                            <input type="text" value="{{ old('name', $userName) }}" placeholder="Enter User Name" name="name" id="name" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <label for="name" class="text-sm font-medium">Email</label>
                        <div class="mb-3">
                            <input type="email" value="{{ old('email', $userEmail) }}" placeholder="Enter User Email" name="email" id="email" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('email')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @if(!$userName)
                            <label for="name" class="text-sm font-medium">Password</label>
                            <div class="mb-3">
                                <input type="text" value="{{ old('password') }}" placeholder="Enter User Password" name="password" id="password" class="border-gray-300 shadow-sm w-full rounded-lg">
                                @error('password')
                                <p class="text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        <div class="grid grid-cols-4 mb-3">
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
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                            {{ $userName ? __('Update') : __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

