<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Collection Header -->
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium hover:text-primary dark:hover:text-primary-light">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="#" class="ml-1 text-sm font-medium hover:text-primary dark:hover:text-primary-light md:ml-2">Collections</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-primary dark:text-primary-light md:ml-2">Premium Laptops</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Premium Laptops</h1>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl">
                        Discover our curated collection of high-performance laptops for professionals and creators. Cutting-edge technology meets elegant design.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-sm text-gray-500 dark:text-gray-400">124 products</span>
                </div>
            </div>
        </div>

        <!-- Filters and Sorting -->
        <div class="mb-8 p-4 bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <!-- Filter Button (Mobile) -->
                <button id="filter-toggle" class="md:hidden mb-4 flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-filter mr-2"></i>
                    Filters
                </button>

                <!-- Active Filters -->
                <div class="flex flex-wrap items-center gap-2 mb-4 md:mb-0">
                    <span class="text-sm font-medium hidden md:block">Filters:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        Laptops
                        <button class="ml-1.5">
                            <i class="fas fa-times text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"></i>
                        </button>
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        $1000-$2000
                        <button class="ml-1.5">
                            <i class="fas fa-times text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"></i>
                        </button>
                    </span>
                    <button class="text-sm text-primary dark:text-primary-light hover:underline">Clear all</button>
                </div>

                <!-- Sorting -->
                <div class="flex items-center">
                    <label for="sort" class="mr-2 text-sm font-medium">Sort by:</label>
                    <select id="sort" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2">
                        <option selected>Featured</option>
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="rating">Customer Rating</option>
                        <option value="newest">Newest Arrivals</option>
                        <option value="bestselling">Bestselling</option>
                    </select>
                </div>
            </div>

            <!-- Filter Panel (Mobile) -->
            <div id="filter-panel" class="hidden md:hidden mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <!-- Filter categories would go here -->
                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium mb-2">Categories</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="filter-laptops" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="filter-laptops" class="ml-2 text-sm">Laptops</label>
                            </div>
                            <div class="flex items-center">
                                <input id="filter-ultrabooks" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="filter-ultrabooks" class="ml-2 text-sm">Ultrabooks</label>
                            </div>
                            <div class="flex items-center">
                                <input id="filter-gaming" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="filter-gaming" class="ml-2 text-sm">Gaming</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-medium mb-2">Price Range</h3>
                        <div class="flex items-center justify-between space-x-4">
                            <input type="number" placeholder="Min" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <span>to</span>
                            <input type="number" placeholder="Max" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                        </div>
                    </div>
                    <button class="w-full bg-primary dark:bg-primary-light text-white py-2 px-4 rounded-lg hover:bg-primary-dark dark:hover:bg-primary">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filters (Desktop) -->
            <aside class="hidden md:block w-64 flex-shrink-0">
                <div class="space-y-6">
                    <!-- Categories -->
                    <div class="p-4 bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-medium mb-4">Categories</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="category-laptops" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600" checked>
                                <label for="category-laptops" class="ml-2">Laptops <span class="text-gray-500 dark:text-gray-400 text-sm">(87)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="category-ultrabooks" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="category-ultrabooks" class="ml-2">Ultrabooks <span class="text-gray-500 dark:text-gray-400 text-sm">(42)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="category-gaming" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="category-gaming" class="ml-2">Gaming <span class="text-gray-500 dark:text-gray-400 text-sm">(35)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="category-workstations" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="category-workstations" class="ml-2">Workstations <span class="text-gray-500 dark:text-gray-400 text-sm">(22)</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="p-4 bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-medium mb-4">Price Range</h3>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <span>$0</span>
                                <span>$5000</span>
                            </div>
                            <input type="range" min="0" max="5000" value="1000" class="w-full h-2 bg-gray-200 dark:bg-gray-600 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between mt-2">
                                <span class="text-sm">$1000</span>
                                <span class="text-sm">$2000</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between space-x-4">
                            <input type="number" value="1000" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <span>to</span>
                            <input type="number" value="2000" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                        </div>
                    </div>

                    <!-- Brands -->
                    <div class="p-4 bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-medium mb-4">Brands</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="brand-apple" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="brand-apple" class="ml-2">Apple <span class="text-gray-500 dark:text-gray-400 text-sm">(32)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-dell" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600" checked>
                                <label for="brand-dell" class="ml-2">Dell <span class="text-gray-500 dark:text-gray-400 text-sm">(28)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-hp" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="brand-hp" class="ml-2">HP <span class="text-gray-500 dark:text-gray-400 text-sm">(24)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-lenovo" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="brand-lenovo" class="ml-2">Lenovo <span class="text-gray-500 dark:text-gray-400 text-sm">(19)</span></label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-asus" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="brand-asus" class="ml-2">Asus <span class="text-gray-500 dark:text-gray-400 text-sm">(15)</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Ratings -->
                    <div class="p-4 bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-medium mb-4">Customer Rating</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="rating-5" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="rating-5" class="ml-2 flex items-center">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-1">& Up</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="rating-4" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="rating-4" class="ml-2 flex items-center">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-1">& Up</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="rating-3" type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary dark:border-gray-600">
                                <label for="rating-3" class="ml-2 flex items-center">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-1">& Up</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Product Card 1 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="MacBook Pro" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-primary dark:bg-primary-light text-white text-xs font-medium px-2 py-1 rounded">
                                -15%
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(142)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Apple MacBook Pro 14"</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">M2 Pro chip, 16GB RAM, 512GB SSD</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400 line-through text-sm">$1,999</span>
                                    <span class="text-primary dark:text-primary-light font-medium ml-2">$1,699</span>
                                </div>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Dell XPS 15" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="fas fa-heart text-red-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(87)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Dell XPS 15</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Intel i7, 32GB RAM, 1TB SSD, 4K Touch</p>
                            <div class="flex items-center justify-between">
                                <span class="text-primary dark:text-primary-light font-medium">$2,299</span>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1629131726692-1accd0c53ce0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="HP Spectre x360" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-primary dark:bg-primary-light text-white text-xs font-medium px-2 py-1 rounded">
                                New
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(214)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">HP Spectre x360</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Intel i7, 16GB RAM, 1TB SSD, 2-in-1</p>
                            <div class="flex items-center justify-between">
                                <span class="text-primary dark:text-primary-light font-medium">$1,599</span>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 4 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1618410320928-2520f7ea9a96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Asus ROG Zephyrus" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(176)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Asus ROG Zephyrus G14</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Ryzen 9, RTX 3060, 16GB RAM, 1TB SSD</p>
                            <div class="flex items-center justify-between">
                                <span class="text-primary dark:text-primary-light font-medium">$1,799</span>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 5 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1618410320928-2520f7ea9a96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Lenovo ThinkPad X1" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-primary dark:bg-primary-light text-white text-xs font-medium px-2 py-1 rounded">
                                -10%
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(92)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Lenovo ThinkPad X1 Carbon</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Intel i7, 16GB RAM, 512GB SSD</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400 line-through text-sm">$1,899</span>
                                    <span class="text-primary dark:text-primary-light font-medium ml-2">$1,709</span>
                                </div>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 6 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Microsoft Surface Laptop 4" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(67)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Microsoft Surface Laptop 4</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Intel i5, 8GB RAM, 256GB SSD</p>
                            <div class="flex items-center justify-between">
                                <span class="text-primary dark:text-primary-light font-medium">$999</span>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 7 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1629131726692-1accd0c53ce0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Razer Blade 15" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="fas fa-heart text-red-500"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-primary dark:bg-primary-light text-white text-xs font-medium px-2 py-1 rounded">
                                Bestseller
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(298)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Razer Blade 15</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Intel i7, RTX 3070, 16GB RAM, 1TB SSD</p>
                            <div class="flex items-center justify-between">
                                <span class="text-primary dark:text-primary-light font-medium">$2,499</span>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 8 -->
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="LG Gram 17" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2">
                                <button class="p-2 bg-white/90 dark:bg-dark-700/90 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(124)</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">LG Gram 17</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Intel i7, 16GB RAM, 1TB SSD, Ultra-light</p>
                            <div class="flex items-center justify-between">
                                <span class="text-primary dark:text-primary-light font-medium">$1,799</span>
                                <button class="quick-view-btn p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="fas fa-eye text-gray-700 dark:text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex flex-col sm:flex-row items-center justify-between">
                    <div class="mb-4 sm:mb-0">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">8</span> of <span class="font-medium">124</span> results
                        </p>
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 rounded-lg border border-primary dark:border-primary-light bg-primary dark:bg-primary-light text-white">
                            1
                        </button>
                        <button class="px-3 py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            2
                        </button>
                        <button class="px-3 py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            3
                        </button>
                        <span class="px-3 py-1">...</span>
                        <button class="px-3 py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            12
                        </button>
                        <button class="px-3 py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Quick View Modal -->
    <div id="quick-view-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-dark-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white dark:bg-dark-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <button id="close-quick-view" class="absolute top-4 right-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-times text-gray-500 dark:text-gray-400"></i>
                        </button>
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="w-full md:w-1/2">
                                    <img id="quick-view-image" src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Product" class="w-full rounded-lg">
                                    <div class="grid grid-cols-4 gap-2 mt-4">
                                        <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Thumbnail" class="h-20 object-cover rounded border border-gray-200 dark:border-gray-700 cursor-pointer hover:border-primary dark:hover:border-primary-light">
                                        <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Thumbnail" class="h-20 object-cover rounded border border-gray-200 dark:border-gray-700 cursor-pointer hover:border-primary dark:hover:border-primary-light">
                                        <img src="https://images.unsplash.com/photo-1629131726692-1accd0c53ce0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Thumbnail" class="h-20 object-cover rounded border border-gray-200 dark:border-gray-700 cursor-pointer hover:border-primary dark:hover:border-primary-light">
                                        <img src="https://images.unsplash.com/photo-1618410320928-2520f7ea9a96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Thumbnail" class="h-20 object-cover rounded border border-gray-200 dark:border-gray-700 cursor-pointer hover:border-primary dark:hover:border-primary-light">
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2">
                                    <h3 id="quick-view-title" class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Apple MacBook Pro 14"</h3>
                                    <div class="flex items-center mb-4">
                                        <div class="flex text-yellow-400">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">142 reviews</span>
                                        <span class="mx-2 text-gray-300 dark:text-gray-600">|</span>
                                        <span class="text-green-600 dark:text-green-400 text-sm font-medium">In Stock</span>
                                    </div>
                                    <div class="mb-4">
                                        <span class="text-gray-500 dark:text-gray-400 line-through text-lg">$1,999</span>
                                        <span class="text-primary dark:text-primary-light font-bold text-2xl ml-2">$1,699</span>
                                        <span class="ml-2 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-500 text-xs font-medium px-2 py-0.5 rounded">15% OFF</span>
                                    </div>
                                    <p id="quick-view-description" class="text-gray-600 dark:text-gray-400 mb-6">
                                        The MacBook Pro 14" with M2 Pro chip delivers exceptional performance for professionals. Featuring a stunning Liquid Retina XDR display, up to 32GB unified memory, and up to 1TB SSD storage. With up to 17 hours of battery life and a versatile array of ports including HDMI and SDXC.
                                    </p>
                                    <div class="mb-6">
                                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Specifications</h4>
                                        <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                            <li><span class="font-medium">Processor:</span> M2 Pro chip, 10-core CPU, 16-core GPU</li>
                                            <li><span class="font-medium">Memory:</span> 16GB unified memory</li>
                                            <li><span class="font-medium">Storage:</span> 512GB SSD</li>
                                            <li><span class="font-medium">Display:</span> 14.2" Liquid Retina XDR, 3024×1964</li>
                                            <li><span class="font-medium">Battery:</span> Up to 17 hours</li>
                                        </ul>
                                    </div>
                                    <div class="flex items-center space-x-4 mb-6">
                                        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg">
                                            <button class="px-3 py-1 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">-</button>
                                            <span class="px-3 py-1">1</span>
                                            <button class="px-3 py-1 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">+</button>
                                        </div>
                                        <button class="flex-1 bg-primary dark:bg-primary-light hover:bg-primary-dark dark:hover:bg-primary text-white py-2 px-4 rounded-lg font-medium">
                                            Add to Cart
                                        </button>
                                        <button class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                                        </button>
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-shield-alt mr-2"></i>
                                            <span>2-year warranty included</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-guest-layout>