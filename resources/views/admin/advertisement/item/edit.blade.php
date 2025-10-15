<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Ad Item') }}"
    :breadcrumb="[
        ['label' => 'Ad Item', 'url' => route('admin.website.ad.item.index')],
        ['label' => 'Edit']
    ]"
    >

    <div class="w-full mt-2">

        <x-ads.ad-set-1 :data="$data" />

        <div class="my-3 flex items-center text-red-600 dark:text-orange-600 bg-orange-100 dark:bg-orange-100 p-2">
            <div class="w-4 h-4 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/></svg>
            </div>
            <p class="text-sm font-bold text-red-600 dark:text-orange-600">{!! __('Ad item must be updated with an expertise of a developer') !!}</p>
        </div>

        <form action="{{ route('admin.website.ad.item.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="country_code" :value="__('Country *')" />
                    <x-admin.input-select id="country_code" name="country_code" title="Select Country" class="w-full">
                        @slot('options')
                            @foreach ($activeCountries as $country)
                                <x-admin.input-select-option value="{{$country->code}}" 
                                    :selected="old('country_code', $data->country_code) == $country->code"
                                > {{$country->name}} </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('country_code')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="ad_section_id" :value="__('Ad Section *')" />
                    <x-admin.input-select id="ad_section_id" name="ad_section_id" title="Select Ad section" class="w-full">
                        @slot('options')
                            @foreach ($adSections as $section)
                                <x-admin.input-select-option value="{{$section->id}}" 
                                    :selected="old('ad_section_id', $data->ad_section_id) == $section->id"
                                > #{{$section->id}} {{$section->name}} ({{$section->pages}}) </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('ad_section_id')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 grid-cols-1">
                <div>
                    <x-admin.input-label for="title" :value="__('Title - HTML enabled')" />
                    <x-admin.textarea id="title" class="block" type="text" name="title" :value="old('title', $data->title)" placeholder="Enter Title" autofocus />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 grid-cols-1">
                <div>
                    <x-admin.input-label for="subtitle" :value="__('Subtitle - HTML enabled')" />
                    <x-admin.textarea id="subtitle" class="block" type="text" name="subtitle" :value="old('subtitle', $data->subtitle)" placeholder="Enter Subtitle" />
                    <x-admin.input-error :messages="$errors->get('subtitle')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="url" :value="__('URL')" />
                    <x-admin.text-input id="url" class="block w-full" type="text" name="url" :value="old('url', $data->url)" placeholder="Enter URL" />
                    <x-admin.input-error :messages="$errors->get('url')" class="mt-2" />
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

            <input type="hidden" name="id" value="{{ $data->id }}" />
        </form>
    </div>
</x-admin-app-layout>