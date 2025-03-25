<div class="fixed bottom-0 block sm:hidden w-full bg-gray-100 dark:bg-gray-800 shadow-lg">
    <div class="">
        <ul class="grid grid-cols-4 gap-2">
            <li>
                <a href="{{route('front.home.index')}}" class="group flex flex-col items-center justify-center {{FD['rounded']}} p-2.5 {{ Route::is('front.home.index') ? 'text-green-600 dark:text-green-600 font-bold' : 'text-gray-700 dark:text-primary-300 font-light' }} ">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}}">
                        <div class="h-4 w-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                        </div>
                    </span>
                    <span class="text-[10px]">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('front.category.index')}}" class="group flex flex-col items-center justify-center {{FD['rounded']}} p-2.5 {{ Route::is('front.home.index') ? 'text-green-600 dark:text-green-600 font-bold' : 'text-gray-700 dark:text-primary-300 font-light' }} ">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}}">
                        <div class="h-4 w-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z"/></svg>
                        </div>
                    </span>
                    <span class="text-[10px] font-bold">Category</span>
                </a>
            </li>
            <li>
                <a href="{{route('front.cart.index')}}" class="group flex flex-col items-center justify-center {{FD['rounded']}} p-2.5 {{ Route::is('front.home.index') ? 'text-green-600 dark:text-green-600 font-bold' : 'text-gray-700 dark:text-primary-300 font-light' }} ">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}}">
                        <div class="h-4 w-4 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>

                            <div class="absolute -top-2 -end-6 {{FD['text-1']}} bg-primary-600 text-gray-50 font-medium w-6 h-6 rounded-full px-1 py-[3px] text-center overflow-hidden">
                                <div class="cart-count">99</div>
                            </div>
                        </div>
                    </span>
                    <span class="text-[10px] font-bold">Cart</span>
                </a>
            </li>
            <li>
                <a href="{{route('front.login.index')}}" class="group flex flex-col items-center justify-center {{FD['rounded']}} p-2.5 {{ Route::is('front.home.index') ? 'text-green-600 dark:text-green-600 font-bold' : 'text-gray-700 dark:text-primary-300 font-light' }} ">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}}">
                        <div class="h-4 w-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                        </div>
                    </span>
                    <span class="text-[10px] font-bold">Login</span>
                    {{-- <span class="text-[10px] font-bold text-gray-700 dark:text-primary-300">Account</span> --}}
                </a>
            </li>
            {{-- <li>
                <a href="#" class="group flex flex-col items-center justify-center {{FD['rounded']}} bg-purple-50 p-2.5 hover:bg-purple-100 dark:bg-purple-900 dark:hover:bg-purple-800">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}} bg-purple-100 group-hover:bg-purple-200 dark:bg-purple-800  dark:group-hover:bg-purple-700">
                        <svg class="h-4 w-4 text-purple-600 dark:text-purple-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.875 1.25 3.875 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.155-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z" /></svg>
                    </span>
                    <span class="text-sm font-medium text-purple-600 dark:text-purple-300">Gifts</span>
                </a>
            </li>
            <li>
                <a href="#" class="group flex flex-col items-center justify-center {{FD['rounded']}} bg-teal-50 p-2.5 hover:bg-teal-100 dark:bg-teal-900 dark:hover:bg-teal-800">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}} bg-teal-100 group-hover:bg-teal-200 dark:bg-teal-800  dark:group-hover:bg-teal-700">
                        <svg class="h-4 w-4 text-teal-600 dark:text-teal-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z" /></svg>
                    </span>
                    <span class="text-sm font-medium text-teal-600 dark:text-teal-300">Wallet</span>
                </a>
            </li>
            <li>
                <a href="#" class="group flex flex-col items-center justify-center {{FD['rounded']}} bg-amber-50 p-2.5 hover:bg-amber-100 dark:bg-amber-900 dark:hover:bg-amber-800">
                    <span class="mb-1 flex h-5 w-5 items-center justify-center {{FD['rounded']}} bg-amber-100 group-hover:bg-amber-200 dark:bg-amber-800  dark:group-hover:bg-amber-700">
                        <svg class="h-4 w-4 text-amber-600 dark:text-amber-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z" /></svg>
                    </span>
                    <span class="text-sm font-medium text-amber-600 dark:text-amber-300">Wallet</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>