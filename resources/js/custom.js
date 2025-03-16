const parentCheckbox = document.getElementById('checkbox-all');
const otherCheckboxes = document.querySelectorAll('input[type=checkbox][id^=checkbox-table-search-]');
const bulkActionDiv = document.getElementById('bulkAction');
const systemTheme = document.getElementById('systemTheme');
const lightTheme = document.getElementById('lightTheme');
const darkTheme = document.getElementById('darkTheme');
const sellingPriceEl = document.getElementById('selling_price');
const mrpEl = document.getElementById('mrp');
const discountEl = document.getElementById('discount');
const costEl = document.getElementById('cost');
const profitEl = document.getElementById('profit');
const marginEl = document.getElementById('margin');


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
// sync Rich Text Editor data
function syncEditorContent() {
    document.getElementById('hiddenDescription').value = document.getElementById('editor').innerHTML;
}
// mask input fields, to accept 2 decimal digits
const formatPriceInput = (e) => {
    let value = e.target.value;
    // Remove non-numeric and non-decimal characters
    value = value.replace(/[^0-9.]/g, '');
    // Remove leading zeros (e.g., "0123" -> "123")
    value = value.replace(/^0+(\d)/, '$1');
    // Ensure only one decimal point
    value = value.replace(/(\..*)\./g, '$1');
    // Limit to 10 digits before the decimal
    const parts = value.split('.');
    if (parts[0].length > 10) {
        parts[0] = parts[0].slice(0, 10); // Truncate to 10 digits
    }
    // Limit to 2 digits after the decimal
    if (parts[1] && parts[1].length > 2) {
        parts[1] = parts[1].slice(0, 2); // Truncate to 2 digits
    }
    // Rejoin the parts
    value = parts.join('.');
    // Update the input value
    e.target.value = value;
};
const formatWholeNumberInput = (e) => {
    let value = e.target.value;
    // Remove non-numeric characters
    value = value.replace(/[^0-9]/g, '');
    // Remove leading zeros (e.g., "0123" -> "123")
    value = value.replace(/^0+(\d)/, '$1');
    // Limit to 10 digits
    if (value.length > 10) {
        value = value.slice(0, 10); // Truncate to 10 digits
    }
    // Update the input value
    e.target.value = value;
};

["selling_price", "mrp", "cost", "quantity"].forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        if (id == "quantity") {
            element.addEventListener("input", formatWholeNumberInput);
        } else {
            element.addEventListener("input", formatPriceInput);
        }
    }
});

// stop elements from typing
["discount", "profit", "margin"].forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        element.addEventListener("keydown", e => e.preventDefault());
        element.addEventListener("input", e => e.target.value = "");
        element.addEventListener("paste", e => e.preventDefault());
    }
});

// calculate discount
if (sellingPriceEl && mrpEl && discountEl) {
    const calculateDiscount = () => {
        const sellingPrice = parseFloat(sellingPriceEl.value);
        const mrp = parseFloat(mrpEl.value);

        if (isNaN(mrp) || isNaN(sellingPrice) || mrp <= 0) {
            discountEl.value = 0;
            discountEl.classList.remove('ring-1', 'ring-red-500', 'border-red-500');
            return;
        }

        if (sellingPrice < mrp) {
            const discount = ((mrp - sellingPrice) / mrp) * 100;
            discountEl.value = Math.round(discount);
            discountEl.classList.remove('ring-1', 'ring-red-500', 'border-red-500');
        } else {
            discountEl.value = 0;
            discountEl.classList.add('ring-1', 'ring-red-500', 'border-red-500');
        }
    };

    sellingPriceEl.addEventListener('input', calculateDiscount);
    mrpEl.addEventListener('input', calculateDiscount);
}

// calculate margin & profit
if (sellingPriceEl && costEl && profitEl && marginEl) {
    const calculateProfit = () => {
        const sellingPrice = parseFloat(sellingPriceEl.value);
        const cost = parseFloat(costEl.value);

        if (isNaN(sellingPrice) || isNaN(cost) || sellingPrice <= 0 || cost <= 0) {
            [profitEl, marginEl].forEach(el => {
                el.value = 0;
                el.classList.remove('ring-1', 'ring-red-500', 'border-red-500');
            });
            return;
        }

        if (cost < sellingPrice) {
            const profit = sellingPrice - cost;
            const roundedProfit = Math.round(profit * 100) / 100;
            const marginPercentage = (profit / sellingPrice) * 100;
            const roundedMarginPercentage = Math.round(marginPercentage * 100) / 100;

            profitEl.value = roundedProfit;
            profitEl.classList.remove('ring-1', 'ring-red-500', 'border-red-500');
            marginEl.value = roundedMarginPercentage;
            marginEl.classList.remove('ring-1', 'ring-red-500', 'border-red-500');
        } else {
            [profitEl, marginEl].forEach(el => {
                el.value = 0;
                el.classList.add('ring-1', 'ring-red-500', 'border-red-500');
            });
        }
    };

    sellingPriceEl.addEventListener('input', calculateProfit);
    costEl.addEventListener('input', calculateProfit);
}
