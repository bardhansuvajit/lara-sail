const navbar = document.getElementById('navbar');
const darkModeToggleEl = document.getElementById('dark-mode');
let lastScrollPosition = 0;

// Function to check if device is mobile
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
    } 
    // Scrolling up or at top of page
    else {
        navbar.style.top = '0px';
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