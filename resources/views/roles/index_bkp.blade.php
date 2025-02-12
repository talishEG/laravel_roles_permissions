<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <x-button  href="{{route('roles.create')}}" class="bg-slate-700">
                {{ __('Create') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />
            @if($roles->isNotEmpty())
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Permissions</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($roles as $role)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">
                                    {{ $role->id }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->name }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->permissions->pluck('name')->implode(',') }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->created_at }}
                                </td>
                                <td class="px-6 py-3 text-center flex justify-center">
                                    <x-button  href="{{route('roles.edit', $role->id)}}" class="bg-slate-700 mx-2">
                                        {{ __('Edit') }}
                                    </x-button>
                                    <form action="{{route('roles.delete', $role->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class=" text-sm rounded-md text-white px-3 py-3 bg-red-700">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            @else
                <div class="text-center text-3xl">
                    No, Roles Found
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
