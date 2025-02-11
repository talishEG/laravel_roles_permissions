<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            @can('create categories')
                <x-button  href="{{route('categories.create')}}" class="bg-slate-700">
                    {{ __('Create') }}
                </x-button>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />
            @if($categories->isNotEmpty())
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Slug</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        @canany(['edit categories', 'delete categories'])
                            <th class="px-6 py-3 text-center">Action</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($categories as $permission)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">
                                {{ $permission->id }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $permission->name }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $permission->slug }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $permission->created_at }}
                            </td>
                            <td class="px-6 py-3 text-center flex justify-center">
                                @can('edit categories')
                                    <x-button  href="{{route('categories.edit', $permission->id)}}" class="bg-slate-700 mx-2">
                                        {{ __('Edit') }}
                                    </x-button>
                                @endcan
                                @can('delete categories')
                                    <form action="{{route('categories.delete', $permission->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class=" text-sm rounded-md text-white px-3 py-3 bg-red-700">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            @else
                <div class="bg-blue-200 border-blue-600 p-4 mb-3 rounded-sm shadow-sm">
                    No, Categories Found
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
