<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create Newsletter Subscription Email') }}"
    :breadcrumb="[
        ['label' => 'Newsletter Subscription Email', 'url' => route('admin.website.newsletter.email.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.website.newsletter.email.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="email" :value="__('Email *')" />
                    <x-admin.text-input id="email" class="block w-full" type="text" name="email" :value="old('email')" placeholder="Enter email" autofocus required />
                    <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
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