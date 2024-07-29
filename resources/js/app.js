import './bootstrap';
import { createApp } from 'vue'
import PageBlocksEdit from './admin/page/BlocksEdit.vue';

const app = createApp({})
app.component('PageBlocksEdit', PageBlocksEdit)
app.mount('#post-form')
