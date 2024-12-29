// ## check all checkboxes
/*
const parentCheckbox = document.getElementById('checkbox-all');
const otherCheckboxes = document.querySelectorAll('input[type=checkbox][id^=checkbox-table-search-]');

if (parentCheckbox && otherCheckboxes) {
    parentCheckbox.onchange = function() {
        otherCheckboxes.forEach(checkbox => {
            checkbox.checked = parentCheckbox.checked
        })
    }
}
*/

const parentCheckbox = document.getElementById('checkbox-all');
const otherCheckboxes = document.querySelectorAll('input[type=checkbox][id^=checkbox-table-search-]');
const bulkActionSelect = document.querySelector('select[name="bulkAction"]');

if (parentCheckbox && otherCheckboxes && bulkActionSelect) {
    parentCheckbox.onchange = function() {
        otherCheckboxes.forEach(checkbox => {
            checkbox.checked = parentCheckbox.checked;
        });
        toggleBulkActionSelect();
    }

    otherCheckboxes.forEach(checkbox => {
        checkbox.onchange = toggleBulkActionSelect;
    });

    function toggleBulkActionSelect() {
        const anyChecked = Array.from(otherCheckboxes).some(checkbox => checkbox.checked);
        bulkActionSelect.disabled = !anyChecked;
    }
}
