@props([
	'product',
	'showAddToCart' => false
])

<article
	class="{{ FD['rounded'] }} group relative overflow-hidden border bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 shadow-sm hover:shadow-lg transition border-gray-200 dark:border-gray-700"
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
			<p class="mt-1 text-[10px] text-gray-500 dark:text-gray-400 line-clamp-2">{{ $product->short_description }}</p>
		@endif

		{{-- price row --}}
		@if (count($product->pricings) > 0)
			@php $p = $product->pricings[0]; @endphp

			<div class="mt-3 flex items-center justify-between gap-2">
				<div>
					<div class="{{ FD['text-2'] }} font-extrabold text-gray-900 dark:text-white leading-none">
						<span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->selling_price) }}
					</div>
					<div class="mt-1 flex items-center gap-2">
						@if($p->mrp && $p->mrp > 0)
							<span class="text-xs text-gray-400 dark:text-gray-400 line-through">
								<span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->mrp) }}
							</span>
							<span class="text-xs font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
								{{ $p->discount }}% off
							</span>
						@endif
					</div>
				</div>

				{{-- <div class="hidden sm:flex items-center text-[10px] text-gray-500 dark:text-gray-300">
					<svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
					<span>Fast Delivery</span>
				</div> --}}
			</div>
		@endif
	</a>

	{{-- badges (kept outside <a>) --}}
	<div class="absolute inset-x-2 top-2 flex justify-between items-start z-1 pointer-events-none">
		{{-- rating pill (left) --}}
		@if(!empty($product->average_rating) && $product->average_rating > 0)
			<span class="pointer-events-auto inline-flex items-center gap-1 bg-green-600 dark:bg-green-700 text-white text-xs font-semibold px-2 py-0.5 {{ FD['rounded'] }} shadow-sm">
				<svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .587l3.668 7.431L23.5 9.748l-5.75 5.6L19.335 24 12 20.047 4.665 24l1.585-8.652L.5 9.748l7.832-1.73L12 .587z"/></svg>
				<span class="text-xs">{{ number_format($product->average_rating, 1) }}</span>
			</span>
		@else
			<span class="hidden"></span>
		@endif

		{{-- wishlist (right) --}}
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
