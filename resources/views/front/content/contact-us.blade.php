<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Contact Us') }}">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 px-2 md:px-6 py-4 md:py-12">
        <div class="max-w-7xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-5 md:mb-10">
                <h1 class="{{ FD['text-2'] }} font-bold text-gray-800 dark:text-gray-200">
                    Get in Touch
                </h1>
                <p class="mt-2 {{ FD['text'] }} text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Have questions, feedback, or partnership ideas?  
                    We're always here to listen and help. Fill out the form or reach us via our contact details below.
                </p>
            </div>

            <hr class="mb-5 md:mb-10 border-gray-200 dark:border-gray-800">

            {{-- Contact Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                {{-- Contact Info --}}
                <div>
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center md:text-left">
                        Our Contact Information
                    </h2>
                    <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mb-6">
                        Reach us through any of the channels below and we’ll respond as quickly as possible.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <div class="w-4 h-4 text-primary dark:text-primary-light flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-120v-720h400v160h400v560H80Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h320v-400H480v80h80v80h-80v80h80v80h-80v80Zm160-240v-80h80v80h-80Zm0 160v-80h80v80h-80Z"/></svg>
                            </div>

                            <span class="ml-3 {{ FD['text'] }} text-gray-700 dark:text-gray-300">
                                {{applicationSettings('company_address1')}}
                            </span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-4 h-4 text-primary dark:text-primary-light flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480v58q0 59-40.5 100.5T740-280q-35 0-66-15t-52-43q-29 29-65.5 43.5T480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480v58q0 26 17 44t43 18q26 0 43-18t17-44v-58q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93h200v80H480Zm0-280q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z"/></svg>
                            </div>

                            <span class="ml-3 {{ FD['text'] }} text-gray-700 dark:text-gray-300">
                                {{applicationSettings('support_email')}}
                            </span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-4 h-4 text-primary dark:text-primary-light flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z"/></svg>
                            </div>

                            <span class="ml-3 {{ FD['text'] }} text-gray-700 dark:text-gray-300">
                                {{applicationSettings('support_contact')}}
                            </span>
                        </li>
                    </ul>

                    {{-- Map --}}
                    <div class="mt-8">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3683.67076332936!2d88.37948907521019!3d22.591413979478286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjLCsDM1JzI5LjEiTiA4OMKwMjInNTUuNCJF!5e0!3m2!1sen!2sin!4v1754767001184!5m2!1sen!2sin"
                            class="w-full h-48 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-800"
                            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- Contact Form --}}
                @livewire('contact-page-form')

            </div>
        </div>
    </div>
</x-guest-layout>
