@php
    if ($type == 'edit') {
        $edTechProdDetail = $data?->edTechSection;
    }

    $boardId = old('board_id') ?? ($type == 'edit' && isset($edTechProdDetail) ? $edTechProdDetail->board_id : null);
    $classId = old('class_id') ?? ($type == 'edit' && isset($edTechProdDetail) ? $edTechProdDetail->class_id : null);
    $subjectId = old('subject_id') ?? ($type == 'edit' && isset($edTechProdDetail) ? $edTechProdDetail->subject_id : null);
    $schoolId = old('school_id') ?? ($type == 'edit' && isset($edTechProdDetail) ? $edTechProdDetail->school_id : null);
    $content = old('content') ?? ($type == 'edit' && isset($edTechProdDetail) ? $edTechProdDetail->content : null);
@endphp

<div class="border-t border-gray-200 dark:border-gray-700"></div>

<h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Ed-Tech Options</h4>



<div class="flex justify-between items-start mb-2">
    <h5 class="font-semibold text-gray-700 dark:text-primary-300 block-heading">Initials</h5>
</div>

<div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">

    {{-- Board --}}
    @livewire('input-school-board-search', [
        'mode' => 'single',
        'product_id' => $boardId,
    ])

    {{-- Class --}}
    @livewire('input-school-class-search', [
        'mode' => 'single',
        'product_id' => $classId,
    ])

    {{-- Subject --}}
    @livewire('input-school-subject-search', [
        'mode' => 'single',
        'product_id' => $subjectId,
    ])

    {{-- School --}}
    @livewire('input-school-search', [
        'mode' => 'single',
        'product_id' => $schoolId,
    ])

</div>





<div class="flex justify-between items-start mb-2">
    <h5 class="font-semibold text-gray-700 dark:text-primary-300 block-heading">Material/ Content</h5>
</div>

<div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
    <div>
        <x-admin.input-label for="file" :value="__('File/s')" />
        <x-admin.file-input id="file" name="file" multiple />
        <x-admin.input-error :messages="$errors->get('file')" class="mt-2" />
    </div>
</div>

<div class="grid gap-4 mb-3 grid-cols-1">
    <div>
        <x-admin.input-label for="content" :value="__('Content')" />
        <x-admin.rich-text-editor name="content" value="{{ $content }}" />
        <x-admin.input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

    <div>
        {!! $content !!}
    </div>
</div>