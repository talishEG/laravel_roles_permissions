<?php
$categoryName=null;
if (isset($category)) {
    $categoryName = $category->name;
}
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $categoryName ? __('Edit Categories') : __('Create Categories') }}
            </h2>
            <x-button href="{{ route('categories.index') }}" class="bg-red-700">
                {{ __('Back') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $categoryName ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" class="w-full">
                    @csrf
                    @if($categoryName)
                        @method('PATCH')
                    @endif
                    <div>
                        <label for="name" class="text-sm font-medium">Name</label>
                        <div class="mb-3">
                            <input type="text" value="{{ old('name', $categoryName) }}" placeholder="Enter Categories Name" name="name" id="name" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                            {{ $categoryName ? __('Update') : __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

