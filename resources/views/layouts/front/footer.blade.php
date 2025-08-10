<footer class="bg-gray-200 antialiased dark:bg-gray-800/90 mb-12 sm:mb-0">
	<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
		<div class="border-b border-gray-100 py-6 dark:border-gray-700 md:py-8 lg:py-16">
			<div class="items-start gap-6 md:gap-8 lg:flex 2xl:gap-24">

				{{-- Footer links --}}
				@include('layouts.front.navigation.footer-link')

				<div class="mt-6 w-full md:mt-8 lg:mt-0 lg:max-w-lg">
					<div class="space-y-5 rounded-lg bg-gray-100 p-6 dark:bg-gray-700/50 shadow-lg">
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

						<div class="flex space-x-4">
							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
								<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
							</a>

							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
								<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
							</a>
			
							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
								<svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" fill="currentColor" fillRule="evenodd"><path d="M818 800 498.11 333.745l.546.437L787.084 0h-96.385L455.738 272 269.15 0H16.367l298.648 435.31-.036-.037L0 800h96.385l261.222-302.618L565.217 800zM230.96 72.727l448.827 654.546h-76.38L154.217 72.727z" transform="translate(103 112)"/></svg>
							</a>
			
							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
							<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path
								fill-rule="evenodd"
								d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
								clip-rule="evenodd"
								/>
							</svg>
							</a>
			
							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
							<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path
								fill-rule="evenodd"
								d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
								clip-rule="evenodd"
								/>
							</svg>
							</a>

							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
								<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1 2.83783C1 2.35041 1.19363 1.88295 1.53829 1.53829C1.88295 1.19363 2.35041 1 2.83783 1H21.1611C21.4025 1 21.6415 1.04754 21.8644 1.1399C22.0874 1.23226 22.29 1.36763 22.4607 1.53829C22.6313 1.70895 22.7667 1.91155 22.8591 2.13452C22.9514 2.3575 22.999 2.59648 22.999 2.83783V21.1611C22.999 21.4025 22.9514 21.6415 22.8591 21.8644C22.7667 22.0874 22.6313 22.29 22.4607 22.4607C22.29 22.6313 22.0874 22.7667 21.8644 22.8591C21.6415 22.9514 21.4025 22.999 21.1611 22.999H2.83783C2.35041 22.999 1.88295 22.8053 1.53829 22.4607C1.19363 22.116 1 21.6486 1 21.1611V2.83783ZM9.70792 9.38711H12.687V10.884C13.1164 10.0232 14.2168 9.24961 15.8699 9.24961C19.0387 9.24961 19.7908 10.9628 19.7908 14.1063V19.9283H16.5826V14.8222C16.5826 13.0321 16.1532 12.0224 15.061 12.0224C13.5463 12.0224 12.9161 13.1109 12.9161 14.8222V19.9283H9.70792V9.38711ZM4.20818 19.7908H7.41637V9.24961H4.20818V19.7908ZM7.87468 5.81227C7.87468 6.08311 7.82133 6.3513 7.71769 6.60152C7.61404 6.85174 7.46212 7.0791 7.27061 7.27061C7.0791 7.46212 6.85174 7.61404 6.60152 7.71769C6.3513 7.82133 6.08311 7.87468 5.81227 7.87468C5.54144 7.87468 5.27325 7.82133 5.02303 7.71769C4.7728 7.61404 4.54545 7.46212 4.35393 7.27061C4.16242 7.0791 4.01051 6.85174 3.90686 6.60152C3.80322 6.3513 3.74987 6.08311 3.74987 5.81227C3.74987 5.26529 3.96716 4.74071 4.35393 4.35393C4.74071 3.96716 5.26529 3.74987 5.81227 3.74987C6.35926 3.74987 6.88384 3.96716 7.27061 4.35393C7.65739 4.74071 7.87468 5.26529 7.87468 5.81227Z"/></svg>
							</a>

							<a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
								<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22.54 6.42a2.77 2.77 0 0 0-1.945-1.957C18.88 4 12 4 12 4s-6.88 0-8.595.463A2.77 2.77 0 0 0 1.46 6.42C1 8.148 1 11.75 1 11.75s0 3.602.46 5.33a2.77 2.77 0 0 0 1.945 1.958C5.121 19.5 12 19.5 12 19.5s6.88 0 8.595-.462a2.77 2.77 0 0 0 1.945-1.958c.46-1.726.46-5.33.46-5.33s0-3.602-.46-5.33M9.75 8.479v6.542l5.75-3.271z" clip-rule="evenodd"/></svg>
							</a>
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
					<li><a href="#" title="" class="font-medium hover:underline"> Website Express </a></li>
					<li><a href="#" title="" class="font-medium hover:underline"> Legal Notice </a></li>
					<li><a href="#" title="" class="font-medium hover:underline"> Product Listing Policy </a></li>
					<li><a href="#" title="" class="font-medium hover:underline"> Terms of Use </a></li>
				</ul>

				<p class="{{FD['text']}} text-gray-500 dark:text-gray-400">&copy; 2024 <a href="#" class="hover:underline">Website</a>, Inc. All rights reserved.</p>
			</div>
		</div>
	</div>
</footer>