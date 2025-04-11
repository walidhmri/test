    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });

    // Check for dark mode preference in localStorage
    document.addEventListener('DOMContentLoaded', function() {
        // Check if dark mode is stored in localStorage
        const isDarkMode = localStorage.getItem('dark') === 'true';
        const html = document.documentElement;

        // Apply dark mode if needed
        if (isDarkMode) {
            html.classList.add('dark-mode');
            updateDarkModeIcons(true);
        } else {
            html.classList.remove('dark-mode');
            updateDarkModeIcons(false);
        }

        // Dark Mode Toggle
        const darkModeDesktop = document.getElementById('darkModeDesktop');
        const darkModeMobile = document.getElementById('darkModeMobile');

        // Desktop dark mode toggle
        if (darkModeDesktop) {
            darkModeDesktop.addEventListener('click', function() {
                toggleDarkMode();
            });
        }

        // Mobile dark mode toggle
        if (darkModeMobile) {
            darkModeMobile.addEventListener('click', function() {
                toggleDarkMode();
            });
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            const isDarkMode = html.classList.contains('dark-mode');

            // Toggle dark mode class
            if (isDarkMode) {
                html.classList.remove('dark-mode');
                updateDarkModeIcons(false);
                localStorage.setItem('dark', 'false');
            } else {
                html.classList.add('dark-mode');
                updateDarkModeIcons(true);
                localStorage.setItem('dark', 'true');
            }
        }

        function updateDarkModeIcons(isDarkMode) {
            const darkIconDesktop = document.getElementById('darkIconDesktop');
            const darkIconMobile = document.getElementById('darkIconMobile');

            if (darkIconDesktop) {
                darkIconDesktop.className = isDarkMode ? 'bi bi-sun-fill fs-5' : 'bi bi-moon-fill fs-5';
            }

            if (darkIconMobile) {
                darkIconMobile.className = isDarkMode ? 'bi bi-sun-fill fs-5' : 'bi bi-moon-fill fs-5';
            }
        }
    });

    // Back to Top Button
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('backToTop');

        if (backToTopButton) {
            // Show/hide back to top button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    backToTopButton.classList.add('active');
                } else {
                    backToTopButton.classList.remove('active');
                }
            });

            // Scroll to top when clicked
            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });

    // Navbar Scroll Effect
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');

        if (navbar) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            if (href !== '#') {
                e.preventDefault();

                const targetElement = document.querySelector(href);
                if (targetElement) {
                    const headerOffset = 100;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
