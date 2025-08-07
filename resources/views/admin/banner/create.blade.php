<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create Banner') }}"
    :breadcrumb="[
        ['label' => 'Banner', 'url' => route('admin.website.banner.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">

        <div class="my-3 flex items-center text-red-600 dark:text-orange-600">
            <div class="w-4 h-4 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/></svg>
            </div>
            <p class="text-sm font-bold text-red-600 dark:text-orange-600">{!! __('Banners must be created &amp; uploaded SEPARATELY for Desktop &amp; Mobile view') !!}</p>
        </div>

        <form action="{{ route('admin.website.banner.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title')" placeholder="Enter title" autofocus required />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="description" :value="__('Description')" />
                    <x-admin.textarea id="description" class="block" type="text" name="description" :value="old('description')" placeholder="Enter Description" />
                    <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="start_at" :value="__('Starts At *')" />
                    <x-admin.text-input id="start_at" class="block w-full" type="datetime-local" name="start_at" :value="old('start_at')" placeholder="Enter Starts At" />
                    <x-admin.input-error :messages="$errors->get('start_at')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="end_at" :value="__('Ends At *')" />
                    <x-admin.text-input id="end_at" class="block w-full" type="datetime-local" name="end_at" :value="old('end_at')" placeholder="Enter Starts At" />
                    <x-admin.input-error :messages="$errors->get('end_at')" class="mt-2" />
                </div>
            </div>

            <hr class="mt-8 mb-6 border-gray-300 dark:border-gray-600">

            <div class="grid gap-4 mb-4 sm:grid-cols-2 items-start">
                <div class="grid gap-4">
                    <div>
                        <p class="text-sm font-bold text-blue-700 dark:text-blue-600">{!! __('WEB-APP') !!}</p>
                    </div>

                    <div>
                        <x-admin.input-label for="web_image" :value="__('Image *')" />
                        <x-admin.file-input id="web_image" name="web_image" />
                        <x-admin.input-error :messages="$errors->get('web_image')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="web_redirect_url" :value="__('Redirect URL *')" />
                        <x-admin.textarea id="web_redirect_url" class="block" type="text" name="web_redirect_url" :value="old('web_redirect_url')" placeholder="Enter Redirect URL" maxlength="1000" />
                        <x-admin.input-error :messages="$errors->get('web_redirect_url')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4">
                    <div>
                        <p class="text-sm font-bold text-blue-700 dark:text-blue-600">{!! __('MOBILE-APP') !!}</p>
                    </div>

                    <div>
                        <x-admin.input-label for="app_image" :value="__('Image *')" />
                        <x-admin.file-input id="app_image" name="app_image" />
                        <x-admin.input-error :messages="$errors->get('app_image')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="mobile_redirect_target" :value="__('Redirect Target *')" />
                        <x-admin.textarea id="mobile_redirect_target" class="block" type="text" name="mobile_redirect_target" :value="old('mobile_redirect_target')" placeholder="Enter Redirect Target" maxlength="1000" />
                        <x-admin.input-error :messages="$errors->get('mobile_redirect_target')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="mobile_redirect_type" :value="__('Redirect Type *')" />

                        <ul class="flex w-full gap-2">
                            <li>
                                <x-admin.radio-input-button class="w-auto px-2" id="type_screen" name="mobile_redirect_type" value="screen" title="Screen" required checked />
                            </li>
                            <li>
                                <x-admin.radio-input-button class="w-auto px-2" id="type_deep_link" name="mobile_redirect_type" value="deep-link" title="Deep Link" />
                            </li>
                            <li>
                                <x-admin.radio-input-button class="w-auto px-2" id="type_url" name="mobile_redirect_type" value="url" title="URL" />
                            </li>
                        </ul>

                        <x-admin.input-error :messages="$errors->get('mobile_redirect_type')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="items-center space-x-4 flex my-6">
                <x-admin.button
                    type="submit"
                    element="button">
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                    @endslot
                    {{ __('Save data') }}
                </x-admin.button>

            </div>
        </form>
    </div>
</x-admin-app-layout>