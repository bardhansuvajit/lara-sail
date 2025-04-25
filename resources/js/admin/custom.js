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
const imagesPositionToggleButton = document.getElementById('imagesPositionToggleButton');
const imageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
const maxFileSize = '2000'; // in kb
const positionButton = document.getElementById('positionButton');
const positionTabs = document.querySelectorAll('.position-tab');

// Global
document.querySelector('form').addEventListener('submit', function () {
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerText = 'Loading...';
    }
});

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
// product category display on click
// function setCategory(id, title) {
//     if (document.querySelector('.category_id')) {
//         document.querySelector('.category_id').value = id;
//     }
//     if (document.querySelector('.category_name')) {
//         document.querySelector('.category_name').value = title;
//     }
// }
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

["selling_price", "mrp", "cost", "stock_quantity"].forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        if (id == "stock_quantity") {
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

// image upload preview
if (document.getElementById("images")) {
    document.getElementById("images").addEventListener("change", function(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = `
            <div class="border border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 p-2 rounded-lg">
                <h5 class="text-gray-700 dark:text-gray-300 font-medium mb-1 text-xs">Image Preview</h5>
                <p class="text-gray-700 dark:text-gray-400 font-medium text-[10px] border-b border-gray-300 dark:border-gray-500 mb-3 pb-2">This is only Preview. To upload these images click on <strong class="font-bold"><em>Save Data</em></strong></p>
                <div class="grid grid-cols-8 mt-4 mb-3 flex-wrap gap-4" id="imageGrid"></div>
            </div>
        `;
        const imageGrid = document.getElementById('imageGrid');

        // image text & warning
        const previewNoticeEl = document.createElement('div');
        previewNoticeEl.classList.add('col-span-8', 'flex', 'space-x-2', 'items-center', 'text-amber-500');
        previewNoticeEl.innerHTML = `
            <div class="w-3 h-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M109-120q-11 0-20-5.5T75-140q-5-9-5.5-19.5T75-180l370-640q6-10 15.5-15t19.5-5q10 0 19.5 5t15.5 15l370 640q6 10 5.5 20.5T885-140q-5 9-14 14.5t-20 5.5H109Zm69-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm0-120q17 0 28.5-11.5T520-400v-120q0-17-11.5-28.5T480-560q-17 0-28.5 11.5T440-520v120q0 17 11.5 28.5T480-360Zm0-100Z"/></svg>
            </div>
            <p class="text-[10px]">Unsupported files/ Not Image files/ File more than ${maxFileSize/1000} MB of size, will not be uploaded</p>
        `;

        const files = Array.from(input.files);
        const dataTransfer = new DataTransfer(); 

        if (files.length > 0) {
            files.forEach((file, index) => {
                const reader = new FileReader();
                const fileType = file.type;
                let fileSize = (file.size / 1024).toFixed(2);
                let fileSizeText = fileSize + " KB";
                if (fileSize > 1000) {
                    let fileSizeMB = (fileSize / 1024).toFixed(2);
                    fileSizeText = fileSizeMB + " MB";
                }

                // Parent container for each file preview
                let fileWrapper = document.createElement("div");
                fileWrapper.classList.add('flex', 'flex-col', 'items-center', 'space-y-1', 'text-center');
                fileWrapper.dataset.index = index;

                // Image or warning container
                let fileContainer = document.createElement("div");
                fileContainer.classList.add('relative', 'inline-block');

                // Close button
                let closeBtn = document.createElement("span");
                closeBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>`;
                closeBtn.classList.add('w-5', 'h-5', 'absolute', '-top-2', '-right-2', 'bg-gray-200', 'hover:bg-gray-400', 'text-gray-800', 'dark:bg-gray-800', 'dark:hover:bg-gray-600', 'dark:text-white', 'border', 'rounded-full', 'cursor-pointer');

                // Remove item on click
                closeBtn.addEventListener("click", function() {
                    fileWrapper.remove(); // Remove from preview
                    removeFile(file); // Remove from input
                });

                // File name
                let fileInfo = document.createElement("p");
                fileInfo.classList.add('text-[8px]', 'text-gray-700', 'dark:text-gray-200', 'truncate', 'w-24', 'overflow-hidden', 'break-words', 'max-h-10', 'line-clamp-2');
                fileInfo.title = file.name;
                fileInfo.textContent = `${file.name}`;

                // File size
                let fileSizeContainer = document.createElement("p");
                fileSizeContainer.classList.add('text-[10px]', 'text-gray-700', 'truncate', 'w-24', 'overflow-hidden', 'break-words', 'max-h-10', 'line-clamp-2', 'font-medium');
                if (fileSize <= 100) {
                    fileSizeContainer.classList.add('text-green-600');
                } else if (fileSize <= 1000) {
                    fileSizeContainer.classList.add('text-yellow-600');
                } else {
                    fileSizeContainer.classList.add('text-orange-600', '!font-black');
                }
                fileSizeContainer.textContent = `(${fileSizeText})`;

                if (imageTypes.includes(fileType)) {
                    // Handle image preview
                    reader.onload = function(e) {
                        let img = document.createElement("img");
                        img.src = e.target.result;
                        img.classList.add('w-24', 'h-24', 'object-scale-down', 'border', 'rounded-xs');

                        fileContainer.appendChild(img);
                        fileContainer.appendChild(closeBtn);
                        fileWrapper.appendChild(fileContainer);
                        fileWrapper.appendChild(fileInfo);
                        fileWrapper.appendChild(fileSizeContainer);
                        imageGrid.appendChild(fileWrapper);
                    };
                    reader.readAsDataURL(file);

                    // Add the file to the new FileList
                    dataTransfer.items.add(file);
                } else {
                    // Handle unsupported formats (PDF, DOC, etc.)
                    let warningIcon = document.createElement("div");
                    warningIcon.innerHTML = `
                        <div class="w-24 h-24 flex items-center justify-center bg-red-100 text-red-600 border border-red-500 rounded-xs">
                            <span class="text-2xl font-bold w-10 h-10">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-240q-17 0-28.5-11.5T800-280v-240q0-17 11.5-28.5T840-560q17 0 28.5 11.5T880-520v240q0 17-11.5 28.5T840-240Zm0 160q-17 0-28.5-11.5T800-120q0-17 11.5-28.5T840-160q17 0 28.5 11.5T880-120q0 17-11.5 28.5T840-80Zm-360 0q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q75 0 147.5 28T754-770q12 12 12 28t-12 28L548-508q-19 19-43.5 8.5T480-537v-263q-134 0-227 93t-93 227q0 134 93 227t227 93q54 0 104-18.5t92-50.5q14-11 30-8t26 17q10 14 7.5 30.5T723-163q-54 40-115.5 61.5T480-80Z"/></svg>
                            </span>
                        </div>
                    `;
                    fileContainer.appendChild(warningIcon);
                    fileContainer.appendChild(closeBtn);
                    fileWrapper.appendChild(fileContainer);
                    fileWrapper.appendChild(fileInfo);
                    fileWrapper.appendChild(fileSizeContainer);
                    imageGrid.appendChild(fileWrapper);
                }
                imageGrid.appendChild(previewNoticeEl);
            });

            // Update input files after processing all
            input.files = dataTransfer.files;
        }
    });

    function removeFile(fileToRemove) {
        const input = document.getElementById("images");
        const newDataTransfer = new DataTransfer();
        Array.from(input.files).forEach(file => {
            if (file !== fileToRemove) {
                newDataTransfer.items.add(file); // Keep only non-deleted files
            }
        });
        input.files = newDataTransfer.files; // Update input with modified FileList
    }
}

if (imagesPositionToggleButton) {
    imagesPositionToggleButton.addEventListener('click', function () {
        document.querySelectorAll('#sortable-container > div').forEach(el => {
            if (!el.classList.contains('position-toggled')) {
                el.classList.add('position-toggled');
                el.querySelector('button').classList.add('hidden');
                el.querySelector('.handle').classList.remove('hidden');
            } else {
                el.classList.remove('position-toggled');
                el.querySelector('button').classList.remove('hidden');
                el.querySelector('.handle').classList.add('hidden');
            }
        })
    });
}

if (positionButton) {
    positionButton.addEventListener('click', function () {
        if (parentCheckbox && otherCheckboxes && positionTabs) {
            if (!parentCheckbox.classList.contains('hidden')) {
                // positionButton.classList.add('border-2', 'border-gray-800', 'dark:border-white');
                positionButton.classList.add(
                    '!text-white',
                    '!bg-primary-600',
                    '!border-primary-600',
                    'hover:!bg-primary-700',
                    'dark:!bg-primary-600',
                    'dark:hover:!bg-primary-700'
                );
                positionTabs.forEach(checkbox => {
                    checkbox.classList.remove('hidden');
                });

                parentCheckbox.classList.add('hidden');
                otherCheckboxes.forEach(checkbox => {
                    checkbox.classList.add('hidden');
                });

                const sortable = document.querySelector("#sortable-container");

                new Sortable(sortable, {
                    handle: '.handle',
                    animation: 150,
                    dragClass: 'rounded-none!',
                    onEnd: function (evt) {
                        const orderedIds = Array.from(sortable.children).map(el => el.dataset.id);
                        // console.log(orderedIds);
                        // Livewire.dispatch('updateProductImageOrder', { ids: orderedIds });

                        const updateRoute = sortable.dataset.route;

                        // Send to Laravel via fetch (or axios if you're using it)
                        fetch(updateRoute, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ ids: orderedIds })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Order updated:', data);
                            showNotification('success', 'Position updated');
                        })
                        .catch(error => {
                            console.error('Error updating order:', error);
                        });
                    }
                });
            } else {
                // positionButton.classList.remove('border-2', 'border-gray-800', 'dark:border-gray-300');
                positionButton.classList.remove(
                    '!text-white',
                    '!bg-primary-600',
                    '!border-primary-600',
                    'hover:!bg-primary-700',
                    'dark:!bg-primary-600',
                    'dark:hover:!bg-primary-700'
                );
                positionTabs.forEach(checkbox => {
                    checkbox.classList.add('hidden');
                });

                parentCheckbox.classList.remove('hidden');
                otherCheckboxes.forEach(checkbox => {
                    checkbox.classList.remove('hidden');
                });
            }
        }
    });
}