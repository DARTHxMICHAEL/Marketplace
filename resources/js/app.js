import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// VUE.JS import 

import { createApp } from 'vue'
import AddOfferModal from './components/AddOfferModal.vue'

const app = createApp({})
app.component('add-offer-modal', AddOfferModal)
app.mount('#app')
