<form class="space-y-4 md:space-y-6" action="#">
    <div>
        @php
            $selectedCountry = $_GET['phone_country_code'] ?? old('phone_country_code') ?? COUNTRY;
        @endphp

        <x-front.input-label for="phone_no" :value="__('Phone number *')" />
        <x-front.text-input-with-dropdown 
            id="phone_no" 
            class="block w-auto" 
            type="tel" 
            name="phone_no" 
            :value="old('phone_no') ? old('phone_no') : $_GET['phone_no'] ?? ''" 
            placeholder="Enter Phone Number" 
            selectTitle="India (+91)" 
            selectId="phone_country_code" 
            selectName="phone_country_code" 
            required=true 
            focus
        >
            @slot('options')
                @foreach ($activeCountries as $countryIndex => $country)
                    <x-front.input-select-option 
                        value="{{$country->short_name}}" 
                        :selected="$selectedCountry == $country->short_name"
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
        <p class="mb-2 {{FD['text']}} text-gray-600 dark:text-gray-400">By continuing you agree to our <a href="" class="font-bold italic">Terms &amp; Conditions</a></p>
    </div>

    <div>
        <button type="submit" class="w-full flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Continue
        </button>
    </div>
</form>