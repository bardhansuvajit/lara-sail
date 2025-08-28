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
			@php
				$mockCollections = [
					(object)['id'=>1,'name'=>'Fresh Produce','count'=>28,'image'=>'https://dummyimage.com/600x400/10b981/ffffff&text=Produce'],
					(object)['id'=>2,'name'=>'Home & Kitchen','count'=>42,'image'=>'https://dummyimage.com/600x400/6366f1/ffffff&text=Home'],
					(object)['id'=>3,'name'=>'Electronics','count'=>18,'image'=>'https://dummyimage.com/600x400/f59e0b/ffffff&text=Electronics'],
					(object)['id'=>4,'name'=>'Fashion','count'=>55,'image'=>'https://dummyimage.com/600x400/ef4444/ffffff&text=Fashion'],
					(object)['id'=>5,'name'=>'Fitness','count'=>14,'image'=>'https://dummyimage.com/600x400/06b6d4/ffffff&text=Fitness'],
					(object)['id'=>6,'name'=>'Beauty','count'=>9,'image'=>'https://dummyimage.com/600x400/f472b6/ffffff&text=Beauty'],
				];
			@endphp

			{{-- <h2 class="text-sm font-semibold mb-3">Featured collections</h2> --}}

			<div class="grid gap-2 sm:gap-4 grid-cols-3 lg:grid-cols-6">
				@foreach($mockCollections as $c)
					<a href="#" class="group block w-auto p-2 sm:p-4 {{ FD['rounded'] }} 
							bg-white dark:bg-slate-800 
							border border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 
							transform transition-all duration-300
							hover:shadow-lg 
							focus:outline-none focus:ring-2 focus:ring-indigo-500">
						<div class="w-full overflow-hidden {{ FD['rounded'] }}">
							<img class="w-full h-20 sm:h-36 object-contain {{ FD['rounded'] }} transition-transform duration-300 group-hover:scale-105" src="{{ $c->image }}" alt="{{ $c->name }}">
						</div>

						<h3 class="{{ FD['text'] }} sm:text-sm font-medium mt-2 truncate">{{ $c->name }}</h3>
						<p class="{{ FD['text-0'] }} sm:text-xs mt-1 text-slate-500 dark:text-slate-400">{{ $c->count }} products</p>
					</a>
				@endforeach
			</div>
		</section>

		<section class="">
			<header class="mb-4">
				<h2 class="text-lg font-semibold">Recommended for you</h2>
				<p class="text-xs text-slate-500 dark:text-slate-400">Handpicked offers & promos — one glance, many irresistible deals.</p>
			</header>

			<!-- MASONRY LAYOUT -->
			<div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-2 sm:gap-4">
				<!-- MEGA DEAL -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group">
					<img src="https://dummyimage.com/800x400/0ea5a4/ffffff&text=Mega+Deal" alt="Mega Deal" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
					<div class="p-2 sm:p-4">
						<h3 class="text-base font-semibold">Mega Deal — Up to <span class="text-yellow-300">70% OFF</span></h3>
						<p class="text-xs text-slate-500 dark:text-slate-300 mt-1 line-clamp-2">Selected categories. Limited stock — hurry! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus voluptate iusto rerum voluptatem architecto nostrum cumque totam amet distinctio minus?</p>
						<div class="mt-3 flex items-center gap-3">
						<span class="inline-flex items-center text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }} bg-teal-600">
							<svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z"/></svg>
							Shop now
						</span>
						<span class="text-xs text-white/90 bg-slate-900/80 dark:bg-white/10 px-2 py-1 {{ FD['rounded'] }}">Use code: SUMMER70</span>
						</div>
					</div>
				</a>

				<!-- SPONSORED BRAND -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group mt-2 sm:mt-4 mb-2 sm:mb-0">
					<img src="https://dummyimage.com/1200x400/94a3b8/ffffff&text=Sponsored+Brand" alt="Sponsored Brand" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
					<div class="p-2 sm:p-4">
						<h4 class="text-sm font-semibold">Sponsored brand — extra 20% off</h4>
						<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Click to reveal limited coupons & offers.</p>
						<div class="mt-3">
							<span class="text-xs text-white bg-red-600 px-3 py-2 {{ FD['rounded'] }}">Reveal coupon</span>
						</div>
					</div>
				</a>

				<!-- BRAND STORY -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group mb-2 sm:mb-0">
					<img src="https://dummyimage.com/600x800/6366f1/ffffff&text=Brand+Story" alt="Brand Story" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
					<div class="p-2 sm:p-4">
						{{-- <h3 class="text-base font-semibold">Brand Story — New Collection</h3> --}}
						<p class="text-xs sm:text-[10px] text-slate-500 dark:text-slate-300">Sustainably made — feel good shopping. Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, saepe?</p>
						<div class="mt-[0.6rem] flex items-center gap-2">
							<span class="text-xs px-3 py-2 border {{ FD['rounded'] }} text-slate-700 dark:text-slate-200">Explore</span>
						</div>
					</div>
				</a>

				<!-- COUPON -->
				{{-- <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden p-3 bg-gradient-to-r from-amber-50 to-white dark:from-amber-900 dark:to-amber-700 border border-slate-200 dark:border-slate-700">
					<div class="flex items-center gap-3">
						<img src="https://dummyimage.com/200x120/94a3b8/ffffff&text=Coupon" alt="Coupon" class="w-24 h-16 object-cover rounded" loading="lazy" />
						<div>
						<h4 class="text-sm font-semibold">Extra 15% off — code: EXTRA15</h4>
						<p class="text-xs text-slate-600 dark:text-slate-300 mt-1">Applies on ₹1499+. Limited time.</p>
						</div>
						<div class="ml-auto">
						<span class="text-xs bg-slate-900/90 text-white px-3 py-2 rounded">Use Code</span>
						</div>
					</div>
				</a> --}}

				<!-- FLASH -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 p-2 sm:p-4 shadow-sm hover:shadow-md">
					<div class="flex items-center gap-3">
						<img src="https://dummyimage.com/150x150/10b981/ffffff&text=Flash" alt="Flash" class="w-20 h-20 object-cover {{ FD['rounded'] }}" loading="lazy" />
						<div>
							<h5 class="text-sm font-semibold">Flash Deal — 4 hours left</h5>
							<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Extra 25% off on essentials.</p>
							<div class="text-xs bg-red-600 text-white px-2 py-1 {{ FD['rounded'] }} w-fit mt-3">Buy Now</div>
						</div>
						{{-- <div class="ml-auto text-xs bg-red-600 text-white px-2 py-1 rounded">Buy Now</div> --}}
					</div>
				</a>

				<!-- GRID COLLAGE -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 my-2 sm:my-4">
					<div class="grid grid-cols-2 gap-2 sm:gap-1">
						<img src="https://dummyimage.com/400x300/f59e0b/ffffff&text=1" alt="1" class="w-full h-28 object-cover" loading="lazy" />
						<img src="https://dummyimage.com/400x300/ef4444/ffffff&text=2" alt="2" class="w-full h-28 object-cover" loading="lazy" />
						<img src="https://dummyimage.com/400x300/06b6d4/ffffff&text=3" alt="3" class="w-full h-28 object-cover" loading="lazy" />
						<img src="https://dummyimage.com/400x300/6366f1/ffffff&text=4" alt="4" class="w-full h-28 object-cover" loading="lazy" />
					</div>
					<div class="p-2 sm:p-4">
						<h4 class="text-base font-semibold text-center">Bundle picks — curated sets</h4>
						{{-- <p class="{{ FD['text'] }} text-slate-500 dark:text-slate-300 mt-1">Mix & match and save more.</p> --}}
						{{-- <div class="mt-3">
							<span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">View bundles</span>
						</div> --}}
					</div>
				</a>

				<!-- APP DEALS -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden p-2 sm:p-4 bg-white dark:bg-slate-800 mb-2 sm:mb-0">
					<div class="flex items-center gap-3">
						<div class="w-12 h-12 {{ FD['rounded'] }} bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-sm font-bold">
							App
						</div>
						<div class="flex-1">
							<h5 class="text-sm font-semibold">App-only deals</h5>
							<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Download & save extra 10%.</p>
						</div>
						<div>
							<span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }} flex items-center gap-2">
								<div class="{{ FD['iconClass'] }}">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M419-80q-28 0-52.5-12T325-126L107-403l19-20q20-21 48-25t52 11l74 45v-328q0-17 11.5-28.5T340-760q17 0 29 11.5t12 28.5v472l-97-60 104 133q6 7 14 11t17 4h221q33 0 56.5-23.5T720-240v-160q0-17-11.5-28.5T680-440H461v-80h219q50 0 85 35t35 85v160q0 66-47 113T640-80H419ZM167-620q-13-22-20-47.5t-7-52.5q0-83 58.5-141.5T340-920q83 0 141.5 58.5T540-720q0 27-7 52.5T513-620l-69-40q8-14 12-28.5t4-31.5q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 17 4 31.5t12 28.5l-69 40Zm335 280Z"/></svg>
								</div>
								Get App
							</span>
						</div>
					</div>
				</a>

				<!-- NEW ARRIVALS -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 transition-transform duration-300 group">
					<!-- Image -->
					<div class="relative">
						<img src="https://dummyimage.com/600x500/94a3b8/ffffff&text=New+Arrivals"
							alt="New Arrivals"
							class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300"
							loading="lazy" />

						<!-- Floating badge -->
						<span class="absolute top-2 left-2 text-[10px] font-medium px-2 py-0.5 {{ FD['rounded'] }} bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow">
							New
						</span>
					</div>

					<!-- Content -->
					<div class="p-3 sm:p-4">
						<h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100">
							New Arrivals
						</h3>
						<p class="text-xs mt-[0.3rem] text-slate-500 dark:text-slate-300 leading-snug line-clamp-3">
							Fresh styles added today. Free returns within 30 days. Lorem ipsum dolor sit amet.
						</p>
					</div>
				</a>

				{{-- <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800">
					<img src="https://dummyimage.com/600x500/94a3b8/ffffff&text=New+Arrivals" alt="New Arrivals" class="w-full h-auto object-cover" loading="lazy" />
					<div class="p-2 sm:p-4">
						<div class="flex items-center gap-2">
							<span class="text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded">New</span>
						</div>
						<p class="text-[10px] text-slate-500 dark:text-slate-300 mt-[0.6rem] line-clamp-2">Fresh styles added today. Free returns within 30 days. Lorem ipsum dolor sit amet.</p>
					</div>
				</a> --}}

				<!-- SAVE 50 -->
				<a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group mt-2 sm:mt-4">
					<img src="https://dummyimage.com/600x300/94a3b8/ffffff&text=Save+50" alt="Save 50" class="w-full h-auto object-contain transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
				</a>
			</div>
		</section>

		<section>
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
				<a href="#" class="block {{ FD['rounded'] }} overflow-hidden relative group">
					<img src="https://dummyimage.com/1200x420/0ea5a4/ffffff&text=Mega+Summer+Sale" alt="Mega Summer Sale" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-300" />
					<div class="absolute inset-0 bg-gradient-to-r from-black/30 to-black/10 dark:from-black/40 dark:to-black/10 flex items-center">
						<div class="p-6 md:p-10 max-w-2xl">
							<h3 class="text-lg font-bold text-white">Mega Summer Sale — Up to <span class="text-yellow-300">70% OFF</span></h3>
							<p class="text-xs text-white/90 mt-2">Top brands, limited stock. Free express delivery on orders above ₹999.</p>
							<div class="mt-4 flex items-center gap-3">
								<span class="inline-flex items-center px-3 py-2 {{ FD['rounded'] }} bg-yellow-400 text-black text-sm font-semibold">Grab the Deal</span>
								<span class="text-xs text-white/80">Use code: <strong>SUMMER70</strong></span>
							</div>
						</div>
					</div>
				</a>

				<a href="#" class="block md:flex items-stretch gap-4 {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 hover:shadow-lg transition">
    
					<!-- Image -->
					<img src="https://dummyimage.com/500x500/ef4444/ffffff&text=Top+Pick"
						alt="Top Pick"
						class="w-full md:w-1/3 h-full object-cover" />

					<!-- Content -->
					<div class="p-4 flex-1 flex flex-col">
						
						<!-- Title -->
						<h4 class="text-sm font-semibold">Editor's Pick — Smart Wireless Earbuds</h4>
						<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">
							Clear bass, 30hr battery, now at an unbeatable price.
						</p>

						<!-- Ratings -->
						<div class="flex items-center gap-1 mt-2">
							<span class="text-yellow-400">★ ★ ★ ★ ☆</span>
							<span class="text-xs text-slate-400">(4.2k reviews)</span>
						</div>

						<!-- Pricing -->
						<div class="mt-3 flex items-center gap-3">
							<div class="flex gap-4">
								<div class="text-sm font-semibold">₹ 1,499</div>
								<div class="text-xs text-slate-400 line-through">₹ 4,299</div>
							</div>
							<div class="ml-auto text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded">65% OFF</div>
						</div>

						<!-- Extra Info -->
						<div class="mt-3 flex flex-wrap items-center gap-2 text-[11px] text-slate-500 dark:text-slate-300">
							<span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">🚚 Free Delivery</span>
							<span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">⏰ Only 12 left</span>
							<span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">🛡 1-Year Warranty</span>
						</div>

						<!-- Actions -->
						<div class="mt-4 flex items-center gap-2">
							<span class="cursor-pointer text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }} hover:opacity-90">Add to Cart</span>
							<span class="cursor-pointer text-xs px-3 py-2 border {{ FD['rounded'] }} text-slate-600 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">Quick View</span>
						</div>
					</div>
				</a>

			</div>
		</section>


		<div class="grid grid-cols-1 gap-6">

			<!-- Ads container -->
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

			<!-- 1) Full-width hero / feature ad (high visual impact) -->
			<a href="#" class="block {{ FD['rounded'] }} overflow-hidden relative group">
				<img src="https://dummyimage.com/1200x420/0ea5a4/ffffff&text=Mega+Summer+Sale" alt="Mega Summer Sale" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-300" />
				<div class="absolute inset-0 bg-gradient-to-r from-black/30 to-black/10 dark:from-black/40 dark:to-black/10 flex items-center">
				<div class="p-6 md:p-10 max-w-2xl">
					<h3 class="text-lg font-bold text-white">Mega Summer Sale — Up to <span class="text-yellow-300">70% OFF</span></h3>
					<p class="text-xs text-white/90 mt-2">Top brands, limited stock. Free express delivery on orders above ₹999.</p>
					<div class="mt-4 flex items-center gap-3">
					<span class="inline-flex items-center px-3 py-2 {{ FD['rounded'] }} bg-yellow-400 text-black text-sm font-semibold">Grab the Deal</span>
					<span class="text-xs text-white/80">Use code: <strong>SUMMER70</strong></span>
					</div>
				</div>
				</div>
			</a>

			<!-- 2) Product spotlight card (image + coupon) -->
			<a href="#" class="block md:flex items-stretch gap-4 {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
				<img src="https://dummyimage.com/600x400/ef4444/ffffff&text=Top+Pick" alt="Top Pick" class="w-full md:w-1/3 h-44 object-cover" />
				<div class="p-4 flex-1">
				<h4 class="text-sm font-semibold">Editor's Pick — Smart Wireless Earbuds</h4>
				<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Clear bass, 30hr battery, now at an unbeatable price.</p>

				<div class="mt-3 flex items-center gap-3">
					<div>
					<div class="text-sm font-semibold">₹ 1,499</div>
					<div class="text-xs text-slate-400 line-through">₹ 4,299</div>
					</div>
					<div class="ml-auto text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded">65% OFF</div>
				</div>

				<div class="mt-4 flex items-center gap-2">
					<span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">Add to Cart</span>
					<span class="text-xs px-3 py-2 border {{ FD['rounded'] }} text-slate-600 dark:text-slate-200">Quick view</span>
				</div>
				</div>
			</a>

			<!-- 3) Bundle deal card (multi-product + urgency) -->
			<a href="#" class="block {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4">
				<div class="flex items-start gap-4">
				<div class="grid grid-cols-3 gap-2 w-28">
					<img src="https://dummyimage.com/120x120/6366f1/ffffff&text=A" alt="item A" class="w-full h-20 object-cover rounded" />
					<img src="https://dummyimage.com/120x120/f59e0b/ffffff&text=B" alt="item B" class="w-full h-20 object-cover rounded" />
					<img src="https://dummyimage.com/120x120/06b6d4/ffffff&text=C" alt="item C" class="w-full h-20 object-cover rounded" />
				</div>
				<div class="flex-1">
					<h4 class="text-sm font-semibold">Family Bundle — Breakfast + Snacks</h4>
					<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">3 bestselling items bundled with free priority shipping.</p>

					<div class="mt-3 flex items-center gap-3">
					<div class="text-sm font-semibold">₹ 899</div>
					<div class="text-xs text-slate-400 line-through">₹ 1,499</div>
					<div class="ml-auto text-xs text-white bg-red-500 px-2 py-1 rounded">Limited — 24 left</div>
					</div>

					<div class="mt-3 flex items-center gap-2">
					<span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">Buy Bundle</span>
					<span class="text-xs text-slate-500 dark:text-slate-300">Or add items separately</span>
					</div>
				</div>
				</div>
			</a>

			<!-- 4) Flash deal small card (great for sidebars or grid interleaving) -->
			<a href="#" class="block {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-3 shadow-sm hover:shadow-md">
				<div class="flex items-center gap-3">
				<img src="https://dummyimage.com/120x120/10b981/ffffff&text=Flash" alt="Flash deal" class="w-20 h-20 object-cover rounded" />
				<div class="flex-1">
					<h5 class="text-sm font-semibold">Flash Deal — 4 hours left</h5>
					<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Extra 25% off on daily essentials.</p>
					<div class="mt-2 flex items-center gap-2">
					<div class="text-sm font-semibold">₹ 249</div>
					<div class="text-xs text-slate-400 line-through">₹ 399</div>
					</div>
				</div>
				<div class="text-xs text-white bg-red-600 px-2 py-1 rounded">Buy Now</div>
				</div>
			</a>

			<!-- 5) Coupon strip (great for high CTR and mobile) -->
			<a href="#" class="block {{ FD['rounded'] }} overflow-hidden p-3 bg-gradient-to-r from-amber-50 to-white dark:from-amber-900 dark:to-amber-700 border border-slate-200 dark:border-slate-700">
				<div class="flex items-center gap-4">
				<img src="https://dummyimage.com/200x120/94a3b8/ffffff&text=Coupon" alt="Coupon offer" class="w-24 h-16 object-cover rounded" />
				<div>
					<h5 class="text-sm font-semibold">Exclusive Coupon — EXTRA15</h5>
					<p class="text-xs mt-1 text-slate-600 dark:text-slate-300">Use EXTRA15 to get an extra 15% off on cart value above ₹1499. Limited time.</p>
				</div>
				<div class="ml-auto text-sm font-semibold bg-slate-900/90 text-white px-3 py-2 rounded">Use Code</div>
				</div>
			</a>

			<!-- 6) Attractive brand tile (image-first, with brand logo and CTA) -->
			<a href="#" class="block {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
				<div class="relative">
				<img src="https://dummyimage.com/1200x600/111827/ffffff&text=Brand+Week" alt="Brand Week" class="w-full h-44 object-cover" />
				<div class="absolute inset-0 flex items-end p-4">
					<div class="bg-white/90 dark:bg-slate-900/80 {{ FD['rounded'] }} p-3 w-full md:w-1/2">
					<div class="flex items-center gap-3">
						<div class="w-10 h-10 {{ FD['rounded'] }} bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-sm font-bold">B</div>
						<div>
						<h5 class="text-sm font-semibold">Brand Week — Selected Styles</h5>
						<p class="text-xs text-slate-600 dark:text-slate-300 mt-1">Extra 10% off for members. Free returns.</p>
						</div>
					</div>
					<div class="mt-3 flex items-center gap-2">
						<span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">Shop Brand</span>
						<span class="text-xs text-slate-500 dark:text-slate-300">Earn 2x points</span>
					</div>
					</div>
				</div>
				</div>
			</a>

			</div>


			<!-- High-converting ad strip (above products) - using Pexels imagery for visual appeal -->
			{{-- <div class="mb-6">
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
				<a href="#" class="group block {{ FD['rounded'] }} overflow-hidden shadow-sm hover:shadow-md bg-gradient-to-r from-indigo-600 to-emerald-500">
					<img src="https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" alt="Home essentials" class="w-full h-28 object-cover opacity-90 group-hover:opacity-100" />
					<div class="p-4 bg-white/5 text-white">
					<h3 class="text-sm font-semibold">Home Essentials — Up to 50% off</h3>
					<p class="text-xs mt-1">Limited stock. Fast delivery.</p>
					</div>
				</a>

				<a href="#" class="group block {{ FD['rounded'] }} overflow-hidden shadow-sm hover:shadow-md border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
					<img src="https://images.pexels.com/photos/3952046/pexels-photo-3952046.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" alt="Subscribe & save" class="w-full h-28 object-cover" />
					<div class="p-4">
					<h3 class="text-sm font-semibold">Subscribe & Save</h3>
					<p class="text-xs mt-1">Auto-reorders with extra 10% off.</p>
					</div>
				</a>

				<a href="#" class="group block {{ FD['rounded'] }} overflow-hidden shadow-sm hover:shadow-md border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
					<img src="https://images.pexels.com/photos/6078123/pexels-photo-6078123.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" alt="Trending gadgets" class="w-full h-28 object-cover" />
					<div class="p-4">
					<h3 class="text-sm font-semibold">Trending Gadgets</h3>
					<p class="text-xs mt-1">New arrivals daily.</p>
					</div>
				</a>
				</div>
			</div> --}}

			<!-- Main product area with in-grid ad tiles -->
			{{-- <section>
				<div class="flex items-center justify-between mb-3">
				<h2 class="text-sm font-semibold">Products</h2>

				@php
					// Mock products as PHP array (server-side rendering - no JS needed)
					$mockProducts = [];
					for ($i = 1; $i <= 28; $i++) {
					$mockProducts[] = (object)[
						'id' => $i,
						'title' => "Product $i",
						'collection' => $mockCollections[$i % count($mockCollections)]->name,
						'price' => number_format(rand(500,25000)/100, 2),
						'oldPrice' => rand(0,10) > 6 ? number_format(rand(700,30000)/100, 2) : null,
						'rating' => number_format(rand(30,50)/10, 1),
						'reviews' => rand(0,500),
						'image' => "https://dummyimage.com/600x400/" . sprintf('%06d', rand(100000,999999)) . "/ffffff&text=P$i",
						'sponsored' => rand(0,100) > 85
					];
					}

					$perPage = (int) request()->get('perpage', 12);
					$page = max(1, (int) request()->get('page', 1));
					$total = count($mockProducts);
					$start = ($page -1) * $perPage;
					$pageItems = array_slice($mockProducts, $start, $perPage);
					$maxPage = (int) ceil($total / $perPage);
				@endphp

				<div class="text-xs text-slate-500">Showing <strong>{{ $start + 1 }}</strong> - <strong>{{ $start + count($pageItems) }}</strong> of <strong>{{ $total }}</strong></div>
				</div>

				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
				@foreach($pageItems as $idx => $p)
					<!-- Product Card -->
					<article class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 {{ FD['rounded'] }} overflow-hidden flex flex-col transition-shadow hover:shadow-lg">
					<div class="relative group">
						<a href="#" class="block">
						<img class="w-full h-48 md:h-44 object-cover transform transition-transform duration-300 group-hover:scale-105" src="{{ $p->image }}" alt="{{ $p->title }}" />
						</a>

						@if($p->sponsored)
						<span class="absolute top-3 left-3 bg-yellow-400 text-black text-[10px] font-semibold px-2 py-1 rounded">Sponsored</span>
						@endif

						<a href="#" class="absolute top-3 right-3 p-1 {{ FD['rounded'] }} bg-white/90 dark:bg-slate-900/70 hover:scale-110">
						<!-- Heart icon -->
						<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M20.8 8.6a5 5 0 0 0-7.07 0L12 10.34l-1.73-1.73a5 5 0 0 0-7.07 7.07L12 21.2l8.8-5.53a5 5 0 0 0 0-7.07z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						</a>
					</div>

					<div class="p-3 flex-1 flex flex-col">
						<h3 class="text-sm font-medium line-clamp-2"><a href="#" class="hover:underline">{{ $p->title }}</a></h3>
						<p class="text-xs text-slate-500 dark:text-slate-300 mt-1">{{ $p->collection }}</p>

						<div class="mt-3 flex items-center justify-between">
						<div>
							<div class="text-sm font-semibold">₹ {{ $p->price }}</div>
							@if($p->oldPrice)
							<div class="text-xs text-slate-400 line-through">₹ {{ $p->oldPrice }}</div>
							@endif
						</div>
						<div class="text-xs text-slate-500 dark:text-slate-300 flex items-center gap-1">
							<svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.3l6.18 3.7-1.64-7.03L21 9.24l-7.19-.62L12 2 10.19 8.62 3 9.24l4.46 4.73L5.82 21z" stroke="currentColor" stroke-width="0.8" stroke-linejoin="round" /></svg>
							{{ $p->rating }} ({{ $p->reviews }})
						</div>
						</div>

						<div class="mt-3 flex items-center gap-2">
						<a href="#" class="flex-1 text-sm py-2 {{ FD['rounded'] }} bg-brand text-white text-center">Add to cart</a>
						<a href="#" class="p-2 {{ FD['rounded'] }} border border-slate-200 dark:border-slate-700 text-center">🔍</a>
						</div>
					</div>
					</article>

					@if(($idx + 1) % 4 === 0)
					<a href="#" class="block {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md col-span-full">
						<img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" class="w-full h-44 object-cover" alt="Sponsored Brand Offer" />
						<div class="p-3">
						<h4 class="text-sm font-semibold">Sponsored brand — extra 20% off</h4>
						<p class="text-xs text-slate-500 mt-1">Click to reveal limited coupons</p>
						</div>
					</a>
					@endif

				@endforeach
				</div>

				<!-- Pagination (server-side query param links) -->
				<div class="mt-6 flex items-center justify-between">
				<div class="flex items-center gap-2">
					@php
					$prevPage = $page > 1 ? $page - 1 : null;
					$nextPage = $page < $maxPage ? $page + 1 : null;
					$query = request()->query();
					@endphp

					@if($prevPage)
					@php $query['page'] = $prevPage; @endphp
					<a href="?{{ http_build_query($query) }}" class="px-3 py-1 text-sm border {{ FD['rounded'] }} bg-white dark:bg-slate-800">Prev</a>
					@else
					<span class="px-3 py-1 text-sm border {{ FD['rounded'] }} text-slate-400">Prev</span>
					@endif

					@if($nextPage)
					@php $query['page'] = $nextPage; @endphp
					<a href="?{{ http_build_query($query) }}" class="px-3 py-1 text-sm border {{ FD['rounded'] }} bg-white dark:bg-slate-800">Next</a>
					@else
					<span class="px-3 py-1 text-sm border {{ FD['rounded'] }} text-slate-400">Next</span>
					@endif
				</div>

				<div>
					<label class="text-xs mr-2">Per page</label>
					<form method="get" class="inline-block">
					@foreach(request()->except('perpage') as $k => $v)
						<input type="hidden" name="{{ $k }}" value="{{ $v }}" />
					@endforeach
					<select name="perpage" onchange="this.form.submit()" class="text-sm border border-slate-200 dark:border-slate-700 {{ FD['rounded'] }} px-2 py-1 bg-white dark:bg-slate-800">
						<option {{ $perPage == 12 ? 'selected' : '' }}>12</option>
						<option {{ $perPage == 24 ? 'selected' : '' }}>24</option>
						<option {{ $perPage == 48 ? 'selected' : '' }}>48</option>
					</select>
					</form>
				</div>
				</div>

			</section> --}}

			<!-- Bottom ad — sticky CTA for mobile users -->
			{{-- <div class="mt-8 lg:hidden">
				<a href="#" class="flex items-center justify-between bg-brand text-white px-4 py-3 {{ FD['rounded'] }} shadow-lg">
				<div>
					<div class="text-sm font-semibold">App-only deal: Extra 15% off</div>
					<p class="text-xs">Download our app & unlock coupons</p>
				</div>
				<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				</a>
			</div> --}}
		</div>
	</div>

</x-guest-layout>