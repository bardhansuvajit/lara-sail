<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Application Settings') }}"
    :breadcrumb="[
        ['label' => 'Edit Application settings']
    ]"
>

    <section class="mt-2">
        @include('admin.application.includes.navbar')

        <div class="py-5 px-5 bg-gray-100 dark:bg-gray-700">
            <div class="mb-3">
                <x-admin.developer-expertise-alert />
            </div>

            <form action="{{ route('admin.application.settings.update', 'basic') }}" method="POST" class="space-y-4">@csrf
                @foreach ($data as $index => $item)
                    @if (in_array($item->category, ['branding', 'favicon']))
                        {{-- Display as read-only --}}
                        <div class="grid grid-cols-4 gap-4 items-start opacity-75">
                            <div class="col-span-1">
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $item->key)) }}</p>
                                <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->pretty_value }}</p>
                            </div>
                            <div class="col-span-3 space-y-2">
                                <div class="bg-gray-200 dark:bg-gray-600 p-3 rounded">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <strong>Data:</strong> {{ $item->value }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        🔒 This setting is managed automatically and cannot be edited here.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="id[]" value="{{ $item->id }}">

                        <div class="grid grid-cols-4 gap-4 items-start">
                            <div class="col-span-1">
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $item->key)) }}</p>
                                <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->pretty_value }}</p>
                            </div>

                            <div class="col-span-3 space-y-2">
                                @switch($item->key)
                                    @case('company_domain')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Value * (machine)')" />
                                            <x-admin.input-select 
                                                id="value-{{ $index }}" 
                                                class="w-full value-select"
                                                name="value[]" 
                                                data-pretty-input="pretty_value-{{ $index }}"
                                            >
                                                @slot('options')
                                                    @foreach ($productTypes as $type)
                                                        <x-admin.input-select-option 
                                                            value="{{ $type->key }}" 
                                                            data-title="{{ $type->title }}"
                                                            :selected="(old('value.'.$index, $item->value) == $type->key)"
                                                        >
                                                            {{ $type->title }}
                                                        </x-admin.input-select-option>
                                                    @endforeach
                                                @endslot
                                            </x-admin.input-select>
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value * (display)')" />
                                            <x-admin.text-input 
                                                id="pretty_value-{{ $index }}" 
                                                class="block w-full pretty-input" 
                                                type="text" 
                                                name="pretty_value[]" 
                                                :value="old('pretty_value.'.$index, $item->pretty_value)" 
                                                placeholder="Auto-filled display value..." 
                                                readonly 
                                                required 
                                            />
                                        </div>

                                        @break

                                    @case('domain_name')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Domain * (machine)')" />
                                            <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value.'.$index, $item->value)" placeholder="https://example.com" required />
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value * (display)')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="text" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" placeholder="https://example.com" required />
                                        </div>
                                        @break

                                    @case('company_name')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Company Title *')" />
                                            <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value.'.$index, $item->value)" placeholder="Enter Company Title..." required />
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value *')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="text" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" placeholder="Enter display title..." required />
                                        </div>
                                        @break

                                    @case('company_establish_year')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Established Year *')" />
                                            <x-admin.text-input id="value" class="block w-full" type="number" min="1900" max="{{ date('Y') }}" name="value[]" :value="old('value.'.$index, $item->value)" placeholder="2000" required />
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value (display)')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="text" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" placeholder="2000" required />
                                        </div>
                                        @break

                                    @case('country_code')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Country * (code)')" />
                                            <x-admin.input-select 
                                                id="value" 
                                                class="w-full"
                                                name="value[]" 
                                            >
                                                @slot('options')
                                                    @foreach ($activeCountries as $country)
                                                        <x-admin.input-select-option value="{{$country->code}}" :selected="(old('value.'.$index, $item->value) == $country->code)">
                                                            {{ $country->name }}
                                                        </x-admin.input-select-option>
                                                    @endforeach
                                                @endslot
                                            </x-admin.input-select>
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value (display)')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="text" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" placeholder="Country display name" required />
                                        </div>
                                        @break

                                    @case('support_contact')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Support Contact * (machine)')" />
                                            <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value.'.$index, $item->value)" placeholder="9038775709" required />
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value (display)')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="text" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" placeholder="+91 903877 5709" required />
                                        </div>
                                        @break

                                    @case('support_email')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Support Email * (machine)')" />
                                            <x-admin.text-input id="value" class="block w-full" type="email" name="value[]" :value="old('value.'.$index, $item->value)" placeholder="support@email.com" required />
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value (display)')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="email" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" placeholder="support@email.com" required />
                                        </div>
                                        @break

                                    @case('company_address1')
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Company Address * (machine)')" />
                                            <x-admin.textarea id="value" class="block w-full" name="value[]" :value="old('value.'.$index, $item->value)"></x-admin.textarea>
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value (display)')" />
                                            <x-admin.textarea id="pretty_value" class="block w-full" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)"></x-admin.textarea>
                                        </div>
                                        @break

                                    @default
                                        {{-- Generic fallback for any other keys --}}
                                        <div>
                                            <x-admin.input-label for="value" :value="__('Value *')" />
                                            <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value.'.$index, $item->value)" required />
                                        </div>

                                        <div>
                                            <x-admin.input-label for="pretty_value" :value="__('Pretty Value')" />
                                            <x-admin.text-input id="pretty_value" class="block w-full" type="text" name="pretty_value[]" :value="old('pretty_value.'.$index, $item->pretty_value)" />
                                        </div>
                                @endswitch

                                <x-admin.input-error :messages="$errors->get('value.'.$index)" class="mt-2" />
                                <x-admin.input-error :messages="$errors->get('pretty_value.'.$index)" class="mt-2" />
                            </div>
                        </div>

                        @if (!$loop->last)
                            <div class="col-span-4">
                                <hr class="dark:border-gray-600">
                            </div>
                        @endif
                    @endif
                @endforeach

                <div class="col-span-4">
                    <div class="flex space-x-2 mt-2">
                        <input type="hidden" name="type" value="basic">

                        <x-admin.button
                            type="submit"
                            class="w-40"
                            element="button">
                            @slot('icon')
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path></svg>
                            @endslot
                            {{ __('Save Changes') }}
                        </x-admin.button>

                        <x-admin.button
                            element="a"
                            tag="secondary"
                            class="w-24"
                            :href="route('admin.application.settings.index', 'basic')">
                        {{ __('Back') }}
                        </x-admin.button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</x-admin-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.value-select').forEach(function(selectEl) {
        const prettyInputId = selectEl.dataset.prettyInput;
        const prettyInput = document.getElementById(prettyInputId);

        // Disable manual typing
        if (prettyInput) prettyInput.readOnly = true;

        // On change, set the title automatically
        selectEl.addEventListener('change', function() {
            const selectedOption = selectEl.options[selectEl.selectedIndex];
            const title = selectedOption.dataset.title || '';
            if (prettyInput) prettyInput.value = title;
        });

        // Trigger once on load (to sync old values)
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        if (selectedOption && prettyInput && !prettyInput.value) {
            prettyInput.value = selectedOption.dataset.title || '';
        }
    });
});
</script>
