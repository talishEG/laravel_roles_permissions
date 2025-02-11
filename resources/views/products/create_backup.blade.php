<?php
$productName = null;
$productDescription = null;
$productPrice = null;
$productStock = null;
$productAttributeName = null;
$productAttributeValue = null;

if (isset($product)) {
    $productName = $product->name;
    $productDescription = $product->description;
    $productPrice = $product->price;
    $productStock = $product->stock;
}
?>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isset($product) ? __('Edit Product') : __('Create Product') }}
            </h2>
            <x-button href="{{ route('products.index') }}" class="bg-red-700">
                {{ __('Back') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                    @csrf
                    @if (isset($product))
                        @method('PATCH')
                    @endif

                    <!-- Product Name -->
                    <div>
                        <label for="name" class="text-sm font-medium">Product Name</label>
                        <div class="mb-3">
                            <input type="text" name="name" id="name" value="{{ old('name', $productName) }}" placeholder="Enter Product Name" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div>
                        <label for="description" class="text-sm font-medium">Description</label>
                        <div class="mb-3">
                            <textarea name="description" id="description" cols="30" rows="5" class="border-gray-300 shadow-sm w-full rounded-lg" placeholder="Enter Product Description">{{ old('description', $productDescription) }}</textarea>
                            @error('description')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Price -->
                    <div>
                        <label for="price" class="text-sm font-medium">Price</label>
                        <div class="mb-3">
                            <input type="text" name="price" id="price" value="{{ old('price', $productPrice) }}" placeholder="Enter Price" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('price')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Stock -->
                    <div>
                        <label for="stock" class="text-sm font-medium">Stock</label>
                        <div class="mb-3">
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $productStock) }}" placeholder="Enter Stock" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('stock')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label for="images" class="text-sm font-medium">Product Images (Choose Primary Image First)</label>
                        <div class="mb-3">
                            <input type="file" name="images[]" multiple class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('images')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Attribute Name -->
                    <div>
                        <label for="attribute_name" class="text-sm font-medium">Attribute Name</label>
                        <div class="mb-3">
                            <input type="text" name="attribute_name" id="attribute_name" value="{{ old('attribute_name', $productAttributeName) }}" placeholder="Enter Attribute Name" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('attribute_name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Attribute Value -->
                    <div>
                        <label for="attribute_value" class="text-sm font-medium">Attribute Value</label>
                        <div class="mb-3">
                            <input type="text" name="attribute_value" id="attribute_value" value="{{ old('attribute_value', $productAttributeValue) }}" placeholder="Enter Attribute Value" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('attribute_value')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                        {{ isset($product) ? __('Update Product') : __('Create Product') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
