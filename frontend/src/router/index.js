import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name:'pokemon.index',
        component: () => import("../views/pokemon/Index.vue")
    },
    {
        path: '/favorite',
        name:'pokemon.favorite',
        component: () => import("../views/pokemon/Favorite.vue")
    },
    {
        path: '/detail/:id',
        name:'pokemon.detail',
        component: () => import("../views/pokemon/Detail.vue")
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;