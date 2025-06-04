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
            <form action="{{ route('admin.application.settings.update', 'shipping') }}" method="POST" class="space-y-4">@csrf
                @foreach ($data as $item)
                    <input type="hidden" name="id[]" value="{{ $item->id }}">

                    {{-- {{ $item }} --}}

                    <div class="flex items-center gap-3">
                        <div class="w-8">
                            {!! $item->countryDetails->flag !!}
                        </div>
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->countryDetails->name }}</p>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="method" :value="__('Method *')" />
                                <x-admin.text-input id="method" class="block w-full" type="text" name="method[]" :value="old('method') ? old('method') : $item->method" placeholder="Enter Method" autofocus required />
                                <x-admin.input-error :messages="$errors->get('method')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="title" :value="__('Title *')" />
                                <x-admin.text-input id="title" class="block w-full" type="text" name="title[]" :value="old('title') ? old('title') : $item->title" placeholder="Enter Title" required />
                                <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="subtitle" :value="__('Subtitle *')" />
                                <x-admin.text-input id="subtitle" class="block w-full" type="text" name="subtitle[]" :value="old('subtitle') ? old('subtitle') : $item->subtitle" placeholder="Enter Subtitle" required />
                                <x-admin.input-error :messages="$errors->get('subtitle')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="cost" :value="__('Cost *')" />
                                <x-admin.text-input id="cost" class="block w-full" type="text" name="cost[]" :value="old('cost') ? old('cost') : $item->cost" placeholder="Enter Cost" required />
                                <x-admin.input-error :messages="$errors->get('cost')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-4">
                            <div>
                                <x-admin.input-label for="description" :value="__('Description *')" />
                                <x-admin.textarea id="description" class="block" type="text" name="description[]" :value="old('description') ? old('description') : $item->description" placeholder="Enter Description" maxlength="1000" />
                                <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-4">
                            <div>
                                <x-admin.input-label for="icon" :value="__('Icon *')" />
                                <x-admin.textarea id="icon" class="block" type="text" name="icon[]" :value="old('icon') ? old('icon') : $item->icon" placeholder="Enter Icon" maxlength="1000" />
                                <x-admin.input-error :messages="$errors->get('icon')" class="mt-2" />
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
                        <input type="hidden" name="type" value="shipping">

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
                            :href="route('admin.application.settings.index', 'cart')">
                        {{ __('Back') }}
                        </x-admin.button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</x-admin-app-layout>
