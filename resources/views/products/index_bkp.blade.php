<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            @can('create products')
                <x-button href="{{ route('products.create') }}" class="bg-slate-700">
                    {{ __('Create') }}
                </x-button>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />
            @if($products->isNotEmpty())
                <table class="w-full table-auto text-center">
                    <thead class="bg-gray-50 text-center">
                    <tr class="border-b text-center">
                        <th class="px-6 py-3 text-center">#</th>
                        <th class="px-6 py-3">Product Name</th>
                        <th class="px-6 py-3">Price</th>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Created</th>
                        @canany(['edit products', 'delete products'])
                            <th class="px-6 py-3">Action</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($products as $product)
                            <?php
                            $primaryImage = $product->images->firstWhere('primary', true);
                            $filePath = null;
                            if (!empty($primaryImage->image_path)) {
                                $filePath = storage_path('app/public/') . $primaryImage->image_path;
                            }
                            ?>
                        <tr class="border-b">
                            <td class="px-6 py-3">
                                {{ $product->id }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-3">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex justify-center mb-4">
                                    @if ($filePath && \Illuminate\Support\Facades\File::exists($filePath))
                                        <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="Product Image" class="w-20 h-20 object-cover rounded-full">
                                    @else
                                        <img src="{{ asset('placeholder-image.png') }}" alt="Default Image" class="w-20 h-20 object-cover rounded-full">
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                {{ $product->stock }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $product->created_at }}
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex justify-center items-center space-x-2">
                                    @can('edit products')
                                        <x-button href="{{ route('products.edit', $product->id) }}" class="bg-slate-700">
                                            {{ __('Edit') }}
                                        </x-button>
                                    @endcan
                                    @can('delete products')
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm rounded-md text-white px-3 py-3 bg-red-700">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            @else
                <div class="bg-blue-200 border-blue-600 p-4 mb-3 rounded-sm shadow-sm">
                    No products found.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
