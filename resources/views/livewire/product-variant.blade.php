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

    <x-modal name="add-variant" maxWidth="6xl" show focusable>
        @if (count($variations) > 0)
            @foreach ($variations as $variation)
                {{$variation->attributeValue->title}}
                <br>
                <br>
                <br>
            @endforeach
        @else
            <p class="text-sm italic">{{ __('No variations found for this Category') }}</p>
        @endif
    </x-modal>    
</div>