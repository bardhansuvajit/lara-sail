<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create User') }}"
    :breadcrumb="[
        ['label' => 'User', 'url' => route('admin.user.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (request()->input('redirect-to') == "offline-order")
                <div class="mb-4">
                    <div>
                        <div class="bg-amber-600 text-gray-900 font-bold p-2">
                            <p class="text-sm">No User found for Phone number {{request()->input('phone-no')}} Please create an User first, then you will be redirected to Offline Order ! </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <div class="grid grid-cols-[auto_1fr] gap-3 items-center">
                        <div class="col-span-full">
                            <x-admin.input-label for="profile_picture" :value="__('Profile picture')" />
                            <x-admin.file-input id="profile_picture" name="profile_picture" />
                            <x-admin.input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div>
                    <x-admin.input-label for="country_code" :value="__('Country *')" />
                    <x-admin.input-select id="country_code" name="country_code" title="Select Parent" class="w-full">
                        @slot('options')
                            @foreach ($activeCountries as $country)
                                <x-admin.input-select-option value="{{$country->code}}" 
                                    :selected="old('country', request()->input('country', COUNTRY['country'])) == $country->code"
                                > {{$country->name}} </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('country_code')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="first_name" :value="__('First Name *')" />
                    <x-admin.text-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name')" placeholder="Enter First Name" autofocus required />
                    <x-admin.input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="last_name" :value="__('Last Name *')" />
                    <x-admin.text-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')" placeholder="Enter Last Name" required />
                    <x-admin.input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="email" :value="__('Email address')" />
                    <x-admin.text-input id="email" class="block w-full" type="text" name="email" :value="old('email')" placeholder="Enter Email address" />
                    <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="primary_phone_no" :value="__('Phone number *')" />
                    <x-admin.text-input id="primary_phone_no" class="block w-full" type="tel" name="primary_phone_no" :value="old('primary_phone_no', request()->input('phone-no'))" placeholder="Enter Primary Phone Number" required />
                    <x-admin.input-error :messages="$errors->get('primary_phone_no')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="alt_phone_no" :value="__('Alt. Phone number')" />
                    <x-admin.text-input id="alt_phone_no" class="block w-full" type="text" name="alt_phone_no" :value="old('alt_phone_no')" placeholder="Enter Alt. Primary Phone Number" />
                    <x-admin.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="gender_id" :value="__('Gender')" />
                    <div class="w-full flex gap-2">
                        <x-front.radio-input-button id="someId1" name="gender_id" value="1">
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Male</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>

                        <x-front.radio-input-button id="someId2" name="gender_id" value="2">
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Female</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>

                        <x-front.radio-input-button id="someId3" name="gender_id" value="3">
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Other</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>

                        <x-front.radio-input-button id="someId4" name="gender_id" value="4" checked>
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Not specified</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>
                    </div>

                    <x-admin.input-error :messages="$errors->get('gender_id')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="date_of_birth" :value="__('Date of Birth')" />
                    <x-admin.text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" placeholder="Enter Date of Birth" />
                    <x-admin.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>
            </div>

            <div class="items-center flex my-6">
                <input type="hidden" name="redirect_to" value="{{ request()->input('redirect-to') }}">

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