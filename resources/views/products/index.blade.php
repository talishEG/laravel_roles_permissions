<x-app-layout>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <p class="text-5xl text-bold bold font-bold text-black">All Products</p>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="/">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny text-2xl">All Products</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name"
                                   tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('products.create') }}"><i
                            class="icon-plus"></i>Add new</a>
            </div>
            <div class="table-responsive">
                @if($products->isNotEmpty())
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Regular Price</th>
                            <th class="text-center">Special Price</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Is Available</th>
                            <th class="text-center">Created</th>
                            @canany(['edit products', 'delete products'])
                                <th class="text-center">Action</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($products as $product)
                           <?php
                                $primaryImage = $product->images->firstWhere('primary', true);
                                $filePath = null;
                                if (!empty($primaryImage->image_path)) {
                                    $filePath = storage_path('app/public/') . $primaryImage->image_path;
                                }
                           ?>
                            <tr class="text-center">
                                <td class="text-center">{{ $product->id }}</td>
                                <td class="text-center">{{ $product->name }}</td>
                                <td class="text-center"> ${{ number_format($product->regular_price, 2) }}</td>
                                <td class="text-center"> ${{ number_format($product->sale_price, 2) }}</td>
                                <td>
                                    <div class="flex justify-center mb-4">
                                        @if ($filePath && \Illuminate\Support\Facades\File::exists($filePath))
                                            <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="Product Image" class="w-20 h-20 object-cover rounded-full">
                                        @else
                                            <img src="{{ asset('placeholder-image.png') }}" alt="Default Image" class="w-20 h-20 object-cover rounded-full">
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center"><?= $product->in_stock ? 'Yes' : 'No'; ?></td>
                                <td class="text-center">{{ $product->created_at }}</td>
                                <td class="flex mx-auto justify-center">
                                    <div class="list-icon-function">
                                         @can('edit products')
                                            <a href="{{ route('products.edit', $product->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                         @endcan
                                         @can('delete products')
                                               <form action="{{ route('products.delete', $product->id) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="item text-danger delete pl-0">
                                                       <i class="icon-trash-2"></i>
                                                   </button>
                                            </form>
                                         @endcan
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {{ $products->links() }}
                @else
                    <div class="text-center text-3xl">
                        No products found.
                    </div>
                @endif
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            </div>
        </div>
    </div>
</x-app-layout>
