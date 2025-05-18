<form 
    class="space-y-4 md:space-y-4" 
    @if (isset($type) && $type == 'register')
        action="{{route('front.register')}}" method="post"
    @elseif (isset($type) && $type == 'login')
        action="" method="post"
    @else
        action=""
    @endif
>
    @if (isset($type) && ($type == 'register' || $type == 'login'))
        @csrf
    @endif

    {{-- REGISTER STARTS --}}
    @if (isset($type) && $type == 'register')
    <div class="grid gap-4 mb-4 sm:grid-cols-2">
        <div>
            <x-front.input-label for="first_name" :value="__('First name *')" />
            <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" placeholder="Enter First Name" maxlength="50" value="{{old('first_name')}}" :autofocus="$focus === 'first_name'" required />
            <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div>
            <x-front.input-label for="last_name" :value="__('Last name *')" />
            <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" placeholder="Enter Last Name" maxlength="50" value="{{old('last_name')}}" required />
            <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
    </div>
    @endif
    {{-- REGISTER ENDS --}}

    <div>
        @php
            $selectedCountry = $_GET['phone_country_code'] ?? old('phone_country_code') ?? COUNTRY['country'];
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
            :focus="$focus === 'phone_no'"
            {{-- focus --}}
            {{-- @if (!isset($type))
                focus
            @endif --}}
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

    {{-- LOGIN & REGISTER STARTS --}}
    @if (isset($type) && ($type == 'login' || $type == 'register'))

    {{-- REGISTER EMAIL STARTS --}}
    @if ($type == 'register')
    <div>
        <x-front.input-label for="email" :value="__('Email')" />
        <x-front.text-input id="email" class="block w-full" type="email" name="email" placeholder="Enter Email Address" value="{{old('email')}}" />
        <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    @endif
    {{-- REGISTER EMAIL ENDS --}}

    <div>
        <x-front.input-label for="password" :value="__('Password *')" />
        <x-front.text-input id="password" class="block w-full" type="password" name="password" placeholder="Enter Password" :autofocus="$focus === 'password'" required />
        <x-front.input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div>
        <x-front.input-checkbox 
            id="remember_me"
            name="remember" 
            :label="__('Remember me')"
            checked />
    </div>
    @endif
    {{-- LOGIN & REGISTER ENDS --}}

    <div>
        <p class="mb-2 {{FD['text']}} text-gray-600 dark:text-gray-400">By continuing you agree to our <a href="" class="font-bold italic">Terms &amp; Conditions</a></p>
    </div>

    <div>
        <button type="submit" class="w-full flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Continue
        </button>
    </div>
</form>