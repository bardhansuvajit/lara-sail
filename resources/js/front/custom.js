// Frontend Design
const FDtext0 = 'text-[10px]';
const FDtext = 'text-xs';
const FDtext1 = 'text-sm';
const FDrounded = '';
const FDBrokenImage = `<svg class="max-w-full max-h-full w-32 h-32 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M366.15-412.31h347.7L603.54-558.46l-98.16 123.08-63.53-75.39-75.7 98.46ZM324.62-280q-27.62 0-46.12-18.5Q260-317 260-344.62v-430.76q0-27.62 18.5-46.12Q297-840 324.62-840h430.76q27.62 0 46.12 18.5Q820-803 820-775.38v430.76q0 27.62-18.5 46.12Q783-280 755.38-280H324.62Zm0-40h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H324.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69Zm-120 160q-27.62 0-46.12-18.5Q140-197 140-224.61v-470.77h40v470.77q0 9.23 7.69 16.92 7.69 7.69 16.93 7.69h470.76v40H204.62ZM300-800v480-480Z"/></svg>`;

// Cache DOM elements and global variables
const baseUrl = window.location.origin;
const urlParams = new URLSearchParams(window.location.search);
const navbar = document.getElementById('navbar');
const darkModeToggleEl = document.getElementById('dark-mode');
const orderSummaryCont = document.getElementById('order-summary-container');
const orderSummaryBtn = document.getElementById('order-summary-toggle');
const orderSummaryEl = document.getElementById('order-summary');
const numberEl = document.querySelectorAll('.digits-only');
const placeOrderForm = document.getElementById('place-order-form');
const mobileCartCounter = document.getElementById('mobile-menu-cart-counter-cont');
const pdpAsideQuickBar = document.getElementById('pdpAsideQuickBar');

let lastScrollPosition = 0;
let notificationElement = null;
let notificationTimeout = null;

// Utility Functions
const getUrlParams = () => new URLSearchParams(window.location.search);

const pageTitle = () => {
    const path = window.location.pathname;
    return path.split("/").pop();
};

const formatIndianMoney = (amount, decimalPlaces = 2) => {
    const fixedAmount = parseFloat(amount).toFixed(decimalPlaces);
    let [whole, fraction] = fixedAmount.split('.');
    
    const lastThree = whole.slice(-3);
    const otherNumbers = whole.slice(0, -3);
    let formattedWhole = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",");
    
    formattedWhole = formattedWhole ? `${formattedWhole},${lastThree}` : lastThree;

    if (decimalPlaces > 0 && parseInt(fraction) !== 0) {
        fraction = fraction.replace(/0+$/, '');
        return `${formattedWhole}.${fraction}`;
    }

    return formattedWhole;
};

// helper: find CSRF token if using Laravel blade `@csrf` meta
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : null;
}

// Notification System
const createNotification = () => {
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
};

const showNotification = (message, options = {}) => {
    createNotification();

    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
        notificationTimeout = null;
    }

    const messageEl = document.getElementById('notification-message');
    const alertDiv = document.getElementById('main-alert');
    const iconHolder = document.getElementById('notification-icon');
    const badge = document.getElementById('notification-badge');
    const redirect = document.getElementById('notification-redirect');

    messageEl.textContent = message;

    // Set notification type
    alertDiv.classList.remove('bg-black', 'bg-green-700', 'bg-red-800');
    if (options.type === "success") {
        alertDiv.classList.add('bg-green-700');
        iconHolder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>`;
    } else if (options.type === "error") {
        alertDiv.classList.add('bg-red-800');
        iconHolder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M330-120 120-330v-300l210-210h300l210 210v300L630-120H330Zm36-190 114-114 114 114 56-56-114-114 114-114-56-56-114 114-114-114-56 56 114 114-114 114 56 56Zm-2 110h232l164-164v-232L596-760H364L200-596v232l164 164Zm116-280Z"/></svg>`;
    } else {
        alertDiv.classList.add('bg-black');
        iconHolder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120q-33 0-56.5-23.5T400-200q0-33 23.5-56.5T480-280q33 0 56.5 23.5T560-200q0 33-23.5 56.5T480-120Zm-80-240v-480h160v480H400Z"/></svg>`;
    }

    // Set badge
    if (options.badgeText) {
        badge.classList.remove('hidden');
        badge.textContent = options.badgeText;
    } else {
        badge.classList.add('hidden');
    }

    // Set redirect
    if (options.redirectText && options.redirectLink) {
        redirect.innerText = options.redirectText;
        redirect.href = options.redirectLink;
    } else {
        redirect.innerText = "";
        redirect.href = "";
    }

    const notification = document.getElementById('simple-notification');
    notification.classList.remove('hidden');
    notification.classList.add('flex');

    notificationTimeout = setTimeout(() => {
        hideNotification();
    }, options.duration || 5000);
};

