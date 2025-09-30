@props([
    'product_slug',
    'average_rating',
    'review_count',
    'all_reviews',
])

<div>
    <div class="text-center">
        <div class="flex justify-center">
            <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $average_rating }}</p>

            <div class="w-8 h-8 text-amber-500 dark:text-amber-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z"/></svg>
            </div>
        </div>

        <div class="text-xs text-gray-600 dark:text-gray-500 mt-1">Based on {{ formatIndianMoney($review_count) }} reviews</div>
    </div>

    @php
        $ratingBuckets = [5=>0,4=>0,3=>0,2=>0,1=>0];
        foreach($all_reviews as $r) $ratingBuckets[$r['rating']]++;
    @endphp

    <div class="mt-3 mb-5 space-y-2 {{ FD['text-1'] }}">
        @foreach($ratingBuckets as $star => $count)
            <div class="flex items-center gap-2">
                <div class="w-10 flex gap-1 items-center">
                    <p class="!w-2 text-xs text-gray-800 dark:text-white">{{ $star }}</p>
                    <div class="w-3 h-3 text-amber-500 dark:text-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z"/></svg>
                    </div>
                </div>
                <div class="flex-1 bg-gray-300 dark:bg-gray-700 h-2 rounded overflow-hidden">
                    <div style="width:@php echo $review_count? intval(($count/$review_count)*100):0 @endphp%" class="h-2 bg-amber-600 dark:bg-amber-500"></div>
                </div>
                <div class="w-8 text-xs text-right text-gray-800 dark:text-white">
                    {{ $count }}
                </div>
            </div>
        @endforeach
    </div>

    <x-front.button
        class="w-full"
        element="a"
        :href="route('front.review.create', $product_slug)"
        >
        @slot('icon')
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Z"/></svg>
        @endslot
        {{ __('Write a review') }}
    </x-front.button>
</div>