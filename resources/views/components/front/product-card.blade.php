@props([
	'product',
	'showAddToCart' => false
])

<article
	class="{{ FD['rounded'] }} group relative overflow-hidden border bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 shadow-sm hover:shadow-lg transition border-gray-200 dark:border-gray-700 hover:border-slate-300 hover:dark:border-slate-600"
	role="article"
	aria-labelledby="product-{{ $product->id }}-title"
>
	{{-- product link wraps image + content; make it a stacking root at z-0 --}}
	<a href="{{ route('front.product.detail', $product->slug) }}"
		class="block relative z-0"
	>
		{{-- image area (transforms create stacking context here) --}}
		<div class="w-full h-44 md:h-48 bg-gray-100 dark:bg-gray-900/20 {{ FD['rounded'] }} overflow-hidden flex items-center justify-center">
			@if (count($product->activeImages) > 0)
				<img
					src="{{ Storage::url($product->activeImages[0]->image_m) }}"
					alt="{{ $product->slug }}"
					loading="lazy"
					class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
				/>
			@else
				<div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
					{!! FD['brokenImageFront'] !!}
				</div>
			@endif
		</div>

		{{-- title --}}
		<h3 id="product-{{ $product->id }}-title" class="mt-3 text-xs font-medium text-gray-900 dark:text-gray-100 leading-tight truncate">
			{{ $product->title }}
		</h3>

		{{-- short description --}}
		@if(!empty($product->short_description))
			<p class="mt-1 text-[10px] text-gray-500 dark:text-gray-400 line-clamp-1 leading-tight">{{ $product->short_description }}</p>
		@endif

		{{-- price row --}}
		@if ( !empty($product->FDPricing) )
			@php
				$p = $product->FDPricing;
				$currencySymbol = $p->country->currency_symbol;
			@endphp

			<div class="mt-3 flex items-center justify-between gap-2">
				<div>
					<div class="{{ FD['text-2'] }} font-extrabold text-gray-900 dark:text-white leading-none">
						<span class="currency-icon">{{ $currencySymbol }}</span>{{ formatIndianMoney($p->selling_price) }}
					</div>
					<div class="mt-1 flex items-center gap-2">
						@if($p->mrp && $p->mrp > 0)
							<span class="text-xs text-gray-400 dark:text-gray-400 line-through">
								<span class="currency-icon">{{ $currencySymbol }}</span>{{ formatIndianMoney($p->mrp) }}
							</span>
							<span class="text-xs font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
								{{ $p->discount }}% off
							</span>
						@endif
					</div>
				</div>
			</div>
		@endif
	</a>

	{{-- badges (kept outside <a>) --}}
	<div class="absolute inset-x-2 top-2 flex justify-between z-1 pointer-events-none items-center">
		{{-- rating pill --}}
		@if ($product->average_rating > 0)
			{!! frontRatingHtml($product->average_rating) !!}
		@endif

		{{-- wishlist --}}
		<button
			type="button"
			class="wishlist-btn pointer-events-auto ml-auto inline-flex items-center justify-center p-1.5 rounded-full
					bg-white/90 dark:bg-gray-900/60 hover:bg-red-600/10 dark:hover:bg-red-600/40
					outline-none focus:outline-none
					focus-visible:ring-2 focus-visible:ring-red-500 dark:focus-visible:ring-red-400
					focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-offset-gray-900
					transition-colors"
			aria-pressed="{{ !empty($product->wishlisted) ? 'true' : 'false' }}"
			aria-label="Toggle wishlist for {{ $product->title }}"
			data-prod-id="{{ $product->id }}"
			>
			<svg class="w-4 h-4 transition-colors" viewBox="0 0 24 24" fill="{{ !empty($product->wishlisted) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
			</svg>
		</button>
	</div>

	{{-- add to cart (optional) --}}
	@if($showAddToCart)
		<div class="mt-3">
			@if (empty($product->variations) || count($product->variations) == 0)
				<button
					type="button"
					class="w-full relative inline-flex justify-center items-center gap-3 {{ FD['rounded'] }} 
						px-2 py-1 md:px-4 md:py-2 
						text-sm font-bold 
						bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 *:
						text-gray-900 shadow-lg shadow-amber-300/30 dark:shadow-amber-900/40 
						transform transition-all duration-180 
						focus:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/40 focus-visible:ring-offset-1 *:
						disabled:opacity-60 disabled:cursor-not-allowed add-to-cart"
						aria-label="Add to cart"
						data-prod-id="{{$product->id}}" 
						data-purchase-type="cart"
						data-variation-data="{{ json_encode($variation['data']['combinations'] ?? []) }}"
					>

					<span class="buttonIcon flex-none flex items-center justify-center">
						<div class="w-5 h-5">
							<svg viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.00024000000000000003" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" fill="#000000"></path> <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" fill="#000000"></path> <path opacity="0.5" d="M2.08368 2.7512C2.22106 2.36044 2.64921 2.15503 3.03998 2.29242L3.34138 2.39838C3.95791 2.61511 4.48154 2.79919 4.89363 3.00139C5.33426 3.21759 5.71211 3.48393 5.99629 3.89979C6.27827 4.31243 6.39468 4.76515 6.44841 5.26153C6.47247 5.48373 6.48515 5.72967 6.49184 6H17.1301C18.815 6 20.3318 6 20.7757 6.57708C21.2197 7.15417 21.0461 8.02369 20.699 9.76275L20.1992 12.1875C19.8841 13.7164 19.7266 14.4808 19.1748 14.9304C18.6231 15.38 17.8426 15.38 16.2816 15.38H10.9787C8.18979 15.38 6.79534 15.38 5.92894 14.4662C5.06254 13.5523 4.9993 12.5816 4.9993 9.64L4.9993 7.03832C4.9993 6.29837 4.99828 5.80316 4.95712 5.42295C4.91779 5.0596 4.84809 4.87818 4.75783 4.74609C4.66977 4.61723 4.5361 4.4968 4.23288 4.34802C3.91003 4.18961 3.47128 4.03406 2.80367 3.79934L2.54246 3.7075C2.1517 3.57012 1.94629 3.14197 2.08368 2.7512Z" fill="#000000"></path> <path d="M13.75 9C13.75 8.58579 13.4142 8.25 13 8.25C12.5858 8.25 12.25 8.58579 12.25 9V10.25H11C10.5858 10.25 10.25 10.5858 10.25 11C10.25 11.4142 10.5858 11.75 11 11.75H12.25V13C12.25 13.4142 12.5858 13.75 13 13.75C13.4142 13.75 13.75 13.4142 13.75 13V11.75H15C15.4142 11.75 15.75 11.4142 15.75 11C15.75 10.5858 15.4142 10.25 15 10.25H13.75V9Z" fill="#000000"></path> </g></svg>
						</div>
					</span>

					<span class="buttonLoader hidden">
						<div class="flex-none flex items-center justify-center">
							<div class="w-5 h-5">
								<svg class="animate-spin" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M18.364 5.636L16.95 7.05A7 7 0 1 0 19 12h2a9 9 0 1 1-2.636-6.364z"></path> </g> </g></svg>
							</div>
						</div>
					</span>

					<span class="buttonLabel">Add to Cart</span>
				</button>
			@else
				<a href="{{ route('front.product.detail', $product->slug) }}" class="w-full {{ FD['rounded'] }} bg-indigo-600 hover:bg-indigo-700 text-white text-sm py-2 font-medium text-center block">View details</a>
			@endif
		</div>
	@endif
</article>
