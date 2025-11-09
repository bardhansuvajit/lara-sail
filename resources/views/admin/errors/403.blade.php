<x-admin-app-layout
    screen="lg"
    title="{{ __('404') }}">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center">
                <!-- Icon -->
                <div class="mb-8">
                    <svg class="w-24 h-24 md:w-32 md:h-32 text-gray-400 dark:text-gray-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                
                <!-- Title -->
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    403 - Unauthorized
                </h1>
                
                <!-- Message -->
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                    The page you are looking for doesn't exist in the admin panel.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Go Back
                    </a>
                    <a href="{{ route('admin.dashboard.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                </div>

                <!-- Debug Info (for admins) -->
                @if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->hasRole('Super Admin'))
                <div class="mt-8 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg text-left max-w-2xl mx-auto">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">Debug Information:</h3>
                    <div class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                        <p><strong>URL:</strong> {{ request()->fullUrl() }}</p>
                        <p><strong>Method:</strong> {{ request()->method() }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-app-layout>