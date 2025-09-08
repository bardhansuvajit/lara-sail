<div 
    x-data='{
        "selectedCategoryId": @json($category_id ?? 0),
        "selectedCategoryTitle": @json($category_name ?? ""),
    }' >
    <x-admin.input-label for="category_id" :value="__('Category *')" />
    <x-admin.dropdown align="top" width="full">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="category_id" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="category_name" 
                x-model="selectedCategoryTitle"
                {{-- :value="old('category_name')"  --}}
                placeholder="Search category" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live.debounce.300ms="category" 
                wire:model.live="category_name"
            />
        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600">
                <ul class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($categories as $category)
                        <li>
                            @if (isset($category['child_details']) && count($category['child_details']) > 0)
                                <a 
                                    class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                    wire:click="getCategoryOptionsByParentId('{{ $category['id'] }}')"
                                    href="javascript: void(0)"
                                    @click.stop
                                >
                                    <div class="w-full flex items-center justify-between">
                                        <div class="flex space-x-2 items-center">
                                            @if($category['image_s']) 
                                                <div class="h-5 overflow-hidden flex">
                                                    <img src="{{ Storage::url($category['image_s']) }}" alt="">
                                                </div>
                                            @endif
                                            <p class="text-xs">{{ $category['title'] }}</p>
                                        </div>

                                        @if ($category['child_details'])
                                            <div class="w-4 h-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            @else
                                <a 
                                    class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                    onclick="setCategory({{ $category['id'] }}, '{{ $category['title'] }}')"
                                    href="javascript: void(0)">
                                    <div class="w-full flex items-center justify-between">
                                        <div class="flex space-x-2 items-center">
                                            @if($category['image_s']) <div class="h-5 overflow-hidden flex"><img src="{{ Storage::url($category['image_s']) }}" alt=""></div> @endif
                                            <p class="text-xs">{{ $category['title'] }}</p>
                                        </div>

                                        <div class="text-xs bg-teal-500 text-white py-0 px-1">
                                            Level {{ $category['level'] }}
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No category found.</li>
                    @endforelse
                </ul>
            </div>
        </x-slot>
    </x-admin.dropdown>

    <input type="hidden" name="category_id" x-model="selectedCategoryId" value="" required>
    <x-admin.input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>

{{-- @section('script') --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (window.Livewire) {
            window.setCategory = function (id, title) {
                let categoryIdInput = document.querySelector('input[name="category_id"]');
                let categoryNameInput = document.querySelector('input[name="category_name"]');

                if (categoryIdInput) {
                    categoryIdInput.value = id;
                }
                if (categoryNameInput) {
                    categoryNameInput.value = title;
                }

                // Ensure Livewire is ready before emitting
                window.Livewire.hook('message.sent', () => {
                    Livewire.emit('setCategory', id, title);
                });
            };
        }
    });
</script>
{{-- @endsection --}}
