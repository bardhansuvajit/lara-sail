<div>
    <div class="grid gap-4 mb-4 sm:grid-cols-2">
        <div>
            <x-admin.input-label for="level" :value="__('Level *')" />

            <ul class="flex space-x-2">
                <input type="radio" wire:model="level" value="1" id="level_1" name="level" checked>

                {{-- <li>
                    <x-admin.radio-input-button id="level_1" name="level" value="1" wire:model="level" checked>
                        1
                    </x-admin.radio-input-button>
                </li> --}}
                <li>
                    <x-admin.radio-input-button id="level_2" name="level" value="2" wire:model="level">
                        2
                    </x-admin.radio-input-button>
                </li>
                <li>
                    <x-admin.radio-input-button id="level_3" name="level" value="3" wire:model="level">
                        3
                    </x-admin.radio-input-button>
                </li>
                <li>
                    <x-admin.radio-input-button id="level_4" name="level" value="4" wire:model="level">
                        4
                    </x-admin.radio-input-button>
                </li>
            </ul>

            {{-- <ul class="flex space-x-2">
                <li><x-admin.radio-input-button id="level_1" name="level" value="1" wire:model="level" required checked /></li>
                <li><x-admin.radio-input-button id="level_2" name="level" value="2" wire:model="level" /></li>
                <li><x-admin.radio-input-button id="level_3" name="level" value="3" wire:model="level" /></li>
                <li><x-admin.radio-input-button id="level_4" name="level" value="4" wire:model="level" /></li>
            </ul> --}}
            <x-admin.input-error :messages="$errors->get('level')" class="mt-2" />
        </div>

        {{-- <div>
            <x-admin.input-label for="parent_id" :value="__('Parent')" />
            <x-admin.input-select id="parent_id" name="parent_id" title="Select Parent" class="w-full">
                @slot('options')
                    <x-admin.input-select-option value="" selected="selected"> None </x-admin.input-select-option>
                @endslot
            </x-admin.input-select>
            <x-admin.input-error :messages="$errors->get('parent_id')" class="mt-2" />
        </div> --}}

        @if ($level > 1)
            <div>
                <x-admin.input-label for="parent_id" :value="__('Parent')" />
                <x-admin.input-select id="parent_id" name="parent_id" wire:model="parentId" class="w-full" title="Select Parent">
                    @slot('options')
                        <!-- Default option -->
                        <x-admin.input-select-option value="" selected="selected"> None </x-admin.input-select-option>
                        @forelse($parentOptions as $option)
                            <x-admin.input-select-option value="{{ $option->id }}">
                                {{ $option->title }}
                            </x-admin.input-select-option>
                        @empty
                            <x-admin.input-select-option value="">
                                {{ __('No available categories') }}
                            </x-admin.input-select-option>
                        @endforelse
                    @endslot
                </x-admin.input-select>
                <x-admin.input-error :messages="$errors->get('parent_id')" class="mt-2" />
            </div>

            {{-- <div>
                <x-admin.input-label for="parent_id" :value="__('Parent *')" />
                <select id="parent_id" name="parent_id" wire:model="parentId" class="block w-full mt-1 form-select" required>
                    <option value="">Select parent</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <x-admin.input-error :messages="$errors->get('parent_id')" class="mt-2" />
            </div> --}}
            
        @endif

        <input type="hidden" name="level" value="{{ $level }}">
        <input type="hidden" name="parent_id" value="{{ $parentId }}">
    </div>
</div>
