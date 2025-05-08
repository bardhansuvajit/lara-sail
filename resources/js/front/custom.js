const urlParams = getUrlParams();
const navbar = document.getElementById('navbar');
const darkModeToggleEl = document.getElementById('dark-mode');
const orderSummaryCont = document.getElementById('order-summary-container');
const orderSummaryBtn = document.getElementById('order-summary-toggle');
const orderSummaryEl = document.getElementById('order-summary');
const phoneNoEl = document.getElementById('phone_no');
let lastScrollPosition = 0;

// GLOBAL
function getUrlParams() {
    return new URLSearchParams(window.location.search);
}

// Notification elements
let notificationElement = null;
let notificationTimeout = null;

// Create notification HTML
function createNotification() {
    if (notificationElement) return;

    notificationElement = document.createElement('div');
    notificationElement.innerHTML = `
        <div class="fixed bottom-8 left-0 right-0 flex justify-center z-50 hidden" id="simple-notification">
            <div class="text-center py-4 lg:px-4 w-full max-w-screen-md mx-4 mb-4 rounded-t-lg">
                <div id="main-alert" class="p-2 bg-black items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex shadow" role="alert">
                    <span id="notification-icon" class="w-4 h-4"></span>

                    <span id="notification-badge" class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-1 hidden"></span>
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

    document.getElementById('simple-notification').classList.remove('hidden');

    // autohide
    // if (options.autoHide) {
        notificationTimeout = setTimeout(() => {
        hideNotification();
        }, options.duration || 5000000);
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

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', createNotification);

// Example usage:
// showNotification('Your message here', {
//   badgeText: 'Alert',
//   type: 'warning', // success/error/warning
//   autoHide: true,
//   duration: 3000
// });

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

if (phoneNoEl) {
    phoneNoEl.addEventListener("input", formatWholeNumberInput);
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
                console.log(data);
                const newData = data.combination.values;
                console.log('newData>>', newData);

                const validValueIds = newData.map(item => item.attribute_value_id.toString());

                document.querySelectorAll('.attr-val-generate').forEach(button => {
                    const buttonValueId = button.dataset.valueId;
                    
                    // Disable if the button's value ID is not in the validValueIds array
                    // button.disabled = !validValueIds.includes(buttonValueId);
                    
                    // Optional: Add/remove a class for styling
                    const label = button.closest('label');
                    if (label) {
                        if (!validValueIds.includes(buttonValueId)) {
                            label.classList.add('!opacity-50', '!cursor-not-allowed');
                        } else {
                            label.classList.remove('!opacity-50', '!cursor-not-allowed');
                        }
                    }
                });

                // Keep the current button enabled
                // btn.disabled = false;
                btn.classList.remove('!opacity-50', '!cursor-not-allowed');

            }
        } catch (error) {
            console.error('Error fetching variation details: ', error);
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
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);

    // Add variations to form data
    if (Object.keys(selectedVariations).length) {
        formData.append('variation', JSON.stringify(selectedVariations));
    }
    // Object.entries(selectedVariations).forEach(([key, value]) => {
    //     formData.append(key, value);
    // });

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

        showNotification('Item added to cart!', { type: 'success' });
        updateCartCount(data.cart_count);

    } catch (error) {
        console.error('Cart action error:', error);
        throw error; // Re-throw for outer catch
    }
}

function updateCartCount(count) {
    const counters = document.querySelectorAll('.cart-count');
    counters.forEach(el => el.textContent = count);
}
