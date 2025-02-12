<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">All Users</p>
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
                    <div class="text-tiny text-2xl">All Users</div>
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
                <a class="tf-button style-1 w208" href="{{ route('users.create') }}"><i
                            class="icon-plus"></i>Add new</a>
            </div>
            <div class="table-responsive">
                @if($users->isNotEmpty())
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Roles</th>
                        <th class="text-center">Created</th>
                        @canany(['edit users', 'delete users'])
                        <th class="text-center">Action</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <x-message />
                    @foreach($users as $user)
                    <tr class="text-center">
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td class="text-center">{{ $user->created_at }}</td>
                        <td class="flex mx-auto justify-center">
                            <div class="list-icon-function">
                                @can('edit users')
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                </a>
                                @endcan
                                @can('delete users')
                                <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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
                {{ $users->links() }}
                @else
                <div class="text-center text-3xl">
                    No users found.
                </div>
                @endif
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            </div>
        </div>
    </div>
</x-app-layout>
