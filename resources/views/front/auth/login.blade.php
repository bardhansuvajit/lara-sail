<x-auth-layout
    screen="max-w-screen-xl"
    title="{{ __('Login') }}">

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-2 sm:px-6 py-4 sm:py-8 mx-auto h-[80vh] sm:h-[80vh] md:h-screen lg:py-0">
            <div class="w-full bg-white {{FD['rounded']}} shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 sm:p-6 space-y-4 md:space-y-6">
                    <h1 class="text-sm md:text-sm font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                        Sign in/ Create your account
                    </h1>

                    @include('layouts.front.login')
                </div>
            </div>
        </div>
      </section>
</x-auth-layout>
