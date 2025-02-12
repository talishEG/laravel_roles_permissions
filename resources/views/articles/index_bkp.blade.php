<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            @can('create articles')
                <x-button  href="{{route('articles.create')}}" class="bg-slate-700">
                    {{ __('Create') }}
                </x-button>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />
            @if($articles->isNotEmpty())
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        @canany(['edit articles', 'delete articles'])
                            <th class="px-6 py-3 text-center">Action</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($articles as $permission)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">
                                {{ $permission->id }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $permission->title }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $permission->author }}
                            </td>
                            <td class="px-6 py-3 text-left">
                                {{ $permission->created_at }}
                            </td>
                            <td class="px-6 py-3 text-center flex justify-center">
                                @can('edit articles')
                                    <x-button  href="{{route('articles.edit', $permission->id)}}" class="bg-slate-700 mx-2">
                                        {{ __('Edit') }}
                                    </x-button>
                                @endcan
                                @can('delete articles')
                                    <form action="{{route('articles.delete', $permission->id)}}" method="POST">
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
                {{ $articles->links() }}
            @else
                <div class="text-center text-3xl">
                    No, Articles Found
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
