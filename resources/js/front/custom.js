// Frontend Design
const FDtext0 = 'text-[10px]';
const FDtext = 'text-xs';
const FDtext1 = 'text-sm';
const FDrounded = '';
const FDBrokenImage = `<svg class="max-w-full max-h-full w-32 h-32 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M366.15-412.31h347.7L603.54-558.46l-98.16 123.08-63.53-75.39-75.7 98.46ZM324.62-280q-27.62 0-46.12-18.5Q260-317 260-344.62v-430.76q0-27.62 18.5-46.12Q297-840 324.62-840h430.76q27.62 0 46.12 18.5Q820-803 820-775.38v430.76q0 27.62-18.5 46.12Q783-280 755.38-280H324.62Zm0-40h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H324.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69Zm-120 160q-27.62 0-46.12-18.5Q140-197 140-224.61v-470.77h40v470.77q0 9.23 7.69 16.92 7.69 7.69 16.93 7.69h470.76v40H204.62ZM300-800v480-480Z"/></svg>`;

const baseUrl = window.location.origin;
const urlParams = getUrlParams();
const navbar = document.getElementById('navbar');
const darkModeToggleEl = document.getElementById('dark-mode');
const orderSummaryCont = document.getElementById('order-summary-container');
const orderSummaryBtn = document.getElementById('order-summary-toggle');
const orderSummaryEl = document.getElementById('order-summary');
// const phoneNoEl = document.getElementById('phone_no');
const numberEl = document.querySelectorAll('.digits-only');
const placeOrderForm = document.getElementById('place-order-form');

// const prePayEl = document.getElementById('online_payment');
// const codEl = document.getElementById('pay_on_delivery');
// const totalAmountShowEl = document.getElementById('total-amount-show');
// const totalAmountEl = document.getElementById('total-amount');
const paymentMethodEl = document.querySelectorAll(`[id^=paymentMethod]`);

let lastScrollPosition = 0;

// GLOBAL
function getUrlParams() {
    return new URLSearchParams(window.location.search);
}
function formatIndianMoney(amount, decimalPlaces = 2) {
    amount = parseFloat(amount).toFixed(decimalPlaces);
    let [whole, fraction] = amount.split('.');

    // Format the whole number part using Indian numbering format
    let lastThree = whole.slice(-3);
    let otherNumbers = whole.slice(0, -3);
    let formattedWhole = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",");
    if (formattedWhole) {
        formattedWhole += ',' + lastThree;
    } else {
        formattedWhole = lastThree;
    }

    // Only show decimal part if it's not zero
    if (decimalPlaces > 0 && parseInt(fraction) !== 0) {
        // Remove trailing zeros from fraction part (e.g., 50 -> 5)
        fraction = fraction.replace(/0+$/, '');
        return formattedWhole + '.' + fraction;
    }

    return formattedWhole;
}


// Notification elements
let notificationElement = null;
let notificationTimeout = null;

