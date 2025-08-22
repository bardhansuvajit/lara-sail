@props(['data'])

<div class="bg-indigo-600 text-white {{ FD['rounded'] }} p-4 sm:p-6 h-full flex flex-col justify-between shadow-md overflow-hidden">
    @if ($data->meta['tags'])
        @php
            $tags = $data->meta['tags'];
        @endphp

        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
            @if ($tags['left'])
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/12 text-xs font-semibold tracking-tight">
                    <div class="{{ FD['iconClass'] }}">
                        {!! $tags['left']['tag1']['svg'] !!}
                    </div>
                    <span class="ml-1">{!! $tags['left']['tag1']['title'] !!}</span>
                </span>

                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/10 text-xs font-medium">
                    <div class="{{ FD['iconClass'] }}">
                        {!! $tags['left']['tag2']['svg'] !!}
                    </div>
                    <span class="ml-1">{!! $tags['left']['tag2']['title'] !!}</span>
                </span>
            </div>
            @endif

            @if ($tags['right'])
                <div class="text-xs text-white/80 flex items-center gap-2 mt-2 sm:mt-0">
                    <div class="{{ FD['iconClass'] }}">
                        {!! $tags['right']['tag1']['svg'] !!}
                    </div>
                    <span>{!! $tags['right']['tag1']['title'] !!}</span>
                </div>
            @endif
        </div>
    @endif

    <div class="mt-3">
        <h3 class="text-lg font-bold">{!! $data->title !!}</h3>
        <p class="text-xs mt-2 text-white/90 mb-3">{!! $data->subtitle !!}</p>

        @if ($data->meta)
            @php
                $meta = $data->meta;
            @endphp
            <ul class="grid grid-cols-2 gap-2 text-xs">
                @foreach ($meta['highlights'] as $tIndex => $tag)
                    <li class="flex items-start gap-2">
                        <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                            {!! $tag['svg'] !!}
                        </div>
                        <span class="text-white/95">{{ $tag['title'] }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-8 sm:mt-4 flex flex-row sm:flex-row items-stretch gap-2">
        @if ($data->cta_primary_url)
            <a href="{{ $data->cta_primary_url }}"
            class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 {{ FD['rounded'] }} bg-white text-indigo-600 font-semibold text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600 transition"
            aria-label="{!! $data->cta_primary_text !!}">
                {!! $data->cta_primary_text !!}
            </a>
        @endif

        @if ($data->cta_secondary_url)
            <a href="{{ $data->cta_secondary_url }}"
            class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 {{ FD['rounded'] }} border border-white/25 text-white text-sm font-medium hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600 transition"
            aria-label="{!! $data->cta_secondary_text !!}">
                {!! $data->cta_secondary_text !!}
            </a>
        @endif
    </div>
</div>