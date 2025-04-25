<div>
    <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
        <div>
            <button 
                type="button" 
                class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'add-variant');"
            >
                <div class="flex items-center">
                    <div class="w-3 h-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    </div>
                    Add options like Colors and Size {{$product_id}} {{$category_id}}
                </div>
            </button>
        </div>
    </div>

    <x-modal name="add-variant" maxWidth="7xl" show focusable>
        <div class="p-4">
            @if (count($variations) > 0)
            @foreach ($variations as $variationAttr)
                {{-- {{$variationAttr}} --}}

                <div class="mb-6">
                    <h5 class="text-base font-medium hover:text-primary-600 transition-colors">
                        <a href="{{ route('admin.product.variation.attribute.edit', $variationAttr->id) }}" 
                        target="_blank"
                        class="flex items-center gap-1">
                            {{ $variationAttr->title }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                            </svg>
                        </a>
                    </h5>

                    @foreach ($variationAttr->values as $attrValue)
                        <p class="text-sm font-bold">{{ $attrValue->title }}</p>

                        {{$attrValue}}
                    @endforeach
                </div>

            @endforeach
        @else
            <p class="text-sm italic">{{ __('No variations found for this Category') }}</p>
        @endif
        </div>
    </x-modal>    
</div>