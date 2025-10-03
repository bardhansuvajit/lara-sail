<div>
    {{-- <form action="{{ route('front.address.store') }}" method="post" class="pt-4">@csrf --}}
    <form action="{{ route('front.address.store') }}" method="post" class="">@csrf
        {{-- <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <h5 class="{{FD['text']}} text-gray-600 dark:text-gray-500">Add {{ $type == "shipping" ? "Delivery" : "Billing"}} Address</h5>
        </div> --}}

        {{-- <p class="{{ FD['text-1'] }} font-normal text-slate-400 dark:text-slate-500 mb-2 md:mb-4">Add {{ $type == "shipping" ? "Delivery" : "Billing"}}  Address</p> --}}

        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <div>
                <x-front.input-label for="{{$type}}_first_name" :value="__('First Name *')" />
                <x-front.text-input id="{{$type}}_first_name" class="block w-full" type="text" name="first_name" placeholder="Enter First Name" :value="old('first_name') ? old('first_name') : $user->first_name ?? ''" maxlength="100" autocomplete="given-name" required />
                <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="{{$type}}_last_name" :value="__('Last Name *')" />
                <x-front.text-input id="{{$type}}_last_name" class="block w-full" type="text" name="last_name" placeholder="Enter Last Name" maxlength="100" autocomplete="family-name" :value="old('last_name') ? old('last_name') : $user->last_name ?? ''" required />
                <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <div>
                <x-front.input-label for="{{$type}}_phone_no" :value="__('Phone number *')" />
                <x-front.text-input-with-text 
                    placeholder="Enter Phone Number" 
                    id="{{$type}}_phone_no" 
                    class="digits-only" 
                    type="tel" 
                    name="phone_no" 
                    autocomplete="tel-national"
                    :value="old('phone_no') ? old('phone_no') : $user->primary_phone_no ?? ''" 

                    text="{{COUNTRY['countryFullName']}} ({{COUNTRY['phoneCode']}})"
                    textPosition="start" 
                >
                </x-front.text-input-with-text>
                <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="{{$type}}_email" :value="__('Email')" />
                <x-front.text-input id="{{$type}}_email" class="block w-full" type="email" name="email" :value="old('email') ? old('email') : $user->email ?? ''" placeholder="Enter Email Address" autocomplete="email" maxlength="70" />
                <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <div class="col-span-2">
                <x-front.input-label for="{{$type}}_address_line_1" :value="__('Flat, House no, Building, Company, Apartment *')" />
                <x-front.text-input id="{{$type}}_address_line_1" class="block w-full" type="text" name="address_line_1" :value="old('address_line_1')" placeholder="Enter Flat, House no, Building, Company, Apartment" maxlength="200" autocomplete="address-line1" autofocus required />
                <x-front.input-error :messages="$errors->get('address_line_1')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <div class="col-span-2">
                <x-front.input-label for="{{$type}}_address_line_2" :value="__('Area, Street, Sector, Village')" />
                <x-front.text-input id="{{$type}}_address_line_2" class="block w-full" type="text" name="address_line_2" :value="old('address_line_2')" placeholder="Enter Area, Street, Sector, Village" maxlength="200" autocomplete="address-line2" />
                <x-front.input-error :messages="$errors->get('address_line_2')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <div>
                <x-front.input-label for="{{$type}}_postal_code" :value="__('Postal Code *')" />
                <x-front.text-input id="{{$type}}_postal_code" class="block w-full digits-only" type="tel" name="postal_code" :value="old('postal_code')" placeholder="Enter Postal Code" maxlength="{{COUNTRY['postalCodeDigits']}}" autocomplete="postal-code" required />
                <x-front.input-error :messages="$errors->get('postal_code')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="{{$type}}_city" :value="__('Town/ City *')" />
                <x-front.text-input id="{{$type}}_city" class="block w-full" type="text" name="city" :value="old('city')" placeholder="Enter Town/ City" maxlength="50" autocomplete="address-level2" required />
                <x-front.input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="{{$type}}_state" :value="__('State *')" />
                <x-front.input-select 
                    id="{{$type}}_state" 
                    class="w-full"
                    name="state" 
                >
                    @slot('options')
                        @foreach ($states as $state)
                            <x-front.input-select-option value="{{$state->code}}" :selected="old('state') == $state->code"> {{$state->name}} </x-front.input-select-option>
                        @endforeach
                    @endslot
                </x-front.input-select>
                <x-front.input-error :messages="$errors->get('state')" class="mt-2" />
            </div>
        </div>

        <div class="border-t dark:border-gray-700 my-5"></div>

        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
            <div class="col-span-1">
                <x-front.input-label for="{{$type}}_landmark" :value="__('Landmark')" />
                <x-front.text-input id="{{$type}}_landmark" class="block w-full" type="text" name="landmark" :value="old('landmark')" placeholder="Enter Landmark" maxlength="200" autocomplete="new-landmark" />
                <x-front.input-error :messages="$errors->get('landmark')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-front.input-label for="{{$type}}_alt_phone_no" :value="__('Alt. Phone number')" />
                <x-front.text-input-with-text 
                    placeholder="Enter Alternate Phone Number" 
                    id="{{$type}}_alt_phone_no" 
                    class="digits-only" 
                    type="tel" 
                    name="alt_phone_no" 
                    :value="old('alt_phone_no') ? old('alt_phone_no') : $user->alt_phone_no ?? ''" 

                    text="{{COUNTRY['countryFullName']}} ({{COUNTRY['phoneCode']}})"
                    textPosition="start" 
                >
                </x-front.text-input-with-text>
                <x-front.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
            </div>
        </div>

        <div class="mb-4">
            <x-front.input-checkbox 
                id="{{$type}}_is_default" 
                name="is_default" 
                value="1" 
                label="Set this as Default address" 
                checked
            />
        </div>

        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="address_type" value="{{ $type }}">
        <input type="hidden" name="country_code" value="{{COUNTRY['country']}}">
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="hidden" name="redirect" value="{{ $redirect ?? url()->current() }}">

        <button type="submit" class="w-full sm:w-max flex items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            {{ __('Deliver here') }}
        </button>
    </form>
</div>
