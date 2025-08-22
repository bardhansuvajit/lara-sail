@props(['data'])

<div class="bg-gradient-to-r from-indigo-50 to-white dark:from-primary-900 dark:to-primary-500 {{FD['rounded']}} p-4">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 flex flex-col justify-center gap-3">
            <h1 class="{{ FD['text-2'] }} md:{{ FD['text-2'] }} lg:{{ FD['text-2'] }} font-extrabold leading-tight">{!! $data->title !!}</h1>
            <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{!! $data->subtitle !!}</p>

            <div class="flex gap-3 mt-3 justify-center sm:justify-start">
                @if ($data->cta_primary_url)
                    <a href="{{ $data->cta_primary_url }}" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded">{!! $data->cta_primary_text !!}</a>
                @endif

                @if ($data->cta_secondary_url)
                    <a href="{{ $data->cta_secondary_url }}" class="text-sm bg-white dark:bg-gray-800 border dark:border-gray-700 px-4 py-2 rounded">{!! $data->cta_secondary_text !!}</a>
                @endif
            </div>
        </div>

        <div class="md:w-80 h-60 flex-shrink-0">
            <img src="{{ Storage::url($data->image_l) }}" alt="hero" class="{{FD['rounded']}} shadow-lg w-full h-auto object-cover">
        </div>
    </div>

    {{-- mini promo strip --}}
    @if ($data->meta)
        @php
            $meta = $data->meta;
        @endphp

        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ($meta['highlights'] as $highlight)
                <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                    <div class="rounded w-6 h-6 object-cover text-gray-400 dark:text-gray-600">
                        {!! $highlight['svg'] !!}
                    </div>
                    <div>
                        <p class="{{ FD['text'] }} font-medium">{{ $highlight['title'] }}</p>
                        <p class="{{ FD['text-0'] }} text-gray-500">{{ $highlight['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>