const hideNotification = () => {
    const notification = document.getElementById('simple-notification');
    if (notification) {
        notification.classList.add('hidden');
    }
    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
        notificationTimeout = null;
    }
};

// IP Information Handling
const checkIpInfo = async () => {
    try {
        const storedData = localStorage.getItem('applicationSettings');
        if (!storedData) return true;

        const appData = JSON.parse(storedData);
        const ipv4 = appData.ipv4;
        if (!ipv4) return true;

        const response = await fetch(`/api/ip/check/${ipv4}`);
        if (!response.ok) return true;

        const data = await response.json();
        return data.code !== 200;
    } catch (error) {
        console.error('Error checking IP:', error);
        return true;
    }
};

const getIpInfo = async () => {
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

        return {
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
    } catch (error) {
        console.error('Error fetching IP info:', error);
        return null;
    }
};

const storeIpInfo = async (ipInfo) => {
    if (!ipInfo) return false;

    try {
        const csrfToken = getCsrfToken();
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

        return response.ok;
    } catch (error) {
        console.error('Error storing IP info:', error);
        return false;
    }
};

// Initialize IP info
(async () => {
    const shouldFetchNewIp = await checkIpInfo();
    if (shouldFetchNewIp) {
        const ipInfo = await getIpInfo();
        if (ipInfo) {
            await storeIpInfo(ipInfo);
            applicationSettingsBrowserStore('ipv4', ipInfo.ip);
            applicationSettingsBrowserStore('country', ipInfo.countryCode);
            applicationSettingsBrowserStore('currency', ipInfo.currency);
        }
    }
})();

// Device Detection
const isMobileDevice = () => window.innerWidth <= 768;

// Scroll Handling
const handleNavbarScroll = () => {
    const currentScrollPosition = window.scrollY;
    const scrollThreshold = 50;
    const navbarHeight = isMobileDevice() ? 43 : 66;

    if (currentScrollPosition > lastScrollPosition && currentScrollPosition > scrollThreshold) {
        navbar.style.top = `-${navbarHeight}px`;
        if (orderSummaryCont) orderSummaryCont.style.top = '9rem';
        if (pdpAsideQuickBar) pdpAsideQuickBar.style.top = '8.2rem';
    } else {
        navbar.style.top = '0px';
        if (orderSummaryCont) orderSummaryCont.style.top = '13rem';
        if (pdpAsideQuickBar) pdpAsideQuickBar.style.top = '12.4rem';
    }

    lastScrollPosition = currentScrollPosition;
};

const throttle = (func, limit) => {
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
            lastFunc = setTimeout(() => {
                if ((Date.now() - lastRan) >= limit) {
                    func.apply(context, args);
                    lastRan = Date.now();
                }
            }, limit - (Date.now() - lastRan));
        }
    }
};

window.addEventListener('scroll', throttle(handleNavbarScroll, 100));
window.addEventListener('resize', () => {
    if (window.scrollY <= 50) {
        navbar.style.top = '0px';
    }
});

// Theme Management
const applicationSettingsBrowserStore = (objKey, objValue) => {
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
};

