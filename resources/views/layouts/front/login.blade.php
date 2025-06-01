<form 
    @if ($formType == "register") 
        action="{{route('front.register')}}" method="post" 
    @elseif ($formType == "login") 
        action="{{route('front.login.store')}}" method="post" 
    @else
        action="" method="get"
    @endif
>
    @if ($formType == "register" || $formType == "login")
        @csrf
    @endif

    {{-- NOT LOGGED IN --}}
    @if ($formType == "default")
    <div class="w-full">
        <div class="grid gap-4 mb-4 sm:grid-cols-1">
            <div>
                <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                <x-front.text-input-with-text 
                    placeholder="Enter Phone Number" 
                    id="phone_no" 
                    class="digits-only" 
                    type="tel" 
                    name="phone_no" 
                    :value="old('phone_no') ? old('phone_no') : $_GET['phone_no'] ?? ''" 

                    text="{{COUNTRY['countryFullName']}} ({{COUNTRY['phoneCode']}})"
                    textPosition="start" 
                    autocomplete="tel-national"
                    :focus="$focus === 'phone_no'"
                >
                </x-front.text-input-with-text>
                <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
            </div>
        </div>
    </div>
    @endif

    {{-- NOT LOGGED IN + ACCOUNT EXISTS --}}
    @if ($formType == "login")
    <div class="w-full">
        <div class="grid gap-4 mb-4 sm:grid-cols-1">
            <div>
                <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                <x-front.text-input-with-text 
                    placeholder="Enter Phone Number" 
                    id="phone_no" 
                    class="digits-only" 
                    type="tel" 
                    name="phone_no" 
                    :value="old('phone_no') ? old('phone_no') : $_GET['phone_no'] ?? ''" 

                    text="{{COUNTRY['countryFullName']}} ({{COUNTRY['phoneCode']}})"
                    textPosition="start" 
                    autocomplete="tel-national"
                >
                </x-front.text-input-with-text>
                <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="password" :value="__('Password *')" />
                <x-front.text-input id="password" class="block w-full" type="password" name="password" placeholder="Enter Password" maxlength="75" autocomplete="new-password" autofocus required />
                <x-front.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="mb-2">
            <x-front.input-checkbox 
                id="show-password"
                label="Show password" />
        </div>
    </div>
    @endif

    {{-- NOT LOGGED IN + NO ACCOUNT EXISTS/ REGISTER --}}
    @if ($formType == "register")
    <div class="w-full">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
                <x-front.input-label for="first_name" :value="__('First name *')" />
                <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name')" placeholder="Enter First Name" maxlength="50" autocomplete="given-name" autofocus required />
                <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="last_name" :value="__('Last name *')" />
                <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')" placeholder="Enter Last Name" maxlength="50" autocomplete="family-name" required />
                <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
                <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                <x-front.text-input-with-text 
                    placeholder="Enter Phone Number" 
                    id="phone_no" 
                    class="digits-only" 
                    type="tel" 
                    name="phone_no" 
                    :value="old('phone_no') ? old('phone_no') : $_GET['phone_no'] ?? ''" 

                    text="{{COUNTRY['countryFullName']}} ({{COUNTRY['phoneCode']}})"
                    textPosition="start" 
                    autocomplete="tel-national"
                    :focus="$focus === 'phone_no'"
                >
                </x-front.text-input-with-text>
                <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
            </div>

            <div>
                <x-front.input-label for="email" :value="__('Email')" />
                <x-front.text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="Enter Email Address" autocomplete="email" maxlength="80" />
                <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
                <x-front.input-label for="password" :value="__('Set password *')" />
                <x-front.text-input id="password" class="block w-full" type="password" name="password" placeholder="Enter Password" maxlength="75" autocomplete="new-password" required />
                <x-front.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="mb-2">
            <x-front.input-checkbox 
                id="show-password"
                label="Show password" />
        </div>
    </div>
    @endif

    <div>
        <p class="mb-2 {{FD['text']}} text-gray-600 dark:text-gray-400">By continuing you agree to our <a href="" class="font-bold italic">Terms &amp; Conditions</a></p>
    </div>

    {{-- form buttons --}}
    {{-- <div class="fixed z-[1] sm:static bottom-16 sm:bottom-0 w-full -ml-[17px] -mb-[8px] sm:m-0 space-y-0 sm:space-y-4 {{FD['rounded']}} border sm:border-0 border-gray-200 bg-white px-2 py-3 sm:p-0 dark:border-0 dark:bg-gray-800"> --}}
        {{-- <div class="w-full sm:w-max flex space-x-2 sm:space-x-4 mt-2 sm:mt-8"> --}}
        <div class="w-full mt-5">
            <button type="submit" class="w-full sm:w-max flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                {{-- Login --}}
                {{ $buttonText }}
            </button>
        </div>
    {{-- </div> --}}

    <input type="hidden" name="phone_country_code" value="{{COUNTRY['country']}}"> <!-- returns 'IN' -->
    <input type="hidden" name="request_path" value="{{request()->path()}}"> <!-- returns 'checkout' -->
</form>