import.meta.glob([
    '../images/**',
    '../fonts/**',
]);
import PhosphorIcons from "@phosphor-icons/vue"
import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './components/App.vue';
import StartPage from './components/StartPage.vue';
import PostPage from './components/PostPage.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: StartPage },
        { path: '/post-page', component: PostPage },
    ]
});

let app = createApp(App)
app.use(router);
app.use(PhosphorIcons);
app.mount('#app')
