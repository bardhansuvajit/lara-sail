<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Ad Section') }}"
    :breadcrumb="[
        ['label' => 'Ad Section']
    ]"
>
    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                @foreach ($allPages as $key => $value)
                    <li class="me-4">
                        <a href="{{ route('admin.website.advertisement.index', ['page' => $key]) }}" class="inline-block py-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 @if (request()->input('page') == $key) dark:text-blue-500 dark:border-blue-500 @endif ">{{ ucwords($key) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-4">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                @foreach ($sections as $section)
                    @foreach ($section->items as $itemIndex => $item)
                        {{ $itemIndex }}
                        <br>
                        {{-- @if ($index == 0) <x-ads.ad-set-1 :data="$item" /> @endif --}}
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</x-admin-app-layout>
