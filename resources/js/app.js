import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import Notion from './components/Notion.vue';

createApp(App).mount('#app');
createApp(Notion).mount("#notion");