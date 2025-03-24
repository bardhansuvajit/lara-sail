const navbar = document.getElementById('navbar');
const darkModeToggleEl = document.getElementById('dark-mode');
let lastScrollPosition = 0;

window.addEventListener('scroll', function() {
    let currentScrollPosition = window.scrollY;

    if (currentScrollPosition > lastScrollPosition) {
        navbar.style.top = '-66px';
    } else if (currentScrollPosition < 50) {
        navbar.style.top = '0px';
    }

    lastScrollPosition = currentScrollPosition;
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
    } else if (savedTheme === "light") {
        document.querySelector('html').classList.add('light');
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