// Create notification HTML
function createNotification() {
    if (notificationElement) return;

    notificationElement = document.createElement('div');
    notificationElement.innerHTML = `
        <div class="fixed bottom-8 left-0 right-0 justify-center z-50 hidden" id="simple-notification">
            <div class="text-center mb-4">
                <div id="main-alert" class="p-2 bg-black items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex shadow" role="alert">
                    <span id="notification-icon" class="w-4 h-4"></span>

                    <span id="notification-badge" class="rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-1 hidden"></span>
                    <span id="notification-message" class="ms-2 text-sm font-semibold mr-2 text-left flex-auto"></span>

                    <a id="notification-redirect" href="" class="text-sm text-yellow-500 hover:text-yellow-600 font-bold me-1"></a>

                    <button id="notification-close" type="button" class="ms-auto me-1 rounded-lg focus:ring-2 focus:ring-gray-300 p-1 inline-flex items-center justify-center h-4 w-4 text-gray-100 hover:text-gray-400" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(notificationElement);
    document.getElementById('notification-close').addEventListener('click', hideNotification);
}

// Show notification
function showNotification(message, options = {}) {
    createNotification();

    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
        notificationTimeout = null;
    }

    // message
    document.getElementById('notification-message').textContent = message;

    // type
    const alertDiv = document.getElementById('main-alert');
    const iconHolder = document.getElementById('notification-icon');
    if (options.type) {
        if (options.type == "success") {
            alertDiv.classList.remove('bg-black'); alertDiv.classList.add('bg-green-700'); alertDiv.classList.remove('bg-red-800');

            iconHolder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>`;
        } else if (options.type == "error") {
            alertDiv.classList.remove('bg-black'); alertDiv.classList.remove('bg-green-700'); alertDiv.classList.add('bg-red-800');

            iconHolder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M330-120 120-330v-300l210-210h300l210 210v300L630-120H330Zm36-190 114-114 114 114 56-56-114-114 114-114-56-56-114 114-114-114-56 56 114 114-114 114 56 56Zm-2 110h232l164-164v-232L596-760H364L200-596v232l164 164Zm116-280Z"/></svg>`;
        } else {
            alertDiv.classList.add('bg-black'); alertDiv.classList.remove('bg-green-700'); alertDiv.classList.remove('bg-red-800');

            iconHolder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120q-33 0-56.5-23.5T400-200q0-33 23.5-56.5T480-280q33 0 56.5 23.5T560-200q0 33-23.5 56.5T480-120Zm-80-240v-480h160v480H400Z"/></svg>`;
        }
    }

    // badge
    const badge = document.getElementById('notification-badge');
    if (options.badgeText) {
        badge.classList.add('flex');
        badge.classList.remove('hidden');
        badge.textContent = options.badgeText;
    } else {
        badge.classList.add('hidden');
    }

    // redirect
    const redirect = document.getElementById('notification-redirect');
    if (options.redirectText && options.redirectLink) {
        redirect.innerText = options.redirectText;
        redirect.href = options.redirectLink;
    } else {
        redirect.innerText = "";
        redirect.href = "";
    }

    document.getElementById('simple-notification').classList.add('flex');
    document.getElementById('simple-notification').classList.remove('hidden');

    // autohide
    // if (options.autoHide) {
        notificationTimeout = setTimeout(() => {
        hideNotification();
        }, options.duration || 5000);
    // }
}

// Hide notification
function hideNotification() {
    const notification = document.getElementById('simple-notification');
    if (notification) {
        notification.classList.add('hidden');
    }
    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
        notificationTimeout = null;
    }
}

// Example usage:
// showNotification('Your message here', {
//   badgeText: 'Alert',
//   type: 'warning', // success/error/warning
//   autoHide: true,
//   duration: 3000
// });

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', createNotification);
// Livewire listeners
document.addEventListener('livewire:init', () => {
    Livewire.on('show-notification', (data) => {
        // console.log(data);
        showNotification(data[0], data[1]);
    });
    Livewire.on('showFullPageLoader', () => {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'full-page-loader' }));
    });
    Livewire.on('hideFullPageLoader', () => {
        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'full-page-loader' }));
        }, 200);
    });
});

window.addEventListener('show-notification', (event) => {
    showNotification(event.detail.message, event.detail.options);
});

// IP information
async function checkIpInfo() {
    try {
        const storedData = localStorage.getItem('applicationSettings');
        if (!storedData) return true; // Changed to true to skip IP fetch

        const appData = JSON.parse(storedData);
        const ipv4 = appData.ipv4;
        if (!ipv4) return true; // Skip if no IP exists

        const response = await fetch(`/api/ip/check/${ipv4}`);
        if (!response.ok) return true; // Skip if API fails

        const data = await response.json();
        return data.code !== 200; // Return true if IP is invalid (needs refresh)
    } catch (error) {
        console.error('Error checking IP:', error);
        return true; // Skip on error
    }
}

async function getIpInfo() {
    try {
        const response = await fetch('http://ip-api.com/json?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query');

        if (!response.ok) {
            console.error('IP API response not OK:', response.status);
            return null;
        }

        const data = await response.json();

        if (!data.query) {
            throw new Error('Invalid IP data received');
        }

        const ipInfo = {
            data: data.data,
            ip: data.query,
            country: data.country,
            countryCode: data.countryCode,
            state: data.regionName,
            stateCode: data.region,
            city: data.city,
            zip: data.zip,
            currency: data.currency,
            lat: data.lat,
            lon: data.lon,
        };
        return ipInfo;
        // console.log(ipInfo);
    } catch (error) {
        console.error('Error fetching IP info:', error);
        return null;
    }
}

