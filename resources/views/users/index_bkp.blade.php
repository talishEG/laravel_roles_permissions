<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <x-button  href="{{route('users.create')}}" class="bg-slate-700">
                {{ __('Create') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />
            @if($users->isNotEmpty())
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Roles</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($users as $user)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">
                                {{ $user->id }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $user->roles->pluck('name')->implode(', ') }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $user->created_at }}
                            </td>
                            <td class="px-6 py-3 text-center flex justify-center">
                                <x-button  href="{{route('users.edit', $user->id)}}" class="bg-slate-700 mx-2">
                                    {{ __('Edit') }}
                                </x-button>
                                @if(!in_array('Super Admin', $user->roles->pluck('name')->toArray()))
                                <form action="{{route('users.delete', $user->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class=" text-sm rounded-md text-white px-3 py-3 bg-red-700">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            @else
                <div class="text-center text-3xl">
                    No, Users Found
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
