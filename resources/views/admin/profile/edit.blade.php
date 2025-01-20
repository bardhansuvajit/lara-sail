<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit profile') }}"
    :breadcrumb="[
        ['label' => 'Profile', 'url' => route('admin.profile.index')],
        ['label' => 'Edit']
    ]"
>

    <section class="w-full mt-2">
        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div class="flex space-x-4">
                    @if (!empty(Storage::url(Auth::guard('admin')->user()->profile_picture_m)))
                        <div class="content-center">
                            <img class="h-14 w-14 rounded-lg object-contain" src="{{ Storage::url(Auth::guard('admin')->user()->profile_picture_m) }}" alt="Helene avatar" />
                        </div>
                    @endif
                    <div>
                        <x-admin.input-label for="profile_picture" :value="__('Profile picture')" />
                        <x-admin.file-input id="profile_picture" name="profile_picture" />
                        <x-admin.input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="first_name" :value="__('First name *')" />
                    <x-admin.text-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::guard('admin')->user()->first_name" placeholder="Enter first name" autofocus required />
                    <x-admin.input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div> 
                    <x-admin.input-label for="last_name" :value="__('Last name *')" />
                    <x-admin.text-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name') ? old('last_name') : Auth::guard('admin')->user()->last_name" placeholder="Enter last name" required />
                    <x-admin.input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="email" :value="__('Email address *')" />
                    <x-admin.text-input id="email" class="block w-full" type="text" name="email" :value="old('email') ? old('email') : Auth::guard('admin')->user()->email" placeholder="Enter email address" required />
                    <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="phone_no" :value="__('Phone number *')" />
                    <x-admin.text-input-with-dropdown 
                        id="phone_no" 
                        class="block w-auto" 
                        type="text" 
                        name="phone_no" 
                        :value="old('phone_no') ? old('phone_no') : Auth::guard('admin')->user()->phone_no" 
                        placeholder="Enter phone number" 
                        selectTitle="India (+91)"
                        selectId="phone_country_code"
                        selectName="phone_country_code"
                        required=true 
                    >
                        @slot('options')
                            @foreach ($activeCountries as $country)
                                <x-admin.input-select-option 
                                    value="{{$country->short_name}}" 
                                    :selected="old('phone_country_code') ? old('phone_country_code') == $country->short_name : Auth::guard('admin')->user()->phone_country_code == $country->phone_code"
                                >
                                    {{ $country->name }} ({{ $country->phone_code }})
                                </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.text-input-with-dropdown>
                    <x-admin.input-error :messages="$errors->get('phone_no')" class="mt-2" />
                    <x-admin.input-error :messages="$errors->get('phone_country_code')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="alt_phone_no" :value="__('Alt. Phone number')" />
                    <x-admin.text-input-with-dropdown 
                        id="alt_phone_no" 
                        class="block w-auto" 
                        type="text" 
                        name="alt_phone_no" 
                        :value="old('alt_phone_no') ? old('alt_phone_no') : Auth::guard('admin')->user()->alt_phone_no" 
                        placeholder="Enter phone number" 
                        selectTitle="India (+91)"
                        selectId="alt_phone_country_code"
                        selectName="alt_phone_country_code"
                        :required=false 
                    >
                        @slot('options')
                            @foreach ($activeCountries as $country)
                                <x-admin.input-select-option 
                                    value="{{$country->short_name}}" 
                                    :selected="old('alt_phone_country_code') ? old('alt_phone_country_code') == $country->short_name : Auth::guard('admin')->user()->alt_phone_country_code == $country->phone_code"
                                >
                                    {{ $country->name }} ({{ $country->phone_code }})
                                </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.text-input-with-dropdown>
                    <x-admin.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
                    <x-admin.input-error :messages="$errors->get('alt_phone_country_code')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="username" :value="__('Username *')" />
                    <x-admin.text-input id="username" class="block w-full" type="text" name="username" :value="old('username') ? old('username') : Auth::guard('admin')->user()->username" placeholder="Enter first name" required />
                    <p class="text-xs mt-1">{{ __('Username & Password is used for login purposes. Be cautious while updating it to a new one.') }} </p>
                    <x-admin.input-error :messages="$errors->get('username')" class="mt-2" />
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
    </section>
</x-admin-app-layout>