async function storeIpInfo(ipInfo) {
    if (!ipInfo) return false;

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!csrfToken) {
            console.error('CSRF token not found');
            return false;
        }

        const response = await fetch('/api/ip/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                data: ipInfo.data,
                ip: ipInfo.ip,
                country: ipInfo.country,
                countryCode: ipInfo.countryCode,
                state: ipInfo.state,
                stateCode: ipInfo.stateCode,
                city: ipInfo.city,
                zip: ipInfo.zip,
                currency: ipInfo.currency,
                lat: ipInfo.lat,
                lon: ipInfo.lon
            })
        });

        if (!response.ok) {
            console.error('Failed to store IP info:', response.status);
            return false;
        }

        return true;
    } catch (error) {
        console.error('Error storing IP info:', error);
        return false;
    }
}

(async () => {
    const shouldFetchNewIp = await checkIpInfo(); // true = fetch new IP
    if (shouldFetchNewIp) {
        const ipInfo = await getIpInfo();
        if (ipInfo) {
            await storeIpInfo(ipInfo);
            applicationSettingsBrowserStore('ipv4', ipInfo.ip);
            applicationSettingsBrowserStore('country', ipInfo.countryCode);
            applicationSettingsBrowserStore('currency', ipInfo.currency);
        }
    }
    // const checkIpExist = await checkIpInfo();

    // if (!checkIpExist) {
    //     const ipInfo = await getIpInfo();
    //     if (ipInfo) {
    //         const stored = await storeIpInfo(ipInfo);
    //         applicationSettingsBrowserStore('ipv4', ipInfo.ip);
    //     } else {
    //         console.log('Location services unavailable');
    //     }
    // }
})();


// check if device is mobile
function isMobileDevice() {
    return window.innerWidth <= 768; // Common breakpoint for mobile devices
}

// Navbar scroll handler
function handleNavbarScroll() {
    const currentScrollPosition = window.scrollY;
    const scrollThreshold = 50; // Minimum scroll amount before hiding
    const navbarHeight = isMobileDevice() ? 43 : 66; // Different heights for mobile/desktop

    // Scrolling down
    if (currentScrollPosition > lastScrollPosition && currentScrollPosition > scrollThreshold) {
        navbar.style.top = `-${navbarHeight}px`;

        // cart page order summary container
        if (orderSummaryCont) {
            orderSummaryCont.style.top = '9rem';
        }
    } 
    // Scrolling up or at top of page
    else {
        navbar.style.top = '0px';

        // cart page order summary container
        if (orderSummaryCont) {
            orderSummaryCont.style.top = '13rem';
        }
    }

    lastScrollPosition = currentScrollPosition;
}

// Throttle the scroll event for better performance
function throttle(func, limit) {
    let lastFunc;
    let lastRan;
    return function() {
        const context = this;
        const args = arguments;
        if (!lastRan) {
            func.apply(context, args);
            lastRan = Date.now();
        } else {
            clearTimeout(lastFunc);
            lastFunc = setTimeout(function() {
                if ((Date.now() - lastRan) >= limit) {
                    func.apply(context, args);
                    lastRan = Date.now();
                }
            }, limit - (Date.now() - lastRan));
        }
    }
}

// Add event listeners
window.addEventListener('scroll', throttle(handleNavbarScroll, 100));

// Handle resize events (in case of device rotation or window resize)
window.addEventListener('resize', function() {
    // Reset navbar position when resizing
    if (window.scrollY <= 50) {
        navbar.style.top = '0px';
    }
});

// dark mode toggle
function applicationSettingsBrowserStore(objKey, objValue) {
    try {
        const storedData = localStorage.getItem('applicationSettings');
        let appData = storedData ? JSON.parse(storedData) : {};
        appData[objKey] = objValue;
        localStorage.setItem('applicationSettings', JSON.stringify(appData));

        return true;
    } catch (error) {
        console.error("Error saving to localStorage:", error);
        return false;
    }
}

