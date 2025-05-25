<div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">

    {{-- heading --}}
    <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
        <div class="w-full min-w-0 flex-1 md:order-2">
            <h2 class="flex space-x-2 items-center mb-1">
                <div class="{{FD['iconClass']}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
                </div>

                <p class="{{FD['text-1']}} md:text-base leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300">{{ __('Account') }}</p>
            </h2>

            {{-- When AUTH FOUND --}}
            @if (auth()->guard('web')->check())
                <div class="flex justify-between">
                    <div>
                        <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">
                            {{$user->first_name}} 
                            {{$user->last_name}}, 
                            {{$user->primary_phone_no}}
                        </p>
                    </div>
                    
                    <div class="flex">
                        <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">
                            Not {{$user->first_name}}? 
                            <form method="POST" action="{{ route('front.logout') }}" class="inline-flex">@csrf
                                <button type="submit" class="{{FD['text']}} italic text-primary-500 dark:text-primary-300 inline">
                                    Sign Out
                                </button>
                            </form>
                            {{-- <a href="#" class="italic text-primary-500">Logout</a> --}}
                        </p>
                    </div>
                </div>
            @else
                <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{!! __('Sign in to receive order updates, save your address, and complete your purchase. Don&apos;t have an account? It&apos;s quick and easy to sign up.') !!}</p>
            @endif
        </div>
    </div>

    {{-- When AUTH NOT FOUND --}}
    @if (!auth()->guard('web')->check())
        <div class="border-t dark:border-gray-700 my-5"></div>

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

                {{-- <div>
                    <p class="mb-2 {{FD['text']}} text-gray-600 dark:text-gray-400">By continuing you agree to our <a href="" class="font-bold italic">Terms &amp; Conditions</a></p> --}}
                </div>
            </div>
            @endif

            {{-- NOT LOGGED IN + NO ACCOUNT EXISTS/ REGISTER --}}
            @if ($formType == "register")
            <div class="w-full">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <x-front.input-label for="first_name" :value="__('First name *')" />
                        <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name')" placeholder="Enter First Name" maxlength="50" autofocus required />
                        <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-front.input-label for="last_name" :value="__('Last name *')" />
                        <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')" placeholder="Enter Last Name" maxlength="50" required />
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
                            :focus="$focus === 'phone_no'"
                        >
                        </x-front.text-input-with-text>
                        <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
                    </div>

                    <div>
                        <x-front.input-label for="email" :value="__('Email')" />
                        <x-front.text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="Enter Email Address" autocomplete="username" maxlength="80" />
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

            {{-- <div>
                <p class="mb-2 {{FD['text']}} text-gray-600 dark:text-gray-400">By continuing you agree to our <a href="" class="font-bold italic">Terms &amp; Conditions</a></p>
            </div> --}}

            {{-- form buttons --}}
            <div class="fixed z-[1] sm:static bottom-16 sm:bottom-0 w-full -ml-[17px] -mb-[8px] sm:m-0 space-y-0 sm:space-y-4 {{FD['rounded']}} border sm:border-0 border-gray-200 bg-white px-2 py-3 sm:p-0 dark:border-0 dark:bg-gray-800">
                <div class="w-full sm:w-max flex space-x-2 sm:space-x-4 mt-2 sm:mt-8">
                    <a href="{{ route('front.cart.index') }}" class="w-full sm:w-max flex space-x-4 items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <div class="w-3 h-3 me-2 text-gray-600 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-200 80-480l280-280 56 56-183 184h647v80H233l184 184-57 56Z"/></svg>
                        </div>

                        Back to Cart
                    </a>

                    <button type="submit" class="w-full sm:w-max flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        {{-- Login --}}
                        {{ $buttonText }}
                    </button>
                </div>
            </div>

            <input type="hidden" name="phone_country_code" value="{{COUNTRY['country']}}"> <!-- returns 'IN' -->
            <input type="hidden" name="request_path" value="{{request()->path()}}"> <!-- returns 'checkout' -->
        </form>
    @endif

</div>