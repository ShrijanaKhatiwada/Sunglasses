// Custom cursor
document.addEventListener('DOMContentLoaded', function() {
    const cursor = document.createElement('div');
    const cursorBorder = document.createElement('div');
    cursor.id = 'cursor';
    cursorBorder.id = 'cursor-border';
    document.body.appendChild(cursor);
    document.body.appendChild(cursorBorder);

    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;
    let borderX = 0, borderY = 0;

    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function animate() {
        let dx = mouseX - cursorX;
        let dy = mouseY - cursorY;
        cursorX += dx * 0.1;
        cursorY += dy * 0.1;
        cursor.style.transform = `translate(${cursorX}px, ${cursorY}px)`;

        dx = mouseX - borderX;
        dy = mouseY - borderY;
        borderX += dx * 0.15;
        borderY += dy * 0.15;
        cursorBorder.style.transform = `translate(${borderX}px, ${borderY}px)`;

        requestAnimationFrame(animate);
    }
    animate();

    // Cursor effects on hover
    const hoverElements = document.querySelectorAll('a, button, .hover-scale');
    hoverElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            cursor.style.transform = `translate(${cursorX}px, ${cursorY}px) scale(1.5)`;
            cursorBorder.style.transform = `translate(${borderX}px, ${borderY}px) scale(1.5)`;
        });
        element.addEventListener('mouseleave', () => {
            cursor.style.transform = `translate(${cursorX}px, ${cursorY}px) scale(1)`;
            cursorBorder.style.transform = `translate(${borderX}px, ${borderY}px) scale(1)`;
        });
    });
});

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (menuToggle && closeMenu && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.remove('translate-x-full');
        });
        
        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.add('translate-x-full');
        });
    }

    // Simple fade-in animations
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach(function(element) {
        element.style.opacity = '1';
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Simple hover effects
    const hoverElements = document.querySelectorAll('.hover-scale');
    hoverElements.forEach(function(element) {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

// GSAP animations
function initGSAPAnimations() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        
        // Slide-in animations
        gsap.utils.toArray('.slide-in-left').forEach(element => {
            gsap.from(element, {
                x: -100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: element,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                }
            });
        });
        
        gsap.utils.toArray('.slide-in-right').forEach(element => {
            gsap.from(element, {
                x: 100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: element,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                }
            });
        });
        
        // Parallax effect
        gsap.utils.toArray('.parallax-bg').forEach(element => {
            gsap.to(element, {
                backgroundPosition: "50% 30%",
                ease: "none",
                scrollTrigger: {
                    trigger: element,
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                }
            });
        });

        // Fade-in animations
        gsap.utils.toArray('.fade-in').forEach(element => {
            gsap.from(element, {
                opacity: 0,
                y: 30,
                duration: 1,
                scrollTrigger: {
                    trigger: element,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                }
            });
        });

        // Scale-in animations
        gsap.utils.toArray('.scale-in').forEach(element => {
            gsap.from(element, {
                scale: 0.8,
                opacity: 0,
                duration: 0.5,
                scrollTrigger: {
                    trigger: element,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                }
            });
        });

        // Stagger animations for cards
        gsap.utils.toArray('.feature-card').forEach((card, i) => {
            gsap.from(card, {
                y: 50,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                },
                delay: i * 0.2
            });
        });

        gsap.utils.toArray('.product-card').forEach((card, i) => {
            gsap.from(card, {
                y: 50,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                },
                delay: i * 0.1
            });
        });
    }
}

// Image lazy loading
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Initialize all functionality
document.addEventListener('DOMContentLoaded', function() {
    initGSAPAnimations();
    initLazyLoading();
}); 