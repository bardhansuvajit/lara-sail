<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Application Settings') }}"
    :breadcrumb="[
        ['label' => 'Application settings']
    ]"
>

    <section class="mt-2">
        @include('admin.application.includes.navbar')

        <div class="py-5 px-5 bg-gray-100 dark:bg-gray-700">
            <div class="mb-3">
                <x-admin.developer-expertise-alert />
            </div>

            <div class="space-y-6">
                <!-- Compact Grid View -->
                <div class="space-y-4">
                    @foreach(['company', 'contact', 'location', 'branding', 'favicon', 'legal', 'business', 'payment', 'seo'] as $category)
                        @if($data->where('category', $category)->count())
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 capitalize">{{ $category }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                                    @foreach($data->where('category', $category) as $setting)
                                        @if ($setting->category == 'branding' || $setting->category == 'favicon')
                                            <!-- Image Part -->
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                                                    {{ str_replace('_', ' ', $setting->key) }}
                                                </p>
                                                <div class="mt-2">
                                                    @if ($setting->key == 'site.webmanifest')
                                                        <div class="w-6 h-6">
                                                            <svg viewBox="0 0 32 32" id="OBJECT" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#b2b2b2;}</style></defs><title/><rect height="26" rx="1" ry="1" width="18" x="5" y="5"/><path class="cls-1" d="M26.71,7.29l-6-6A1,1,0,0,0,20,1H10A1,1,0,0,0,9,2V26a1,1,0,0,0,1,1H26a1,1,0,0,0,1-1V8A1,1,0,0,0,26.71,7.29Z"/><path d="M20.71,1.29A1,1,0,0,0,20,1V7a1,1,0,0,0,1,1h6a1,1,0,0,0-.29-.71Z"/><path d="M19,13.5H14a1,1,0,0,1,0-2h5a1,1,0,0,1,0,2Z"/><path d="M22,17.5H14a1,1,0,0,1,0-2h8a1,1,0,0,1,0,2Z"/><path d="M22,21.5H14a1,1,0,0,1,0-2h8a1,1,0,0,1,0,2Z"/></svg>
                                                        </div>
                                                    @else
                                                        <img src="{{ Storage::url($setting->pretty_value) }}" alt="{{ $setting->key }}" class="h-6">
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <!-- Text Part -->
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                                                    {{ str_replace('_', ' ', $setting->key) }}
                                                </p>
                                                <p class="text-xs font-semibold text-gray-900 dark:text-white">
                                                    {{ $setting->pretty_value }}
                                                </p>
                                            </div>
                                        @endif
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