const applySavedTheme = () => {
    const appData = JSON.parse(localStorage.getItem('applicationSettings') || '{}');
    const savedTheme = appData.theme || "system";
    const html = document.querySelector('html');
    
    html.classList.remove('light', 'dark');

    if (savedTheme === "dark") {
        html.classList.add('dark');
        if (darkModeToggleEl) darkModeToggleEl.checked = true;
    } else if (savedTheme === "light") {
        html.classList.add('light');
        if (darkModeToggleEl) darkModeToggleEl.checked = false;
    } else {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            html.classList.add('dark');
            if (darkModeToggleEl) darkModeToggleEl.checked = true;
        } else {
            html.classList.add('light');
            if (darkModeToggleEl) darkModeToggleEl.checked = false;
        }
    }
};

applySavedTheme();

if (darkModeToggleEl) {
    darkModeToggleEl.addEventListener('click', () => {
        const html = document.querySelector('html');
        if (darkModeToggleEl.checked) {
            if (!html.classList.contains('dark')) {
                html.classList.remove('light');
                html.classList.add('dark');
                applicationSettingsBrowserStore('theme', 'dark');
            }
        } else {
            if (!html.classList.contains('light')) {
                html.classList.remove('dark');
                html.classList.add('light');
                applicationSettingsBrowserStore('theme', 'light');
            }
        }
    });
}

