// LaFatour - Main JavaScript File
// Using Alpine.js for reactive components

document.addEventListener('alpine:init', () => {
    // Mobile Menu Store
    Alpine.store('mobileMenu', {
        isOpen: false,
        toggle() {
            this.isOpen = !this.isOpen;
        },
        close() {
            this.isOpen = false;
        }
    });

    // Scroll Store
    Alpine.store('scroll', {
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 50;
            });
        }
    });

    // Modal Store
    Alpine.store('modal', {
        open: false,
        content: null,
        openModal(content) {
            this.content = content;
            this.open = true;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.open = false;
            this.content = null;
            document.body.style.overflow = '';
        }
    });

    // Toast Store
    Alpine.store('toast', {
        show: false,
        message: '',
        type: 'success',
        showNotification(message, type = 'success') {
            this.message = message;
            this.type = type;
            this.show = true;
            setTimeout(() => {
                this.show = false;
            }, 3000);
        }
    });

    // Package Filter Component
    Alpine.data('packageFilter', () => ({
        type: 'all',
        priceRange: [0, 100000000],
        duration: 'all',
        sortBy: 'latest',
        packages: [],

        init() {
            this.loadPackages();
        },

        async loadPackages() {
            // This would normally fetch from API
            // For now, just a placeholder
        },

        filterPackages() {
            return this.packages.filter(pkg => {
                if (this.type !== 'all' && pkg.type !== this.type) return false;
                if (pkg.price < this.priceRange[0] || pkg.price > this.priceRange[1]) return false;
                if (this.duration !== 'all' && pkg.duration !== this.duration) return false;
                return true;
            });
        }
    }));

    // Image Lightbox Component
    Alpine.data('lightbox', () => ({
        isOpen: false,
        currentImage: null,
        images: [],

        open(index, allImages) {
            this.images = allImages;
            this.currentImage = index;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },

        close() {
            this.isOpen = false;
            document.body.style.overflow = '';
        },

        next() {
            this.currentImage = (this.currentImage + 1) % this.images.length;
        },

        prev() {
            this.currentImage = (this.currentImage - 1 + this.images.length) % this.images.length;
        }
    }));

    // FAQ Accordion Component
    Alpine.data('faq', () => ({
        openItems: [],

        toggle(index) {
            if (this.openItems.includes(index)) {
                this.openItems = this.openItems.filter(i => i !== index);
            } else {
                this.openItems.push(index);
            }
        },

        isOpen(index) {
            return this.openItems.includes(index);
        }
    }));

    // Booking Form Wizard Component
    Alpine.data('bookingWizard', () => ({
        currentStep: 1,
        totalSteps: 5,
        formData: {
            package: '',
            personalInfo: {},
            documents: {},
            payment: {}
        },

        nextStep() {
            if (this.validateStep(this.currentStep)) {
                this.currentStep++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },

        validateStep(step) {
            // Validate current step before proceeding
            return true;
        },

        async submitBooking() {
            // Submit booking data
            Alpine.store('toast').showNotification('Booking berhasil dikirim!', 'success');
        }
    }));

    // Counter Animation Component
    Alpine.data('counter', (target) => ({
        count: 0,
        target: target,
        duration: 2000,

        init() {
            this.animate();
        },

        animate() {
            const startTime = performance.now();
            const animateCount = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / this.duration, 1);
                const easeOut = 1 - Math.pow(1 - progress, 3);
                this.count = Math.floor(this.target * easeOut);

                if (progress < 1) {
                    requestAnimationFrame(animateCount);
                } else {
                    this.count = this.target;
                }
            };
            requestAnimationFrame(animateCount);
        }
    }));

    // Scroll Reveal Component
    Alpine.data('scrollReveal', () => ({
        visible: false,

        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.visible = true;
                    }
                });
            }, { threshold: 0.1 });

            observer.observe(this.$el);
        }
    }));
});

// Utility functions
const utils = {
    formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    },

    formatDate(date) {
        return new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }).format(new Date(date));
    },

    formatDateRange(startDate, endDate) {
        const start = new Intl.DateTimeFormat('id-ID', {
            day: 'numeric',
            month: 'short'
        }).format(new Date(startDate));
        const end = new Intl.DateTimeFormat('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        }).format(new Date(endDate));
        return `${start} - ${end}`;
    },

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Alpine.store('toast').showNotification('Berhasil disalin!', 'success');
        });
    }
};

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // Add active class to current nav item
    const currentPath = window.location.pathname;
    document.querySelectorAll('nav a').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('text-primary-600');
        }
    });
});

// Export for use in inline scripts
window.LaFatour = {
    utils
};
