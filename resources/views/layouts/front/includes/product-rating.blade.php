<fieldset class="flex items-center gap-3" aria-label="Product rating">
    <legend class="sr-only">Rating</legend>

    {{-- <input type="hidden" name="rating_value" id="rating_value" value="0" /> --}}

    <div class="flex items-center gap-2 md:gap-3">
        @for ($i = 1; $i <= 5; $i++)
            <input id="rating-{{ $i }}" name="rating" value="{{ $i }}" type="radio" class="sr-only" {{ old('rating') == $i ? 'checked' : '' }} />
            <label for="rating-{{ $i }}" data-value="{{ $i }}"
                class="rating-label cursor-pointer rounded-md text-slate-300 dark:text-slate-600 transition-colors duration-200 hover:text-amber-400 dark:hover:text-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-amber-400"
                tabindex="0" aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                    fill="currentColor" class="w-6 h-6">
                    <path
                        d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z" />
                </svg>
            </label>
        @endfor
    </div>

</fieldset>

<script>
(function () {
    const inputs = Array.from(document.querySelectorAll('input[name="rating"]'));
    const labels = Array.from(document.querySelectorAll('.rating-label'));
    // const hidden = document.getElementById('rating_value');

    function updateVisual(rating) {
        const r = Number(rating) || 0;
        labels.forEach(lbl => {
            const v = Number(lbl.dataset.value);
            if (v <= r) {
                lbl.classList.add('text-amber-400', 'scale-110');
                lbl.classList.remove('text-slate-300', 'dark:text-slate-600');
            } else {
                lbl.classList.remove('text-amber-400', 'scale-110');
                if (!lbl.classList.contains('text-slate-300')) lbl.classList.add('text-slate-300');
                if (!lbl.classList.contains('dark:text-slate-600')) lbl.classList.add('dark:text-slate-600');
            }
        });
        // if (hidden) hidden.value = String(r);
    }

    // update based on actual selection
    inputs.forEach(inp => {
        inp.addEventListener('change', () => updateVisual(inp.value));
    });

    // hover preview
    labels.forEach(lbl => {
        lbl.addEventListener('mouseenter', () => {
            const v = lbl.dataset.value;
            updateVisual(v); // temporary preview
        });
        lbl.addEventListener('mouseleave', () => {
            const checked = inputs.find(i => i.checked);
            updateVisual(checked ? checked.value : 0); // revert to selection
        });

        // keyboard accessibility
        lbl.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const v = lbl.dataset.value;
                const target = document.getElementById('rating-' + v);
                if (target) target.checked = true;
                updateVisual(v);
            }
        });
    });

    // init from any pre-checked radio
    const checked = inputs.find(i => i.checked);
    updateVisual(checked ? checked.value : 0);
})();
</script>
