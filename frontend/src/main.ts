import { createApp } from "vue";
import App from "./App.vue";
import "./style.css";

// router
import { createRouter, createWebHistory } from "vue-router";
import About from "./pages/About.vue";
import Home from "./pages/Home.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      component: Home,
    },
    {
      path: "/about",
      component: About,
    },
  ],
});

createApp(App).use(router).mount("#app");
