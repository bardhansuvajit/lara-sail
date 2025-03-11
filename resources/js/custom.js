const parentCheckbox = document.getElementById('checkbox-all');
const otherCheckboxes = document.querySelectorAll('input[type=checkbox][id^=checkbox-table-search-]');
const bulkActionDiv = document.getElementById('bulkAction');
const systemTheme = document.getElementById('systemTheme');
const lightTheme = document.getElementById('lightTheme');
const darkTheme = document.getElementById('darkTheme');


// ## listing pages, check all checkboxes
if (parentCheckbox && otherCheckboxes && bulkActionDiv) {
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

// ## global, toggle light/ dark/ system theme
function applicationSettingsBrowserStore(objKey, objValue) {
    let appData = localStorage.getItem('applicationSettings');
    appData = appData ? JSON.parse(appData) : {};

    appData[objKey] = objValue;
    localStorage.setItem('applicationSettings', JSON.stringify(appData));
}

function applySavedTheme() {
    let appData = localStorage.getItem('applicationSettings');
    appData = appData ? JSON.parse(appData) : {};

    let savedTheme = appData.theme || "system";
    document.querySelector('html').classList.remove('light', 'dark');

    if (savedTheme === "dark") {
        document.querySelector('html').classList.add('dark');
    } else if (savedTheme === "light") {
        document.querySelector('html').classList.add('light');
    } else {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.querySelector('html').classList.add('dark');
        } else {
            document.querySelector('html').classList.add('light');
        }
    }
}

applySavedTheme();

if (systemTheme && lightTheme && darkTheme) {
    lightTheme.addEventListener('click', function () {
        if (!document.querySelector('html').classList.contains('light')) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').classList.add('light');
            applicationSettingsBrowserStore('theme', 'light');
        }
    });
    darkTheme.addEventListener('click', function () {
        if (!document.querySelector('html').classList.contains('dark')) {
            document.querySelector('html').classList.remove('light');
            document.querySelector('html').classList.add('dark');
            applicationSettingsBrowserStore('theme', 'dark');
        }
    });
    systemTheme.addEventListener('click', function () {
        document.querySelector('html').classList.remove('light', 'dark');
        applicationSettingsBrowserStore('theme', 'system');
        applySavedTheme();
    });
}

// ## product create/ edit page
// mask input fields, to accept 2 decimal digits
const formatPriceInput = e => e.target.value = e.target.value
    .replace(/[^0-9.]/g, '')
    .replace(/^0+(\d)/, '$1')
    .replace(/(\..*)\./g, '$1')
    .replace(/^(\d*\.\d{2}).*/, '$1');

["selling_price", "mrp", "cost"].forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        element.addEventListener("input", formatPriceInput);

        // calculate discount, profit & margin
        if (id == "mrp") {
            element.addEventListener("input", function() {
                const mrp = parseFloat(element.value) || 0;
                const selling_price = parseFloat(document.getElementById('selling_price').value) || 0;
                const discountEl = document.getElementById('discount');

                if (selling_price < mrp) {
                    const discount = ((mrp - selling_price) / mrp) * 100;
                    discountEl.value = discount.toFixed(2);
                    discountEl.classList.remove('ring-1', 'ring-red-500', 'border-red-500');
                } else {
                    discountEl.classList.add('ring-1', 'ring-red-500', 'border-red-500');
                }
            });
        }
    }
});

// stop these from typing
["discount", "profit", "margin"].forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        element.addEventListener("keydown", e => e.preventDefault());
        element.addEventListener("input", e => e.target.value = "");
        element.addEventListener("paste", e => e.preventDefault());
    }
});

