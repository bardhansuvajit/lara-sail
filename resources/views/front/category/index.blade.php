<x-guest-layout 
    screen="max-w-screen-xl" 
    title="{{ __('Categories') }}">

    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">

        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><span class="text-gray-800 font-medium dark:text-gray-300">Category</span></li>
                </ol>
            </nav>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4 items-center justify-between mt-2">
                <div class="col-span-1">
                    <h1 class="text-sm sm:text-lg font-bold text-gray-900 dark:text-white">{{ __('Explore categories') }}</h1>
                    <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">{{ __('Browse by category - discover curated picks, deals and top brands.') }}</p>
                </div>

                <div class="col-span-1 sm:col-start-3 justify-self-end w-full sm:w-auto overflow-hidden">
                    <form action="" method="GET">
                        <div class="flex flex-col sm:grid sm:grid-cols-8 items-center gap-2 sm:gap-4">
                            <div class="w-full sm:col-span-6">
                                <x-front.text-input id="search" class="block w-full" type="text" name="search" placeholder="Search categories..." value="{{ request('search') }}" maxlength="80" autocomplete="search" required />
                            </div>

                            <div class="w-full sm:col-span-2">
                                <div class="flex gap-1">
                                    <x-front.button
                                        type="submit"
                                        class="w-full sm:w-40"
                                        element="button">
                                        @slot('icon')
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-140v-320h320v320H80Zm80-80h160v-160H160v160Zm60-340 220-360 220 360H220Zm142-80h156l-78-126-78 126ZM863-42 757-148q-21 14-45.5 21t-51.5 7q-75 0-127.5-52.5T480-300q0-75 52.5-127.5T660-480q75 0 127.5 52.5T840-300q0 26-7 50.5T813-204L919-98l-56 56ZM660-200q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29ZM320-380Zm120-260Z"/></svg>
                                        @endslot
                                        {{ __('Search') }}
                                    </x-front.button>
                                </div>
                            </div>
                        </div>

                        @if (request('search'))
                            <div class="flex justify-end mt-2">
                                <a href="{{ route('front.category.index') }}" class="text-[10px] inline-flex gap-2 items-center text-end text-amber-800/80 hover:text-amber-800 dark:text-amber-600/80 dark:hover:text-amber-600">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m592-481-57-57 143-182H353l-80-80h487q25 0 36 22t-4 42L592-481ZM791-56 560-287v87q0 17-11.5 28.5T520-160h-80q-17 0-28.5-11.5T400-200v-247L56-791l56-57 736 736-57 56ZM535-538Z"/></svg>
                                    Clear Filter
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="col-span-1 sm:col-span-3">
                    <p class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500 line-clamp-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex rem placeat, iure ad accusamus maiores odit, quos illum doloremque ratione repellat similique. Laudantium nesciunt natus asperiores aliquam esse est facere ullam ipsa exercitationem earum. Minima saepe vitae voluptas ducimus tempore? Consequuntur molestiae odit ipsum, architecto suscipit labore inventore a iste delectus tenetur deserunt, veniam ex! Sapiente vero, perspiciatis ab dolore fuga earum pariatur rerum quas possimus ipsa rem impedit quis culpa odio consequatur repudiandae nesciunt aspernatur. Tenetur sunt labore maiores impedit aliquid maxime hic omnis consectetur illo eaque nam cupiditate dolorum a, animi placeat voluptate numquam! Placeat odit ratione nisi ab, modi atque dolore laborum neque impedit alias, unde similique, et necessitatibus quod eum ipsa deserunt suscipit reprehenderit. Voluptatem consequuntur necessitatibus corrupti molestiae? Repudiandae, sunt perferendis odit hic enim itaque reprehenderit fuga, voluptatibus nulla placeat necessitatibus voluptatum eaque, debitis similique ratione vero atque. Magni magnam debitis et, sed ex porro in expedita, saepe rerum culpa quidem accusamus? Vel deserunt veritatis veniam reprehenderit voluptas temporibus neque atque, facere debitis cumque sit eos, reiciendis eius vero fugiat accusamus modi accusantium sint a inventore? Quam id non beatae tempore illo enim nulla placeat. Vel, adipisci. Explicabo ea laudantium nemo repellendus! Eius, molestias id laudantium voluptate, nobis illo odit harum</p>
                </div>
            </div>
        </header>

        {{-- Top banner ad --}}
        @if ($categoryPageAd3)
            <a href="{{ $categoryPageAd3->url }}" class="block {{ FD['rounded'] }} overflow-hidden shadow">
                <img src="{{ Storage::url($categoryPageAd3->image_l) }}" alt="Top ad" class="w-full h-auto object-cover">
            </a>
        @endif


        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

            {{-- Filters + Small Ads --}}
            {{-- <div class="hidden sm:block">
                @include('layouts.front.includes.categories-filter')
            </div> --}}

            {{-- Categories + Featured Products --}}
            <main class="lg:col-span-4 space-y-2 sm:space-y-4">
                {{-- All categories --}}
                @if ($catCount > 0)
                    <div class="bg-white dark:bg-gray-800 p-2 sm:p-4 {{ FD['rounded'] }} shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-sm sm:text-base">All categories</h3>
                            <div class="text-xs text-gray-500">Showing {{ $catCount .' '. ( ($catCount == 1) ? 'category' : 'categories' ) }}</div>
                        </div>

                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 sm:gap-3">
                            @foreach($parents as $cat)
                                <a href="{{ route('front.category.detail', $cat->slug) }}" class="block">
                                    <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-1 sm:p-2 group transition h-full flex flex-col shadow-sm hover:shadow-md border dark:border-gray-700 overflow-hidden">
                                        {{-- Image --}}
                                        @if (!empty($cat->image_s))
                                            <img src="{{ Storage::url($cat->image_s) }}" alt=""
                                                class="w-full h-12 sm:h-16 object-contain mb-2 group-hover:scale-105 transition">
                                        @else
                                            <div class="w-full h-12 sm:h-16 mb-2 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                                {!! FD['brokenImageFront'] !!}
                                            </div>

                                            {{-- <div class="flex-1 flex items-center justify-center mb-2 bg-gradient-to-br from-blue-500 to-purple-500 text-white overflow-hidden">
                                                <span class="text-xs sm:text-sm font-bold">{{ $cat->title }}</span>
                                            </div>
                                            @php $cat->title = null; @endphp --}}
                                        @endif

                                        {{-- Title --}}
                                        @if (!empty($cat->title))
                                            <p class="text-[10px] sm:text-xs font-medium text-center line-clamp-2 text-gray-900 dark:text-white mb-0.5">
                                                {{ $cat->title }}
                                            </p>
                                        @endif

                                        {{-- Description --}}
                                        @if (!empty($cat->short_description))
                                            <p class="{{ FD['text-0'] }} sm:text-[10px] font-light text-center line-clamp-2 text-gray-500 dark:text-gray-500 leading-tight">
                                                {{ $cat->short_description }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif


                {{-- Sub categories --}}
                <div class="container mx-auto">
                    <div class="grid grid-cols-3 gap-2 sm:gap-4 lg:grid-cols-8">
                        @foreach ($children as $item)
                            <a href="{{ route('front.category.detail', $item->slug) }}" class="group block bg-white dark:bg-gray-800 {{ FD['rounded'] }} overflow-hidden shadow-sm hover:shadow-lg transition transform">
                                <div class="w-full h-20 overflow-hidden p-2">
                                    @if ($item->image_m)
                                        <img src="{{ Storage::url($item->image_m) }}" alt="{{ $item->slug }}" class="w-full h-full object-scale-down group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                                            {!! FD['brokenImageFront'] !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="p-2 text-center">
                                    <h3 class="text-[10px] sm:text-xs font-semibold text-gray-900 dark:text-gray-100">{{ $item->title }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ count($item->activeProducts) }} products</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


                {{-- Trending categories --}}
                {{-- <div class="bg-gradient-to-t from-sky-500 to-indigo-500 p-3 sm:p-4 {{ FD['rounded'] }} shadow">
                    <div class="flex items-center justify-between mb-2 sm:mb-3">
                        <h3 class="font-bold text-white text-sm sm:text-base">Trending categories</h3>
                        <!-- <a href="#" class="text-xs text-indigo-200 hover:text-white">View more</a> -->
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3">
                        @foreach($categories as $ind => $trenCategory)
                            <a href="{{ route('front.category.detail', $trenCategory->slug) }}" class="block">
                                <div class="bg-white dark:bg-gray-800 p-2 sm:p-3 {{ FD['rounded'] }} flex items-center gap-2 sm:gap-3 group hover:shadow-md transition-shadow">
                                    @if ($trenCategory->image_s)
                                        <img src="{{ Storage::url($trenCategory->image_s) }}" 
                                            alt="{{ $trenCategory->slug }}" 
                                            class="w-auto h-10 sm:h-12 object-cover {{ FD['rounded'] }} group-hover:scale-105 transition-transform">
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs sm:text-sm font-semibold truncate">{{ $trenCategory->title }}</p>
                                        @if ($trenCategory->short_description)
                                            <p class="{{ FD['text-0'] }} sm:text-[10px] mt-0.5 text-gray-500 dark:text-gray-400 line-clamp-1 sm:line-clamp-2 leading-tight">
                                                {{ $trenCategory->short_description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div> --}}


                {{-- Featured products --}}
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                            </div>

                            <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                                {{-- Product Card Component --}}
                                @foreach ($featuredProducts as $featuredItem)
                                    <x-front.product-card :product="$featuredItem->product" />
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif


            </main>
        </div>

        {{-- Proudly Indian --}}
        <x-front.proudly-indian />

        {{-- Homepage Ad 2 + Homepage Ad 3 --}}
        @if ($categoryPageAd1 || $categoryPageAd2)
            <section class="max-w-7xl grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-4 items-stretch">

                @if ($categoryPageAd1)
                    <x-ads.ad-set-2 :data="$categoryPageAd1" />
                @endif

                @if ($categoryPageAd2)
                    <x-ads.ad-set-3 :data="$categoryPageAd2" />
                @endif
            </section>
        @endif
    </div>

</x-guest-layout>
