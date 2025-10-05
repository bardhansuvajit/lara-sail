@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'required' => false,
    'labelClass' => false,
    'selectedElCheckoutAddress' => false
])

<div class="group" x-data>
    <input 
        type="radio" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'hidden peer']) }}
        @required($required)
        @checked($checked)
        x-on:change="
            // Find all delivery text elements and reset them
            document.querySelectorAll('.delivery-selected').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.delivery-not-selected').forEach(el => el.classList.remove('hidden'));
            // Show selected text for this element
            $el.closest('.group').querySelector('.delivery-selected').classList.remove('hidden');
            $el.closest('.group').querySelector('.delivery-not-selected').classList.add('hidden');
        "
    />

    <label for="{{ $id }}" class="flex flex-col h-full p-2 md:p-4 border-2 border-gray-200 dark:border-gray-700 cursor-pointer 
        bg-white peer-checked:bg-gray-100 peer-checked:text-gray-800 peer-checked:border-gray-900
        dark:bg-gray-700 dark:peer-checked:bg-gray-600 dark:peer-checked:text-gray-300 dark:peer-checked:border-gray-100
        transition-colors duration-200 ease-in-out
        {{ $labelClass ?? '' }}
    ">
        <!-- Main content area that grows to fill available space -->
        <div class="flex-1">
            {{ $slot }}
        </div>

        <!-- Delivery status section - always at bottom -->
        @if ($selectedElCheckoutAddress)
            <div class="mt-3">
                <div class="delivery-selected {{ $checked ? '' : 'hidden' }} flex w-full items-center justify-center {{ FD['rounded'] }} bg-green-600 dark:bg-green-600 px-3 py-1 {{ FD['text'] }} font-medium text-white gap-2">
                    <span class="{{ FD['iconClass'] }}">
                        <svg class="animate-delivery-combined" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                    </span>
                    Your items will be delivered Here
                </div>

                <div class="delivery-not-selected {{ $checked ? 'hidden' : 'flex' }} flex w-full items-center justify-center {{ FD['rounded'] }} bg-slate-500 dark:bg-slate-500 px-3 py-1 {{ FD['text'] }} font-medium text-white gap-2">
                    <span class="{{ FD['iconClass'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M200-640v440h560v-440H640v320l-160-80-160 80v-320H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm184 80v190l80-40 80 40v-190H400Zm-200 0h560-560Z"/>
                        </svg>
                    </span>
                    Select to Deliver Here
                </div>
            </div>
        @endif
    </label>
</div>