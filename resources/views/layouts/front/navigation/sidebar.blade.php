{{-- mobile device only --}}
<x-front.sidebar name="mob-sidebar" mobileWidth="sm" maxWidth="2xl" direction="left" focusable>
	@slot('header')
		<header class="flex items-center justify-between p-2">
			<div class="flex-shrink-0 md:order-1">
				<a href="{{ url('/') }}" title="" class="">
					<img class="w-auto sm:flex h-6 sm:h-5 dark:hidden" src="{{ Storage::url('public/default/logo/logo-full.svg') }}" alt="">
					<img class="hidden w-auto h-6 sm:h-5 dark:block" src="{{ Storage::url('public/default/logo/logo-full-dark.svg') }}" alt="">
				</a>
			</div>
		</header>	
	@endslot

	<div class="p-2 w-full">
		<ul class="items-center space-y-2 px-2">
			@foreach ($activeCollections as $collection)
				<li class="">
                    <a href="{{ route('front.collection.detail', $collection->slug) }}">
						<button type="button" title="{{ $collection->slug }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
							{{ $collection->title }}
						</button>
					</a>
				</li>
            @endforeach
		</ul>

		<div id="dropdown-cta" class="p-4 mt-6 {{ FD['rounded'] }} bg-blue-50 dark:bg-blue-900" role="alert">
			<div class="flex items-center mb-3">
			   <span class="bg-orange-100 text-orange-800 {{FD['text']}} font-semibold me-2 px-2.5 py-0.5 {{ FD['rounded'] }} dark:bg-orange-200 dark:text-orange-900">Beta</span>
			   <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 inline-flex justify-center items-center w-6 h-6 text-blue-900 {{ FD['rounded'] }} focus:ring-2 focus:ring-blue-400 p-1 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800" data-dismiss-target="#dropdown-cta" aria-label="Close">
				  <span class="sr-only">Close</span>
				  <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
					 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
				  </svg>
			   </button>
			</div>
			<p class="mb-3 {{FD['text']}} text-blue-800 dark:text-blue-400">
			   	Preview the new Website dashboard navigation! You can turn the new navigation off for a limited time in your profile.
			</p>
			<a class="{{FD['text']}} text-blue-800 underline font-medium hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" href="#">Turn new navigation off</a>
		</div>
	</div>
</x-front.sidebar>

