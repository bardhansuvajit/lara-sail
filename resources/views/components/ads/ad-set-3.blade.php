@props(['data'])

@php
    /** Type 1, when small image is square
     *  Type 2, when small image is vertical
     */
    $rightSideAdType = 1; // Type 1/2

    if ($rightSideAdType == 2) {
        $adClass1 = "p-4 sm:p-6";
        $adClass11 = "gap-4";
        $adClass2 = "rounded-md";
        $adClass3 = "w-20 h-20";
        $adClass4 = "";
    } else {
        $adClass1 = "p-0";
        $adClass11 = "";
        $adClass2 = FD['rounded'];
        $adClass3 = "w-40 h-full";
        $adClass4 = "p-4 sm:p-6";
    }
@endphp

<div class="bg-white dark:bg-gray-800 {{ $adClass1 }} flex {{ $adClass11 }} shadow-sm h-full {{ FD['rounded'] }} relative overflow-hidden items-center">
    @if (isset($data->meta['bgImage']))
        <div class="absolute inset-0 opacity-30 dark:opacity-30 z-0">
            <img src="{{ Storage::url($data->meta['bgImage']) }}" alt="{{ $data->title }}" class="w-full h-full object-cover object-center">
        </div>
    @endif

    <div class="hidden sm:block h-full z-0">
        <img src="{{ Storage::url($data->image_m) }}" alt="" class="{{ $adClass3 }} object-cover flex-shrink-0 {{ $adClass2 }} z-0" aria-hidden="true" />
    </div>

    <div class="flex-1 flex flex-col justify-between h-full z-0 {{ $adClass4 }}">
        @if (isset($data->meta['tags']))
            @php
                $tags = $data->meta['tags'];
            @endphp

            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                @if ($tags['left'])
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/12 text-xs font-semibold tracking-tight bg-indigo-50 text-indigo-700">
                        <div class="{{ FD['iconClass'] }}">
                            {!! $tags['left']['tag1']['svg'] !!}
                        </div>
                        <span class="ml-1">{!! $tags['left']['tag1']['title'] !!}</span>
                    </span>

                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-green-50 text-green-700 text-xs font-medium">
                        <div class="{{ FD['iconClass'] }}">
                            {!! $tags['left']['tag2']['svg'] !!}
                        </div>
                        <span class="ml-1">{!! $tags['left']['tag2']['title'] !!}</span>
                    </span>
                </div>
                @endif

                @if ($tags['right'])
                    <div class="text-xs text-gray-700 dark:text-white/80 flex items-center gap-2 mt-2 sm:mt-0">
                        <div class="{{ FD['iconClass'] }}">
                            {!! $tags['right']['tag1']['svg'] !!}
                        </div>
                        <span>{!! $tags['right']['tag1']['title'] !!}</span>
                    </div>
                @endif
            </div>
        @endif

        <div class="mt-3">
            <h3 class="text-lg font-bold dark:text-gray-50">{!! $data->title !!}</h3>
            <p class="text-xs text-gray-600 dark:text-gray-300 mt-2 mb-3">{!! $data->subtitle !!}</p>

            @if ($data->meta)
                @php
                    $meta = $data->meta;
                @endphp
                <ul class="grid grid-cols-2 gap-2 text-xs">
                    @foreach ($meta['highlights'] as $tIndex => $tag)
                        <li class="flex items-start gap-2">
                            <div class="{{ FD['iconClass'] }} text-gray-700 dark:text-white/95 shrink-0">
                                {!! $tag['svg'] !!}
                            </div>
                            <span class="text-gray-700 dark:text-white/95">{{ $tag['title'] }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-6 sm:mt-4 flex gap-3">
            @if ($data->cta_primary_url)
                <a href="{{ $data->cta_primary_url }}"
                class="inline-flex items-center justify-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold {{ FD['rounded'] }}
                        focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-100 dark:focus-visible:ring-offset-gray-800 transition"
                aria-label="{!! $data->cta_primary_text !!}">
                    {!! $data->cta_primary_text !!}
                </a>
            @endif

            @if ($data->cta_primary_url)
                <a href="{{ $data->cta_secondary_url }}"
                class="inline-flex items-center justify-center px-3 py-2 border border-gray-700 dark:border-gray-500 text-xs sm:text-sm text-gray-700 dark:text-gray-200 {{ FD['rounded'] }}
                        hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 transition"
                aria-label="{!! $data->cta_secondary_text !!}">
                    {!! $data->cta_secondary_text !!}
                </a>
            @endif
        </div>
    </div>
</div>