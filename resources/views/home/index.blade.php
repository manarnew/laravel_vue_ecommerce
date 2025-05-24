<x-app-layout>
    <!-- Hero Section with Phone Image -->
    <section class="bg-slate-800 text-white">
        <div class="container mx-auto px-4 py-8 sm:py-12 md:py-16">
            <div class="flex flex-col-reverse md:flex-row items-center gap-6 md:gap-12">
                <!-- Text Content -->
                <div class="md:w-1/2 mt-4 md:mt-0">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 leading-tight">
                        Shop the Best Deals Right From Your Phone!
                    </h1>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center bg-indigo-600 text-white px-4 py-2 sm:px-5 sm:py-3 rounded-md font-medium hover:bg-indigo-800 transition duration-300 border border-white">
                            <i class="fab fa-google-play mr-2"></i> Show now
                        </a>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <div class="flex -space-x-2 mr-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                class="w-6 h-6 rounded-full border-2 border-indigo-700" alt="User">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                class="w-6 h-6 rounded-full border-2 border-indigo-700" alt="User">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg"
                                class="w-6 h-6 rounded-full border-2 border-indigo-700" alt="User">
                        </div>
                        <span class="text-indigo-200">Join {{ \App\Models\Customer::count() }}+ happy Customers</span>
                    </div>
                </div>

                <!-- Phone Image -->
                <div class="md:w-1/2 relative">
                    <div class="relative mx-auto" style="max-width: 300px">
                        <!-- Phone frame -->
                        <img src="https://cdn.pixabay.com/photo/2017/01/22/12/07/imac-1999636_1280.png" alt="Smartphone"
                            class="w-full h-auto">
                        <!-- Screen content - replace with your app screenshot -->
                        <div
                            class="absolute top-4 left-1/2 transform -translate-x-1/2 w-[85%] h-[92%] overflow-hidden rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4" x-data="{
            categories: {{ $categories->toJson() }},
        }">
            <h2 class ="text-3xl font-bold text-center mb-12">Shop by
                Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

                <template x-for="category in categories" :key="category.id">
                    <a href="#"
                        class="bg-gray-50 hover:bg-indigo-50 rounded-lg p-6 text-center transition duration-300 border border-gray-100 hover:border-indigo-200">
                        <h3 class="font-medium text-gray-800" x-text="category.name"></h3>
                    </a>
                </template>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Featured Products</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <template x-for="product in featuredProducts" :key="product.id">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="relative">
                            <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-indigo-600 text-white text-xs px-2 py-1 rounded-full">
                                <span x-text="product.rating"></span> <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1" x-text="product.name"></h3>
                            <div class="flex justify-between items-center">
                                <span class="text-indigo-600 font-bold" x-text="'$' + product.price"></span>
                                <button @click="addToCart" class="text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-plus-circle text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Banner Section -->
    <section class="py-12 bg-slate-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Free Shipping on Orders Over $50</h2>
            <p class="text-xl mb-6">Shop now and get free delivery on your doorstep</p>
            <button
                class="bg-white text-indigo-800 px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition duration-300">
                Learn More
            </button>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">What Our Customers Say</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Great products and fast delivery! I'm very satisfied with my
                        purchase."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Customer"
                            class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h4 class="font-medium">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500">Verified Buyer</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Excellent customer service. They helped me choose the perfect
                        product for my needs."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Customer"
                            class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h4 class="font-medium">Michael Chen</h4>
                            <p class="text-sm text-gray-500">Verified Buyer</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"The quality of products exceeded my expectations. Will definitely
                        shop here again!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Customer"
                            class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h4 class="font-medium">Emily Rodriguez</h4>
                            <p class="text-sm text-gray-500">Verified Buyer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">Get the latest updates on new products, special offers, and
                more delivered to your inbox.</p>
            <div class="flex flex-col sm:flex-row max-w-md mx-auto sm:max-w-xl">
                <input type="email" placeholder="Your email address"
                    class="px-4 py-3 rounded-md sm:rounded-r-none mb-2 sm:mb-0 flex-grow border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button
                    class="bg-indigo-600 text-white px-6 py-3 rounded-md sm:rounded-l-none font-medium hover:bg-indigo-700 transition duration-300">
                    Subscribe
                </button>
            </div>
        </div>
    </section>
</x-app-layout>
