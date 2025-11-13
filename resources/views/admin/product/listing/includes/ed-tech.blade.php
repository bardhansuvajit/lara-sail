<div class="border-t border-gray-200 dark:border-gray-700"></div>

<h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Ed-Tech Options</h4>

<div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">

    {{-- Board --}}
    @livewire('input-school-board-search', [
        'mode' => 'single',
        'selected_ids' => old('board_id'),
    ])

    {{-- Class --}}
    @livewire('input-school-class-search', [
        'mode' => 'single',
        'selected_ids' => old('class_id'),
    ])

    {{-- Subject --}}
    @livewire('input-school-subject-search', [
        'mode' => 'single',
        'selected_ids' => old('subject_id'),
    ])

    {{-- School --}}
    @livewire('input-school-search', [
        'mode' => 'single',
        'selected_ids' => old('school_id'),
    ])

</div>