import '@fontsource-variable/jost';

const animateElements = () => {
    const elements = document.querySelectorAll('[data-animate]');

    elements.forEach(element => element.classList.add('animate-on-scroll'))

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
