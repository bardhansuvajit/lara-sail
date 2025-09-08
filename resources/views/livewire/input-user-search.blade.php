<div 
    x-data='{
        "selectedUserId": @json($user_id ?? 0),
        "selectedUserName": @json($user_name ?? ""),
    }' 
    wire:ignore.self
>
    <x-admin.input-label for="user_id" :value="__('User *')" />
    <x-admin.dropdown align="bottom" width="full" wire:key="dropdown-{{ $user_id }}">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="user_id" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="user_name" 
                x-model="selectedUserName"
                placeholder="Search user" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live.debounce.300ms="user" 
            />
        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600" wire:key="user-list-{{ time() }}">
                <ul class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($users as $user)
                        <li wire:key="user-{{ $user->id }}">
                            <a class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                               onclick="setUser({{ $user->id }}, '{{ addslashes($user->first_name).' '.addslashes($user->last_name) }}')"
                               href="javascript:void(0)">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex space-x-2 items-center">
                                        {{-- @if($user->image_s)
                                        <div class="h-8 overflow-hidden flex">
                                            <img src="{{ Storage::url($user->image_s) }}" alt="">
                                        </div>
                                        @endif --}}
                                        <p class="text-xs">{{ $user->first_name }} {{ $user->last_name }}</p>
                                    </div>
                                    {{-- <div class="text-xs bg-teal-500 text-white py-0 px-1">
                                        Level {{ $user->level ?? '' }}
                                    </div> --}}
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No user found.</li>
                    @endforelse
                </ul>

                @if (count($users) > 0)
                    <div class="px-2 py-1" 
                        wire:key="user-pagination-{{ $users->currentPage() }}"
                        @click.stop 
                    >
                        {{ $users->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>
        </x-slot>
    </x-admin.dropdown>

    <input type="hidden" name="user_id" x-model="selectedUserId" value="{{ $user_id }}" required>
    <x-admin.input-error :messages="$errors->get('user_id')" class="mt-2" />
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (window.Livewire) {
            window.setUser = function (id, full_name) {
                const categoryIdInput = document.querySelector('input[name="user_id"]');
                const categoryNameInput = document.querySelector('input[name="user_name"]');

                if (categoryIdInput) {
                    categoryIdInput.value = id;
                }
                if (categoryNameInput) {
                    categoryNameInput.value = full_name;
                }

                // Ensure Livewire is ready before emitting
                window.Livewire.hook('message.sent', () => {
                    Livewire.emit('setUser', id, full_name);
                });
            };
        }
    });

    /*
    document.addEventListener('DOMContentLoaded', function() {
        // Prevent dropdown close on pagination clicks
        // document.addEventListener('click', function(e) {
        //     const paginationLinks = e.target.closest('[wire\\:click="previousPage"], [wire\\:click="nextPage"], [wire\\:click="gotoPage"]');
        //     if (paginationLinks) {
        //         e.stopPropagation();
        //         e.preventDefault();
        //     }
        // });

        if (window.Livewire) {
            window.setUser = function(id, title) {
                // Update hidden inputs
                const userIdInput = document.querySelector('input[name="user_id"]');
                const userTitleInput = document.querySelector('input[name="user_name"]');
                
                if (userIdInput) userIdInput.value = id;
                if (userTitleInput) userTitleInput.value = title;
                
                // Update Livewire component
                if (window.Livewire) {
                    Livewire.dispatch('setUser', {id, title});
                }
                
                // Close dropdown
                document.dispatchEvent(new CustomEvent('close-dropdown'));
            };
        }
    });
    */
</script>