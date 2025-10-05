import './bootstrap';
import '../css/custom.css';

// import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'

Alpine.plugin(collapse)
Alpine.plugin(focus)

window.Alpine = Alpine;
// Alpine.start();
