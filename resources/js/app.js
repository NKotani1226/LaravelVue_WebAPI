import './bootstrap';
import { createApp, h } from 'vue';
import App from './components/App.vue';
import Notion from './components/Notion.vue';

createApp(App).mount('#app');
createApp(Notion).mount("#notion");

// コンポーネントのマッピング
const components = [
    {
        id: "notion",
        component: Notion,
    }
    // 新しいコンポーネントが必要な場合はここに追加
];

// コンポーネントを動的にマウントする関数
const mountComponent = ({ id, component }) => {
    const element = document.getElementById(id);
    if (element) {
        const props = element.getAttribute("data-props");
        const parsedProps = props ? JSON.parse(props) : {};
        const app = createApp({
            render: () => h(component, { data: parsedProps }),
        });
        app.mount(`#${id}`);
    }
};

// 各コンポーネントをループで処理
components.forEach(mountComponent);