<div>
    <div class="grid gap-4 grid-cols-2">
        <div>
            <x-admin.input-label for="level" :value="__('Level *')" />
            <ul class="flex space-x-2">
                <li><x-admin.radio-input-button id="level_1" wire:model.live="level" value="1" name="level" /></li>
                <li><x-admin.radio-input-button id="level_2" wire:model.live="level" value="2" name="level" /></li>
                <li><x-admin.radio-input-button id="level_3" wire:model.live="level" value="3" name="level" /></li>
                <li><x-admin.radio-input-button id="level_4" wire:model.live="level" value="4" name="level" /></li>
            </ul>
            <x-admin.input-error :messages="$errors->get('level')" class="mt-2" />
        </div>

        @if ($level > 1)
            <div>
                <x-admin.input-label for="parent_id" :value="__('Parent')" />
                <x-admin.input-select id="parent_id" name="parent_id" title="Select Parent" class="w-full" wire:model="parent_id">
                    @slot('options')
                        <x-admin.input-select-option value="" selected="selected"> None </x-admin.input-select-option>
                        @foreach($parentOptions as $parent)
                            <x-admin.input-select-option value="{{ $parent['id'] }}" :selected="$parentId == $parent['id']" >
                                {{ $parent['title'] }}
                            </x-admin.input-select-option>
                        @endforeach
                    @endslot
                </x-admin.input-select>
                <x-admin.input-error :messages="$errors->get('parent_id')" class="mt-2" />
            </div>
        @endif
    </div>
</div>