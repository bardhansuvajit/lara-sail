@props(['data'])

<section class="antialiased">
    <div class="mx-auto grid max-w-screen-xl {{ FD['rounded'] }} bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16 border dark:border-gray-700">
        <div class="lg:col-span-5 lg:mt-0 flex items-center justify-center">
            <img
                src="{{ Storage::url($data->image_l) }}"
                alt="{{ $data->title }}"
                class="w-full max-w-md {{ FD['rounded'] }} object-cover transition-transform duration-300 hover:scale-[1.02] dark:shadow-none shadow hover:shadow-lg"
                loading="lazy"
                role="img"
                aria-hidden="false"
            />
        </div>

        <div class="me-auto place-self-center lg:col-span-7 space-y-4 mt-4 sm:mt-0">
            @if ($data->meta)
                @php
                    $meta = $data->meta;
                @endphp
                <div class="flex items-center gap-3">
                    @foreach ($meta['tags'] as $tIndex => $tag)
                        @php
                            $randomTagColors = FD['randomTagColors'];
                            $colorClass = $randomTagColors[array_rand($randomTagColors)];
                        @endphp
                        <span class="inline-flex items-center rounded-full px-3 py-1 {{ FD['text'] }} font-medium {{ $colorClass }}">
                            <div class="h-4 w-4 mr-2">
                                {!! $tag['svg'] !!}
                            </div>
                            <span class="text-[10px] sm:text-xs">{{ $tag['title'] }}</span>
                        </span>
                    @endforeach
                </div>
            @endif

            <h1 class="{{ FD['text-2'] }} md:text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {!! $data->title !!}
            </h1>

            <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">
                {!! $data->subtitle !!}
            </p>

            <div class="flex items-end gap-4">
                @if ($data->meta)
                    @php
                        $meta = $data->meta;
                    @endphp

                    <div class="flex items-center gap-3">
                        <div class="text-2xl font-extrabold text-gray-900 dark:text-white leading-none">{!! $meta['pricing']['sell'] !!}</span></div>
                        <div class="flex flex-col {{ FD['text'] }} text-gray-500 dark:text-gray-400">
                            <span class="line-through">{!! $meta['pricing']['mrp'] !!}</span>
                            <span class="text-green-600 dark:text-green-400 font-medium">{!! $meta['pricing']['sale_text'] !!}</span>
                        </div>
                    </div>
                @endif

                <div class="ml-4 {{ FD['text'] }} text-gray-600 dark:text-gray-300" aria-live="polite">
                    <span class="block">Offer ends in</span>
                    <time id="promo-countdown" class="font-mono text-sm">48:00:00</time>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 gap-2">
                @if ($data->cta_primary_url)
                    <a
                        href="{{ $data->cta_primary_url }}"
                        class="{{ FD['rounded'] }} inline-flex items-center justify-center bg-primary-700 px-5 py-3 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                        role="button"
                        aria-label="{{ $data->cta_primary_text }} - {{ $data->title }}"
                    >
                        {!! $data->cta_primary_text !!}
                    </a>
                @endif

                @if ($data->cta_secondary_url)
                    <a
                        href="{{ $data->cta_secondary_url }}"
                        class="inline-flex items-center justify-center {{ FD['rounded'] }} px-4 py-3 text-sm font-medium text-primary-700 bg-white border border-gray-200 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-700 dark:text-primary-300"
                        role="button"
                        aria-label="{{ $data->cta_secondary_text }} about the {{ $data->title }}"
                    >
                        {!! $data->cta_secondary_text !!}
                    </a>
                @endif
            </div>

            @if ($data->meta)
                @php
                    $meta = $data->meta;
                @endphp

                <ul class="mt-2 flex flex-wrap gap-3 {{ FD['text'] }} text-gray-600 dark:text-gray-300">
                    @foreach ($meta['highlights'] as $highlight)
                        <li class="inline-flex items-center gap-2">
                            <div class="{{ FD['iconClass'] }} text-gray-500 dark:text-gray-300">
                                {!! $highlight['svg'] !!}
                            </div>

                            <span>{{ $highlight['title'] }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
</section>