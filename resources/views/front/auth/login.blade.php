<x-simple-guest
    screen="max-w-screen-xl"
    title="{{ __('Login') }}">

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-2 sm:px-6 py-4 sm:py-8 mx-auto h-80 sm:h-96 md:h-screen lg:py-0">
            {{-- <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                Flowbite
            </a> --}}
            <div class="w-full bg-white {{FD['rounded']}} shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 sm:p-6 space-y-4 md:space-y-6">
                    <h1 class="text-sm md:text-sm font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                        Sign in to your account
                    </h1>

                    <form class="space-y-4 md:space-y-6" action="#">
                        <div>
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
                                            :selected="old('phone_country_code') ? old('phone_country_code') : $countryIndex == 0"
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

                        {{-- <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                  <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                  <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                        </div> --}}

                        {{-- <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button> --}}

                        {{-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p> --}}
                    </form>
                </div>
            </div>
        </div>
      </section>
</x-simple-guest>
