<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Role') }}
            </h2>
            <x-button href="{{ route('roles.index') }}" class="bg-red-700">
                {{ __('Back') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="w-full">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="name" class="text-sm font-medium">Name</label>
                        <div class="mb-3">
                            <input type="text" value="{{ old('name', $role->name) }}" placeholder="Enter Role Name" name="name" id="name" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-4 mb-3">
                            @if($permissions->isNotEmpty())
                                @foreach($permissions as $permission)
                                    <div class="mt-3">
                                        <input type="checkbox"
                                               name="permissions[]"
                                               {{ $hasPermissions->contains($permission->name) ? 'checked' : ''}}
                                               id="permissions{{ $permission->id }}"
                                               class="rounded"
                                               value="{{ $permission->name }}">
                                        <label for="permissions{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                            {{  __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

