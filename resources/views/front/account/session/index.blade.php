@extends('layouts.front.account', [
    'showHeader' => true,
    'title' => __('Manage Sessions'),
    'subtitle' => __('View and manage your active login sessions across different devices.'),
    'breadcrumb' => [
        [
            'title' => 'Account',
            'url' => route('front.account.index')
        ],
        [
            'title' => 'Manage Sessions'
        ]
    ]
])

@section('content')
<div>
    <div class="{{ FD['rounded'] }} bg-white dark:bg-gray-800">
        <!-- Current Session Card -->
        <div class="bg-gray-50 dark:bg-gray-700 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700 p-2 md:p-4 mb-2 md:mb-4">
            <div class="flex items-center justify-between mb-2">
                <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Current Session</h2>
                <span class="px-3 py-1 bg-green-200 text-green-800 {{ FD['text'] }} font-medium rounded-full dark:bg-green-700 dark:text-green-300">
                    Active Now
                </span>
            </div>

            @php
                $currentSession = $activeSessions->firstWhere('token', session()->getId());
            @endphp

            @if($currentSession)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 {{ FD['rounded'] }} flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-120v-80H160q-33 0-56.5-23.5T80-280v-440q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v440q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-440H160v440Zm0 0v-440 440Z"/></svg>
                            </div>
                            <div>
                                <p class="{{ FD['text'] }} font-medium text-gray-900 dark:text-white">{{ ucwords($currentSession->device_info) }}</p>
                                <p class="{{ FD['text-0'] }} text-gray-500 dark:text-gray-400">{{ ucwords($currentSession->platform) }} • {{ ucwords($currentSession->browser) }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 {{ FD['text-0'] }} text-gray-600 dark:text-gray-400">
                            <div class="flex items-center space-x-2">
                                <svg class="{{ FD['iconClass'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                    <path d="M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 294q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/>
                                </svg>
                                <span>{{ $currentSession->location ?? 'Location not available' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="{{ FD['iconClass'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                    <path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                                </svg>
                                <span>Last active: {{ $currentSession->last_activity_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="{{ FD['iconClass'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z"/></svg>
                                <span>Logged in: {{ $currentSession->login_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center md:justify-end">
                        <span class="p-2 bg-blue-100 text-blue-700 {{ FD['text'] }} font-medium {{ FD['rounded'] }} dark:bg-blue-800 dark:text-blue-200">
                            This Device
                        </span>
                    </div>
                </div>
            @else
                <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">Current session information not available.</p>
            @endif
        </div>

        <!-- Other Active Sessions -->
        @if ($activeSessions->where('token', '!=', session()->getId())->count() > 0)
            <div class="bg-gray-50 dark:bg-gray-700 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700 p-2 md:p-4 mb-2 md:mb-4">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Other Active Sessions</h2>

                    <x-front.button
                        element="button"
                        size="sm"
                        tag="danger"
                        x-data="" 
                        x-on:click="$dispatch('open-modal', 'logout-other-devices-modal');"
                        >
                        @slot('icon')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                        @endslot
                        {{ __('Logout From Other Devices') }}
                    </x-front.button>
                </div>

                @if($activeSessions->where('token', '!=', session()->getId())->count() > 0)
                    <div class="space-y-4">
                        @foreach($activeSessions->where('token', '!=', session()->getId()) as $session)
                            <div class="flex items-center justify-between {{ FD['rounded'] }} py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 {{ FD['rounded'] }} flex items-center justify-center">
                                        @if($session->platform === 'ios' || $session->platform === 'android')
                                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-40q-33 0-56.5-23.5T200-120v-720q0-33 23.5-56.5T280-920h400q33 0 56.5 23.5T760-840v720q0 33-23.5 56.5T680-40H280Zm0-200v120h400v-120H280Zm200 100q17 0 28.5-11.5T520-180q0-17-11.5-28.5T480-220q-17 0-28.5 11.5T440-180q0 17 11.5 28.5T480-140ZM280-320h400v-400H280v400Zm0-480h400v-40H280v40Zm0 560v120-120Zm0-560v-40 40Z"/></svg>
                                        @elseif($session->platform === 'tablet')
                                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M100-120q-33 0-56.5-23.5T20-200v-560q0-33 23.5-56.5T100-840h760q33 0 56.5 23.5T940-760v560q0 33-23.5 56.5T860-120H100Zm0-120v40h760v-40H100Zm0-80h760v-440H100v440Zm0-520h760v-40H100v40Zm0 0v-40 40Zm0 600v40-40Z"/></svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-120v-80H160q-33 0-56.5-23.5T80-280v-440q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v440q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-440H160v440Zm0 0v-440 440Z"/></svg>
                                        @endif
                                    </div>

                                    <div>
                                        <p class="{{ FD['text'] }} font-medium text-gray-900 dark:text-white">
                                            {{ $session->device_info ?: 'Unknown Device' }}
                                        </p>
                                        <div class="flex items-center space-x-2 {{ FD['text-0'] }} text-gray-500 dark:text-gray-400">
                                            <span>{{ ucfirst($session->platform) }}</span>
                                            <span>•</span>
                                            <span>{{ $session->browser ?: 'Unknown Browser' }}</span>
                                            <span>•</span>
                                            <span>{{ $session->location ?: 'Unknown Location' }}</span>
                                        </div>
                                        <div class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500">
                                            Last active: {{ $session->last_activity_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('front.account.session.logout', $session->token) }}" method="POST">
                                    @csrf
                                    <x-front.button
                                        element="button"
                                        tag="danger"
                                        type="submit"
                                        size="xs"
                                        >
                                        {{ __('Logout') }}
                                    </x-front.button>
                                    {{-- <button type="submit" 
                                            onclick="return confirm('Are you sure you want to logout from this device?')"
                                            class="px-3 py-1 bg-red-100 text-red-700 {{ FD['text'] }} font-medium rounded hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                                        Logout
                                    </button> --}}
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- <div class="text-center py-8">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/>
                            </svg>
                        </div>
                        <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">No other active sessions found.</p>
                        <p class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500 mt-1">You're only logged in on this device.</p>
                    </div> --}}
                @endif
            </div>
        @endif

        <!-- Recent Sessions History -->
        <div class="bg-gray-50 dark:bg-gray-700 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700 p-2 md:p-4 mb-2 md:mb-4">
            <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white mb-4">Recent Sessions (Last 30 Days)</h2>

            @if($recentSessions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full {{ FD['text'] }} text-left text-gray-500 dark:text-gray-400">
                        <thead class="{{ FD['text'] }} text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="p-2 md:px-4 md:py-3 min-w-32">Device & Location</th>
                                <th class="p-2 md:px-4 md:py-3 min-w-32">Platform</th>
                                <th class="p-2 md:px-4 md:py-3 min-w-32">Login Time</th>
                                <th class="p-2 md:px-4 md:py-3 min-w-32">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSessions as $session)
                            <tr class="border-b dark:border-gray-700">
                                <td class="p-2 md:px-4 md:py-3">
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $session->device_info ?: 'Unknown Device' }}
                                    </div>
                                    <div class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">
                                        {{ $session->location ?: 'Unknown Location' }}
                                    </div>
                                </td>
                                <td class="p-2 md:px-4 md:py-3">
                                    <div class="flex items-center space-x-2">
                                        @if($session->platform === 'ios' || $session->platform === 'android')
                                        <svg class="{{ FD['iconClass'] }} text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                            <path d="M280-40q-33 0-56.5-23.5T200-120v-720q0-33 23.5-56.5T280-920h400q33 0 56.5 23.5T760-840v720q0 33-23.5 56.5T680-40H280Zm0-200v120h400v-120H280Zm200 100q17 0 28.5-11.5T520-180q0-17-11.5-28.5T480-220q-17 0-28.5 11.5T440-180q0 17 11.5 28.5T480-140ZM280-320h400v-400H280v400Zm0-480h400v-40H280v40Zm0 560v120-120Zm0-560v-40 40Z"/>
                                        </svg>
                                        @elseif($session->platform === 'tablet')
                                        <svg class="{{ FD['iconClass'] }} text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                            <path d="M100-120q-33 0-56.5-23.5T20-200v-560q0-33 23.5-56.5T100-840h760q33 0 56.5 23.5T940-760v560q0 33-23.5 56.5T860-120H100Zm0-120v40h760v-40H100Zm0-80h760v-440H100v440Zm0-520h760v-40H100v40Zm0 0v-40 40Zm0 600v40-40Z"/>
                                        </svg>
                                        @else
                                        <svg class="{{ FD['iconClass'] }} text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                            <path d="M320-120v-80H160q-33 0-56.5-23.5T80-280v-440q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v440q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-440H160v440Zm0 0v-440 440Z"/>
                                        </svg>
                                        @endif
                                        <span>{{ ucfirst($session->platform) }}</span>
                                    </div>
                                    <div class="{{ FD['text'] }} text-gray-400">{{ $session->browser ?: 'Unknown Browser' }}</div>
                                </td>
                                <td class="p-2 md:px-4 md:py-3">
                                    <div>{{ $session->login_at->format('M j, Y') }}</div>
                                    <div class="{{ FD['text'] }} text-gray-400">{{ $session->login_at->format('g:i A') }}</div>
                                </td>
                                <td class="p-2 md:px-4 md:py-3">
                                    @if($session->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 {{ FD['text'] }} font-medium rounded-full dark:bg-green-900 dark:text-green-300">
                                        Active
                                    </span>
                                    @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 {{ FD['text'] }} font-medium rounded-full dark:bg-gray-600 dark:text-gray-300">
                                        Logged out
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M480-120q-138 0-240.5-91.5T122-440h82q14 104 92.5 172T480-200q117 0 198.5-81.5T760-480q0-117-81.5-198.5T480-760q-69 0-129 32t-101 88h110v80H120v-240h80v94q51-64 124.5-99T480-840q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-480q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-120Zm80-192L440-464v-216h80v184l104 104-56 56Z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400">No recent sessions found.</p>
                </div>
            @endif
        </div>

        <!-- Security Tips -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 {{ FD['rounded'] }} p-2 md:p-4">
            <h3 class="{{ FD['text-1'] }} font-semibold text-blue-900 dark:text-blue-100 mb-2">Security Tips</h3>

            <ul class="text-blue-800 dark:text-blue-200 space-y-2 {{ FD['text'] }}">
                <li class="flex items-start space-x-2">
                    <svg class="{{ FD['iconClass'] }} flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q54 0 104-17.5t92-50.5L228-676q-33 42-50.5 92T160-480q0 134 93 227t227 93Zm252-124q33-42 50.5-92T800-480q0-134-93-227t-227-93q-54 0-104 17.5T284-732l448 448Z"/></svg>
                    <span>Regularly review your active sessions and logout from unfamiliar devices</span>
                </li>
                <li class="flex items-start space-x-2">
                    <svg class="{{ FD['iconClass'] }} flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    <span>Always logout from shared or public computers</span>
                </li>
                <li class="flex items-start space-x-2">
                    <svg class="{{ FD['iconClass'] }} flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                    <span>Use strong, unique passwords and enable two-factor authentication if available</span>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- MODALS --}}
<x-front.modal 
    name="logout-other-devices-modal" 
    maxWidth="sm" 
    vertical="middle"
    >
    <div class="p-6">
        <div class="max-w-sm mx-auto text-center">
            <!-- Warning Icon -->
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                        <path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm-40-160h80v-240h-80v240Zm40 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">
                Logout Other Devices
            </h3>

            <!-- Description -->
            <div class="mb-6">
                <p class="text-gray-600 dark:text-gray-300 mb-3">
                    This will log you out from all devices except this one.
                </p>
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3 text-left">
                    <div class="flex items-start space-x-2">
                        <svg class="{{ FD['iconClass'] }} text-yellow-600 dark:text-yellow-400 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M440-280h80v-80h-80v80Zm40-320q17 0 28.5 11.5T520-560q0 17-11.5 28.5T480-520q-17 0-28.5-11.5T440-560q0-17 11.5-28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                        </svg>
                        <div class="{{ FD['text'] }} text-yellow-800 dark:text-yellow-200">
                            <p class="font-medium">You will stay logged in on this device.</p>
                            <p class="mt-1">Other devices will need to login again.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <x-front.button
                    element="button"
                    tag="secondary"
                    x-on:click="$dispatch('close')"
                    >
                    {{ __('Cancel') }}
                </x-front.button>

                <form action="{{ route('front.account.session.logout-all') }}" method="POST" class="flex-1">@csrf
                    <x-front.button
                        element="button"
                        tag="danger"
                        type="submit"
                        >
                        @slot('icon')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q97-30 162-118.5T718-480H480v-315l-240 90v207q0 7 2 18h238v316Z"/></svg>
                        @endslot
                        {{ __('Logout Others') }}
                    </x-front.button>
                </form>
            </div>
        </div>
    </div>
</x-front.modal>

@endsection