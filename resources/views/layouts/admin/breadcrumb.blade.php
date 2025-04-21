@if(isset($breadcrumb) && is_array($breadcrumb))
    <nav class="mb-4 flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-1 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard.index') }}" class="inline-flex items-center text-xs font-medium text-gray-700 hover:text-primary-600 dark:text-gray-200 dark:hover:text-primary-300">
                    <svg class="me-2 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                    </svg>
                    Home
                </a>
            </li>
            @foreach ($breadcrumb as $crumb)
                @if (!$loop->last)
                    <li>
                        <div class="flex items-center">
                            <svg class="mx-1 w-4 h-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                            </svg>

                            <a href="{{ $crumb['url'] }}" class="ms-1 text-xs font-medium text-gray-700 hover:text-primary-600 dark:text-gray-200 dark:hover:text-primary-300 md:ms-2">{{ $crumb['label'] }}</a>
                        </div>
                    </li>
                @else
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="mx-1 w-4 h-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                            </svg>

                            <span class="ms-1 text-xs font-medium text-gray-500 dark:text-gray-400 md:ms-2">{{ $crumb['label'] }}</span>
                        </div>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif