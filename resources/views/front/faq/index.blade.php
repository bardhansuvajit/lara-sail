<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('FAQs') }}">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 px-2 md:px-6 py-4 md:py-12">
        <div class="max-w-7xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="{{ FD['text-2'] }} font-bold text-gray-800 dark:text-gray-200">
                    Frequently Asked Questions
                </h1>
                <p class="mt-2 {{ FD['text'] }} text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Find answers to the most common questions. Use the category filter to quickly find what you need.
                </p>
            </div>

            {{-- Category Filter --}}
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                @foreach($categories as $category)
                    <a href="?category={{ urlencode($category) }}"
                       class="px-3 py-1 rounded-full {{ FD['text'] }} font-medium transition
                              {{ $activeCategory === $category 
                                  ? 'bg-primary-600 text-white' 
                                  : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-primary-100 dark:hover:bg-primary-800' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>

            {{-- FAQ List --}}
            <div class="space-y-4">
                @php
                    if ($activeCategory !== 'All') {
                        $faqs = array_filter($faqs, fn($f) => $f['cat'] === $activeCategory);
                    }
                @endphp

                @forelse ($faqs as $faqIndex => $faq)
                    <div x-data="{ open: {{ $faqIndex == 0 ? 'true' : 'false' }} }" class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow">
                        <button @click="open = !open" 
                                class="w-full flex justify-between items-center px-4 py-3 {{ FD['text'] }} font-medium text-left text-gray-800 dark:text-gray-200 focus:outline-none">
                            {{ $faq['q'] }}
                            <svg :class="{ 'rotate-180': open }" 
                                class="w-4 h-4 text-gray-500 transform transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" 
                            x-collapse 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0"
                            x-transition:enter-end="opacity-100 max-h-screen"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 max-h-screen"
                            x-transition:leave-end="opacity-0 max-h-0"
                            class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 overflow-hidden">
                            <div class="px-4 pb-4">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>

                    {{-- <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow">
                        <button @click="open = !open" 
                                class="w-full flex justify-between items-center px-4 py-3 {{ FD['text'] }} font-medium text-left text-gray-800 dark:text-gray-200 focus:outline-none">
                            {{ $faq['q'] }}
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 text-gray-500 transform transition-transform"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="px-4 pb-4 {{ FD['text'] }} text-gray-600 dark:text-gray-400">
                            {{ $faq['a'] }}
                        </div>
                    </div> --}}
                @empty
                    <p class="text-center {{ FD['text'] }} text-gray-500 dark:text-gray-400">No FAQs found for this category.</p>
                @endforelse
            </div>

            {{-- CTA --}}
            <div class="text-center mt-10">
                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mb-4">
                    Still have questions? We’re here to help.
                </p>
                <a href="{{ route('front.content.contact') }}" 
                   class="inline-flex items-center px-4 py-2 {{ FD['text-1'] }} bg-primary-600 hover:bg-primary-700 text-white {{ FD['rounded'] }} font-medium transition-colors">
                   Contact Us
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
