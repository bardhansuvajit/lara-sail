// ## check all checkboxes
const parentCheckbox = document.getElementById('checkbox-all');
const otherCheckboxes = document.querySelectorAll('input[type=checkbox][id^=checkbox-table-search-]');
const bulkActionDiv = document.getElementById('bulkAction');

if (parentCheckbox && otherCheckboxes) {
    parentCheckbox.onchange = function() {
        otherCheckboxes.forEach(checkbox => {
            checkbox.checked = parentCheckbox.checked
        })
        toggleBulkActionDiv()
    }

    otherCheckboxes.forEach(checkbox => {
        checkbox.onchange = toggleBulkActionDiv;
    });

    function toggleBulkActionDiv() {
        const anyChecked = Array.from(otherCheckboxes).some(checkbox => checkbox.checked);
        if (anyChecked) {
            bulkActionDiv.classList.remove('hidden');
            bulkActionDiv.classList.add('block');
        } else {
            bulkActionDiv.classList.remove('block');
            bulkActionDiv.classList.add('hidden');
        }
    }
}




/*
const parentCheckbox = document.getElementById('checkbox-all');
const otherCheckboxes = document.querySelectorAll('input[type=checkbox][id^=checkbox-table-search-]');
const bulkActionSelect = document.querySelector('select[name="bulkAction"]');

if (parentCheckbox && otherCheckboxes && bulkActionSelect) {
    parentCheckbox.onchange = function() {
        otherCheckboxes.forEach(checkbox => {
            checkbox.checked = parentCheckbox.checked
        });
        toggleBulkActionSelect();
    };

    otherCheckboxes.forEach(checkbox => {
        checkbox.onchange = toggleBulkActionSelect;
    });

    function toggleBulkActionSelect() {
        const anyChecked = Array.from(otherCheckboxes).some(checkbox => checkbox.checked);
        bulkActionSelect.disabled = !anyChecked;

        if (bulkActionSelect.disabled) {
            bulkActionSelect.classList.add('bg-gray-300', 'cursor-not-allowed');
            bulkActionSelect.classList.remove('bg-white');
        } else {
            bulkActionSelect.classList.remove('bg-gray-300', 'cursor-not-allowed');
            bulkActionSelect.classList.add('bg-white');
        }
    }
}
*/
