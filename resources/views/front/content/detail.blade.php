<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ $metaTitle }}"
    description="{{ $metaDescription }}">

    <main class="mx-auto px-4 sm:px-6 py-8">
        <div class="max-w-4xl mx-auto mb-8 text-center">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-3xl">
                {{ $content->title }}
            </h1>
            <div class="mt-4 border-b border-gray-200 dark:border-gray-700"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-2 sm:p-4">
                    <div class="prose dark:prose-invert max-w-none text-xs">
                        {!! nl2br($content->content) !!}
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="px-2 sm:px-4 py-4 bg-gray-50 dark:bg-gray-700/30 text-sm text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                    Last updated on {{ $content->updated_at->format('F j, Y') }}
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto mt-8 justify-self-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to previous page
            </a>
        </div>
    </main>

</x-guest-layout>