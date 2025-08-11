<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create Content Page') }}"
    :breadcrumb="[
        ['label' => 'Content Page', 'url' => route('admin.website.content.page.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.website.content.page.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title')" placeholder="Enter title" autofocus required />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="content" :value="__('Content *')" />
                    <x-admin.textarea id="content" class="block !min-h-[12rem]" type="text" name="content" :value="old('content')" placeholder="Enter Content" />
                    <x-admin.input-error :messages="$errors->get('content')" class="mt-2" />
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700"></div>

            <h4 class="mt-4 mb-3 font-bold text-xs text-black dark:text-primary-200">Search Engine Content</h4>

            <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                <div>
                    <x-admin.input-label for="meta_title" :value="__('Meta Title')" />
                    <x-admin.text-input id="meta_title" class="block" type="text" name="meta_title" :value="old('meta_title')" placeholder="Enter Meta Title" />
                    <x-admin.input-error :messages="$errors->get('meta_title')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                <div>
                    <x-admin.input-label for="meta_description" :value="__('Meta Description')" />
                    <x-admin.textarea id="meta_description" class="block" type="text" name="meta_description" :value="old('meta_description')" placeholder="Enter Meta Description" />
                    <x-admin.input-error :messages="$errors->get('meta_description')" class="mt-2" />
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