<div>
    {{-- <x-admin.input-checkbox-toggle-switch checked="{{ $status == 1 }}" /> --}}

    <x-admin.input-select 
        id="status" 
        class="w-full"
        name="status" 
        wire:model="selectedStatusId"
        wire:change="updateStatus"
    >
        @slot('options')
            @foreach ($allStatus as $status)
                <x-admin.input-select-option 
                    value="{{$status->id}}" 
                    :selected="$selectedStatusId == $status->id"
                    {{-- :selected="$type->key == $item->value" --}}
                >
                    {{ $status->title }}
                </x-admin.input-select-option>
            @endforeach
        @endslot
    </x-admin.input-select>
</div>
