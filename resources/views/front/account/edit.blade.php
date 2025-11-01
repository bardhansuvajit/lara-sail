@extends('layouts.front.account', [
    'showHeader' => true,
    'title' => __('Edit Account'),
    'subtitle' => __('Keep your account information accurate and up to date.'),
    'breadcrumb' => [
        [
            'title' => 'Account',
            'url' => route('front.account.index')
        ],
        [
            'title' => 'Edit Account'
        ]
    ]
])

@section('content')
    <div class="space-y-4 md:space-y-6">
        <div class="{{ FD['rounded'] }} bg-white shadow-sm dark:bg-gray-800">
            <div>
                <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Basic information</p>
            </div>

            <form action="{{ route('front.account.update') }}" method="POST">@csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="first_name" :value="__('First name *')" />
                        <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" placeholder="Enter First Name" maxlength="50" value="{{ old('first_name', $user->first_name) }}" autofocus required />
                        <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-front.input-label for="last_name" :value="__('Last name *')" />
                        <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" placeholder="Enter Last Name" maxlength="50" value="{{ old('last_name', $user->last_name) }}" required />
                        <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                        <x-front.text-input-with-dropdown 
                            id="phone_no" 
                            class="block w-auto digits-only" 
                            type="tel" 
                            name="phone_no" 
                            :value="old('phone_no', $user->primary_phone_no)" 
                            placeholder="Enter Phone Number" 
                            selectTitle="India (+91)" 
                            selectId="phone_country_code" 
                            selectName="phone_country_code" 
                            required=true 
                            autocomplete="tel-national"
                            focus
                        >
                            @slot('options')
                                @foreach ($activeCountries as $country)
                                    <x-front.input-select-option 
                                        value="{{$country->code}}" 
                                        :selected="old('phone_country_code') ? $country->code == old('phone_country_code') : $country->code == $user->country->code"
                                    >
                                        {{ $country->name }} ({{ $country->phone_code }})
                                    </x-front.input-select-option>
                                @endforeach
                            @endslot
                        </x-front.text-input-with-dropdown>
                        <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
                        <x-front.input-error :messages="$errors->get('phone_country_code')" class="mt-2" />
                    </div>

                    <div>
                        <x-front.input-label for="alt_phone_no" :value="__('Alternate Phone number')" />
                        <x-front.text-input id="alt_phone_no" class="block w-full digits-only" type="tel" name="alt_phone_no" placeholder="Enter Alternate Phone number" value="{{ old('alt_phone_no', $user->alt_phone_no) }}" />
                        <x-front.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="email" :value="__('Email')" />
                        <x-front.text-input id="email" class="block w-full" type="email" name="email" placeholder="Enter Email Address" maxlength="80" value="{{ old('email', $user->email) }}" />
                        <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-front.button
						element="button"
						tag="success"
                        type="submit"
                        class="w-full md:w-36"
						>
						{{ __('Update') }}
					</x-front.button>
                </div>
            </form>
        </div>

        <hr class="border-t border-gray-300 dark:border-gray-600 my-6">

        <!-- Optional information -->
        <div class="{{ FD['rounded'] }} bg-white shadow-sm dark:bg-gray-800">
            <div>
                <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Optional information</p>
            </div>

            <form action="{{ route('front.account.update.optional') }}" method="POST">@csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="gender_id" :value="__('Gender')" />

                        <div class="w-full flex gap-2">
                            <x-front.radio-input-button id="someId1" name="gender_id" value="1" :checked="$user->gender_id == 1">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Male</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>

                            <x-front.radio-input-button id="someId2" name="gender_id" value="2" :checked="$user->gender_id == 2">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Female</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>

                            <x-front.radio-input-button id="someId3" name="gender_id" value="3" :checked="$user->gender_id == 3">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Other</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>

                            <x-front.radio-input-button id="someId4" name="gender_id" value="4" :checked="$user->gender_id == 4">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Not specified</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>
                        </div>

                        <x-front.input-error :messages="$errors->get('gender_id')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="date_of_birth" :value="__('Date of Birth')" />
                        <x-front.text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" placeholder="Enter Date of Birth" max="{{date('Y-m-d')}}" value="{{ $user->date_of_birth }}" />
                        <x-front.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </div>
                </div>

                <div>
                    {{-- <button type="submit" class="w-full sm:w-max flex items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update
                    </button> --}}
                    <x-front.button
						element="button"
						tag="success"
                        type="submit"
                        class="w-full md:w-36"
						>
						{{ __('Update') }}
					</x-front.button>
                </div>
            </form>
        </div>

        <hr class="border-t border-gray-300 dark:border-gray-600 my-6">

        <!-- Password -->
        <div class="{{ FD['rounded'] }} bg-white shadow-sm dark:bg-gray-800">
            <div>
                <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Password</p>
            </div>

            {{-- <form action="{{ route('front.account.update.optional') }}" method="POST">@csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="gender_id" :value="__('Gender')" />

                        <div class="w-full flex gap-2">
                            <x-front.radio-input-button id="someId1" name="gender_id" value="1" :checked="$user->gender_id == 1">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Male</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>

                            <x-front.radio-input-button id="someId2" name="gender_id" value="2" :checked="$user->gender_id == 2">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Female</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>

                            <x-front.radio-input-button id="someId3" name="gender_id" value="3" :checked="$user->gender_id == 3">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Other</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>

                            <x-front.radio-input-button id="someId4" name="gender_id" value="4" :checked="$user->gender_id == 4">
                                <div class="text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div>
                                            <div class="{{FD['text']}} font-semibold">Not specified</div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>
                        </div>

                        <x-front.input-error :messages="$errors->get('gender_id')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="date_of_birth" :value="__('Date of Birth')" />
                        <x-front.text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" placeholder="Enter Date of Birth" max="{{date('Y-m-d')}}" value="{{ $user->date_of_birth }}" />
                        <x-front.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </div>
                </div> --}}

                <div>
                    {{-- <a href="{{ route('front.account.password.edit') }}" class="w-full sm:w-max flex gap-2 items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="{{ FD['iconClass'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q97-30 162-118.5T718-480H480v-315l-240 90v207q0 7 2 18h238v316Z"/></svg>
                        Edit Password
                    </a> --}}
                    <x-front.button
						element="a"
						tag="primary"
						:href="route('front.account.password.edit')"
                        class="w-full md:w-36"
						>
						@slot('icon')
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q97-30 162-118.5T718-480H480v-315l-240 90v207q0 7 2 18h238v316Z"/></svg>
						@endslot
						{{ __('Edit password') }}
					</x-front.button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
@endsection
