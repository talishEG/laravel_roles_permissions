<?php
$roleName=null;
if (isset($permission)) {
    $roleName = $permission->name;
}
?>
<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">{{ isset($product) ? 'Edit Permission' : 'Add Permission' }}</p>
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
                        <div class="text-tiny">Permissions</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li><div class="text-tiny">{{ isset($product) ? 'Edit' : 'Add' }} Permission</div></li>
            </ul>
        </div>
        <div class="main-content-wrap">
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ $roleName ? route('permissions.update', $permission->id) : route('permissions.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if($roleName)
                        @method('PATCH')
                    @endif
                    <fieldset class="name">
                        <div class="body-title">Permission Name <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="Permission name" name="name"
                               tabindex="0" value="{{ old('name', $roleName) }}" aria-required="true" required="">
                    </fieldset>
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">{{ $roleName ? __('Update') : __('Save') }}</button>
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

