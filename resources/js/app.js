import './bootstrap';

/**
 * TK UNITY - Main Application JS
 */
document.addEventListener('DOMContentLoaded', () => {
    initNavigation();
    initNewsletter();
    initCopyLinks();
    initMegaMenuImages();
});

// Re-init on Livewire navigation if using Livewire
document.addEventListener('livewire:navigated', () => {
    initNavigation();
    initMegaMenuImages();
});

/**
 * Navigation & Header Logic
 */
function initNavigation() {
    const header = document.getElementById('header');
    const body = document.body;
    const toggle = document.querySelector('[data-mobile-toggle]');
    const backdrop = document.querySelector('[data-mobile-close]');
    const mobileNav = document.getElementById('mobile-nav');

    if (!header) return;

    // Header Scroll Effect
    const updateHeader = () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', updateHeader);
    updateHeader(); // Initial check

    // Mobile Menu & Mega Menu Toggle
    if (toggle && backdrop && mobileNav) {
        const logoWrapper = document.getElementById('logoWrapper');
        const megaMenu = document.getElementById('megaMenu');

        const closeNav = () => {
            body.classList.remove('nav-open');
            if (megaMenu) megaMenu.classList.remove('active');
            if (logoWrapper) logoWrapper.classList.remove('active');
            if (backdrop) backdrop.classList.remove('active');
            toggle.setAttribute('aria-expanded', 'false');
            if (mobileNav) mobileNav.setAttribute('aria-hidden', 'true');
        };

        const openNav = () => {
            body.classList.add('nav-open');
            toggle.setAttribute('aria-expanded', 'true');
            if (mobileNav) mobileNav.setAttribute('aria-hidden', 'false');
        };

        const toggleMegaMenu = () => {
            if (!megaMenu) return;
            const isActive = megaMenu.classList.contains('active');
            if (isActive) {
                megaMenu.classList.remove('active');
                if (logoWrapper) logoWrapper.classList.remove('active');
                backdrop.classList.remove('active');
                body.classList.remove('nav-open');
            } else {
                megaMenu.classList.add('active');
                if (logoWrapper) logoWrapper.classList.add('active');
                backdrop.classList.add('active');
                body.classList.add('nav-open');
            }
        };

        // Clear existing listeners
        const newToggle = toggle.cloneNode(true);
        toggle.parentNode.replaceChild(newToggle, toggle);

        newToggle.addEventListener('click', () => {
            if (body.classList.contains('nav-open')) {
                closeNav();
            } else {
                openNav();
            }
        });

        if (logoWrapper) {
            logoWrapper.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMegaMenu();
            });
        }

        backdrop.addEventListener('click', closeNav);

        mobileNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeNav);
        });

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && body.classList.contains('nav-open')) {
                closeNav();
            }
        });
    }
}

/**
 * Newsletter Form Logic
 */
function initNewsletter() {
    document.querySelectorAll('[data-newsletter]').forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            // In a real app, this would be an AJAX call
            alert('Thanks for subscribing!');
            form.reset();
        });
    });
}

/**
 * Copy Link Logic
 */
function initCopyLinks() {
    document.querySelectorAll('[data-copy-link]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const url = window.location.href;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    showToast('Link copied to clipboard!');
                }).catch(() => {
                    showToast('Unable to copy link.', 'error');
                });
            } else {
                // Fallback
                const fallback = document.createElement('textarea');
                fallback.value = url;
                fallback.setAttribute('readonly', '');
                fallback.style.position = 'absolute';
                fallback.style.left = '-9999px';
                document.body.appendChild(fallback);
                fallback.select();

                try {
                    document.execCommand('copy');
                    showToast('Link copied to clipboard!');
                } catch (error) {
                    showToast('Unable to copy link.', 'error');
                }
                document.body.removeChild(fallback);
            }
        });
    });
}

/**
 * Mega Menu Hover Image Logic
 */
function initMegaMenuImages() {
    const megaLinks = document.querySelectorAll('.mega-menu-category a[data-image]');
    const megaImg = document.querySelector('.mega-feat-img');
    const megaTitle = document.querySelector('.mega-feat-content h5');
    const megaDesc = document.querySelector('.mega-feat-content p');

    if (megaLinks.length > 0 && megaImg) {
        megaLinks.forEach(link => {
            link.addEventListener('mouseenter', () => {
                const newImage = link.getAttribute('data-image');
                const newCaption = link.getAttribute('data-caption');
                const newTitle = link.textContent.trim();

                if (!newImage) return;

                megaImg.style.opacity = '0.5';
                setTimeout(() => {
                    megaImg.src = newImage;
                    megaImg.style.opacity = '1';
                }, 150);

                if (megaTitle) megaTitle.textContent = newTitle;
                if (megaDesc) megaDesc.textContent = newCaption;
            });
        });
    }
}

/**
 * Simple Toast/Alert Helper
 */
function showToast(message, type = 'success') {
    // For now using simple alert, can be replaced with a proper toast UI
    alert(message);
}
