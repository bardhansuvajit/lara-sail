@php
$card = [
    'left' => [
        'flag_svg' => '<svg id="flag-icons-india" viewBox="0 0 640 480"xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><path d="M0 0h640v160H0z"fill=#f93 /><path d="M0 160h640v160H0z"fill=#fff /><path d="M0 320h640v160H0z"fill=#128807 /><g transform="matrix(3.2 0 0 3.2 320 240)"><circle r=20 fill=#008 /><circle r=17.5 fill=#fff /><circle r=3.5 fill=#008 /><g id=in-d><g id=in-c><g id=in-b><g id=in-a fill=#008><circle r=.9 transform="rotate(7.5 -8.8 133.5)"/><path d="M0 17.5.6 7 0 2l-.6 5z"/></g><use height=100% transform=rotate(15) width=100% xlink:href=#in-a /></g><use height=100% transform=rotate(30) width=100% xlink:href=#in-b /></g><use height=100% transform=rotate(60) width=100% xlink:href=#in-c /></g><use height=100% transform=rotate(120) width=100% xlink:href=#in-d /><use height=100% transform=rotate(-120) width=100% xlink:href=#in-d /></g></svg>',

        'bg_image' => Storage::url('public/default/images/indian-flag.png'),
        'title' => 'Proudly Indian',
        'subtitle' => 'Supporting 50k+ local sellers',
        'trust' => [
            [
                'label' => 'Secure',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M420-360h120l-23-129q20-10 31.5-29t11.5-42q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 23 11.5 42t31.5 29l-23 129Zm60 280q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Z"/></svg>'
            ],
            [
                'label' => 'Verified',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM240-40v-309q-38-42-59-96t-21-115q0-134 93-227t227-93q134 0 227 93t93 227q0 61-21 115t-59 96v309l-240-80-240 80Zm240-280q100 0 170-70t70-170q0-100-70-170t-170-70q-100 0-170 70t-70 170q0 100 70 170t170 70ZM320-159l160-41 160 41v-124q-35 20-75.5 31.5T480-240q-44 0-84.5-11.5T320-283v124Zm160-62Z"/></svg>'
            ],
        ],
    ],
    'right' => [
        'heading' => 'Shop with Confidence',
        'headingIcon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z"/></svg>',
        'features' => [
            [
                'title' => 'Free Delivery',
                'subtitle' => 'Over ₹499 orders',
                'color_classes' => 'bg-indigo-50 dark:bg-indigo-900/30',
                'icon' => '<svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>'
            ],
            [
                'title' => '100% Safe',
                'subtitle' => 'Payment protection',
                'color_classes' => 'bg-green-50 dark:bg-green-900/30',
                'icon' => '<svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>'
            ],
            [
                'title' => 'Easy Returns',
                'subtitle' => '30-day policy',
                'color_classes' => 'bg-blue-50 dark:bg-blue-900/30',
                'icon' => '<svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>'
            ],
            [
                'title' => '24/7 Support',
                'subtitle' => 'Always available',
                'color_classes' => 'bg-purple-50 dark:bg-purple-900/30',
                'icon' => '<svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>'
            ],
        ],
        'stat' => '5M+ happy customers',
    ],
    'cta' => [
        'shop_label' => 'Explore Our Collection',
        'shop_route' => route('front.collection.index'),
    ]
];
@endphp

<section class="max-w-7xl">
    <!-- Compact Premium Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-100 dark:border-gray-700 {{ FD['rounded'] }} shadow-sm overflow-hidden">
        <div class="grid md:grid-cols-12">
            <!-- Left Column - Visual Impact -->
            <div class="md:col-span-5 bg-gradient-to-b from-orange-100 to-green-100 dark:from-orange-800/20 dark:to-green-800/20 p-6 flex flex-col justify-center items-center text-center relative overflow-hidden">
                <!-- Flag Background -->
                <div class="absolute inset-0 opacity-40 dark:opacity-30 z-0">
                    <img src="{{ $card['left']['bg_image'] }}" 
                        alt="Indian Flag Background" 
                        class="w-full h-full object-cover object-center">
                </div>

                <!-- Foreground Content -->
                <div class="relative z-1 w-full">
                    <!-- Flag Icon (optional) -->
                    <div class="mb-3 mx-auto w-12 h-12">
                        {!! $card['left']['flag_svg'] !!}
                    </div>

                    <!-- Text Content -->
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $card['left']['title'] }}</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-300">{{ $card['left']['subtitle'] }}</p>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="mt-4 flex items-center justify-center space-x-3">
                        <div class="flex items-center bg-white/80 dark:bg-gray-800/80 px-2 py-1 rounded-full">
                            <div class="w-4 h-4 text-green-600">
                                {!! $card['left']['trust'][0]['icon'] !!}
                            </div>
                            <span class="ml-1 text-xs font-medium text-gray-700 dark:text-gray-300">{{ $card['left']['trust'][0]['label'] }}</span>
                        </div>
                        <div class="flex items-center bg-white/80 dark:bg-gray-800/80 px-2 py-1 rounded-full">
                            <div class="w-4 h-4 text-green-600">
                                {!! $card['left']['trust'][1]['icon'] !!}
                            </div>
                            <span class="ml-1 text-xs font-medium text-gray-700 dark:text-gray-300">{{ $card['left']['trust'][1]['label'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Features -->
            <div class="md:col-span-7 p-4 sm:p-6">
                <div class="flex items-center mb-6">
                    <div class="w-6 h-6 text-green-600 dark:text-green-400">
                        {!! $card['right']['headingIcon'] !!}
                    </div>
                    <h2 class="ml-2 text-lg font-bold text-gray-900 dark:text-white">{{ $card['right']['heading'] }}</h2>
                </div>

                <!-- Compact Features Grid -->
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($card['right']['features'] as $feature)
                        <div class="flex items-start space-x-2">
                            <div class="flex-shrink-0 {{ $feature['color_classes'] }} {{ FD['rounded'] }} p-1.5">
                                {!! $feature['icon'] !!}
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-900 dark:text-white">{{ $feature['title'] }}</h3>
                                <p class="mt-0.5 text-xs text-gray-600 dark:text-gray-400">{{ $feature['subtitle'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Compact CTA -->
                <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="ml-1.5 text-xs text-gray-500 dark:text-gray-400">5M+ happy customers</span>
                    </div>

                    <a href="{{ $card['cta']['shop_route'] }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-orange-500 to-green-600 hover:from-orange-600 hover:to-green-700 transition-all">
                        {{ $card['cta']['shop_label'] }}
                        <svg class="ml-1.5 -mr-0.5 w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>