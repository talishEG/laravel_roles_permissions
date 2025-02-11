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
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">{{ isset($product) ? 'Edit Article' : 'Add Article' }}</p>
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
                        <div class="text-tiny">Articles</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li><div class="text-tiny">{{ isset($product) ? 'Edit' : 'Add' }} Article</div></li>
            </ul>
        </div>
        <div class="main-content-wrap">
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ $articleTitle ? route('articles.update', $article->id) : route('articles.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if($articleTitle)
                        @method('PATCH')
                    @endif
                    <fieldset class="title">
                        <div class="body-title">Article Name <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="Article name" name="title"
                               tabindex="0" value="{{ old('title', $articleTitle) }}">
                    </fieldset>
                    @error('title')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <fieldset class="text">
                        <div class="body-title">Text <span class="tf-color-1">*</span>
                        </div>
                        <textarea name="text" id="text" class="flex-grow" placeholder="author name" tabindex="1">{{ old('text', $articleText) }}</textarea>
                    </fieldset>
                    @error('text')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <fieldset class="author">
                        <div class="body-title">Article Author <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="author name" name="author"
                               tabindex="2" value="{{ old('author', $articleAuthor) }}">
                    </fieldset>
                    @error('author')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">{{ $articleTitle ? __('Update') : __('Save') }}</button>
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