// Homepage Swiper
if (document.querySelector('.mySwiper')) {
    new Swiper(".mySwiper", {
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

// Cart Toggle
if (orderSummaryBtn && orderSummaryEl) {
    orderSummaryBtn.addEventListener('click', () => {
        orderSummaryEl.classList.toggle('hidden');
    });
}

// Product Detail Variations
urlParams.forEach((value, paramName) => {
    if (paramName.startsWith('variation-')) {
        const attributeName = paramName.replace('variation-', '');
        const selector = `input[name="variation${attributeName}"], 
                        input[name="variation[${attributeName}]"], 
                        input[name="variation-${attributeName}"], 
                        input[name="${attributeName}"]`;

        document.querySelectorAll(selector).forEach(input => {
            if (input.value.toLowerCase() === value.toLowerCase()) {
                input.checked = true;
                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    }
});

// Main Swiper
if (document.querySelector('.main-swiper')) {
    new Swiper(".main-swiper", {
        spaceBetween: 30,
        centeredSlides: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'w-3 h-3 rounded-full bg-gray-500 border-2 border-gray-200 transition-all',
            bulletActiveClass: 'w-6 bg-black',
            renderBullet: (index, className) => `<span class="${className}"></span>`,
        },
    });
}

// Number Input Formatting
const formatWholeNumberInput = (e) => {
    let value = e.target.value.replace(/[^0-9]/g, '');
    value = value.replace(/^0+(\d)/, '$1');
    if (value.length > 10) value = value.slice(0, 10);
    e.target.value = value;
};

if (numberEl) {
    numberEl.forEach(el => {
        el.addEventListener("input", formatWholeNumberInput);
    });
}

// Product Attribute Handling
const scrollToVariationTab = () => {
    const variationTab = document.querySelector('#variationTab');
    if (variationTab) {
        variationTab.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center'
        });
    }
};

const checkAllVariationsSelected = (requiredVariations, selectedVariations) => {
    const requiredParams = requiredVariations.map(v => 
        `variation-${v.slug.toLowerCase().replace(/ /g, '-')}`
    );
    
    return requiredParams.every(param => 
        Object.prototype.hasOwnProperty.call(selectedVariations, param)
    );
};

// Cart Management
const cartDataFetch = async () => {
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
};

cartDataFetch();

const handleCartAction = async (productId, quantity, selectedVariations) => {
    const urlParameter = getUrlParams();
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    formData.append('url_param', urlParameter);

    if (Object.keys(selectedVariations).length) {
        formData.append('variation', JSON.stringify(selectedVariations));
    }

    try {
        const response = await fetch('/cart/store', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
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

        if (pageTitle() != 'cart' && pageTitle() != 'checkout') {
            setTimeout(() => {
                document.querySelector('#cart-btn').click();
            }, 100);
        }

        return data;
    } catch (error) {
        showNotification('Cart action error', { type: 'error' });
        console.error('Cart action error:', error);
        throw error;
    }
};

const updateCartCount = (count) => {
    const counters = document.querySelectorAll('.cart-count');
    counters.forEach(el => {
        el.innerHTML = count > 0 
            ? `${count} <span class='hidden md:inline-block'>${count == 1 ? 'item' : 'items'}</span>` 
            : '';
    });
};

const updateCartData = (cartInfo, cartItems) => {
    const cartProductsElements = document.querySelectorAll('.cart-products');
    const cartRedirectElement = document.querySelector('.cart-redirect');

    if (cartItems.length > 0) {
        const singleCartItem = cartItems.map(item => `
            <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="col-span-2">
                    <div class="flex items-center gap-3">
                        <a href="${item.product_url_with_variation || item.product_url}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                            ${item.image_s ? 
                                `<img class="h-auto max-h-full w-full" src="${item.image_s}" alt="${item.product_title}">` :
                                FDBrokenImage
                            }
                        </a>
                        <div class="w-full">
                            <a href="${item.product_url_with_variation || item.product_url}" class="inline-block text-xs ${FDtext0} text-gray-900 hover:underline dark:text-white">${item.product_title}</a>
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
                            data-link="${item.product_url_with_variation || item.product_url}"
                            data-image="${item.image_m || 'not found'}"
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

        if (mobileCartCounter) {
            mobileCartCounter.style.display = 'block';
        }
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

        if (mobileCartCounter) {
            mobileCartCounter.style.display = 'none';
        }
    }
};

const bindCartQtyEvents = () => {
    document.querySelectorAll('.cart-qty-update').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            updateCartQty(btn.dataset.id, btn.dataset.type);
        });
    });
};

const bindRemoveFromCartEvents = () => {
    document.querySelectorAll('.remove-from-cart').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const imagePath = btn.dataset.image === "not found" 
                ? FDBrokenImage 
                : `<img class="h-auto max-h-full w-full" src="${btn.dataset.image}" alt="${btn.dataset.title}">`;

            const productData = `
            <div class="items-center dark:border-gray-600">
                <div class="flex items-center gap-4">
                    <a href="${btn.dataset.link}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                        ${imagePath}
                    </a>
                    <div class="w-full">
                        <a href="${btn.dataset.link}" class="inline-block text-xs ${FDtext0} text-gray-900 hover:underline dark:text-white">${btn.dataset.title}</a>
                        ${btn.dataset.attributes ? `<p class="${FDtext0} text-gray-400">${btn.dataset.attributes}</p>` : ''}
                        <p class="mt-0.5 truncate ${FDtext} font-normal text-gray-500 dark:text-gray-300">
                            <span class="currency-symbol">₹</span> ${formatIndianMoney(btn.dataset.price)}
                        </p>
                    </div>
                </div>
            </div>
            `;

            document.querySelector('.delete-product-data').innerHTML = productData;
            document.querySelector('#delete-cart-item-form').action = `/cart/delete/${btn.dataset.id}`;
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-cart-item-deletion' }));
        });
    });
};

const updateCartQty = async (id, type) => {
    try {
        const response = await fetch('/cart/qty/update', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                type: type
            })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Failed to update cart');
        }

        showNotification(data.message, { type: data.status });
        updateCartCount(data.cart_count);
        updateCartData(data.cart_info, data.cart_items);

        if (window.Livewire) {
            window.dispatchEvent(new CustomEvent('cart-updated'));
        }
    } catch (error) {
        showNotification('Cart action error', { type: 'error' });
        console.error('Cart action error:', error);
    }
};

// Add to Cart Event Delegation
document.addEventListener('click', async (e) => {
    const addToCartBtn = e.target.closest('.add-to-cart');
    if (!addToCartBtn) return;

    e.preventDefault();
    const originalHtml = addToCartBtn.innerHTML;

    try {
        addToCartBtn.innerText = 'Loading...';
        addToCartBtn.disabled = true;

        const productId = addToCartBtn.dataset.prodId;
        const quantity = parseInt(addToCartBtn.dataset.quantity || 1);
        const variationData = JSON.parse(addToCartBtn.dataset.variationData || '[]');
        const selectedVariations = {};
        const urlParams = getUrlParams();

        if (variationData.length > 0) {
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

        await handleCartAction(productId, quantity, selectedVariations);

        if (pageTitle() == 'cart' || pageTitle() == 'checkout') {
            if (window.Livewire) {
                window.dispatchEvent(new CustomEvent('updateCartInfo'));
            }
        }
    } catch (error) {
        console.error('Add to cart error:', error);
        showNotification('Failed to add to cart. Please try again.', { type: 'error' });
    } finally {
        addToCartBtn.innerHTML = originalHtml;
        addToCartBtn.disabled = false;
    }
});

// Cart Item Deletion
if (document.querySelector('#delete-cart-item-form')) {
    document.querySelector('#delete-cart-item-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const url = form.action;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: document.getElementById('cart-item-type').value,
                    _method: 'DELETE'
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to remove item');
            }

            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'confirm-cart-item-deletion' }));
            showNotification(data.message, { type: data.status });
            updateCartCount(data.cart_count);
            updateCartData(data.cart_info, data.cart_items);

            if (pageTitle() != 'cart' && pageTitle() != 'checkout') {
                setTimeout(() => {
                    document.querySelector('#cart-btn').click();
                }, 100);
            }
        } catch (error) {
            showNotification('Cart action error', { type: 'error' });
            console.error('Cart action error:', error);
        }
    });
}

// Checkout Address Handling
const selectedShipAddrEl = document.querySelector('input[name=shipping_address_id]');
const selectedBillAddrEl = document.querySelector('input[name=billing_address_id]');
const shippingAddresses = document.querySelectorAll('.shipping-address');
const billingAddresses = document.querySelectorAll('.billing-address');

if (selectedShipAddrEl && shippingAddresses.length > 0) {
    shippingAddresses.forEach(el => {
        if (el.checked) selectedShipAddrEl.value = el.value;
        el.addEventListener('change', () => {
            if (el.checked) selectedShipAddrEl.value = el.value;
        });
    });
}

if (selectedBillAddrEl && billingAddresses.length > 0) {
    billingAddresses.forEach(el => {
        if (el.checked) selectedBillAddrEl.value = el.value;
        el.addEventListener('change', () => {
            if (el.checked) selectedBillAddrEl.value = el.value;
        });
    });
}

if (placeOrderForm) {
    placeOrderForm.addEventListener('submit', () => {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'full-page-loader' }));
    });
}

// Wishlist Management
const checkWishlistStatus = async () => {
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    if (!wishlistButtons.length) return;

    try {
        const productIds = Array.from(wishlistButtons).map(btn => btn.dataset.prodId);

        const response = await fetch(`${baseUrl}/wishlist/check-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({
                product_ids: productIds
            })
        });

        const data = await response.json();

        if (response.ok && data.status === 'success') {
            data.data.forEach(productId => {
                const button = document.querySelector(`.wishlist-btn[data-prod-id="${productId}"]`);
                if (button) {
                    const heartIcon = button.querySelector('svg');
                    heartIcon.querySelector('path').setAttribute('fill', 'red');
                }
            });
        }
    } catch (error) {
        console.error('Error checking wishlist status:', error);
    }
};

document.addEventListener('DOMContentLoaded', checkWishlistStatus);

document.addEventListener('click', async (e) => {
    const wishlistBtn = e.target.closest('.wishlist-btn');
    if (!wishlistBtn) return;

    e.preventDefault();
    e.stopPropagation();

    const heartIcon = wishlistBtn.querySelector('svg');
    const isWishlisted = heartIcon.querySelector('path').hasAttribute('fill');

    try {
        wishlistBtn.disabled = true;
        const productId = wishlistBtn.dataset.prodId;

        const response = await fetch(`${baseUrl}/wishlist/toggle/${productId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            }
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Failed to Wishlist item');
        }

        if (data.code == 200) {
            if (!isWishlisted) {
                heartIcon.classList.add('scale-[1.2]');
                heartIcon.querySelector('path').setAttribute('fill', 'red');
                
                const btnRect = wishlistBtn.getBoundingClientRect();
                confetti({
                    particleCount: 80,
                    spread: 50,
                    origin: { 
                        x: (btnRect.left + btnRect.width/2) / window.innerWidth,
                        y: (btnRect.top + btnRect.height/2) / window.innerHeight
                    },
                    colors: ['#ff0000', '#ff6666', '#ff9999'],
                    scalar: 0.7
                });
            } else {
                heartIcon.classList.add('scale-[1.2]');
                setTimeout(() => {
                    heartIcon.querySelector('path').removeAttribute('fill');
                }, 150);
            }
        }

        showNotification(data.message, { type: data.status });
    } catch (error) {
        console.error('Wishlist item error:', error);
        if (!isWishlisted) {
            heartIcon.querySelector('path').removeAttribute('fill');
        } else {
            heartIcon.querySelector('path').setAttribute('fill', 'red');
        }
        showNotification('Failed to Wishlist item. Please try again.', { type: 'error' });
    } finally {
        setTimeout(() => {
            heartIcon.classList.remove('scale-[1.2]');
            wishlistBtn.disabled = false;
        }, 300);
    }
});

// Product Description Show More
document.querySelectorAll('p.description-wrapper').forEach(p => {
    p.classList.add('line-clamp-2', 'relative');

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'absolute right-0 bottom-0 bg-gradient-to-br from-[#ffffffb5] to-[#ffffff] dark:from-[#1e293beb] dark:to-[#1e293bad] pl-8 font-light text-xs text-gray-800 dark:text-white hover:underline show-more-btn hidden';
    btn.setAttribute('aria-expanded', 'false');
    btn.textContent = 'Show more';
    p.appendChild(btn);

    setTimeout(() => {
        if (p.scrollHeight <= p.clientHeight) {
            btn.remove();
            return;
        }

        btn.classList.remove('hidden');

        let expanded = false;
        const duration = 200;

        const expand = () => {
            const start = p.clientHeight;
            p.classList.remove('line-clamp-2');
            const end = p.scrollHeight;

            p.style.maxHeight = start + 'px';
            requestAnimationFrame(() => {
                p.style.transition = `max-height ${duration}ms ease`;
                p.style.maxHeight = end + 'px';
            });

            const onEnd = () => {
                p.style.transition = '';
                p.style.maxHeight = '';
                p.removeEventListener('transitionend', onEnd);
            };
            p.addEventListener('transitionend', onEnd);

            btn.textContent = 'Show less';
            btn.setAttribute('aria-expanded', 'true');
        };

        const collapse = () => {
            const full = p.scrollHeight;
            p.style.maxHeight = full + 'px';

            requestAnimationFrame(() => {
                p.classList.add('line-clamp-2');

                requestAnimationFrame(() => {
                    const clampedH = p.clientHeight;
                    p.style.transition = `max-height ${duration}ms ease`;
                    p.style.maxHeight = clampedH + 'px';
                });
            });

            const onEnd = () => {
                p.style.transition = '';
                p.style.maxHeight = '';
                p.removeEventListener('transitionend', onEnd);
            };
            p.addEventListener('transitionend', onEnd);

            btn.textContent = 'Show more';
            btn.setAttribute('aria-expanded', 'false');
        };

        btn.addEventListener('click', () => {
            expanded = !expanded;
            expanded ? expand() : collapse();
        });
    }, 40);
});

// Price Range Slider
const wrapper = document.getElementById('rangeWrapper');
if (wrapper) {
    const minRange = document.getElementById('minRange');
    const maxRange = document.getElementById('maxRange');
    const connect = document.getElementById('connect');
    const minValue = document.getElementById('minValue');
    const maxValue = document.getElementById('maxValue');

    const MIN = Number(wrapper.dataset.min || minRange.min || 0);
    const MAX = Number(wrapper.dataset.max || minRange.max || 500);
    const STEP = Number(wrapper.dataset.step || minRange.step || 1);
    const RANGE = MAX - MIN;

    const pct = (v) => ((v - MIN) / RANGE) * 100;

    const updatePositions = () => {
        let a = Number(minRange.value);
        let b = Number(maxRange.value);

        if (a > b) {
            if (document.activeElement === minRange) {
                a = b;
                minRange.value = a;
            } else {
                b = a;
                maxRange.value = b;
            }
        }

        const pA = pct(a);
        const pB = pct(b);

        connect.style.left = pA + '%';
        connect.style.width = (pB - pA) + '%';

        minValue.style.left = pA + '%';
        maxValue.style.left = pB + '%';
        minValue.innerHTML = '<span class="currency-symbol">₹</span>' + formatIndianMoney(a);
        maxValue.innerHTML = '<span class="currency-symbol">₹</span>' + formatIndianMoney(b);

        document.getElementById('min_price').value = a;
        document.getElementById('max_price').value = b;
    };

    minRange.addEventListener('input', updatePositions);
    maxRange.addEventListener('input', updatePositions);
    minRange.addEventListener('change', updatePositions);
    maxRange.addEventListener('change', updatePositions);

    minRange.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') { 
            e.preventDefault(); 
            minRange.value = Math.max(MIN, Number(minRange.value) - STEP); 
            updatePositions(); 
        }
        if (e.key === 'ArrowRight' || e.key === 'ArrowUp') { 
            e.preventDefault(); 
            minRange.value = Math.min(MAX, Number(minRange.value) + STEP); 
            updatePositions(); 
        }
    });
    
    maxRange.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') { 
            e.preventDefault(); 
            maxRange.value = Math.max(MIN, Number(maxRange.value) - STEP); 
            updatePositions(); 
        }
        if (e.key === 'ArrowRight' || e.key === 'ArrowUp') { 
            e.preventDefault(); 
            maxRange.value = Math.min(MAX, Number(maxRange.value) + STEP); 
            updatePositions(); 
        }
    });

    if (Number(minRange.value) < MIN) minRange.value = MIN;
    if (Number(maxRange.value) > MAX) maxRange.value = MAX;

    updatePositions();

    document.getElementById('filtersForm').addEventListener('submit', () => {
        updatePositions();
    });
}

// Category Filter Placement
const tpl = document.getElementById('category-filter-root');
const desktopTarget = document.getElementById('desktop-filter-target');
const mobileTarget = document.getElementById('mobile-filter-target');

if (tpl) {
    const mq = window.matchMedia('(min-width:1024px)');

    const placeFilter = () => {
        if (mq.matches) {
            if (!desktopTarget.contains(tpl)) {
                desktopTarget.appendChild(tpl);
                desktopTarget.classList.remove('hidden');
            }
        } else {
            if (!mobileTarget.contains(tpl)) {
                mobileTarget.appendChild(tpl);
            }
        }
    };

    placeFilter();
    mq.addEventListener ? mq.addEventListener('change', placeFilter) : mq.addListener(placeFilter);
}

// Flash Sale Countdown
const countdownEl = document.getElementById('countdown');
if (countdownEl) {
    let remaining = 10 * 60;
    setInterval(() => {
        if (remaining <= 0) { 
            countdownEl.textContent = '00:00:00'; 
            return; 
        }
        remaining--;
        const h = String(Math.floor(remaining / 3600)).padStart(2, '0');
        const m = String(Math.floor((remaining % 3600) / 60)).padStart(2, '0');
        const s = String(remaining % 60).padStart(2, '0');
        countdownEl.textContent = `${h}:${m}:${s}`;
    }, 1000);
}

// Livewire Event Listeners
document.addEventListener('livewire:init', () => {
    Livewire.on('show-notification', (data) => {
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

// Initialize notification system
document.addEventListener('DOMContentLoaded', createNotification);

// Update Frontend Primary Currency
document.querySelectorAll('.toggle-currency').forEach(el => {
    el.addEventListener('click', async (e) => {
        e.preventDefault();

        const countryCode = el.dataset.title;
        // console.log(countryCode);

        // call countryCode detail API
        const endpoint = `/api/country/update/${countryCode}`;
        const headers = { 'Content-Type': 'application/json' };
        const csrf = getCsrfToken();
        if (csrf) headers['X-CSRF-TOKEN'] = csrf;

        try {
            const response = await fetch(endpoint);
            if (!response.ok) return true;

            const data = await response.json();
            // console.log(data);

            if (data.code == 200) {
                const countryData = data.data;
            }

            // return data.code !== 200;

        } catch (error) {
            console.error('Error checking IP:', error);
            return true;
        }
    })
});
