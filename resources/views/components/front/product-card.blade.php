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
					class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105"
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
			<p class="mt-1 text-[10px] text-gray-500 dark:text-gray-400 line-clamp-2 leading-tight">{{ $product->short_description }}</p>
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
					class="w-full {{ FD['rounded'] }} bg-indigo-600 hover:bg-indigo-700 text-white text-sm py-2 font-medium focus:outline-none focus:ring-3 focus:ring-indigo-500/30 transition add-to-cart"
					data-prod-id="{{ $product->id }}"
					data-purchase-type="cart"
				>Add to cart</button>
			@else
				<a href="{{ route('front.product.detail', $product->slug) }}" class="w-full {{ FD['rounded'] }} bg-indigo-600 hover:bg-indigo-700 text-white text-sm py-2 font-medium text-center block">View details</a>
			@endif
		</div>
	@endif
</article>
