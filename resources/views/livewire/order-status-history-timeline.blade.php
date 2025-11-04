<div>
    <div class="p-2">
        <div class="" id="order-timeline-sort-container">
            <!-- heading -->
            <div class="flex justify-end mb-2">
                <p class="font-medium text-xs">Display in Frontend</p>
            </div>

            @foreach ($timeline as $stat)
                <div 
                    class="hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-1"
                    wire:key="variation-{{ $stat->id }}" 
                    data-id="{{ $stat->id }}"
                    >
                    <div class="flex justify-between items-center w-100">
                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                            <div class="w-6 flex-none transition-all duration-300 ease-in-out highlight-position-selector hidden">
                                <div class="handle cursor-grab h-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-primary-500 dark:text-primary-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-160q-33 0-56.5-23.5T280-240q0-33 23.5-56.5T360-320q33 0 56.5 23.5T440-240q0 33-23.5 56.5T360-160Zm240 0q-33 0-56.5-23.5T520-240q0-33 23.5-56.5T600-320q33 0 56.5 23.5T680-240q0 33-23.5 56.5T600-160ZM360-400q-33 0-56.5-23.5T280-480q0-33 23.5-56.5T360-560q33 0 56.5 23.5T440-480q0 33-23.5 56.5T360-400Zm240 0q-33 0-56.5-23.5T520-480q0-33 23.5-56.5T600-560q33 0 56.5 23.5T680-480q0 33-23.5 56.5T600-400ZM360-640q-33 0-56.5-23.5T280-720q0-33 23.5-56.5T360-800q33 0 56.5 23.5T440-720q0 33-23.5 56.5T360-640Zm240 0q-33 0-56.5-23.5T520-720q0-33 23.5-56.5T600-800q33 0 56.5 23.5T680-720q0 33-23.5 56.5T600-640Z"/></svg>
                                </div>
                            </div>

                            <div class="w-6 h-6 rounded-full flex items-center justify-center mr-3
                                @if ($stat->class) {{ $stat->class }} @else bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400 @endif 
                                ">

                                @if ($stat->icon)
                                    {!! $stat->icon !!}
                                @else
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $stat->title }}</p>
                                <p class="text-xs font-medium">{{ $stat->notes }}</p>
                                <p class="text-xs">{{ $stat->created_at->diffForHumans().' - '.( $stat->created_at->format('M j, Y g:i A') ) }}</p>
                            </div>
                        </div>

                        <div>
                            {{-- <x-admin.input-checkbox-toggle-switch checked="{{ $stat->show_in_frontend == 1 }}" /> --}}

                            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <label class="inline-flex items-center w-full cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer" {{ $stat->show_in_frontend == true ? 'checked' : '' }} wire:click="toggle({{ $stat->id }})">

                                    <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full rtl:peer-checked:after:translate-x-[-100%] peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all dark:border-gray-500 peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // variants drag & drop to set position
    window.addEventListener('load', () => {
        (function () {
            const sortable = document.querySelector("#order-timeline-sort-container");

            new Sortable(sortable, {
                handle: '.handle',
                animation: 150,
                dragClass: 'rounded-none!',
                onEnd: function (evt) {
                    const orderedIds = Array.from(sortable.children).map(el => el.dataset.id);
                    // console.log(orderedIds);
                    Livewire.dispatch('updateorderStatusTimeline', { ids: orderedIds });
                }
            });
        })();
    });
</script>