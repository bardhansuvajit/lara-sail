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
        <x-admin.input-label for="files" :value="__('File/s')" />
        <x-admin.file-input id="files" name="files[]" multiple />
        <x-admin.input-error :messages="$errors->get('files.*')" class="mt-2" />
    </div>
</div>

<!-- Show uploaded files if exist -->
@if ($type == 'edit')
    @php
        $files = $data->files;
    @endphp

    @if (count($files) > 0)
        <div class="grid grid-cols-8 mt-4 mb-3 flex-wrap gap-4">

            @foreach ($files as $singleFile)
                <div class="flex flex-col items-center space-y-1 text-center" data-index="0">
                    <div class="relative inline-block">
                        <a href="{{ Storage::url($singleFile->file_path) }}" target="_blank">
                            <div class="w-24 h-24 rounded-xs transition-transform duration-300 hover:scale-110">
                                @if ($singleFile->extension == 'pdf')
                                    <!-- PDF icon -->
                                    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56 64" enable-background="new 0 0 56 64" xml:space="preserve"><g><path fill="#8C181A" d="M5.1,0C2.3,0,0,2.3,0,5.1v53.8C0,61.7,2.3,64,5.1,64h45.8c2.8,0,5.1-2.3,5.1-5.1V20.3L37.1,0H5.1z"/><path fill="#6B0D12" d="M56,20.4v1H43.2c0,0-6.3-1.3-6.1-6.7c0,0,0.2,5.7,6,5.7H56z"/><path opacity="0.5" fill="#FFFFFF" enable-background="new    " d="M37.1,0v14.6c0,1.7,1.1,5.8,6.1,5.8H56L37.1,0z"/></g><path fill="#FFFFFF" d="M14.9,49h-3.3v4.1c0,0.4-0.3,0.7-0.8,0.7c-0.4,0-0.7-0.3-0.7-0.7V42.9c0-0.6,0.5-1.1,1.1-1.1h3.7c2.4,0,3.8,1.7,3.8,3.6C18.7,47.4,17.3,49,14.9,49z M14.8,43.1h-3.2v4.6h3.2c1.4,0,2.4-0.9,2.4-2.3C17.2,44,16.2,43.1,14.8,43.1zM25.2,53.8h-3c-0.6,0-1.1-0.5-1.1-1.1v-9.8c0-0.6,0.5-1.1,1.1-1.1h3c3.7,0,6.2,2.6,6.2,6C31.4,51.2,29,53.8,25.2,53.8z M25.2,43.1h-2.6v9.3h2.6c2.9,0,4.6-2.1,4.6-4.7C29.9,45.2,28.2,43.1,25.2,43.1z M41.5,43.1h-5.8V47h5.7c0.4,0,0.6,0.3,0.6,0.7s-0.3,0.6-0.6,0.6h-5.7v4.8c0,0.4-0.3,0.7-0.8,0.7c-0.4,0-0.7-0.3-0.7-0.7V42.9c0-0.6,0.5-1.1,1.1-1.1h6.2c0.4,0,0.6,0.3,0.6,0.7C42.2,42.8,41.9,43.1,41.5,43.1z"/></svg>
                                @else
                                    <!-- DOC icon -->
                                    <svg class="w-full h-full" viewBox="-4 0 64 64" xmlns="http://www.w3.org/2000/svg"><g fill-rule="evenodd"><path d="m5.11 0a5.07 5.07 0 0 0 -5.11 5v53.88a5.07 5.07 0 0 0 5.11 5.12h45.78a5.07 5.07 0 0 0 5.11-5.12v-38.6l-18.94-20.28z" fill="#107cad"/><path d="m56 20.35v1h-12.82s-6.31-1.26-6.13-6.71c0 0 .21 5.71 6 5.71z" fill="#084968"/><path d="m37.07 0v14.56a5.78 5.78 0 0 0 6.11 5.79h12.82z" fill="#90d0fe" opacity=".5"/></g><path d="m14.24 53.86h-3a1.08 1.08 0 0 1 -1.08-1.08v-9.85a1.08 1.08 0 0 1 1.08-1.08h3a6 6 0 1 1 0 12zm0-10.67h-2.61v9.34h2.61a4.41 4.41 0 0 0 4.61-4.66 4.38 4.38 0 0 0 -4.61-4.68zm14.42 10.89a5.86 5.86 0 0 1 -6-6.21 6 6 0 1 1 11.92 0 5.87 5.87 0 0 1 -5.92 6.21zm0-11.09c-2.7 0-4.41 2.07-4.41 4.88s1.71 4.88 4.41 4.88 4.41-2.09 4.41-4.88-1.72-4.87-4.41-4.87zm18.45.38a.75.75 0 0 1 .2.52.71.71 0 0 1 -.7.72.64.64 0 0 1 -.51-.24 4.06 4.06 0 0 0 -3-1.38 4.61 4.61 0 0 0 -4.63 4.88 4.63 4.63 0 0 0 4.63 4.88 4 4 0 0 0 3-1.37.7.7 0 0 1 .51-.24.72.72 0 0 1 .7.74.78.78 0 0 1 -.2.51 5.33 5.33 0 0 1 -4 1.69 6.22 6.22 0 0 1 0-12.43 5.26 5.26 0 0 1 4 1.72z" fill="#ffffff"/></svg>
                                @endif
                            </div>
                        </a>

                        <a
                            href="{{ route('admin.product.file.delete', $singleFile->id) }}" 
                            onclick="return confirm('Are you sure?');"
                            class="w-5 h-5 absolute -top-2 -right-2 bg-gray-200 hover:bg-gray-400 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-600 dark:text-white border rounded-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"></path></svg>
                        </a>
                    </div>
                    <p class="text-[8px] text-gray-700 dark:text-gray-200 truncate w-24 overflow-hidden break-words max-h-10 line-clamp-2" title="{{ $singleFile->file_name }}">
                        {{ $singleFile->file_name }}
                    </p>
                    <p class="text-[10px] text-gray-500 truncate w-24 overflow-hidden break-words max-h-10 line-clamp-2 font-medium">
                        ({{ formatFileSize($singleFile->file_size) }})
                    </p>
                </div>
            @endforeach

        </div>
    @endif
@endif

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