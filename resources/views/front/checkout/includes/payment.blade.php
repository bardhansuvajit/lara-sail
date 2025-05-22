<div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">

    {{-- heading --}}
    <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
        <div class="w-full min-w-0 flex-1 md:order-2">
            <h2 class="flex space-x-2 items-center mb-1">
                <div class="{{FD['iconClass']}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/></svg>
                </div>

                <p class="text-sm md:text-base leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300">{{ __('Payment') }}</p>
            </h2>

            {{-- When AUTH NOT FOUND --}}
            @if (auth()->guard('web')->check())
                <div class="flex justify-between">
                    <div>
                        <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">
                            {{auth()->guard('web')->user()->first_name}} 
                            {{auth()->guard('web')->user()->last_name}}, 
                            {{auth()->guard('web')->user()->primary_phone_no}}
                        </p>
                    </div>
                    
                    <div class="flex">
                        <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">
                            Not {{auth()->guard('web')->user()->first_name}}? 
                            <form method="POST" action="{{ route('front.logout') }}" class="inline-flex">@csrf
                                <button type="submit" class="{{FD['text']}} italic text-primary-500 inline">
                                    Sign Out
                                </button>
                            </form>
                            {{-- <a href="#" class="italic text-primary-500">Logout</a> --}}
                        </p>
                    </div>
                </div>
            @else
                <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident</p>
            @endif
        </div>
    </div>

    

    {{-- When AUTH NOT FOUND --}}
    @if (auth()->guard('web')->check())

    @else
        
    @endif

</div>