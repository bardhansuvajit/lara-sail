<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Error 404') }}">

    <div class="min-h-[30rem] md:min-h-[36rem] flex flex-col justify-center items-center bg-white dark:bg-gray-900 px-6">
        {{-- Illustration --}}
        <div class="dark:block hidden">
            <img 
                src="{{Storage::url('public/default/error/undraw_startled_ez5h-dark.svg')}}" 
                alt="Page not found illustration" 
                class="w-48 md:w-64 mb-8"
            >
        </div>
        <div class="block dark:hidden">
            <img 
                src="{{Storage::url('public/default/error/undraw_startled_ez5h-light.svg')}}" 
                alt="Page not found illustration" 
                class="w-48 md:w-64 mb-8"
            >
        </div>

        {{-- 404 Heading --}}
        <h1 class="text-5xl font-bold text-gray-800 dark:text-gray-200">404</h1>
        <p class="mt-3 text-sm md:text-base font-medium text-gray-600 dark:text-gray-400">
            Oops! The page you're looking for doesn't exist.
        </p>

        {{-- Search Box --}}
        <div class="mt-6 w-full max-w-md">
            @include('layouts.front.navigation.search')
        </div>

        {{-- Buttons --}}
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="{{ route('front.home.index') }}" 
            class="inline-flex items-center px-3 py-2 text-sm bg-primary-600 hover:bg-primary-700 text-white {{FD['rounded']}} font-medium transition-colors">
                {{-- Home Icon --}}
                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                Go Home
            </a>

            <a href="{{ route('front.collection.index') }}" 
            class="inline-flex items-center px-3 py-2 text-sm border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200 {{FD['rounded']}} font-medium transition-colors">
                {{-- Shop Icon --}}
                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z"/></svg>
                Browse Shop
            </a>
        </div>

        {{-- Recommended Links --}}
        {{-- <div class="mt-12 w-full max-w-2xl">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                You might be interested in:
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('front.collection.index', ['category' => 'new-arrivals']) }}" 
                class="p-4 border border-gray-200 dark:border-gray-700 {{FD['rounded']}} hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    🆕 New Arrivals
                </a>
                <a href="{{ route('front.collection.index', ['category' => 'best-sellers']) }}" 
                class="p-4 border border-gray-200 dark:border-gray-700 {{FD['rounded']}} hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    ⭐ Best Sellers
                </a>
            </div>
        </div> --}}
    </div>
</x-guest-layout>