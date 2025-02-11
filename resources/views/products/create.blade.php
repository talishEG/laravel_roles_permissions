<?php
$productName = null;
$productSlug = null;
$productDescription = null;
$productShortDescription = null;
$productRegularPrice = null;
$productSalesPrice = null;
$productStock = null;
$productIsFeatured = null;
$productAttributeName = null;
$productAttributeValue = null;

if (isset($product)) {
    $productName = $product->name;
    $productSlug = $product->slug;
    $productShortDescription = $product->short_description;
    $productDescription = $product->description;
    $productRegularPrice = $product->regular_price;
    $productSalesPrice = $product->sale_price;
    $productStock = $product->in_stock;
    $productIsFeatured = $product->is_featured;
}
?>
<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</p>
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
                        <div class="text-tiny">Products</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li><div class="text-tiny">{{ isset($product) ? 'Edit' : 'Add' }} Product</div></li>
            </ul>
        </div>
        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data" class="tf-section-2 form-add-product">
            @csrf
            @if (isset($product))
                @method('PATCH')
            @endif
            <div class="wg-box">
                <fieldset class="name">
                    <div class="body-title mb-10">Product Name <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Enter Product Name"
                           name="name" id="name" tabindex="0" value="{{ old('name', $productName) }}" aria-required="true"="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the
                        product name.</div>
                    @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset class="slug">
                    <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                    <input type="text" name="slug" id="slug" placeholder="Enter Product Slug" value="{{ old('slug', $productSlug) }}">
                    @error('slug')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div class="gap22 cols">
                    <fieldset class="category">
                        <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select name="category_id">
                                <option value="">Choose category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </fieldset>

                </div>

                <fieldset class="short_description">
                    <div class="body-title mb-10">Short Description <span
                                class="tf-color-1">*</span></div>
                    <textarea class="mb-10 ht-150" name="short_description"
                              placeholder="Short Description" tabindex="0" aria-required="true"
                             ="">{{ old('description', $productShortDescription) }}</textarea>
                    <div class="text-tiny">Do not exceed 100 characters when entering the
                        product name.</div>
                    @error('short_description')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                    </div>
                    <textarea class="mb-10" name="description" placeholder="Description"
                              tabindex="0" aria-required="true"="">{{ old('description', $productDescription) }}</textarea>
                    <div class="text-tiny">Do not exceed 100 characters when entering the
                        product name.</div>
                </fieldset>
            </div>
            <div class="wg-box">
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style="display:none">
                            <img src="../../../localhost_8000/images/upload/upload-1.png"
                                 class="effect8" alt="">
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                <span class="body-text">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="primaryImage" accept="image/*">
                            </label>
                        </div>
                    </div>
                    @error('primaryImage') <p class="text-red-600">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset>
                    <div class="body-title mb-10">Upload Gallery Images</div>
                    <div class="upload-image mb-16">
                        <div id="galUpload" class="item up-load">
                            <label class="uploadfile" for="gFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                <span class="text-tiny">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                <input type="file" id="gFile" name="images[]" accept="image/*"
                                       multiple="">
                            </label>
                        </div>
                    </div>
                </fieldset>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Regular Price <span
                                    class="tf-color-1">*</span></div>
                        <input type="text" name="regular_price" placeholder="Enter Regular Price" value="{{ old('regular_price', $productRegularPrice) }}">
                        @error('regular_price') <p class="text-red-600">{{ $message }}</p> @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Sale Price <span
                                    class="tf-color-1">*</span></div>
                        <input type="text" name="sale_price" placeholder="Enter Sale Price" value="{{ old('sale_price', $productSalesPrice) }}">
                        @error('sale_price')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>


                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                        </div>
                        <input type="text" name="sku" placeholder="Enter SKU" value="{{ old('sku', $product->sku ?? '') }}">
                        @error('sku') <p class="text-red-600">{{ $message }}</p> @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                        </div>
                        <input type="text" name="quantity" placeholder="Enter quantity" value="{{ old('quantity', $product->quantity ?? '') }}">
                        @error('quantity') <p class="text-red-600">{{ $message }}</p> @enderror
                    </fieldset>
                </div>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Stock</div>
                        <div class="select mb-10">
                            <select name="in_stock">
                                <option value="0" {{ old('in_stock', $productStock) == 0 ? 'selected' : '' }}>Out of Stock</option>
                                <option value="1" {{ old('in_stock', $productStock) == 1 ? 'selected' : '' }}>In Stock</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Featured</div>
                        <div class="select mb-10">
                            <select name="is_featured">
                                <option value="0" {{ old('is_featured', $productIsFeatured) == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('is_featured', $productIsFeatured) == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Add product</button>
                </div>
            </div>
        </form>
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