<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">All Categories</p>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="/">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny text-2xl">All Categories</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name"
                                   tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('categories.create') }}"><i
                            class="icon-plus"></i>Add new</a>
            </div>
            <div class="table-responsive">
                @if($categories->isNotEmpty())
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Slug</th>
                        <th class="text-center">Created</th>
                        @canany(['edit categories', 'delete categories'])
                        <th class="text-center">Action</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <x-message />
                    @foreach($categories as $category)
                    <tr class="text-center">
                        <td class="text-center">{{ $category->id }}</td>
                        <td class="text-center">{{ $category->name }}</td>
                        <td class="text-center">{{ $category->slug }}</td>
                        <td class="text-center">{{ $category->created_at }}</td>
                        <td class="flex mx-auto justify-center">
                            <div class="list-icon-function">
                                @can('edit categories')
                                <a href="{{ route('categories.edit', $category->id) }}">
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                </a>
                                @endcan
                                @can('delete categories')
                                <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="item text-danger delete pl-0">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
                {{ $categories->links() }}
                @else
                <div class="bg-blue-200 border-blue-600 p-4 mb-3 rounded-sm shadow-sm">
                    No categories found.
                </div>
                @endif
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            </div>
        </div>
    </div>
</x-app-layout>
