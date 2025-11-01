<div class="mx-auto mt-2 md:mt-6 flex-1 space-y-6 lg:mt-0 lg:w-full mb-0 md:mb-4">
    <div class="space-y-4 {{ FD['rounded'] }} bg-white px-2 py-3 lg:p-4 shadow-sm dark:bg-gray-800">
        <div class="block">
            
            <div class="flex justify-center sm:justify-start mb-5">
                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <span class="font-medium text-gray-600 dark:text-gray-300">
                        {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                    </span>
                </div>
            </div>

            {{-- <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Basic information</p> --}}

            <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Full name</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Phone number</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                        {{ $user->primary_phone_no }}
                        @if ($user->alt_phone_no)
                            / {{ $user->alt_phone_no }}
                        @endif
                    </dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Email</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ $user->email }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Gender</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ genderString($user->gender_id) }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Country</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                        <div class="flex items-center">
                            @if ($user->country->flag)
                                <div class="inline-flex justify-center h-4 mr-2">
                                    {!! $user->country->flag !!}
                                </div>
                            @endif
                            {{ $user->country->name }}
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
        </div>

        @if (!request()->is('account/edit*'))
            <div>
                <x-front.button
                    element="a"
                    tag="secondary"
                    :href="route('front.account.edit')"
                    >
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-240Zm-320 80v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q37 0 73 4.5t72 14.5l-67 68q-20-3-39-5t-39-2q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32h240v80H160Zm400 40v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-340L683-120H560Zm300-263-37-37 37 37ZM620-180h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19ZM480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Z"/></svg>
                    @endslot
                    {{ __('Edit Profile') }}
                </x-front.button>
            </div>
        @endif

        <div class="flex items-center justify-center gap-2">
            <p class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 dark:text-primary-400">
                Not {{$user->first_name}}?
            </p>
            <form method="POST" action="{{ route('front.logout') }}" class="flex">@csrf
                <button type="submit" class="inline-flex items-center underline hover:no-underline {{FD['text']}} font-medium text-primary-700 dark:text-primary-400">Logout</button>
            </form>
        </div>
    </div>
</div>