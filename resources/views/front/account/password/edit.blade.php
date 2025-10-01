@extends('layouts.front.account', [
    'title' => __('Edit Password')
])

@section('content')
    <div class="space-y-4 md:space-y-6">
        <div class="{{ FD['rounded'] }} bg-white shadow-sm dark:bg-gray-800">
            <form action="{{ route('front.account.password.update') }}" method="POST">@csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="current_password" :value="__('Current password *')" />
                        <x-front.text-input id="current_password" class="block w-full" type="password" name="current_password" placeholder="Enter Current password" maxlength="50" value="{{ old('current_password', $user->current_password) }}" autofocus required />
                        <x-front.input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-front.input-label for="password" :value="__('New password *')" />
                        <x-front.text-input id="password" class="block w-full" type="password" name="password" placeholder="Enter New password" maxlength="50" value="" required />
                        <x-front.input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
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
