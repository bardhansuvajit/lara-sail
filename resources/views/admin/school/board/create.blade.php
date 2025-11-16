<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create Board') }}"
    :breadcrumb="[
        ['label' => 'Board', 'url' => route('admin.school.board.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.school.board.store') }}" method="post">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-admin.input-label for="name" :value="__('Class Name *')" />
                    <x-admin.text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="e.g., 9, 10, 11, 12" autofocus required />
                    <x-admin.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="position" :value="__('Position')" />
                    <x-admin.text-input id="position" class="block w-full" type="number" name="position" :value="old('position', 1)" placeholder="Display order" min="1" />
                    <x-admin.input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="thumbnail_icon" :value="__('SVG Icon')" />
                    <x-admin.textarea id="thumbnail_icon" class="block w-full min-h-[8rem] font-mono text-sm" name="thumbnail_icon" :value="old('thumbnail_icon')" placeholder="Paste SVG code here" />
                    <x-admin.input-error :messages="$errors->get('thumbnail_icon')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="description" :value="__('Description')" />
                    <x-admin.textarea id="description" class="block w-full min-h-[4rem]" name="description" :value="old('description')" placeholder="Enter class description" maxlength="1000" />
                    <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-admin.input-label for="meta_title" :value="__('Meta Title')" />
                    <x-admin.text-input id="meta_title" class="block w-full" type="text" name="meta_title" :value="old('meta_title')" placeholder="SEO meta title" />
                    <x-admin.input-error :messages="$errors->get('meta_title')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="meta_description" :value="__('Meta Description')" />
                    <x-admin.textarea id="meta_description" class="block w-full min-h-[4rem]" name="meta_description" :value="old('meta_description')" placeholder="SEO meta description" />
                    <x-admin.input-error :messages="$errors->get('meta_description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div>
                    <x-admin.input-label for="tags" :value="__('Tags (JSON)')" />
                    <x-admin.textarea id="tags" class="block w-full min-h-[4rem] font-mono text-sm" name="tags" :value="old('tags')" placeholder='["tag1", "tag2", "tag3"]' />
                    <x-admin.input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>
            </div>

            <div class="items-center space-x-4 flex my-6">
                <x-admin.button
                    type="submit"
                    element="button">
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                    @endslot
                    {{ __('Save Class') }}
                </x-admin.button>
            </div>
        </form>
    </div>
</x-admin-app-layout>