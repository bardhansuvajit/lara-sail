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

                    <span x-text="open ? 'Close FAQ Form' : 'Add FAQ'"></span>

                    <div class="w-3 h-3 ml-1" x-show="open">
                        {{-- close icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                    </div>
                </div>
            </a>

            <div x-show="open" class="">
                <div id="faq-container">
                    <div class="grid gap-4 mt-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="faq-question" :value="__('Question')" />
                            <x-admin.textarea 
                                id="faq-question" 
                                class="block w-full" 
                                name="faq_question" 
                                wire:model.defer="faq_question"
                                placeholder="Enter Question" 
                                maxlength="1000" 
                            />
                            <x-admin.input-error :messages="$errors->get('faq_question')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mt-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="faq-answer" :value="__('Answer')" />
                            <x-admin.textarea 
                                id="faq-answer" 
                                class="block w-full" 
                                name="faq_answer" 
                                wire:model.defer="faq_answer"
                                placeholder="Enter Answer" 
                                maxlength="10000" 
                            />
                            <x-admin.input-error :messages="$errors->get('faq_answer')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-admin.button 
                            element="button" 
                            tag="primary" 
                            type="button" 
                            wire:click="createFaq" 
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

        {{-- List of FAQs --}}
        @if($faqs && $faqs->count())
            <div class="space-y-1 bg-gray-50 dark:bg-gray-700 rounded p-2">
                <div class="border-b border-gray-300 dark:border-gray-500 pb-2">
                    <div class="flex justify-between">
                        <h5 class="text-gray-700 dark:text-gray-300 font-medium text-xs">FAQs List</h5>

                        <div>
                            <button 
                                type="button"
                                class="text-xs inline-block text-gray-600 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-500" 
                                id="faqPositionToggleButton" 
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
                </div>

                <div id="faq-sort-container">
                    @foreach($faqs as $faq)
                        <div 
                            class="flex items-center justify-between p-1 dark:hover:bg-gray-800/40"
                            wire:key="variation-{{ $faq->id }}" 
                            data-id="{{ $faq->id }}"
                        >

                            <div class="flex items-center gap-2">
                                <div class="w-6 flex-none transition-all duration-300 ease-in-out faq-position-selector hidden">
                                    <div class="handle cursor-grab h-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-primary-500 dark:text-primary-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-160q-33 0-56.5-23.5T280-240q0-33 23.5-56.5T360-320q33 0 56.5 23.5T440-240q0 33-23.5 56.5T360-160Zm240 0q-33 0-56.5-23.5T520-240q0-33 23.5-56.5T600-320q33 0 56.5 23.5T680-240q0 33-23.5 56.5T600-160ZM360-400q-33 0-56.5-23.5T280-480q0-33 23.5-56.5T360-560q33 0 56.5 23.5T440-480q0 33-23.5 56.5T360-400Zm240 0q-33 0-56.5-23.5T520-480q0-33 23.5-56.5T600-560q33 0 56.5 23.5T680-480q0 33-23.5 56.5T600-400ZM360-640q-33 0-56.5-23.5T280-720q0-33 23.5-56.5T360-800q33 0 56.5 23.5T440-720q0 33-23.5 56.5T360-640Zm240 0q-33 0-56.5-23.5T520-720q0-33 23.5-56.5T600-800q33 0 56.5 23.5T680-720q0 33-23.5 56.5T600-640Z"/></svg>
                                    </div>
                                </div>

                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-300 text-xs">{!! nl2br($faq->question) !!}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{!! nl2br($faq->answer) !!}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div wire:key="toggle-wrapper-{{ $faq->id }}">
                                    @livewire('toggle-status', [
                                        'model' => 'ProductFaq',
                                        'modelId' => $faq->id,
                                    ], key('toggle-'.$faq->id))
                                </div>

                                <x-admin.button-icon
                                    element="button"
                                    class="!w-6 !h-6 bg-gray-200 hover:bg-gray-400 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-600 dark:text-white border rounded-full cursor-pointer transition-colors duration-300"
                                    tag="secondary"
                                    x-data=""
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-faq-deletion'); 
                                        $dispatch('set-delete-id', {{$faq->id}})" 
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

    {{-- faq delete confirm modal --}}
    <x-admin.modal name="confirm-faq-deletion" maxWidth="sm" focusable>
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
                    wire:click.prevent="deleteFaq(deleteId)"
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
            const sortable = document.querySelector("#faq-sort-container");

            new Sortable(sortable, {
                handle: '.handle',
                animation: 150,
                dragClass: 'rounded-none!',
                onEnd: function (evt) {
                    const orderedIds = Array.from(sortable.children).map(el => el.dataset.id);
                    // console.log(orderedIds);
                    Livewire.dispatch('updateProductFaqsOrder', { ids: orderedIds });
                }
            });
        })();
    });
</script>