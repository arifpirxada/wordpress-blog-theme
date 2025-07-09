// Js for navbar

const hamburger = document.querySelector('.hamburger');
const navbarNav = document.querySelector('.navbar-nav');
const navbar = document.querySelector('.navbar');

hamburger.addEventListener('click', function () {
    hamburger.classList.toggle('active');
    navbarNav.classList.toggle('active');
});

// Close mobile menu when clicking on a link
// document.querySelectorAll('.navbar-nav a').forEach(link => {
//     link.addEventListener('click', function () {
//         hamburger.classList.remove('active');
//         navbarNav.classList.remove('active');
//     });
// });

// Close mobile menu when clicking outside
document.addEventListener('click', function (event) {
    if (!event.target.closest('.navbar')) {
        hamburger.classList.remove('active');
        navbarNav.classList.remove('active');
    }
});

// Navbar scroll effect
window.addEventListener('scroll', function () {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});



// Dropdown Functionality JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown toggles
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(function(toggle) {
        const dropdown = toggle.closest('.dropdown');
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        
        // Click event for dropdown toggle
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Close all other dropdowns
            closeAllDropdowns();
            
            // Toggle current dropdown
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
                toggle.classList.remove('active');
            } else {
                dropdownMenu.classList.add('show');
                toggle.classList.add('active');
            }
        });
        
        // Hover events for desktop
        if (window.innerWidth > 768) {
            dropdown.addEventListener('mouseenter', function() {
                dropdownMenu.classList.add('show');
                toggle.classList.add('active');
            });
            
            dropdown.addEventListener('mouseleave', function() {
                dropdownMenu.classList.remove('show');
                toggle.classList.remove('active');
            });
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            closeAllDropdowns();
        }
    });
    
    // Close dropdown when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAllDropdowns();
        }
    });
    
    // Function to close all dropdowns
    function closeAllDropdowns() {
        const dropdownMenus = document.querySelectorAll('.dropdown-menu');
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        dropdownMenus.forEach(function(menu) {
            menu.classList.remove('show');
        });
        
        dropdownToggles.forEach(function(toggle) {
            toggle.classList.remove('active');
        });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            // Remove hover events on mobile
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function(dropdown) {
                dropdown.removeEventListener('mouseenter', function() {});
                dropdown.removeEventListener('mouseleave', function() {});
            });
        }
    });
    
    // Handle mobile menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navbarNav = document.querySelector('.navbar-nav');
    
    if (hamburger && navbarNav) {
        hamburger.addEventListener('click', function() {
            // Close all dropdowns when mobile menu is toggled
            if (navbarNav.classList.contains('active')) {
                closeAllDropdowns();
            }
        });
    }
});

// Optional: Add smooth scrolling for anchor links in dropdown
document.querySelectorAll('.dropdown-item[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close dropdown after clicking
            this.closest('.dropdown-menu').classList.remove('show');
            this.closest('.dropdown').querySelector('.dropdown-toggle').classList.remove('active');
        }
    });
});