function applySavedTheme() {
    let appData = localStorage.getItem('applicationSettings');
    appData = appData ? JSON.parse(appData) : {};

    let savedTheme = appData.theme || "system";
    document.querySelector('html').classList.remove('light', 'dark');

    if (savedTheme === "dark") {
        document.querySelector('html').classList.add('dark');
        if (darkModeToggleEl) {
            darkModeToggleEl.checked = true;
        }
    } else if (savedTheme === "light") {
        document.querySelector('html').classList.add('light');
        if (darkModeToggleEl) {
            darkModeToggleEl.checked = false;
        }
    } else {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.querySelector('html').classList.add('dark');
            if (darkModeToggleEl) {
                darkModeToggleEl.checked = true;
            }
        } else {
            document.querySelector('html').classList.add('light');
            if (darkModeToggleEl) {
                darkModeToggleEl.checked = false;
            }
        }
    }
}

applySavedTheme();

if (darkModeToggleEl) {
    darkModeToggleEl.addEventListener('click', function() {
        if (darkModeToggleEl.checked) {
            if (!document.querySelector('html').classList.contains('dark')) {
                document.querySelector('html').classList.remove('light');
                document.querySelector('html').classList.add('dark');
                applicationSettingsBrowserStore('theme', 'dark');
            }
        } else {
            if (!document.querySelector('html').classList.contains('light')) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').classList.add('light');
                applicationSettingsBrowserStore('theme', 'light');
            }
        }
    });
}

// HOME
if (document.querySelector('.mySwiper')) {
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}

// CART
if (orderSummaryBtn && orderSummaryEl) {
    orderSummaryBtn.addEventListener('click', function () {
        if (orderSummaryEl.classList.contains('hidden')) {
            orderSummaryEl.classList.remove('hidden');
        } else {
            orderSummaryEl.classList.add('hidden');
        }
    });
}

// PRODUCT DETAIL - variation from url
urlParams.forEach((value, paramName) => {
    // Check if parameter starts with 'variation-'
    if (paramName.startsWith('variation-')) {
        // Extract the attribute name (what comes after 'variation-')
        const attributeName = paramName.replace('variation-', '');

        // Find all radio inputs with name="variation[attributeName]" or similar pattern
        // This depends on how your form is structured - adjust selector as needed
        const selector = `input[name="variation${attributeName}"], 
                        input[name="variation[${attributeName}]"], 
                        input[name="variation-${attributeName}"], 
                        input[name="${attributeName}"]`;

        document.querySelectorAll(selector).forEach(input => {
            if (input.value.toLowerCase() === value.toLowerCase()) {
                input.checked = true;
                
                // Trigger change event in case any listeners depend on it
                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    }
});

if (document.querySelector('.main-swiper')) {
    var swiper = new Swiper(".main-swiper", {
        spaceBetween: 30,
        centeredSlides: true,
        // autoplay: {
        //     delay: 5000,
        //     disableOnInteraction: false,
        // },
        // pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        // },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'w-3 h-3 rounded-full bg-gray-500 border-2 border-gray-200 transition-all',
            bulletActiveClass: 'w-6 bg-black',
            renderBullet: function (index, className) {
              return `<span class="${className}"></span>`;
            },
          },
        // navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        // },
    });
}

// LOGIN
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

// if (phoneNoEl) {
//     phoneNoEl.addEventListener("input", formatWholeNumberInput);
// }

if (numberEl) {
    numberEl.forEach(el => {
        el.addEventListener("input", formatWholeNumberInput);
    });
}

// product detail
/*
// Tab Switching
document.querySelectorAll('[data-tab]').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('[data-tab]').forEach(b => b.classList.remove('border-black'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        btn.classList.add('border-black');
        document.getElementById(btn.dataset.tab).classList.remove('hidden');
    });
});
*/

document.querySelectorAll('.attr-val-generate').forEach(btn => {
    btn.addEventListener('click', async (e) => {
        const btn = e.currentTarget;

        const productId = btn.dataset.prodId;
        const attrId = btn.dataset.attrId;
        const valueId = btn.dataset.valueId;
        // const valueSlug = btn.value;
        // const attrSlug = btn.name;

        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        try {
            const response = await fetch('/api/variation/check', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    productId: productId,
                    attrId: attrId,
                    valueId: valueId
                })
            });

            const data = await response.json();

            if (response.ok) {
                // Inside the response.ok check

                const validValueIds = data.data.map(id => id.toString());

                document.querySelectorAll('.attr-val-generate').forEach(input => {
                    const inputValueId = input.dataset.valueId;
                    const label = input.nextElementSibling;
                    const inputAttrSlug = input.name;
                    const inputValueSlug = input.value.toLowerCase();

                    if (label && label.tagName === 'LABEL') {
                        if (!validValueIds.includes(inputValueId)) {
                            // Disable input and style label for unavailable options
                            label.classList.add('opacity-50');

                            if (input.checked) {
                                input.checked = false;
                                // Remove the parameter from the URL
                                params.delete(inputAttrSlug);
                            }
                        } else {
                            // Enable input and reset label styling for available options
                            label.classList.remove('opacity-50');
                        }
                    }

                    // If the input is checked and is a valid value, set/update the parameter
                    if (input.checked && validValueIds.includes(inputValueId)) {
                        params.set(inputAttrSlug, inputValueSlug);
                    }
                });

                // Update the URL without reloading the page
                window.history.replaceState({}, '', `${url.pathname}?${params}`);

            }
        } catch (error) {
            // console.error('Error fetching variation details: ', error);
            showNotification('Error fetching variation details. Please try again.', { type: 'error' });
        }
    });
});

