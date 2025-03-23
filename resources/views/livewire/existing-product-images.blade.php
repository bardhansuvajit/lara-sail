<div>
    @if (count($images) > 0)
        <div class="border border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 p-2 rounded-lg">
            <div class="border-b border-gray-300 dark:border-gray-500 pb-2">
                <h5 class="text-gray-700 dark:text-gray-300 font-medium text-xs">Uploaded Images</h5>
            </div>

            <div class="my-3 grid grid-cols-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-8 gap-4">
                @foreach ($images as $imageKey => $singleImage)
                    @php
                        $imagePath = $singleImage->image_m;
                        $fullPath = Storage::path($imagePath);
                        $fileSize = Storage::exists($imagePath) ? filesize($fullPath) : 0;
                        $fileSizeKB = number_format($fileSize / 1024, 2) . ' KB';
                        $fileName = basename($imagePath);

                        $dimensions = Storage::exists($imagePath) ? getimagesize($fullPath) : null;
                        $width = $dimensions ? $dimensions[0] : 'N/A';
                        $height = $dimensions ? $dimensions[1] : 'N/A';
                    @endphp

                    <div class="relative group break-inside-avoid">
                        <img class="w-full h-auto transition-transform duration-300 transform group-hover:scale-105 border dark:border-gray-800" src="{{ Storage::url($imagePath) }}" alt="{{ $fileName }}" loading="lazy">
                        {{-- <p class="text-[8px] text-gray-700 dark:text-gray-300 mt-2 text-clip" title="{{ $fileName }}">{{ $fileName }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $fileSizeKB }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Dimensions: {{ $width }}x{{ $height }}</p> --}}

                        <x-admin.button-icon
                            element="button"
                            class="!w-6 !h-6 absolute -top-3 -right-3 z-2 bg-gray-200 hover:bg-gray-400 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-600 dark:text-white border rounded-full cursor-pointer transition-colors duration-300"
                            tag="secondary"
                            x-data=""
                            x-on:click.prevent="
                                $dispatch('open-modal', 'confirm-image-deletion'); 
                                $dispatch('data-image-path', '{{ Storage::url($singleImage->image_s) }}');
                                $dispatch('set-delete-id', {{$singleImage->id}})" 
                        >
                            @slot('icon')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4 mx-auto">
                                    <path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"></path>
                                </svg>
                            @endslot
                        </x-admin.button-icon>

                    </div>
                @endforeach
            </div>

            <div class="border-t border-gray-300 dark:border-gray-500 pt-2">
                <div>
                    <a 
                        href="javascript: void(0)" 
                        class="text-xs inline-block text-gray-600 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-500" 
                        id="highlightButton" 
                        x-data="" 
                        x-on:click.prevent="
                            $dispatch('open-modal', 'highlight');
                        " 
                    >
                        <div class="flex items-center">
                            <div class="w-3 h-3 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-440v-287L217-624l-57-56 200-200 200 200-57 56-103-103v287h-80ZM600-80 400-280l57-56 103 103v-287h80v287l103-103 57 56L600-80Z"/></svg>
                            </div>
                            Change position
                        </div>
                    </a>
                </div>

                <div>
                    <x-admin.input-checkbox 
                        id="see-image-details-checkbox"
                        label="See more image details" />
                </div>
            </div>
        </div>

        {{-- image delete confirm modal --}}
        <x-modal name="confirm-image-deletion" maxWidth="sm" focusable>
            <div 
                class="p-6" 
                x-data="{ deleteId: '', image: '' }" 
                x-on:set-delete-id.window="deleteId = $event.detail" 
                x-on:data-image-path.window="image = $event.detail"
            >
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure?') }}
                </h2>

                <div class="my-4">
                    <img x-bind:src="image" alt="" class="h-12 object-cover">
                </div>

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
                        wire:click.prevent="deleteImage(deleteId)"
                        x-on:click="$dispatch('close')"
                    >
                        {{ __('Yes, Delete') }}
                    </x-admin.button>
        
                    {{-- <form :action="deleteRoute" method="POST" class="ms-3">
                        @csrf
                        @method('DELETE')
                        <x-admin.button
                            element="button"
                            tag="danger"
                            href="javascript: void(0)"
                            title="Delete"
                        >
                            {{ __('Yes, Delete') }}
                        </x-admin.button>
                    </form> --}}
                </div>
            </div>
        </x-modal>
    @else
        <p class="text-base font-medium text-red-600 dark:text-orange-600 space-y-1">No Images found !</p>
        <p class="text-xs text-red-400 dark:text-orange-700 space-y-1">A {{ $type }} must have some images to give an idea to the customers what they are paying for.</p>
    @endif
</div>
