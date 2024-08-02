import './Main.entry.css';
import '@fontsource-variable/jost';

//@ts-ignore
import AOS from 'simple-aos';
import Ukiyo from 'ukiyojs';

import('flowbite').then(({ initFlowbite }) => {
    initFlowbite();
});

function init() {
    new Ukiyo('.parallax', {
        willChange: true,
        scale: 1.2,
        speed: 1.2,
    });

    AOS.init({ once: true });
}

document.addEventListener('DOMContentLoaded', () => {
    init();
});

document.addEventListener('turbo:load', () => {
    init();
});
