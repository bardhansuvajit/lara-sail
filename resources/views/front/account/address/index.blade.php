<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Address</h2>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="mx-auto mt-6 flex-1 space-y-6 lg:mt-0 lg:w-full mb-4">
                    <div class="space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="block">
                            
                            <div class="flex justify-center sm:justify-start mb-5">
                                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <span class="font-medium text-gray-600 dark:text-gray-300">
                                        {{ substr(Auth::guard('web')->user()->first_name, 0, 1) }}{{ substr(Auth::guard('web')->user()->last_name, 0, 1) }}
                                    </span>
                                </div>
                            </div>

                            {{-- <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Basic information</p> --}}

                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Full name</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                        {{ Auth::guard('web')->user()->first_name }} {{ Auth::guard('web')->user()->last_name }}
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Phone number</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                        {{ Auth::guard('web')->user()->primary_phone_no }}
                                        @if (Auth::guard('web')->user()->alt_phone_no)
                                            / {{ Auth::guard('web')->user()->alt_phone_no }}
                                        @endif
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ Auth::guard('web')->user()->email }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Gender</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ genderString(Auth::guard('web')->user()->gender_id) }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Country</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            @if (Auth::guard('web')->user()->country->flag)
                                                <div class="inline-flex justify-center h-4 mr-2">
                                                    {!! Auth::guard('web')->user()->country->flag !!}
                                                </div>
                                            @endif
                                            {{ Auth::guard('web')->user()->country->name }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
                        </div>

                        <div class="flex space-x-2 lg:space-x-0">
                            <a href="{{route('front.account.edit')}}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Edit Profile
                            </a>
                        </div>

                        <div class="flex items-center justify-center gap-2">
                            <p class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 dark:text-primary-500">
                                Not {{Auth::guard('web')->user()->first_name}}?
                            </p>
                            <form method="POST" action="{{ route('front.logout') }}" class="flex">@csrf
                                <button type="submit" class="inline-flex items-center underline hover:no-underline {{FD['text']}} font-medium text-primary-700 dark:text-primary-500">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- right part - order summary --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div>

                        @include('front.account.address.includes.create', ['type' => 'shipping'])

                        @foreach ($addresses as $address)
                            <x-front.radio-input-button 
                                id="addressId{{$address->id}}" 
                                name="shipping_address_id" 
                                value="{{$address->id}}" 
                                {{-- :checked="$address->is_default == 1"  --}}
                                class="shipping-address" 
                                labelClass="mb-2" 
                            >
                                <div class="{{FD['rounded']}} shadow-sm dark:border-gray-700">
                                    <div class="flex justify-between">
                                        <div>
                                            <h5 class="mb-1 {{FD['text-1']}} font-bold tracking-tight text-gray-700 dark:text-white">{{$address->first_name}} {{$address->last_name}}</h5>

                                            <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                                {{$address->address_line_1}} 
                                                {{$address->address_line_2}} @if (!empty($address->landmark)), {{$address->landmark}} @endif
                                            </p>

                                            <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                                {{$address->city}}, 
                                                {{strtoupper($address->stateDetail->name)}}, 
                                                {{$address->postal_code}}
                                            </p>

                                            <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">{{strtoupper($address->countryDetail->name)}}</p>
                                        </div>

                                        {{-- @if (count($shippingAddresses) > 1)
                                        <div class="flex items-center">
                                            <p class="flex w-24 items-center justify-center {{FD['rounded']}} bg-primary-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:bg-primary-600">Deliver Here</p>
                                        </div>
                                        @endif --}}

                                        <div class="flex items-center">
                                            <div class="flex flex-col items-center">
                                                {{-- <p class="flex w-24 items-center justify-center {{FD['rounded']}} bg-primary-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:bg-primary-600">Select</p> --}}

                                                <form action="{{ route('front.address.delete', $address->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex w-24 items-center justify-center {{FD['rounded']}} text-orange-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:text-orange-600">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-front.radio-input-button>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
