<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create Ad Item') }}"
    :breadcrumb="[
        ['label' => 'Ad Item', 'url' => route('admin.website.ad.item.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">

        <div class="my-3 flex items-center text-red-600 dark:text-orange-600 bg-orange-100 dark:bg-orange-100 p-2">
            <div class="w-4 h-4 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/></svg>
            </div>
            <p class="text-sm font-bold text-red-600 dark:text-orange-600">{!! __('Ad item must be created with an expertise of a developer') !!}</p>
        </div>

        <form action="{{ route('admin.website.ad.item.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="pages" :value="__('Pages *')" />
                    <x-admin.text-input id="pages" class="block w-full" type="text" name="pages" :value="old('pages')" placeholder="Enter pages - comma separated" autofocus />
                    <x-admin.input-error :messages="$errors->get('pages')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="name" :value="__('Name *')" />
                    <x-admin.text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="Enter name - e.g. Hero: Big Deal, Trusted marketplace" />
                    <x-admin.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="type" :value="__('Type *')" />
                    <ul class="flex w-full gap-2">
                        @foreach ($typesArr as $typeIndex => $type)
                            <li>
                                <x-admin.radio-input-button class="w-auto px-2" id="type_{{ $typeIndex }}" name="type" value="{{ $type }}" title="{{ ucwords($type) }}" :checked="old('type', $loop->first ? $type : null) == $type" />
                            </li>
                        @endforeach
                    </ul>
                    <x-admin.input-error :messages="$errors->get('type')" class="mt-2" />
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