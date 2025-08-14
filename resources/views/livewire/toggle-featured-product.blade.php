<div class="flex text-xs">
    @foreach (['featured' => 'Featured', 'flash' => 'Flash', 'trending' => 'Trending', 'off' => 'Off'] as $value => $label)
        <label class="cursor-pointer border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition {{ $loop->first ? 'rounded-l-md' : '' }} {{ $loop->last ? 'rounded-r-md -ml-px' : '-ml-px' }}">
            <input 
                type="radio" 
                name="plan_{{ $productId }}" 
                value="{{ $value }}" 
                wire:click="updateFeatureType('{{ $value }}')" 
                class="hidden peer"
                @checked(($featureType ?? 'off') === $value)>

            <span class="peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 px-3 py-1.5 inline-block">
                {{ $label }}
            </span>
        </label>
    @endforeach
</div>
