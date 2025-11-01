@extends('layouts.front.account', [
    'showHeader' => true,
    'title' => __('Account'),
    'subtitle' => __('Access and control your personal account information.'),
])

@section('content')
	{{-- <div class="block sm:hidden">
		@include('front.account.includes.account-overview')
	</div> --}}

	<div class="w-full md:col-span-2">
		{{-- Top summary --}}
		<div class="{{ FD['rounded'] }} flex items-center gap-4">
			<div class="flex items-center gap-4">
				<div class="w-14 h-14 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-700 dark:text-indigo-200 font-semibold">
					{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
				</div>
			</div>

			<div class="flex-1 min-w-0">
				<div class="flex items-center gap-3">
					<div class="flex space-x-2">
						<h2 class="text-lg font-semibold truncate">{{ $user->first_name }} {{ $user->last_name }}</h2>
						{{-- @if($user->email_verified_at) --}}
							<span class="inline-flex items-center gap-1 rounded-full text-xs font-medium text-teal-700 dark:text-teal-500" title="Email verified">
								<svg class="{{ FD['iconClass'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m344-60-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm94-278 226-226-56-58-170 170-86-84-56 56 142 142Z"/></svg>
							</span>
						{{-- @endif --}}
					</div>
					{{-- <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-200">Silver • 1,250 pts</span> --}}
				</div>
				<p class="{{ FD['text-1'] }} text-gray-500 dark:text-gray-400 truncate">Member since {{ $user->created_at->format('M Y') }}</p>
			</div>

			<div class="flex-shrink-0">
				<x-front.button
                    element="a"
                    tag="secondary"
                    :href="route('front.account.edit')"
                    >
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-240Zm-320 80v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q37 0 73 4.5t72 14.5l-67 68q-20-3-39-5t-39-2q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32h240v80H160Zm400 40v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-340L683-120H560Zm300-263-37-37 37 37ZM620-180h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19ZM480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Z"/></svg>
                    @endslot

                    <span class="hidden md:inline-block">{{ __('Edit Profile') }}</span>
                </x-front.button>
			</div>
		</div>

		{{-- Recent Orders --}}
		<div class="mt-10 grid grid-cols-1 gap-4">
			<div class="space-y-4">
				<div class="{{ FD['rounded'] }}">
					<div class="flex items-center justify-between">
						<h3 class="{{ FD['text-1'] }} font-semibold">Recent orders</h3>
						<a href="{{ route('front.order.index') }}" class="{{ FD['text-1'] }} text-primary-500 dark:text-primary-400 underline hover:no-underline">View all</a>
					</div>

					<ul class="mt-1 space-y-3">
						@forelse($orders as $o)
							<li class="flex items-center justify-between bg-gray-50 dark:bg-gray-900/30 p-3 {{ FD['rounded'] }}">
								<div class="min-w-0">
									<div class="flex items-center gap-2">
										<span class="{{ FD['text-1'] }} font-medium truncate">#{{ $o->order_number }}</span>
										@php
											$statusClasses = match($o->status) {
												'delivered'  => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
												'cancelled'  => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
												'shipped'    => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
												'processing' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
												default      => 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200',
											};
										@endphp

										<span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusClasses }}">
											{{ ucwords(str_replace('_', ' ', $o->status)) }}
										</span>
									</div>

									<p class="text-xs text-gray-500 truncate">{{ $o->created_at->diffForHumans() }} • {{ formatIndianMoney($o->total) }}</p>
								</div>
								<div class="flex items-center gap-2">
									<a href="{{ route('front.order.detail',$o->order_number) }}" class="hidden md:inline-block {{ FD['text-1'] }} dark:text-gray-500 hover:underline">Track</a>

									<a href="{{ route('front.order.detail', $o->order_number) }}" class="inline-flex items-center px-3 py-2 {{ FD['text'] }} font-medium text-gray-700 bg-gray-100 {{ FD['rounded'] }} hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-200">
										<svg class="{{ FD['iconClass'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z"/></svg>
									</a>
								</div>
							</li>
						@empty
							<li class="{{ FD['text'] }} text-gray-500">
								No recent orders. 
								<a href="{{ route('front.home.index') }}" class="text-primary-500 dark:text-primary-400 hover:underline">Start shopping</a>
							</li>
						@endforelse
					</ul>
				</div>
			</div>
		</div>

		{{-- Security & support row --}}
		<div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
			<div>
				<h3 class="{{ FD['text-1'] }} font-semibold">Security</h3>
				<p class="mt-1 {{ FD['text'] }} text-gray-500">Last login: {{ $user->lastLoginHistory->login_at->diffForHumans() ?? '—' }} from {{ $user->lastLoginHistory->device_type ?? 'unknown device' }}</p>

				<div class="mt-3 flex gap-2">
					<x-front.button
						element="a"
						tag="primary"
						:href="route('front.account.password.edit')"
						>
						@slot('icon')
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q97-30 162-118.5T718-480H480v-315l-240 90v207q0 7 2 18h238v316Z"/></svg>
						@endslot
						{{ __('Edit password') }}
					</x-front.button>

					<x-front.button
						element="a"
						tag="secondary"
						:href="route('front.account.session.index')"
						>
						@slot('icon')
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M261-200q-51 0-85-34t-34-85q0-51 34-85.5t85-34.5q51 0 85 34t34 85q0 51-34 85.5T261-200ZM153-521v-239h51v239h-51Zm108 275q31 0 51-21t20-53q0-32-19.5-52.5T261-393q-31 0-51 20.5T190-320q0 32 20 53t51 21Zm-11-275v-239h56l90 152-2-38v-114h50v239h-51l-96-161 3 38v123h-50Zm262 321q-42 0-67-27t-25-72v-140h49v143q0 21 12.5 35t30.5 14q18 0 30-14t12-35v-143h49v140q0 45-25 72t-66 27Zm194 0v-192h-64v-47h176v47h-63v192h-49Z"/></svg>
						@endslot
						{{ __('Manage sessions') }}
					</x-front.button>
				</div>
			</div>

			<div>
				<h3 class="{{ FD['text-1'] }} font-semibold">Support</h3>
				<p class="mt-1 {{ FD['text'] }} text-gray-500">Need help? Chat with us or raise a support request.</p>

				<div class="mt-3 flex gap-2">
					<x-front.button
						element="a"
						tag="success"
						:href="route('front.account.password.edit')"
						>
						@slot('icon')
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q97-30 162-118.5T718-480H480v-315l-240 90v207q0 7 2 18h238v316Z"/></svg>
						@endslot
						{{ __('Chat') }}
					</x-front.button>
					{{-- <a href="#" class="px-3 py-2 inline-flex items-center {{ FD['rounded'] }} bg-indigo-600 text-white {{ FD['text-1'] }}">Chat</a>
					<a href="#" class="px-3 py-2 inline-flex items-center {{ FD['rounded'] }} border {{ FD['text-1'] }}">Raise ticket</a> --}}
				</div>
			</div>
		</div>

	</div>
@endsection
