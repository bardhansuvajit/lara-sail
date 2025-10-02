@extends('layouts.front.account', [
    'title' => __('Edit Password')
])

@section('content')

    {{-- @if ($errors->updatePassword->any())
        {{ dd($errors->updatePassword->all()) }}
    @endif --}}


    <div class="space-y-4 md:space-y-6">
        <div class="{{ FD['rounded'] }} bg-white shadow-sm dark:bg-gray-800">
            {{-- <form action="{{ route('front.account.password.update') }}" method="POST">@csrf --}}
            <form method="post" action="{{ route('front.password.update') }}">
                @csrf
                @method('put')

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="current_password" :value="__('Current password *')" />
                        <x-front.text-input id="current_password" class="block w-full" type="password" name="current_password" placeholder="Enter Current password" maxlength="50" value="" autofocus />
                        <x-front.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="password" :value="__('New password *')" />
                        <x-front.text-input id="password" class="block w-full" type="password" name="password" placeholder="Enter New password" maxlength="50" value="" />
                        <x-front.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="password_confirmation" :value="__('Confirm New password *')" />
                        <x-front.text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" placeholder="Confirm New password" maxlength="50" value="" />
                        <x-front.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-2">
                    <x-front.input-checkbox 
                        id="show-password"
                        label="Show password" />
                </div>

                <div>
                    <button type="submit" class="w-full sm:w-max flex items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
