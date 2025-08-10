<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('FAQs') }}">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 px-6 py-12">
        <div class="max-w-7xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Frequently Asked Questions
                </h1>
                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Find answers to the most common questions. Use the category filter to quickly find what you need.
                </p>
            </div>

            {{-- Category Filter --}}
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                @php
                    $categories = ['All', 'Orders', 'Payments', 'Shipping', 'Returns', 'Account'];
                    $activeCategory = request('category', 'All');
                @endphp

                @foreach($categories as $category)
                    <a href="?category={{ urlencode($category) }}"
                       class="px-3 py-1 rounded-full text-xs font-medium transition
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
                    $faqs = [
                        ['q' => 'How do I place an order?', 'a' => 'Simply browse products, add them to your cart, and proceed to checkout.', 'cat' => 'Orders'],
                        ['q' => 'What payment methods are accepted?', 'a' => 'We accept credit/debit cards, UPI, net banking, and popular wallets.', 'cat' => 'Payments'],
                        ['q' => 'How long does shipping take?', 'a' => 'Standard delivery takes 3-5 business days; express delivery is 1-2 days.', 'cat' => 'Shipping'],
                        ['q' => 'How do I track my order?', 'a' => 'You can track your order from your account dashboard under "My Orders".', 'cat' => 'Orders'],
                        ['q' => 'Can I return a product?', 'a' => 'Yes, returns are accepted within 7 days if the product is unused and in original packaging.', 'cat' => 'Returns'],
                        ['q' => 'How do I reset my password?', 'a' => 'Go to login page, click "Forgot Password", and follow the instructions.', 'cat' => 'Account'],
                    ];

                    if ($activeCategory !== 'All') {
                        $faqs = array_filter($faqs, fn($f) => $f['cat'] === $activeCategory);
                    }
                @endphp

                @forelse ($faqs as $faq)
                    <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-lg shadow">
                        <button @click="open = !open" 
                                class="w-full flex justify-between items-center px-4 py-3 text-xs font-medium text-left text-gray-800 dark:text-gray-200 focus:outline-none">
                            {{ $faq['q'] }}
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 text-gray-500 transform transition-transform"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="px-4 pb-4 text-xs text-gray-600 dark:text-gray-400">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @empty
                    <p class="text-center text-xs text-gray-500 dark:text-gray-400">No FAQs found for this category.</p>
                @endforelse
            </div>

            {{-- CTA --}}
            <div class="text-center mt-10">
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">
                    Still have questions? We’re here to help.
                </p>
                <a href="{{ route('front.content.contact') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm bg-primary-600 hover:bg-primary-700 text-white {{ FD['rounded'] }} font-medium transition-colors">
                   Contact Us
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
