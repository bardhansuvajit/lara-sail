<div>
    <form wire:submit.prevent="submit">
        <div class="">
            <div class="grid grid-cols-4 gap-2 items-end">
                <div class="col-span-3">
                    <x-front.input-label for="email" :value="__('Get the latest deals and more.')" />
                    <x-front.text-input 
                        id="email" 
                        class="block w-full" 
                        type="email" 
                        wire:model="email" 
                        placeholder="Enter Email Address" 
                        autocomplete="email" 
                        maxlength="80" 
                    />
                </div>

                <div class="col-span-1">
                    <button 
                        type="submit" 
                        class="w-full h-8 flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Subscribe</span>
                        <span wire:loading>
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>

            <div class="col-span-4">
                @error('email')
                    <x-front.input-error :messages="$message" class="mt-2" />
                @enderror

                {{-- @if($success)
                    <div class="mt-2 text-xs text-green-600 dark:text-green-400">
                        Thank you for subscribing!
                    </div>
                @endif --}}
            </div>
        </div>
    </form>
</div>