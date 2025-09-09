<x-front.dropdown width="48">
    <x-slot name="trigger">
        <button type="button" class="inline-flex items-center gap-1 {{FD['text']}} font-medium hover:underline dark:text-white">
            <div class="flex gap-1 items-center">
                <p>
                    <span class="currency-symbol">{{ COUNTRY['icon'] }}</span>
                    <span class="currency-code">({{ COUNTRY['currency'] }})</span>
                </p>
                <div class="w-5">
                    {!! COUNTRY['flagSvg'] !!}
                </div>
            </div>

            {!! FD['dropdownCaret'] !!}
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="bg-white dark:bg-gray-700">
            <ul class="text-start {{FD['text']}} font-medium dark:text-white">
                @foreach ($activeCountries as $item)
                    <li>
                        <a href="javascript: void(0)" data-title="{{ $item->code }}" class="inline-flex w-full items-center gap-2 {{FD['rounded']}} px-3 py-2 {{FD['text']}} hover:bg-gray-100 dark:hover:bg-gray-600 toggle-currency" >
                            <div class="w-4 h-4 flex items-center">
                                {!! $item->flag !!}
                            </div>
                            <p>{{ $item->name }} - {{ $item->currency_symbol }} ({{ $item->currency_code }})</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-slot>
</x-front.dropdown>
