<div class="section-menu-left">
    <div class="box-logo">
        <a href="{{route('dashboard')}}" id="site-logo-inner">
            <img class="" id="logo_header" alt="" src="{{ asset('admin/assets/images/logo/logo.png') }}"
                 data-light="{{ asset('admin/assets/images/logo/logo.png') }}" data-dark="{{ asset('admin/assets/images/logo/logo.png') }}">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">Main Home</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{route('dashboard')}}" class="{{request()->routeIs('dashboard') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">

                @can('view categories')
                    <li class="menu-item has-children @if(in_array(Request::segment(1), ['categories'])){{ 'active' }}@endif">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">Categories</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('categories.create')}}" class="{{ request()->routeIs('categories.create') ? 'active' : ''}}">
                                    <div class="text">New Category</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('categories.index')}}" class="{{ request()->routeIs('categories.index') ? 'active' : ''}}">
                                    <div class="text">Categories</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view products')
                    <li class="menu-item has-children @if(in_array(Request::segment(1), ['products'])){{ 'active' }}@endif">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-shopping-cart"></i></div>
                            <div class="text">Products</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('products.create')}}" class="{{ request()->routeIs('products.create') ? 'active' : ''}}">
                                    <div class="text">Add Product</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('products.index')}}" class="{{ request()->routeIs('products.index') ? 'active' : ''}}">
                                    <div class="text">Products</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view articles')
                <li class="menu-item has-children @if(in_array(Request::segment(1), ['articles'])){{ 'active' }}@endif">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-image"></i></div>
                        <div class="text">Articles</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('articles.create')}}" class="{{ request()->routeIs('articles.create') ? 'active' : ''}}">
                                <div class="text">Add Article</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('articles.index')}}" class="{{ request()->routeIs('articles.index') ? 'active' : ''}}">
                                <div class="text">Articles</div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('view users')
                <li class="menu-item has-children @if(in_array(Request::segment(1), ['users'])){{ 'active' }}@endif">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">Users</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('users.create')}}" class="{{ request()->routeIs('users.create') ? 'active' : ''}}">
                                <div class="text">Add User</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('users.index')}}" class="{{ request()->routeIs('users.index') ? 'active' : ''}}">
                                <div class="text">Users</div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('view permissions')
                    <li class="menu-item has-children @if(in_array(Request::segment(1), ['permissions'])){{ 'active' }}@endif">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file-plus"></i></div>
                            <div class="text">Permissions</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('permissions.create')}}" class="{{ request()->routeIs('permissions.create') ? 'active' : ''}}">
                                    <div class="text">Add Permission</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('permissions.index')}}" class="{{ request()->routeIs('permissions.index') ? 'active' : ''}}">
                                    <div class="text">Permissions</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view roles')
                    <li class="menu-item has-children @if(in_array(Request::segment(1), ['roles'])){{ 'active' }}@endif">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file-plus"></i></div>
                            <div class="text">Roles</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="{{route('roles.create')}}" class="{{ request()->routeIs('roles.create') ? 'active' : ''}}">
                                    <div class="text">Add Role</div>
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{route('roles.index')}}" class="{{ request()->routeIs('roles.index') ? 'active' : ''}}">
                                    <div class="text">Roles</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <li class="menu-item">
                    <a href="{{route('profile.edit')}}" class="{{ request()->routeIs('profile.edit') ? 'active' : ''}}">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">Settings</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>