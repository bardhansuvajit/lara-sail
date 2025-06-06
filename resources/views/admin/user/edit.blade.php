<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit User') }}"
    :breadcrumb="[
        ['label' => 'User', 'url' => route('admin.user.index')],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.user.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <div class="grid grid-cols-[auto_1fr] gap-3 items-center">
                        @if (!empty($data->profile_picture))
                            <div class="content-center me-3">
                                <img class="h-14 w-14 rounded-lg object-contain" src="{{ Storage::url($data->profile_picture) }}" alt="Picture" />
                            </div>
                        @endif
                        <div class="@if(!empty($data->profile_picture)) col-start-2 @else col-span-full @endif">
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
                                <x-admin.input-select-option value="{{$country->short_name}}" :selected="$data->country_code == $country->short_name"> {{$country->name}} </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('country_code')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="first_name" :value="__('First Name *')" />
                    <x-admin.text-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name') ? old('first_name') : $data->first_name" placeholder="Enter First Name" autofocus required />
                    <x-admin.input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="last_name" :value="__('Last Name *')" />
                    <x-admin.text-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name') ? old('last_name') : $data->last_name" placeholder="Enter Last Name" required />
                    <x-admin.input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="email" :value="__('Email address')" />
                    <x-admin.text-input id="email" class="block w-full" type="text" name="email" :value="old('email') ? old('email') : $data->email" placeholder="Enter Email address" />
                    <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="primary_phone_no" :value="__('Phone number *')" />
                    <x-admin.text-input id="primary_phone_no" class="block w-full" type="text" name="primary_phone_no" :value="old('primary_phone_no') ? old('primary_phone_no') : $data->primary_phone_no" placeholder="Enter Last Name" required />
                    <x-admin.input-error :messages="$errors->get('primary_phone_no')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="alt_phone_no" :value="__('Alt. Phone number')" />
                    <x-admin.text-input id="alt_phone_no" class="block w-full" type="text" name="alt_phone_no" :value="old('alt_phone_no') ? old('alt_phone_no') : $data->alt_phone_no" placeholder="Enter Last Name" />
                    <x-admin.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="gender_id" :value="__('Gender')" />
                    <div class="w-full flex gap-2">
                        <x-front.radio-input-button id="someId1" name="gender_id" value="1" :checked="$data->gender_id == 1">
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Male</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>

                        <x-front.radio-input-button id="someId2" name="gender_id" value="2" :checked="$data->gender_id == 2">
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Female</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>

                        <x-front.radio-input-button id="someId3" name="gender_id" value="3" :checked="$data->gender_id == 3">
                            <div class="text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div>
                                        <div class="{{FD['text']}} font-semibold">Other</div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>

                        <x-front.radio-input-button id="someId4" name="gender_id" value="4" :checked="$data->gender_id == 4">
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
                    <x-admin.text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" :value="old('date_of_birth', $data->date_of_birth)" placeholder="Enter Date of Birth" />
                    <x-admin.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>
            </div>

            {{-- {{ dd($data->date_of_birth) }} --}}

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