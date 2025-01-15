<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit profile') }}"
    :breadcrumb="[
        ['label' => 'Profile', 'url' => route('admin.profile.index')],
        ['label' => 'Change password']
    ]"
>

    <section class="w-full mt-2">
        <form action="{{ route('admin.profile.password.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="current_password" :value="__('Current password *')" />
                    <x-admin.text-input id="current_password" class="block w-full" type="password" name="current_password" :value="old('current_password')" placeholder="Enter current password" autofocus required />
                    <x-admin.input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="new_password" :value="__('New password *')" />
                    <x-admin.text-input id="new_password" class="block w-full" type="password" name="new_password" :value="old('new_password')" placeholder="Enter new password" required />
                    <x-admin.input-error :messages="$errors->get('new_password')" class="mt-2" />
                </div>

                <div> 
                    <x-admin.input-label for="confirm_password" :value="__('Confirm password *')" />
                    <x-admin.text-input id="confirm_password" class="block w-full" type="password" name="confirm_password" :value="old('confirm_password')" placeholder="Enter new password again" required />
                    <x-admin.input-error :messages="$errors->get('confirm_password')" class="mt-2" />
                </div>
            </div>

            <div class="w-full">
                <x-admin.input-checkbox 
                    id="show-password"
                    label="Show password" />
            </div>

            <div class="items-center space-x-4 flex my-6">
                <x-admin.button
                    type="submit"
                    element="button">
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                    @endslot
                    {{ __('Change password') }}
                </x-admin.button>
            </div>
        </form>
    </section>
</x-admin-app-layout>
