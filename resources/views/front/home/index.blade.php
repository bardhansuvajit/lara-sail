<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">
                        <a href="{{$banner->web_redirect_url}}" target="_blank">
                            <img src="{{ Storage::url($banner->web_image_l_path) }}" alt="{{$banner->title}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    @if (count($featuredProducts) > 0)
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                    {{-- Product Card Component --}}
                    @foreach ($featuredProducts as $featuredItem)
                        <x-front.product-card :product="$featuredItem->product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="bg-white px-4 py-10 antialiased dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <svg class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M205.5-323.5H282q-.5-31.5-22.75-53.75T205.5-400v76.5Zm135.5 0h55q0-79.06-55.72-134.78T205.5-514v55q56.5.5 96 39.75T341-323.5Zm114 0h55q0-62.8-23.79-118.47t-65.18-97.06q-41.39-41.39-97.06-65.18Q268.3-628 205.5-628v55.11q103.8 0 176.65 72.7Q455-427.5 455-323.5ZM326-129v-79H165q-30.94 0-52.97-22.03Q90-252.06 90-283v-473q0-30.94 22.03-52.97Q134.06-831 165-831h630q30.94 0 52.97 22.03Q870-786.94 870-756v473q0 30.94-22.03 52.97Q825.94-208 795-208H634v79H326ZM165-283h630v-473H165v473Zm0 0v-473 473Z"/></svg>
                </a>
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                Save <span class="currency-symbol">₹</span>500 today on your purchase <br />
                of a new iMac computer.
                </h1>

                <p class="mb-6 text-gray-500 dark:text-gray-400">Reserve your new Apple iMac 27” today and enjoy exclusive savings with qualified activation. Pre-order now to secure your discount.</p>

                <a href="#" class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"> Pre-order now </a>
            </div>
        </div>
    </section>

</x-guest-layout>