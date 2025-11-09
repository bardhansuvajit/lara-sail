<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Application Settings') }}"
    :breadcrumb="[
        ['label' => 'Application settings']
    ]"
>

    <section class="mt-2">
        @include('admin.application.includes.navbar')

        <div class="py-5 px-5 bg-gray-50 dark:bg-gray-700">
            <div class="mb-3">
                <x-admin.developer-expertise-alert />
            </div>

            <div class="space-y-6">
                <!-- Compact Grid View -->
                <div class="space-y-4">
                    @foreach(['company', 'contact', 'location', 'branding', 'legal', 'business', 'payment', 'seo'] as $category)
                        @if($data->where('category', $category)->count())
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 capitalize">{{ $category }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                                    @foreach($data->where('category', $category) as $setting)
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                                                {{ str_replace('_', ' ', $setting->key) }}
                                            </p>
                                            <p class="text-xs font-semibold text-gray-900 dark:text-white">
                                                {{ $setting->pretty_value }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Edit Button -->
                <div class="flex space-x-2 mt-2">
                    <x-admin.button
                        element="a"
                        tag="secondary"
                        class="w-40"
                        :href="route('admin.application.settings.edit', 'basic')">
                        @slot('icon')
                            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
                            </svg>
                        @endslot
                        {{ __('Edit') }}
                    </x-admin.button>
                </div>
            </div>
        </div>
    </section>

</x-admin-app-layout>