<?php
$categoryName=null;
if (isset($category)) {
    $categoryName = $category->name;
}
?>
<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">{{ isset($product) ? 'Edit Category' : 'Add Category' }}</p>
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
                        <div class="text-tiny">Categories</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li><div class="text-tiny">{{ isset($product) ? 'Edit' : 'Add' }} Category</div></li>
            </ul>
        </div>
        <div class="main-content-wrap">
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ $categoryName ? route('categories.update', $category->id) : route('categories.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if($categoryName)
                        @method('PATCH')
                    @endif
                    <fieldset class="name">
                        <div class="body-title">Category Name <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="Category name" name="name"
                               tabindex="0" value="{{ old('name', $categoryName) }}">
                    </fieldset>
                    @error('name')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">

                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                    <span class="body-text">Drop your images here or select <span
                                                class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                            <div class="item" id="imgpreview" style="display: none">
                                <img src="{{ asset('placeholder-image.png') }}"
                                     class="effect8" alt="">
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">{{ $categoryName ? __('Update') : __('Save') }}</button>
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

            $('#myFile').on('change', function (event) {
                if (event.target.files && event.target.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $("#imgpreview").show();
                        $('#imgpreview img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        });
    </script>
    @endpush

</x-app-layout>

