<footer class="bg-gray-200 antialiased dark:bg-gray-800/90 mb-12 sm:mb-0">
	<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
		<div class="border-b border-gray-100 py-6 dark:border-gray-700 md:py-8 lg:py-16">
			<div class="items-start gap-6 md:gap-8 lg:flex 2xl:gap-24">

				{{-- Footer links --}}
				@include('layouts.front.navigation.footer-link')

				<div class="mt-6 w-full md:mt-8 lg:mt-0 lg:max-w-lg">
					<div class="space-y-5 {{FD['rounded']}} bg-gray-100 p-3 md:p-6 dark:bg-gray-700/50 shadow-lg overflow-hidden">
						@if (auth()->guard('web')->check())
							<a href="{{ route('front.account.index') }}" title="" class="{{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500"> Visit your Account </a>
						@else
							<a href="{{ route('front.login') }}" title="" class="{{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500"> Sign In or Create Account </a>
						@endif

						<hr class="border-gray-200 dark:border-gray-600" />

						{{-- Newsletter Subscription form --}}
						@include('layouts.front.includes.newsletter-subscription')

						<hr class="border-gray-200 dark:border-gray-600" />

						<div>
							<p class="mb-3 {{FD['text']}} font-medium text-gray-900 dark:text-white">Trade on the go with <a href="#" title="" class="underline hover:no-underline">Website App</a></p>

							{{-- Mobile App Download Link --}}
							@include('layouts.front.navigation.app-download-buttons')
						</div>

						<hr class="border-gray-200 dark:border-gray-600" />

						<div class="flex flex-wrap gap-y-4 gap-x-4">
							@foreach ($socialMedia as $sm)
								<div class="block dark:hidden">
									<a href="{{ $sm->url }}" target="_blank" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
										<div class="h-5 w-5">
											{!! $sm->icon_colored !!}
										</div>
									</a>
								</div>
								<div class="hidden dark:block">
									<a href="{{ $sm->url }}" target="_blank" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
										<div class="h-5 w-5">
											{!! $sm->icon_base !!}
										</div>
									</a>
								</div>
							@endforeach
						</div>

					</div>
				</div>
			</div>
		</div>
	
		<div class="py-6 md:py-8">
			<div class="gap-4 space-y-5 xl:flex xl:items-center xl:justify-between xl:space-y-0">
				<a href="#" title="" class="block">
					<img class="block h-8 w-auto dark:hidden" src="{{ Storage::url('public/default/logo/logo-full.svg') }}" alt="">
					<img class="hidden h-8 w-auto dark:block" src="{{ Storage::url('public/default/logo/logo-full-dark.svg') }}" alt="">
				</a>

				<ul class="flex flex-wrap items-center gap-4 {{FD['text']}} text-gray-900 dark:text-white xl:justify-center">
					<li>
						<a href="{{ route('front.content.legal-notice') }}" class="font-medium hover:underline">Legal Notice</a>
					</li>
					<li>
						<a href="{{ route('front.content.terms-of-use') }}" class="font-medium hover:underline">Terms of Use</a>
					</li>
					<li>
						<a href="{{ route('front.content.affiliate-program') }}" class="font-medium hover:underline">Affiliate Program</a>
					</li>
					<li>
						<a href="{{ route('front.content.exclusive-offers') }}" class="font-medium hover:underline">Exclusive Offers</a>
					</li>
				</ul>

				<p class="{{FD['text']}} text-gray-500 dark:text-gray-400">&copy; 2024 <a href="#" class="hover:underline">Website</a>, Inc. All rights reserved.</p>
			</div>
		</div>
	</div>
</footer>