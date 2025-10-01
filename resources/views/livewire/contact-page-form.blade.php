<div>
    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center md:text-left">
        Send Us a Message
    </h2>

    <div class="grid gap-4 mb-4 sm:grid-cols-2">
        <div>
            <x-front.input-label for="first_name" :value="__('First name *')" />
            <x-front.text-input
                id="first_name"
                wire:model.defer="first_name"
                class="block w-full"
                type="text"
                maxlength="50"
                placeholder="Enter First Name"
                autocomplete="given-name"
            />
            <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div>
            <x-front.input-label for="last_name" :value="__('Last name *')" />
            <x-front.text-input
                id="last_name"
                wire:model.defer="last_name"
                class="block w-full"
                type="text"
                maxlength="50"
                placeholder="Enter Last Name"
                autocomplete="family-name"
            />
            <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
    </div>

    <div class="grid gap-4 mb-4 sm:grid-cols-2">
        <div>
            <x-front.input-label for="phone_no" :value="__('Phone number *')" />
            <x-front.text-input-with-dropdown 
                id="phone_no"
                selectId="phone_country_code" 
                selectName="phone_country_code" 
                selectModel="phone_country_code"
                inputModel="phone_no"
                placeholder="Enter Phone Number"
                autocomplete="tel-national"
                maxLength="{{COUNTRY['phoneNoDigits']}}"
            >
                @slot('options')
                    @foreach ($activeCountries as $country)
                        <x-front.input-select-option value="{{ $country->code }}">
                            {{ $country->name }} ({{ $country->phone_code }})
                        </x-front.input-select-option>
                    @endforeach
                @endslot
            </x-front.text-input-with-dropdown>

            {{-- <x-front.text-input-with-dropdown 
                id="phone_no" 
                class="block w-auto" 
                type="tel" 
                name="phone_no" 
                :value="old('phone_no')" 
                placeholder="Enter Phone Number" 
                selectTitle="India (+91)" 
                selectId="phone_country_code" 
                selectName="phone_country_code" 
                wire:model.defer="phone_no"
                autocomplete="tel-national"
                maxLength="{{COUNTRY['phoneNoDigits']}}"
            >
                @slot('options')
                    @foreach ($activeCountries as $country)
                        <x-front.input-select-option 
                            value="{{$country->code}}" 
                            :selected="old('phone_country_code') ? $country->code == old('phone_country_code') : '' "
                        >
                            {{ $country->name }} ({{ $country->phone_code }})
                        </x-front.input-select-option>
                    @endforeach
                @endslot
            </x-front.text-input-with-dropdown> --}}

            <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
            <x-front.input-error :messages="$errors->get('phone_country_code')" class="mt-2" />
        </div>

        <div>
            <x-front.input-label for="email" :value="__('Email')" />
            <x-front.text-input
                id="email"
                wire:model.defer="email"
                class="block w-full"
                type="email"
                maxlength="100"
                placeholder="Enter Email Address"
                autocomplete="email"
            />
            <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </div>

    <div class="grid gap-4 mb-4">
        <div>
            <x-front.input-label for="message" :value="__('Message *')" />
            <x-front.textarea
                id="message"
                wire:model.defer="message"
                class="block w-full"
                maxlength="1000"
                placeholder="Enter message"
            />
            <x-front.input-error :messages="$errors->get('message')" class="mt-2" />
        </div>
    </div>

    <div>
        <button
            type="button"
            wire:click="submit"
            wire:loading.attr="disabled"
            wire:target="submit"
            class="w-full sm:w-max flex items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white"
        >
            <span wire:loading.remove wire:target="submit">Send Message</span>
            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                Sending...
            </span>
        </button>
    </div>
</div>

<script>
    document.addEventListener("livewire:initialized", () => {
        @this.set('page', window.location.href);
    });
</script>
