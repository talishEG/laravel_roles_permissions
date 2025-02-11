<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">{{ 'Create Role' }}</p>
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
                        <div class="text-tiny">Roles</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li><div class="text-tiny">{{ 'Add Role' }}</div></li>
            </ul>
        </div>
        <div class="main-content-wrap">
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('roles.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">User Name <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="Enter Role Name" name="name" value="{{ old('name') }}">
                    </fieldset>
                    @error('name')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="grid grid-cols-4 mb-3">
                        <div class="body-title">Roles</div>
                        @if($permissions->isNotEmpty())
                        @foreach($permissions as $permission)
                        <div class="mt-3">
                            <input type="checkbox" name="permissions[]" id="permissions{{ $permission->id }}" class="rounded" value="{{ $permission->name }}">
                            <label for="role{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">{{ __('Save') }}</button>
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

