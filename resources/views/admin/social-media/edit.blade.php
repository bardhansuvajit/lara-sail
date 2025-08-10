<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Social Media') }}"
    :breadcrumb="[
        ['label' => 'Social Media', 'url' => route('admin.website.social.media.index')],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.website.social.media.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="name" :value="__('Name *')" />
                    <x-admin.text-input id="name" class="block w-full" type="text" name="name" :value="old('name', $data->name)" placeholder="Enter Name" autofocus required />
                    <x-admin.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="icon_colored" :value="__('Colored Icon (SVG) *')" />
                    <x-admin.textarea id="icon_colored" class="block" type="text" name="icon_colored" :value="old('icon_colored', $data->icon_colored)" placeholder="e.g. <svg..." />
                    <x-admin.input-error :messages="$errors->get('icon_colored')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="icon_base" :value="__('Base Icon (SVG) *')" />
                    <x-admin.textarea id="icon_base" class="block" type="text" name="icon_base" :value="old('icon_base', $data->icon_base)" placeholder="e.g. <svg..." />
                    <x-admin.input-error :messages="$errors->get('icon_base')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-admin.input-label for="url" :value="__('Redirect URL *')" />
                <x-admin.textarea id="url" class="block" type="text" name="url" :value="old('url', $data->url)" placeholder="Enter Redirect URL" maxlength="1000" />
                <x-admin.input-error :messages="$errors->get('url')" class="mt-2" />
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