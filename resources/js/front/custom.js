const navbar = document.getElementById('navbar');
let lastScrollPosition = 0;

window.addEventListener('scroll', function() {
    let currentScrollPosition = window.scrollY;

    if (currentScrollPosition > lastScrollPosition) {
        navbar.style.top = '-85px';
        // console.log('User is scrolling down');
    } else if (currentScrollPosition < 50) {
        navbar.style.top = '0px';
    }

    lastScrollPosition = currentScrollPosition;
});