/**
 * EP Restore Theme JavaScript
 */

(function() {
    'use strict';
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Add active class to header on scroll
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
    
    // Form validation enhancement
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const phone = this.querySelector('input[name="phone"]');
            const privacy = this.querySelector('input[name="privacy"]');
            
            if (phone && !phone.value.match(/[0-9()#+*\-=.]+/)) {
                e.preventDefault();
                alert('Bitte geben Sie eine gültige Telefonnummer ein.');
                phone.focus();
                return false;
            }
            
            if (privacy && !privacy.checked) {
                e.preventDefault();
                alert('Bitte akzeptieren Sie die Datenschutzbestimmungen.');
                privacy.focus();
                return false;
            }
        });
    }
    
})();
