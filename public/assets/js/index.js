           // Count Up Animation
           document.addEventListener('DOMContentLoaded', function() {
            const countUpElements = document.querySelectorAll('.count-up');

            const options = {
                threshold: 0.5
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const targetValue = parseInt(target.getAttribute('data-value'));
                        const duration = 2000; // 2 seconds
                        const step = targetValue / (duration / 16); // 60fps

                        let current = 0;
                        const timer = setInterval(() => {
                            current += step;
                            if (current >= targetValue) {
                                target.textContent = targetValue;
                                clearInterval(timer);
                            } else {
                                target.textContent = Math.floor(current);
                            }
                        }, 16);

                        observer.unobserve(target);
                    }
                });
            }, options);

            countUpElements.forEach(element => {
                observer.observe(element);
            });
        });

        // Parallax Effect for Hero Section
        document.addEventListener('DOMContentLoaded', function() {
            const heroSection = document.querySelector('.hero-section');

            if (heroSection) {
                window.addEventListener('scroll', function() {
                    const scrollPosition = window.scrollY;
                    const shapes = document.querySelectorAll('.shape');

                    shapes.forEach((shape, index) => {
                        const speed = 0.1 + (index * 0.05);
                        const yPos = scrollPosition * speed;
                        shape.style.transform = `translateY(${yPos}px)`;
                    });
                });
            }
        });