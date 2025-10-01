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
            <div class="flex space-x-2 lg:space-x-0">
                <a href="{{route('front.account.edit')}}" class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Edit Profile
                </a>
            </div>
        @endif

        <div class="flex items-center justify-center gap-2">
            <p class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 dark:text-primary-500">
                Not {{$user->first_name}}?
            </p>
            <form method="POST" action="{{ route('front.logout') }}" class="flex">@csrf
                <button type="submit" class="inline-flex items-center underline hover:no-underline {{FD['text']}} font-medium text-primary-700 dark:text-primary-500">Logout</button>
            </form>
        </div>
    </div>
</div>