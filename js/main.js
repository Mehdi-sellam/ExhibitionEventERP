const navItems = document.querySelector('.nav_items');
const opNavItems = document.querySelector('#open_nav_btn');
const clNavItems = document.querySelector('#close_nav_btn');

// Open Nav
const openNav = () => {
    navItems.style.display = 'flex';
    opNavItems.style.display = 'none';
    clNavItems.style.display = 'inline-block';
}

//Close Nav
const closeNav = () => {
    navItems.style.display = 'none';
    opNavItems.style.display = 'inline-block';
    clNavItems.style.display = 'none';
}

opNavItems.addEventListener('click', openNav);
clNavItems.addEventListener('click', closeNav);


const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show_sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide_sidebar-btn');

const showSidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
}

const hideSidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}

showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);


document.addEventListener('DOMContentLoaded', function() {
    const circles = document.querySelectorAll('.circular_bar circle');
    circles.forEach(circle => {
        const max = parseInt(circle.getAttribute('data-max'), 10);
        const offset = parseFloat(circle.getAttribute('data-offset'));
        const delay = 2500; // Adjusted delay to allow CSS animation to complete
        setTimeout(() => {
            circle.style.strokeDashoffset = max - offset;
        }, delay);
    });
});




