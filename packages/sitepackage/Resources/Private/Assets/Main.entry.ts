import './Main.entry.css';
import 'aos/dist/aos.css';
import '@fontsource-variable/jost';

//@ts-ignore
import AOS from 'aos';

function init() {
    AOS.init({ once: true });
}

document.addEventListener('DOMContentLoaded', () => {
    init();
});

document.addEventListener('turbo:load', () => {
    init();
});
