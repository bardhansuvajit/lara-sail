<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Ad Section') }}"
    :breadcrumb="[ ['label' => 'Ad Section'] ]"
>
    <section class="sm:rounded-lg overflow-hidden px-1 py-2">

        <div class="my-3 flex items-center text-red-600 dark:text-orange-600 bg-orange-100 dark:bg-orange-100 p-2">
            <div class="w-4 h-4 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/></svg>
            </div>
            <p class="text-sm font-bold text-red-600 dark:text-orange-600">{!! __('Developer expertise is required to manage this section') !!}</p>
        </div>

        {{-- Tabs --}}
        <nav role="tablist" aria-label="Ad pages" class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px justify-center">
                @php $current = request('page', $currentPage ?? 'homepage'); @endphp
                @foreach ($allPages as $key => $value)
                    @php $isActive = (string) $current === (string) $key; @endphp
                    <li class="me-4" role="presentation">
                        <a
                            href="{{ route('admin.website.advertisement.index', ['page' => $key]) }}"
                            role="tab"
                            aria-selected="{{ $isActive ? 'true' : 'false' }}"
                            class="inline-block py-3 border-b-2 rounded-t-lg px-3
                              {{ $isActive ? 'text-blue-600 border-blue-600' : 'text-gray-400 dark:hover:text-gray-500 hover:text-gray-800 border-transparent' }}"
                        >
                            {{ ucwords(str_replace(['_', '-'], ' ', $key)) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="mt-4">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700 flex flex-col gap-6">
                @forelse ($sections as $sectionIndex => $section)
                    @php
                        $items = $section->items ?? collect();
                        $componentName = 'ads.ad-set-' . \Illuminate\Support\Str::kebab($section->type ?? 'default');
                    @endphp

                    @forelse ($items as $item)
                        <div class="grid grid-cols-10 justify-between items-center gap-4 hover:bg-gray-100 dark:hover:bg-gray-600">

                            <!-- homepage -->
                            @if ($currentPage == "homepage")
                                @switch($sectionIndex)
                                    @case(0)
                                        <div class="col-span-6">
                                            <x-ads.ad-set-1 :data="$item" />
                                        </div>
                                        <div class="col-span-2"></div>
                                        @break
                                    @case(1)
                                        <div class="col-span-4">
                                            <x-ads.ad-set-2 :data="$item" />
                                        </div>
                                        <div class="col-span-4"></div>
                                        @break
                                    @case(2)
                                        <div class="col-span-4">
                                            <x-ads.ad-set-3 :data="$item" />
                                        </div>
                                        <div class="col-span-4"></div>
                                        @break
                                    @case(3)
                                        <div class="col-span-8">
                                            <x-ads.ad-set-4 :data="$item" />
                                        </div>
                                        @break
                                    @default
                                        <h5>Something Happened ! No Ads Found.</h5>
                                @endswitch

                            <!-- category -->
                            @elseif ($currentPage == "category")
                                @switch($sectionIndex)
                                    @case(0)
                                        <div class="col-span-4">
                                            <x-ads.ad-set-2 :data="$item" />
                                        </div>
                                        <div class="col-span-4"></div>
                                        @break
                                    @case(1)
                                        <div class="col-span-4">
                                            <x-ads.ad-set-3 :data="$item" />
                                        </div>
                                        <div class="col-span-4"></div>
                                        @break
                                    @case(2)
                                        <div class="col-span-8">
                                            <a href="{{ $item->url }}" class="block {{ FD['rounded'] }} overflow-hidden shadow">
                                                <img src="{{ Storage::url($item->image_l) }}" alt="Top ad" class="w-full h-auto object-cover" loading="lazy">
                                            </a>
                                        </div>
                                        @break
                                    @default
                                        <h5>Something Happened ! No Ads Found.</h5>
                                @endswitch
                            @endif

                            <div class="col-span-2">
                                <div class="flex justify-end items-center space-x-2">
                                    @livewire('toggle-status', [
                                        'model' => 'AdItem',
                                        'modelId' => $item->id
                                    ], key("toggle-{$item->id}"))

                                    <x-admin.button-icon
                                        element="a"
                                        tag="secondary"
                                        :href="route('admin.website.ad.item.edit', $item->id)"
                                        title="Edit"
                                        class="border"
                                        >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                        @endslot
                                    </x-admin.button-icon>
                                </div>

                                <hr class="my-3 dark:border-gray-500">

                                <p class="text-end text-sm">{{ ucwords($section->pages) }}</p>
                            </div>
                        </div>
                    @empty
                        {{-- optional empty for items --}}
                        <div class="text-sm text-gray-500 italic px-4 py-2">No items in "{{ $section->name }}"</div>
                    @endforelse

                @empty
                    <div class="text-center text-gray-500 py-6">No ad sections found for this page.</div>
                @endforelse
            </div>
        </div>
    </section>
</x-admin-app-layout>
