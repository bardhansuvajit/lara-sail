const urlParams = new URLSearchParams(window.location.search);
const navbar = document.getElementById('navbar');
const darkModeToggleEl = document.getElementById('dark-mode');
const orderSummaryCont = document.getElementById('order-summary-container');
const orderSummaryBtn = document.getElementById('order-summary-toggle');
const orderSummaryEl = document.getElementById('order-summary');
const phoneNoEl = document.getElementById('phone_no');
let lastScrollPosition = 0;

// GLOBAL
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

phoneNoEl.addEventListener("input", formatWholeNumberInput);