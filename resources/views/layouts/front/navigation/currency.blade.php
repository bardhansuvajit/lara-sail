<x-front.dropdown width="48">
    <x-slot name="trigger">
        <button type="button" class="inline-flex items-center gap-1 {{FD['text']}} font-medium hover:underline dark:text-white">
            <div class="flex gap-1 items-center">
                <p>
                    <span class="currency-symbol">₹</span>
                    <span class="currency-code">(INR)</span>
                </p>
                <div class="w-5">
                    <svg id=flag-icons-in viewBox="0 0 640 480"xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><path d="M0 0h640v160H0z"fill=#f93 /><path d="M0 160h640v160H0z"fill=#fff /><path d="M0 320h640v160H0z"fill=#128807 /><g transform="matrix(3.2 0 0 3.2 320 240)"><circle r=20 fill=#008 /><circle r=17.5 fill=#fff /><circle r=3.5 fill=#008 /><g id=in-d><g id=in-c><g id=in-b><g id=in-a fill=#008><circle r=.9 transform="rotate(7.5 -8.8 133.5)"/><path d="M0 17.5.6 7 0 2l-.6 5z"/></g><use height=100% transform=rotate(15) width=100% xlink:href=#in-a /></g><use height=100% transform=rotate(30) width=100% xlink:href=#in-b /></g><use height=100% transform=rotate(60) width=100% xlink:href=#in-c /></g><use height=100% transform=rotate(120) width=100% xlink:href=#in-d /><use height=100% transform=rotate(-120) width=100% xlink:href=#in-d /></g></svg>
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
