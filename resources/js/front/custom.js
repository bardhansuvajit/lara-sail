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
// on select variation data, send into url parameter
function sendUrlParam(variationType, value) {
    // Check if the URL already has a query string
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);

    // Set the parameter
    params.set('variation-'+variationType, value.toLowerCase());

    // Update the URL without reloading the page
    window.history.replaceState({}, '', `${url.pathname}?${params}`);
}

// Tab Switching
document.querySelectorAll('[data-tab]').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('[data-tab]').forEach(b => b.classList.remove('border-black'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        btn.classList.add('border-black');
        document.getElementById(btn.dataset.tab).classList.remove('hidden');
    });
});

// add to cart
document.querySelectorAll('.add-to-cart').forEach(cartBtn => {
    cartBtn.addEventListener('click', () => {
        const productId = cartBtn.dataset.prodId;
        const variationData = JSON.parse(cartBtn.dataset.variationData);

        // if variation exists
        if (variationData.length > 0) {
            console.log(variationData);
            
            let hasSelectedVariations = false;
            const selectedVariations = {};
            const urlParamsDynamic = getUrlParams();

            urlParamsDynamic.forEach((value, paramName) => {
                if (paramName.startsWith('variation-')) {
                    selectedVariations[paramName] = value;
                    hasSelectedVariations = true;
                }
            });

            if (!hasSelectedVariations) {
                // alert('Please select product variations before adding to cart.');
                const variationTab = document.querySelector('#variationTab');
                if (variationTab) {
                    variationTab.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' // or 'start', 'nearest'
                    });

                    // variationTab.classList.add('animate-pulse', 'ring-2', 'ring-yellow-500', 'ring-offset-2');

                    // // Remove animation after 2 seconds
                    // setTimeout(() => {
                    //     variationTab.classList.remove(
                    //         'animate-pulse', 
                    //         'ring-2', 
                    //         'ring-yellow-500', 
                    //         'ring-offset-2'
                    //     );
                    // }, 2000);
                }
                return;
            }

            console.log('Selected Variations:', selectedVariations);
        }
    });
});
