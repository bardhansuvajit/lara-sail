@extends('layouts.front.account', [
    'title' => __('Account')
])

@section('content')
    <div class="block sm:hidden">
        @include('front.account.includes.account-overview')
    </div>

    {{-- Account tab content (right column) --}}
<div class="w-full md:col-span-2">
  {{-- Top summary --}}
  <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4 flex items-center gap-4">
    <div class="flex items-center gap-4">
      <div class="w-14 h-14 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-700 dark:text-indigo-200 font-semibold">
        {{ strtoupper(substr($user->name,0,2)) }}
      </div>
    </div>

    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-3">
        <h2 class="text-lg font-semibold truncate">{{ $user->name ?: 'Account' }}</h2>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-200">Silver • 1,250 pts</span>
        @if($user->email_verified_at)
          <span class="ml-2 inline-flex items-center text-sm text-green-700 dark:text-green-300">✔ Verified</span>
        @endif
      </div>
      <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Member since {{ $user->created_at->format('M Y') }}</p>
    </div>

    <div class="flex-shrink-0">
      <a href="{{ route('front.account.edit') }}" class="inline-flex items-center px-3 py-2 rounded-md bg-indigo-600 text-white text-sm hover:bg-indigo-700 focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500">Edit Profile</a>
    </div>
  </div>

  {{-- Quick action chips --}}
  <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-3">
    <a href="{{ route('front.order.index') }}" class="p-3 bg-white dark:bg-gray-800 rounded-md shadow-sm flex flex-col items-start">
      <span class="text-sm text-gray-500 dark:text-gray-300">Orders</span>
      <span class="mt-1 text-lg font-semibold">{{ $ordersCount ?? 0 }}</span>
      <span class="text-xs text-gray-400 mt-1">Recent & Track</span>
    </a>
    <a href="{{ route('front.wishlist.index') }}" class="p-3 bg-white dark:bg-gray-800 rounded-md shadow-sm flex flex-col">
      <span class="text-sm text-gray-500 dark:text-gray-300">Wishlist</span>
      <span class="mt-1 text-lg font-semibold">{{ $wishlistCount ?? 0 }}</span>
      <span class="text-xs text-gray-400 mt-1">Saved items</span>
    </a>
    <a href="{{ route('front.address.index') }}" class="p-3 bg-white dark:bg-gray-800 rounded-md shadow-sm flex flex-col">
      <span class="text-sm text-gray-500 dark:text-gray-300">Addresses</span>
      <span class="mt-1 text-lg font-semibold">{{ $addressesCount ?? 0 }}</span>
      <span class="text-xs text-gray-400 mt-1">Manage</span>
    </a>
    <a href="#" class="p-3 bg-white dark:bg-gray-800 rounded-md shadow-sm flex flex-col">
      <span class="text-sm text-gray-500 dark:text-gray-300">Cards</span>
      <span class="mt-1 text-lg font-semibold">{{ $cardsCount ?? 0 }}</span>
      <span class="text-xs text-gray-400 mt-1">Default & Manage</span>
    </a>
  </div>

  {{-- Main panels (two-column on desktop) --}}
  <div class="mt-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
    {{-- Left column: Profile & Default address --}}
    <div class="space-y-4">
      {{-- Profile details card --}}
      <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4">
        <h3 class="text-sm font-semibold">Profile</h3>
        <dl class="mt-3 grid grid-cols-1 gap-y-2 text-sm">
          <div class="flex justify-between">
            <dt class="text-gray-500">Full name</dt>
            <dd class="text-gray-900 dark:text-gray-100">{{ $user->name ?? '-' }}</dd>
          </div>
          <div class="flex justify-between">
            <dt class="text-gray-500">Phone</dt>
            <dd class="text-gray-900 dark:text-gray-100">
              {{ $user->phone ?? '-' }}
              @if($user->phone_verified_at)
                <span class="ml-2 text-xs text-green-700 dark:text-green-300">Verified</span>
              @endif
            </dd>
          </div>
          <div class="flex justify-between">
            <dt class="text-gray-500">Email</dt>
            <dd class="text-gray-900 dark:text-gray-100">{{ $user->email ?? '-' }}</dd>
          </div>
        </dl>
        <div class="mt-4">
          <a href="{{ route('front.account.edit') }}" class="text-indigo-600 hover:underline text-sm">Edit profile</a>
        </div>
      </div>

      {{-- Default delivery address --}}
      <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4">
        <h3 class="text-sm font-semibold">Delivery address</h3>
        {{-- @if($defaultAddress)
          <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 truncate">{{ $defaultAddress->line_1 }}, {{ $defaultAddress->city }} — {{ $defaultAddress->pincode }}</p>
          <div class="mt-3 flex items-center gap-2">
            <a href="{{ route('front.address.index') }}" class="text-sm inline-flex items-center px-2.5 py-1 rounded-md bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-200">Change</a>
            <a href="{{ route('front.order.create', ['address' => $defaultAddress->id]) }}" class="text-sm inline-flex items-center px-2.5 py-1 rounded-md border">Deliver here</a>
          </div>
        @else
          <p class="mt-2 text-sm text-gray-500">No default address. <a href="{{ route('front.address.create') }}" class="text-indigo-600 hover:underline">Add address</a></p>
        @endif --}}
      </div>
    </div>

    {{-- Right column: Orders & Payment --}}
    <div class="space-y-4">
      {{-- Recent orders --}}
      <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4">
        <div class="flex items-center justify-between">
          <h3 class="text-sm font-semibold">Recent orders</h3>
          <a href="{{ route('front.order.index') }}" class="text-sm text-indigo-600 hover:underline">View all</a>
        </div>

        <ul class="mt-3 space-y-3">
          {{-- @forelse($recentOrders as $o)
            <li class="flex items-center justify-between bg-gray-50 dark:bg-gray-900/30 p-3 rounded-md">
              <div class="min-w-0">
                <div class="flex items-center gap-2">
                  <span class="text-sm font-medium truncate">#{{ $o->order_number }}</span>
                  <span class="text-xs px-2 py-0.5 rounded-full text-xs {{ $o->status === 'delivered' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($o->status) }}</span>
                </div>
                <p class="text-xs text-gray-500 truncate">{{ $o->created_at->diffForHumans() }} • {{ format_money($o->total) }}</p>
              </div>
              <div class="flex items-center gap-2">
                <a href="{{ route('front.order.show',$o->id) }}" class="text-sm text-indigo-600 hover:underline">Track</a>
                <a href="{{ route('front.order.reorder',$o->id) }}" class="text-sm text-gray-500 hover:underline">Reorder</a>
              </div>
            </li>
          @empty
            <li class="text-sm text-gray-500">No recent orders. <a href="{{ route('front.home') }}" class="text-indigo-600 hover:underline">Start shopping</a></li>
          @endforelse --}}
        </ul>
      </div>

      {{-- Payment methods --}}
      <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4">
        <div class="flex items-center justify-between">
          <h3 class="text-sm font-semibold">Payment methods</h3>
          <a href="#" class="text-sm text-indigo-600 hover:underline">Manage</a>
        </div>

        <div class="mt-3 space-y-2">
          {{-- @forelse($cards as $card)
            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900/30 rounded-md">
              <div>
                <div class="text-sm font-medium">**** **** **** {{ $card->last4 }}</div>
                <div class="text-xs text-gray-500">{{ $card->brand }} • Expires {{ $card->exp_month }}/{{ $card->exp_year }}</div>
              </div>
              <div class="flex items-center gap-2">
                @if($card->is_default) <span class="text-xs text-indigo-700">Default</span> @endif
                <a href="#" class="text-sm text-gray-500 hover:underline">Remove</a>
              </div>
            </div>
          @empty
            <p class="text-sm text-gray-500">No saved cards. <a href="{{ route('front.payment.method.create') }}" class="text-indigo-600 hover:underline">Add a card</a></p>
          @endforelse --}}
        </div>
      </div>
    </div>
  </div>

  {{-- Security & support row --}}
  <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4">
      <h3 class="text-sm font-semibold">Security</h3>
      <p class="mt-2 text-sm text-gray-500">Last login: {{ $lastLoginAt ?? '—' }} from {{ $lastLoginDevice ?? 'unknown device' }}</p>
      <div class="mt-3 flex gap-2">
        <a href="#" class="px-3 py-2 inline-flex items-center rounded-md border text-sm">Change password</a>
        <a href="#" class="px-3 py-2 inline-flex items-center rounded-md border text-sm">Manage sessions</a>
      </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm p-4">
      <h3 class="text-sm font-semibold">Support</h3>
      <p class="mt-2 text-sm text-gray-500">Need help? Chat with us or raise a support request.</p>
      <div class="mt-3 flex gap-2">
        <a href="#" class="px-3 py-2 inline-flex items-center rounded-md bg-indigo-600 text-white text-sm">Chat</a>
        <a href="#" class="px-3 py-2 inline-flex items-center rounded-md border text-sm">Raise ticket</a>
      </div>
    </div>
  </div>
</div>

@endsection

{{-- <x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Account') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-2 md:pt-4 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">

            <h2 class="{{ FD['text-2'] }} font-semibold text-gray-900 dark:text-white sm:text-lg">Account</h2>

            @include('layouts.front.global-alert')

            <div class="mt-2 md:mt-4 gap-2 md:gap-4 lg:flex lg:items-start">
                <div class="hidden sm:block w-full">
                    @include('front.account.includes.account-overview')
                </div>

                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 p-2 sm:p-4 mb-2 md:mb-4">
                        <div class="block sm:hidden">
                            @include('front.account.includes.account-overview')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout> --}}
