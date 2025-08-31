<x-guest-layout
	screen="max-w-screen-xl"
	title="{{ __('Collection') }}">

	<!-- Breadcrumb + Page Title -->
	<div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">
        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><span class="text-gray-800 font-medium dark:text-gray-300">Collection</span></li>
                </ol>
            </nav>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4 items-center justify-between mt-2">
                <div class="col-span-1">
                    <h1 class="text-sm sm:text-lg font-bold text-gray-900 dark:text-white">{{ __('Explore collections') }}</h1>
                    <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">{{ __('Browse curated collections & featured product groups.') }}</p>
                </div>

                <div class="col-span-1 sm:col-start-3 justify-self-end w-full sm:w-auto overflow-hidden">
                    <form action="" method="GET">
                        <div class="flex flex-col sm:grid sm:grid-cols-8 items-center gap-2 sm:gap-4">
                            <div class="w-full sm:col-span-6">
                                <x-front.text-input id="search" class="block w-full" type="text" name="search" placeholder="Search collections..." value="{{ request('search') }}" maxlength="80" autocomplete="search" required />
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
                                <a href="{{ route('front.collection.index') }}" class="text-[10px] inline-flex gap-2 items-center text-end text-amber-800/80 hover:text-amber-800 dark:text-amber-600/80 dark:hover:text-amber-600">
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

		<section>
			{{-- <h2 class="text-sm font-semibold mb-3">Featured collections</h2> --}}

			<div class="grid gap-2 sm:gap-4 grid-cols-3 lg:grid-cols-6">
				@foreach($collections as $c)
					<a href="{{ route('front.collection.detail', $c->slug) }}" class="group block w-auto p-2 sm:p-4 {{ FD['rounded'] }} 
							bg-white dark:bg-slate-800 
							border border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 
							transform transition-all duration-300
							hover:shadow-lg 
							focus:outline-none focus:ring-2 focus:ring-indigo-500">
						<div class="w-full overflow-hidden {{ FD['rounded'] }}">
							@if (!empty($c->image_m))
								<img class="w-full h-20 sm:h-36 object-contain {{ FD['rounded'] }} transition-transform duration-300 group-hover:scale-105" src="{{ $c->image_m }}" alt="{{ $c->slug }}">
							@else
								<div class="w-full h-20 sm:h-36 flex items-center justify-center text-gray-400 dark:text-gray-500">
									{!! FD['brokenImageFront'] !!}
								</div>
							@endif
						</div>

						<h3 class="{{ FD['text'] }} sm:text-sm font-medium mt-2 truncate">{{ $c->title }}</h3>
						<p class="{{ FD['text-0'] }} sm:text-xs mt-1 text-slate-500 dark:text-slate-400">{{ $c->count }} products</p>
					</a>
				@endforeach
			</div>
		</section>

		{{-- MASONRY LAYOUT --}}
		<section class="">
			<header class="mb-4">
				<h1 class="text-sm sm:text-lg font-bold text-gray-900 dark:text-white">{{ __('Recommended for you') }}</h1>
				<p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">{{ __('Handpicked offers & promos — one glance, many irresistible deals.') }}</p>
			</header>

			<x-ads.ad-set-masonry-1 />
		</section>

		{{-- ADS --}}
		<section>
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
				<div class="flex">
					<x-ads.ad-set-5 />
				</div>

				<div class="flex">
					<x-ads.ad-set-6 />
				</div>
			</div>
		</section>

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
							<x-front.product-card :product="$featuredItem" />
						@endforeach
					</div>
				</div>
			</section>
		@endif
	</div>

</x-guest-layout>