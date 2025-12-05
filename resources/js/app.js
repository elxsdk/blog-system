import "./bootstrap";
import { initDropdowns, initModals } from "flowbite";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Initialize Flowbite components after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initDropdowns();
    initModals();
});
