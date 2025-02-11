<?php
$articleTitle=null;
$articleText=null;
$articleAuthor=null;
if (isset($article)) {
    $articleTitle = $article->title;
    $articleText = $article->text;
    $articleAuthor = $article->author;
}
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $articleTitle ? __('Edit Articles') : __('Create Articles') }}
            </h2>
            <x-button href="{{ route('articles.index') }}" class="bg-red-700">
                {{ __('Back') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $articleTitle ? route('articles.update', $article->id) : route('articles.store') }}" method="POST" class="w-full">
                    @csrf
                    @if($articleTitle)
                        @method('PATCH')
                    @endif
                    <div>
                        <label for="name" class="text-sm font-medium">Name</label>
                        <div class="mb-3">
                            <input type="text" value="{{ old('title', $articleTitle) }}" placeholder="Enter Articles Name" name="title" id="title" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('title')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="text" id="text" cols="30" rows="10" class="border-gray-300 shadow-sm w-full rounded-lg">{{ old('text', $articleText) }}</textarea>
                            @error('text')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" value="{{ old('author', $articleAuthor) }}" placeholder="Enter Articles Name" name="author" id="author" class="border-gray-300 shadow-sm w-full rounded-lg">
                            @error('author')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                            {{ $articleTitle ? __('Update') : __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

