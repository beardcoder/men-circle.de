import '@fontsource-variable/jost';

const animateElements = () => {
    const elements = document.querySelectorAll('[data-animate]');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.1,
        },
    );

    elements.forEach((element) => {
        observer.observe(element);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    animateElements();
});

document.addEventListener('turbo:load', () => {
    animateElements();
});