function scrollToVariationTab() {
    const variationTab = document.querySelector('#variationTab');
    if (variationTab) {
        variationTab.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center'
        });
    }
}

function checkAllVariationsSelected(requiredVariations, selectedVariations) {
    // Convert variation names to URL parameter format with null checks
    const requiredParams = requiredVariations.map(v => {
        const attrName = v.slug;
        return `variation-${attrName.toLowerCase().replace(/ /g, '-')}`;
    });

    // Check if all required parameters exist in selected variations
    return requiredParams.every(param => {
        return Object.prototype.hasOwnProperty.call(selectedVariations, param);

    });
}

async function cartDataFetch() {
    try {
        const response = await fetch('/cart/fetch');
        const data = await response.json();

        if (data.code == 200) {
            updateCartCount(data.cart_count);
            updateCartData(data.cart_info, data.cart_items);
        } else {
            updateCartData('', []);
        }
    } catch (error) {
        console.error('Cart action error:', error);
    }
}

cartDataFetch();

// add to cart
document.querySelectorAll('.add-to-cart').forEach(cartBtn => {
    cartBtn.addEventListener('click', async (e) => {

        const button = e.currentTarget;
        const originalHtml = button.innerHTML;

        try {
            // Set loading state
            button.innerText = 'Loading...';
            button.disabled = true;

            const productId = button.dataset.prodId;
            const quantity = parseInt(button.dataset.quantity || 1);
            const variationData = JSON.parse(button.dataset.variationData || '[]');
            const selectedVariations = {};

            // Handle variations
            if (variationData.length > 0) {
                const urlParams = getUrlParams();
                let hasSelectedVariations = false;

                urlParams.forEach((value, paramName) => {
                    if (paramName.startsWith('variation-')) {
                        selectedVariations[paramName] = value;
                        hasSelectedVariations = true;
                    }
                });

                if (!hasSelectedVariations) {
                    showNotification('Select variants first', { type: 'warning' });
                    scrollToVariationTab();
                    return;
                }

                if (!checkAllVariationsSelected(variationData, selectedVariations)) {
                    const missing = variationData
                        .filter(v => !selectedVariations[`variation-${v.slug.toLowerCase().replace(/ /g, '-')}`])
                        .map(v => v.title);
                    
                    showNotification(`Missing selections: ${missing.join(', ')}`, { type: 'warning' });
                    scrollToVariationTab();
                    return;
                }
            }

            // Proceed with add to cart
            await handleCartAction(productId, quantity, selectedVariations);
        } catch (error) {
            console.error('Add to cart error:', error);
            showNotification('Failed to add to cart. Please try again.', { type: 'error' });
        } finally {
            // Reset button state
            button.innerHTML = originalHtml;
            button.disabled = false;
        }
    });
});

