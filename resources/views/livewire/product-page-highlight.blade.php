<div>
    <div class="grid gap-4 mb-3 grid-cols-1">
        <div x-data="{ open: false }">
            <a 
                href="javascript: void(0)" 
                class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                @click="open = !open"
            >
                <div class="flex items-center">
                    <div class="w-3 h-3" x-show="!open">
                        {{-- add icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    </div>

                    <span x-text="open ? 'Close Highlight Form' : 'Add Highlight'"></span>

                    <div class="w-3 h-3 ml-1" x-show="open">
                        {{-- close icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                    </div>
                </div>
            </a>

            <div x-show="open" class="">
                <div id="highlight-container">
                    <div class="grid gap-4 mt-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="icon" :value="__('Icon')" />
                            <ul class="flex space-x-2">
                                @forelse (developerSettings('product_highlight_icons')->icons as $keyIcon => $keyValue)
                                    <li>
                                        <x-admin.radio-input-button 
                                            id="icon_{{$keyIcon}}" 
                                            value='{!! $keyValue !!}' 
                                            title='{!! $keyValue !!}'
                                            name="icon"
                                            wire:model="icon"
                                            :checked="$loop->first"
                                            {{-- @if($loop->first) checked @endif --}}
                                        />
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                            <x-admin.input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mt-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="highlight-title" :value="__('Title')" />
                            <x-admin.text-input 
                                id="highlight-title" 
                                class="block w-full" 
                                type="text" 
                                name="highlight_title" 
                                wire:model.defer="highlight_title"
                                placeholder="Enter title" 
                            />
                            <x-admin.input-error :messages="$errors->get('highlight_title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mt-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="highlight-description" :value="__('Description')" />
                            <x-admin.textarea 
                                id="highlight-description" 
                                class="block w-full" 
                                name="highlight_description" 
                                wire:model.defer="highlight_description"
                                placeholder="Enter Description" 
                                maxlength="10000" 
                            />
                            <x-admin.input-error :messages="$errors->get('highlight_description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-admin.button 
                            element="button" 
                            tag="primary" 
                            type="button" 
                            wire:click="createHighlight" 
                            title="Add Now"
                        >
                            @slot('icon')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                            @endslot
                            Add Now
                        </x-admin.button>
                    </div>
                </div>
            </div>
        </div>

        {{-- List of Highlights --}}
        @if($highlights && $highlights->count())
            <div class="space-y-1 bg-gray-50 dark:bg-gray-700 rounded p-2">
                <div class="border-b border-gray-300 dark:border-gray-500 pb-2">
                    <div class="flex justify-between items-center">
                        <h5 class="text-gray-700 dark:text-gray-300 font-medium text-xs">Highlights' List</h5>

                        <button 
                            type="button"
                            class="text-xs inline-block text-gray-600 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-500" 
                            id="positionToggleButton" 
                            >
                            <div class="flex items-center">
                                <div class="w-3 h-3 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-440v-287L217-624l-57-56 200-200 200 200-57 56-103-103v287h-80ZM600-80 400-280l57-56 103 103v-287h80v287l103-103 57 56L600-80Z"/></svg>
                                </div>
                                Change position
                            </div>
                        </button>
                    </div>
                </div>

                <div id="highlight-sort-container">
                    @foreach($highlights as $highlight)
                        <div 
                            class="flex items-center justify-between p-1 dark:hover:bg-gray-800/40"
                            wire:key="variation-{{ $highlight->id }}" 
                            data-id="{{ $highlight->id }}"
                        >

                            <div class="flex items-center gap-2">
                                <div class="w-6 flex-none transition-all duration-300 ease-in-out highlight-position-selector hidden">
                                    <div class="handle cursor-grab h-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-primary-500 dark:text-primary-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-160q-33 0-56.5-23.5T280-240q0-33 23.5-56.5T360-320q33 0 56.5 23.5T440-240q0 33-23.5 56.5T360-160Zm240 0q-33 0-56.5-23.5T520-240q0-33 23.5-56.5T600-320q33 0 56.5 23.5T680-240q0 33-23.5 56.5T600-160ZM360-400q-33 0-56.5-23.5T280-480q0-33 23.5-56.5T360-560q33 0 56.5 23.5T440-480q0 33-23.5 56.5T360-400Zm240 0q-33 0-56.5-23.5T520-480q0-33 23.5-56.5T600-560q33 0 56.5 23.5T680-480q0 33-23.5 56.5T600-400ZM360-640q-33 0-56.5-23.5T280-720q0-33 23.5-56.5T360-800q33 0 56.5 23.5T440-720q0 33-23.5 56.5T360-640Zm240 0q-33 0-56.5-23.5T520-720q0-33 23.5-56.5T600-800q33 0 56.5 23.5T680-720q0 33-23.5 56.5T600-640Z"/></svg>
                                    </div>
                                </div>

                                <span class="w-5 h-5">{!! $highlight->icon !!}</span>

                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-300 text-xs">{{ $highlight->title }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $highlight->description }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div wire:key="toggle-wrapper-{{ $highlight->id }}">
                                    @livewire('toggle-status', [
                                        'model' => 'ProductHighlightList',
                                        'modelId' => $highlight->id,
                                    ], key('toggle-'.$highlight->id))
                                </div>

                                <x-admin.button-icon
                                    element="button"
                                    class="!w-6 !h-6 bg-gray-200 hover:bg-gray-400 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-600 dark:text-white border rounded-full cursor-pointer transition-colors duration-300"
                                    tag="secondary"
                                    x-data=""
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-highlight-deletion'); 
                                        $dispatch('set-delete-id', {{$highlight->id}})" 
                                >
                                    @slot('icon')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4 mx-auto"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"></path></svg>
                                    @endslot
                                </x-admin.button-icon>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endif
    </div>

    {{-- highlight delete confirm modal --}}
    <x-admin.modal name="confirm-highlight-deletion" maxWidth="sm" focusable>
        <div 
            class="p-6" 
            x-data="{ deleteId: '' }" 
            x-on:set-delete-id.window="deleteId = $event.detail" 
        >
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure?') }}
            </h2>

            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                {{ __('Once this data is deleted, it cannot be recovered') }}
            </p>

            <div class="mt-6 flex justify-end space-x-3">
                <x-admin.button
                    element="button"
                    tag="secondary"
                    href="javascript: void(0)"
                    title="Cancel"
                    class="border"
                    type="button"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-admin.button>

                <x-admin.button
                    element="button"
                    tag="danger"
                    href="javascript: void(0)"
                    title="Delete"
                    wire:click.prevent="deleteHighlight(deleteId)"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Yes, Delete') }}
                </x-admin.button>
            </div>
        </div>
    </x-admin.modal>
</div>

<script>
    // variants drag & drop to set position
    window.addEventListener('load', () => {
        (function () {
            const sortable = document.querySelector("#highlight-sort-container");

            new Sortable(sortable, {
                handle: '.handle',
                animation: 150,
                dragClass: 'rounded-none!',
                onEnd: function (evt) {
                    const orderedIds = Array.from(sortable.children).map(el => el.dataset.id);
                    // console.log(orderedIds);
                    Livewire.dispatch('updateProductHighlightsOrder', { ids: orderedIds });
                }
            });
        })();
    });
</script>