(function () {
    const body = document.body;
    const header = document.getElementById('header');

    const updateHeader = function () {
        if (!header) {
            return;
        }
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', updateHeader);
    updateHeader();

    const toggle = document.querySelector('[data-mobile-toggle]');
    const backdrop = document.querySelector('[data-mobile-close]');
    const mobileNav = document.getElementById('mobile-nav');

    if (toggle && backdrop && mobileNav) {
        const closeNav = function () {
            body.classList.remove('nav-open');
            toggle.setAttribute('aria-expanded', 'false');
            mobileNav.setAttribute('aria-hidden', 'true');
        };

        const openNav = function () {
            body.classList.add('nav-open');
            toggle.setAttribute('aria-expanded', 'true');
            mobileNav.setAttribute('aria-hidden', 'false');
        };

        toggle.addEventListener('click', function () {
            if (body.classList.contains('nav-open')) {
                closeNav();
            } else {
                openNav();
            }
        });

        backdrop.addEventListener('click', closeNav);

        mobileNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeNav);
        });

        window.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && body.classList.contains('nav-open')) {
                closeNav();
            }
        });
    }

    document.querySelectorAll('[data-newsletter]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            alert('Thanks for subscribing!');
        });
    });

    document.querySelectorAll('[data-copy-link]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const url = window.location.href;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(function () {
                    alert('Link copied to clipboard!');
                }).catch(function () {
                    alert('Unable to copy link.');
                });
                return;
            }

            const fallback = document.createElement('textarea');
            fallback.value = url;
            fallback.setAttribute('readonly', '');
            fallback.style.position = 'absolute';
            fallback.style.left = '-9999px';
            document.body.appendChild(fallback);
            fallback.select();

            try {
                document.execCommand('copy');
                alert('Link copied to clipboard!');
            } catch (error) {
                alert('Unable to copy link.');
            }

            document.body.removeChild(fallback);
        });
    });
})();
