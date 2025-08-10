<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('About Us') }}">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 px-6 py-12">
        <div class="max-w-7xl mx-auto">

            {{-- Header Section --}}
            <div class="text-center mb-10">
                <h1 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    About Our Store
                </h1>
                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    We are more than just an eCommerce store — we're your go-to destination for quality products, fast delivery, and outstanding customer service.
                </p>
            </div>

            <hr class="mb-10 border-gray-200 dark:border-gray-800">

            {{-- Mission Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
                <div>
                    <div class="dark:block hidden">
                        <img 
                            src="{{Storage::url('public/default/about/undraw_goals_0pov-dark.svg')}}" 
                            alt="Our Mission" 
                            class="w-48 md:w-72 max-w-md mx-auto"
                        >
                    </div>
                    <div class="block dark:hidden">
                        <img 
                            src="{{Storage::url('public/default/about/undraw_goals_0pov-light.svg')}}" 
                            alt="Our Mission" 
                            class="w-48 md:w-72 max-w-md mx-auto"
                        >
                    </div>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center md:text-left">
                        Our Mission
                    </h2>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                        Our mission is simple: to bring you the best quality products at competitive prices. 
                        We work directly with trusted suppliers and artisans to ensure every product meets 
                        our strict standards. With a focus on sustainable practices and customer satisfaction, 
                        we aim to make your shopping experience effortless and enjoyable.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mt-4">
                        {{-- Point 1 --}}
                        <div class="p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-xs">Quality Products</span>
                            </div>
                        </div>

                        {{-- Point 2 --}}
                        <div class="p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs">Fast Delivery</span>
                            </div>
                        </div>

                        {{-- Point 3 --}}
                        <div class="p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-xs">Wide Product Range</span>
                            </div>
                        </div>

                        {{-- Point 4 --}}
                        <div class="p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0H5" />
                                </svg>
                                <span class="text-xs">Secure Payments</span>
                            </div>
                        </div>

                        {{-- Point 5 --}}
                        <div class="p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                                <span class="text-xs">Easy Returns</span>
                            </div>
                        </div>

                        {{-- Point 6 --}}
                        <div class="p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs">24/7 Customer Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Values Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
                <div class="order-2 md:order-1">
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center md:text-left">
                        Our Values
                    </h2>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                        We believe in transparency, integrity, and customer-first service. 
                        These core values shape every decision we make and every product we offer. 
                        From eco-friendly packaging to fair pricing, we're committed to doing business the right way.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            {{-- Icon --}}
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-xs text-gray-700 dark:text-gray-300">Quality & Authenticity</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-xs text-gray-700 dark:text-gray-300">Customer-Centric Approach</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-xs text-gray-700 dark:text-gray-300">Eco-Friendly Practices</span>
                        </li>
                    </ul>
                </div>
                <div class="order-1 md:order-2">
                    <div class="dark:block hidden">
                        <img 
                            src="{{Storage::url('public/default/about/undraw_spread-love_0ekp-dark.svg')}}" 
                            alt="Our Values" 
                            class="w-48 md:w-72 max-w-md mx-auto"
                        >
                    </div>
                    <div class="block dark:hidden">
                        <img 
                            src="{{Storage::url('public/default/about/undraw_spread-love_0ekp-light.svg')}}" 
                            alt="Our Values" 
                            class="w-48 md:w-72 max-w-md mx-auto"
                        >
                    </div>
                </div>
            </div>

            <hr class="mb-10 border-gray-200 dark:border-gray-800">

            {{-- Team Section --}}
            {{-- <div class="mb-16">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200 text-center mb-6">
                    Meet Our Team
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ([
                        ['name' => 'John Doe', 'role' => 'Founder & CEO', 'img' => 'https://dummyimage.com/150x150/ddd/000&text=JD'],
                        ['name' => 'Jane Smith', 'role' => 'Head of Operations', 'img' => 'https://dummyimage.com/150x150/ddd/000&text=JS'],
                        ['name' => 'Michael Lee', 'role' => 'Lead Designer', 'img' => 'https://dummyimage.com/150x150/ddd/000&text=ML'],
                        ['name' => 'Emily Davis', 'role' => 'Marketing Manager', 'img' => 'https://dummyimage.com/150x150/ddd/000&text=ED'],
                    ] as $member)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow text-center p-6">
                        <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}" class="w-24 h-24 rounded-full mx-auto mb-4">
                        <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $member['name'] }}</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $member['role'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div> --}}

            {{-- CTA Section --}}
            <div class="text-center">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    Join Our Journey
                </h2>
                <p class="text-xs text-gray-600 dark:text-gray-400 max-w-lg mx-auto mb-6">
                    Whether you're here to shop or collaborate, we'd love to hear from you. Let's build something great together.
                </p>

                <div class="max-w-lg mx-auto mb-6">
                    {{-- Newsletter Subscription form --}}
                    @include('layouts.front.includes.newsletter-subscription')
                </div>

                <a href="{{ route('front.content.contact') }}" 
                    class="inline-flex items-center px-4 py-2 text-sm bg-primary-600 hover:bg-primary-700 text-white {{FD['rounded']}} font-medium transition-colors">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-400q33 0 56.5-23.5T560-480q0-33-23.5-56.5T480-560q-33 0-56.5 23.5T400-480q0 33 23.5 56.5T480-400ZM320-240h320v-23q0-24-13-44t-36-30q-26-11-53.5-17t-57.5-6q-30 0-57.5 6T369-337q-23 10-36 30t-13 44v23ZM720-80H240q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80Zm0-80v-446L526-800H240v640h480Zm-480 0v-640 640Z"/></svg>
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>