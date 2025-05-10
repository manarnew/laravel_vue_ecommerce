<x-app-layout>
    <!-- Product List -->
    <div class="grid gap-8 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-5">
        <!-- Product Item -->
        @foreach ($products as $item)
            <div x-data="productItem({{ json_encode([
                'id' => $item->id,
                'image' => $item->image,
                'title' => $item->title,
                'price' => $item->price,
                'addToCartUrl' => route('cart.add', $item),
            ]) }})"
                class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white">
                <a href="{{ route('products.view', $item->slug) }}" class="block overflow-hidden">
                    <img src="{{ $item->image }}" alt=""
                        class="rounded-lg hover:scale-105 hover:rotate-1 transition-transform" />
                </a>
                <div class="p-4">
                    <h3 class="text-lg">
                        <a href="{{ route('products.view', $item->slug) }}">
                            {{ $item->title }}
                        </a>
                    </h3>
                    <h5 class="font-bold">$ {{ $item->price }}</h5>
                </div>
                <div class="flex justify-between py-3 px-4">
                    <button class="btn-primary" @click="addToCart()">
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
        <!--/ Product Item -->
    </div>
    {{ $products->links() }}
</x-app-layout>