async function handleCartAction(productId, quantity, selectedVariations) {
    const urlParameter = getUrlParams();
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    formData.append('url_param', urlParameter);

    // Add variations to form data
    if (Object.keys(selectedVariations).length) {
        formData.append('variation', JSON.stringify(selectedVariations));
    }

    try {
        const response = await fetch('/cart/store', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Failed to add to cart');
        }

        showNotification(data.message, { type: data.status });

        updateCartCount(data.cart_count);
        updateCartData(data.cart_info, data.cart_items);

        setTimeout(() => {
            document.querySelector('#cart-btn').click()
        }, 100);

    } catch (error) {
        showNotification('Cart action error', { type: 'error' });
        console.error('Cart action error:', error);
        throw error; // Re-throw for outer catch
    }
}

function updateCartCount(count) {
    const counters = document.querySelectorAll('.cart-count');
    
    if (count > 0) {
        // counters.forEach(el => el.textContent = count + (count == 1 ? ' item' : ' items'));
        counters.forEach(el => el.innerHTML = count + ` <span class='hidden md:inline-block'>${count == 1 ? 'item' : 'items'}</span>`);
    } else {
        counters.forEach(el => el.textContent = '');
    }
}

function updateCartData(cartInfo, cartItems) {
    // console.log('cartInfo>>', cartInfo);
    // console.log('cartItems>>', cartItems);

    const cartProductsElements = document.querySelectorAll('.cart-products');
    const cartRedirectElement = document.querySelector('.cart-redirect');

    if (cartItems.length > 0) {
        const singleCartItem = cartItems.map(item => `
            <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="col-span-2">
                    <div class="flex items-center gap-3">
                        <a href="${item.product_url_with_variation ? item.product_url_with_variation : item.product_url}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                            ${item.image_s ? 
                                `<img class="h-auto max-h-full w-full" src="${baseUrl}/storage/${item.image_s}" alt="${item.product_title}">` :
                                `${FDBrokenImage}`
                            }
                        </a>
                        <div class="w-full">
                            <a href="${item.product_url_with_variation ? item.product_url_with_variation : item.product_url}" class="inline-block text-xs ${FDtext0} text-gray-900 hover:underline dark:text-white">${item.product_title}</a>
                            ${item.variation_attributes ? `<p class="${FDtext0} text-gray-400">${item.variation_attributes}</p>` : ''}
                            <p class="mt-0.5 truncate ${FDtext} font-normal text-gray-500 dark:text-gray-300">
                                <span class="currency-symbol">₹</span> ${formatIndianMoney(item.selling_price)}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="flex items-center justify-end gap-3">
                        <div class="relative flex items-center">
                            <button 
                                type="button" 
                                class="cart-qty-update inline-flex h-5 w-5 flex-shrink-0 items-center justify-center ${FDrounded} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                data-id="${item.id}" 
                                data-type="desc" 
                                ${item.quantity == 1 ? 'disabled' : ''}
                            >
                                <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                            </button>

                            <input type="text" class="w-8 p-0 flex-shrink-0 border-0 bg-transparent text-center ${FDtext} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="${item.quantity}" required="">

                            <button 
                                type="button" 
                                class="cart-qty-update inline-flex h-5 w-5 flex-shrink-0 items-center justify-center ${FDrounded} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                data-id="${item.id}" 
                                data-type="asc" 
                            >
                                <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                            </button>
                        </div>

                        <button 
                            type="button" 
                            class="remove-from-cart text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700" 
                            data-id="${item.id}"
                            data-title="${item.product_title}"
                            data-attributes="${item.variation_attributes || ''}"
                            data-price="${item.selling_price}"
                            data-link="${item.product_url_with_variation ? item.product_url_with_variation : item.product_url}"
                            data-image="${item.image_m ? item.image_m : 'not found'}"
                            data-quantity="${item.quantity}"
                            title="Remove from Cart"
                        >
                            <div class="h-4 w-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');

        // Update cart products
        cartProductsElements.forEach(el => {
            el.innerHTML = singleCartItem;
        });

        if (cartRedirectElement) {
            cartRedirectElement.innerHTML = `
            <div class="space-y-4 px-3 py-2 dark:border-gray-600">
                <dl class="flex items-center justify-between">
                    <dt class="font-medium ${FDtext1} leading-tight dark:text-white">Total</dt>
                    <dd class="font-semibold ${FDtext1} leading-tight dark:text-white"><span class="currency-symbol">₹</span> ${formatIndianMoney(cartInfo.total)}</dd>
                </dl>

                <div class="flex space-x-2">
                    <a href="/cart" title="" class="inline-flex w-full items-center justify-center ${FDrounded} bg-primary-600 px-5 py-2.5 ${FDtext} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"> See your cart </a>

                    <a href="/checkout" title="" class="inline-flex w-full items-center justify-center ${FDrounded} bg-primary-600 px-5 py-2.5 ${FDtext} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"> Checkout </a>
                </div>
            </div>
            `;
        }

        bindCartQtyEvents();
        bindRemoveFromCartEvents();
    } else {
        cartProductsElements.forEach(el => {
            el.innerHTML = `
            <div class="p-4">
                <img src="${baseUrl}/storage/default/cart/undraw_successful-purchase_p2fz.svg" alt="empty-cart" class="w-full h-24">
                <P class="text-xs mt-4 text-center">Your cart is empty!</P>
            </div>
            `;
        });

        if (cartRedirectElement) {
            cartRedirectElement.textContent = '';
        }
    }
}

// Cart Quantity Update
function bindCartQtyEvents() {
    document.querySelectorAll('.cart-qty-update').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = btn.dataset.id;
            const type = btn.dataset.type;
            updateCartQty(id, type);
        });
    });
}

// Remove from Cart
function bindRemoveFromCartEvents() {
    document.querySelectorAll('.remove-from-cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = btn.dataset.id;
            const title = btn.dataset.title;
            const attributes = btn.dataset.attributes;
            const price = btn.dataset.price;
            const link = btn.dataset.link;
            const image = btn.dataset.image;

            let imagePath = `<img class="h-auto max-h-full w-full" src="${baseUrl}/storage/${image}" alt="${title}">`;

            if (image == "not found") {
                imagePath = FDBrokenImage;
            }

            const productData = `
            <div class="items-center dark:border-gray-600">
                <div class="flex items-center gap-4">
                    <a href="${link}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                        ${imagePath}
                    </a>
                    <div class="w-full">
                        <a href="${link}" class="inline-block text-xs ${FDtext0} text-gray-900 hover:underline dark:text-white">${title}</a>
                        ${attributes ? `<p class="${FDtext0} text-gray-400">${attributes}</p>` : ''}
                        <p class="mt-0.5 truncate ${FDtext} font-normal text-gray-500 dark:text-gray-300">
                            <span class="currency-symbol">₹</span> ${formatIndianMoney(price)}
                        </p>
                    </div>
                </div>
            </div>
            `;

            document.querySelector('.delete-product-data').innerHTML = productData;

            const deleteForm = document.querySelector('#delete-cart-item-form');
            deleteForm.action = `/cart/delete/${id}`;

            // Dispatch the open-modal event with the modal name as detail
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-cart-item-deletion' }));
        });
    });
}

async function updateCartQty(id, type) {
    try {
        const response = await fetch('/cart/qty/update', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                type: type
            })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Failed to add to cart');
        }

        showNotification(data.message, { type: data.status });

        updateCartCount(data.cart_count);
        updateCartData(data.cart_info, data.cart_items);

        if (window.Livewire) {
            window.dispatchEvent(new CustomEvent('cart-updated'));
            // setTimeout(() => Livewire.dispatch('getCartData'), 100);
            // Livewire.dispatch('getCartData');
            
            // OR if you need to target a specific component
            // Livewire.dispatchTo('cart-component-name', 'getCartData');
        }

        // setTimeout(() => {
        //     document.querySelector('#cart-btn').click()
        // }, 100);
    } catch (error) {
        showNotification('Cart action error', { type: 'error' });
        console.error('Cart action error:', error);
        throw error; // Re-throw for outer catch
    }
}

if (document.querySelector('#delete-cart-item-form')) {
    document.querySelector('#delete-cart-item-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const url = form.action;
        const action = document.getElementById('cart-item-type').value;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: action,
                    _method: 'DELETE'
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to add to cart');
            }

            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'confirm-cart-item-deletion' }));

            showNotification(data.message, { type: data.status });

            updateCartCount(data.cart_count);
            updateCartData(data.cart_info, data.cart_items);

            setTimeout(() => {
                document.querySelector('#cart-btn').click()
            }, 100);
        } catch (error) {
            showNotification('Cart action error', { type: 'error' });
            console.error('Cart action error:', error);
            throw error; // Re-throw for outer catch
        }
    });
}

// CHECKOUT PAGE
const selectedShipAddrEl = document.querySelector('input[name=shipping_address_id]');
const selectedBillAddrEl = document.querySelector('input[name=billing_address_id]');
const shippingAddresses = document.querySelectorAll('.shipping-address');
const billingAddresses = document.querySelectorAll('.billing-address');

// Shipping Address
if (selectedShipAddrEl && shippingAddresses.length > 0) {
    shippingAddresses.forEach(el => {
        if (el.checked) {
            selectedShipAddrEl.value = el.value;
        }

        el.addEventListener('change', () => {
            if (el.checked) {
                selectedShipAddrEl.value = el.value;
            }
        });
    })
}
// Billing Address
if (selectedBillAddrEl && billingAddresses.length > 0) {
    billingAddresses.forEach(el => {
        if (el.checked) {
            selectedBillAddrEl.value = el.value;
        }

        el.addEventListener('change', () => {
            if (el.checked) {
                selectedBillAddrEl.value = el.value;
            }
        });
    })
}

// Payment Mode selection
/*
function updatePaymentMode(mode, charge, discount) {
    console.log('mode>>', mode);
    console.log('charge>>', charge);
    console.log('discount>>', discount);
    
    charge = parseFloat(charge);
    discount = parseFloat(discount);

    if (charge > 0) {
        // Heading
        if (document.getElementById('payment-method-summary-text'))
            document.getElementById('payment-method-summary-text').innerText = 'Payment method Charge';
        // Amount
        if (document.getElementById('payment-method-summary-amount'))
            document.getElementById('payment-method-summary-amount').innerText = charge;
        // Icon
        if (document.getElementById('payment-method-summary-icon'))
            document.getElementById('payment-method-summary-icon').innerText = '';
        // Color
        if (document.getElementById('payment-method-summary-highlight'))
            document.getElementById('payment-method-summary-highlight').classList.remove('text-green-600');

        // Total Amount
        if (totalAmountShowEl && totalAmountEl) {
            let totalAmount = totalAmountEl.innerText;
            const newAmount = parseFloat(totalAmount) + charge;
            totalAmountShowEl.innerText = formatIndianMoney(newAmount);
        }
    } else if (discount > 0) {
        // Heading
        if (document.getElementById('payment-method-summary-text'))
            document.getElementById('payment-method-summary-text').innerText = 'Payment method Discount';
        // Amount
        if (document.getElementById('payment-method-summary-amount'))
            document.getElementById('payment-method-summary-amount').innerText = discount;
        // Icon
        if (document.getElementById('payment-method-summary-icon'))
            document.getElementById('payment-method-summary-icon').innerText = '-';
        // Color
        if (document.getElementById('payment-method-summary-highlight'))
            document.getElementById('payment-method-summary-highlight').classList.add('text-green-600');

        // Total Amount
        if (totalAmountShowEl && totalAmountEl) {
            let totalAmount = totalAmountEl.innerText;
            const newAmount = parseFloat(totalAmount) - discount;
            totalAmountShowEl.innerText = formatIndianMoney(newAmount);
        }
    }
}

if (paymentMethodEl) {
    paymentMethodEl.forEach(el => {
        el.addEventListener('change', () => {
            updatePaymentMode('cod', el.dataset.charge, el.dataset.discount);
        });
    })
}

// if (prePayEl.checked) {
//     updatePaymentMode('prePaid', prePayEl.dataset.charge, prePayEl.dataset.discount);
// } else if (codEl.checked) {
//     updatePaymentMode('cod', codEl.dataset.charge, codEl.dataset.discount);
// }

// prePayEl.addEventListener('change', () => {
//     updatePaymentMode('prePaid', prePayEl.dataset.charge, prePayEl.dataset.discount);
// });
// codEl.addEventListener('change', () => {
//     updatePaymentMode('cod', codEl.dataset.charge, codEl.dataset.discount);
// });
*/

// Payment method
if (placeOrderForm) {
    placeOrderForm.addEventListener('submit', function () {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'full-page-loader' }));
    });
}