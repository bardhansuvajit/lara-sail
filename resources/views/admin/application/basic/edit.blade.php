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
            <form action="{{ route('admin.application.settings.update', 'basic') }}" method="POST" class="space-y-4">@csrf
                @foreach ($data as $index => $item)
                    <input type="hidden" name="id[]" value="{{ $item->id }}">

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <div>
                                @switch($index)
                                    @case(0)
                                        <x-admin.input-label for="value" :value="__('Company Domain *')" />
                                        <x-admin.input-select 
                                            id="value" 
                                            class="w-full"
                                            name="value[]" 
                                        >
                                            @slot('options')
                                                @foreach ($productTypes as $type)
                                                    <x-admin.input-select-option value="{{$type->key}}" :selected="$type->key == $item->value"> {{ ucwords($type->key) }} </x-admin.input-select-option>
                                                @endforeach
                                            @endslot
                                        </x-admin.input-select>
                                        {{-- <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value') ? old('value') : $item->value" placeholder="Enter Company Title..." required /> --}}
                                        @break
                                    @case(1)
                                        <x-admin.input-label for="value" :value="__('Domain *')" />
                                        <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value') ? old('value') : $item->value" placeholder="Enter Domain..." autofocus required />
                                        @break
                                    @case(2)
                                        <x-admin.input-label for="value" :value="__('Company Title *')" />
                                        <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value') ? old('value') : $item->value" placeholder="Enter Company Title..." required />
                                        @break
                                    @case(3)
                                        <x-admin.input-label for="value" :value="__('Country *')" />
                                        <x-admin.input-select 
                                            id="value" 
                                            class="w-full"
                                            name="value[]" 
                                        >
                                            @slot('options')
                                                @foreach ($activeCountries as $country)
                                                    <x-admin.input-select-option value="{{$country->short_name}}" :selected="$country->short_name == $item->value"> {{ $country->name }} </x-admin.input-select-option>
                                                @endforeach
                                            @endslot
                                        </x-admin.input-select>
                                        {{-- <x-admin.text-input id="value" class="block w-full" type="text" name="value[]" :value="old('value') ? old('value') : $item->value" placeholder="Enter Company Title..." required /> --}}
                                        @break
                                    @default
                                        
                                @endswitch

                                <x-admin.input-error :messages="$errors->get('value')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    @if (!$loop->last)
                        <div class="col-span-4">
                            <hr class="dark:border-gray-600">
                        </div>
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
