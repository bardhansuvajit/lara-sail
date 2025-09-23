@props(['data'])

<article class="p-3 border dark:border-slate-700 {{ FD['rounded'] }} mb-3">
    <header class="flex items-start justify-between gap-3 mb-3">
        <div>
            <div class="flex gap-2">
                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <span class="font-medium text-gray-600 dark:text-gray-300">
                        {{ substr($data->user->first_name, 0, 1) }}{{ substr($data->user->last_name, 0, 1) }}
                    </span>
                </div>

                <div>
                    <p class="{{ FD['text-1'] }}">{{ $data->user->first_name }} {{ $data->user->last_name }}</p>
                    <div class="flex items-center gap-1 mt-1">@for($i=0;$i<5;$i++) {!! $i < $data->rating ? '<svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' : '<svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' !!} @endfor</div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <p class="{{ FD['text-0'] }} text-slate-500">Verified purchase</p>
            <p class="{{ FD['text-0'] }} text-slate-500">{{ $data->created_at->diffForHumans() }}</p>
        </div>
    </header>
    <div class="mt-2">
        <p class="font-semibold {{ FD['text'] }} text-slate-800 dark:text-white">{{ $data->title }}</p>

        <p class="mt-1 {{ FD['text'] }} text-slate-500 dark:text-slate-400/80 description-wrapper">{!! nl2br($data->review) !!}</p>
    </div>
</article>