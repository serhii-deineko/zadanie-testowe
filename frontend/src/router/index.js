"use strict";

import { route } from "quasar/wrappers";
import { createRouter, createWebHistory } from "vue-router";

export default route(() => {
    const router = createRouter({
        history: createWebHistory(process.env.VUE_ROUTER_BASE),
        routes: [
            {
                path: "/",
                name: "Welcome",
                component: () => import("src/pages/Welcome.vue"),
            },
            {
                path: "/create-account",
                name: "CreateNewAccount",
                component: () => import("src/pages/auth/CreateNewAccount.vue"),
            },
            {
                path: "/login",
                name: "UserLogin",
                component: () => import("src/pages/auth/UserLogin.vue"),
            },
            {
                path: "/settings",
                name: "UserProfile",
                component: () => import("src/pages/auth/UserProfile.vue"),
            },
            {
                path: "/dashboard",
                name: "Dashboard",
                component: () => import("src/pages/user/Dashboard.vue"),
            },
            {
                path: "/:catchAll(.*)*",
                component: () => import("pages/ErrorNotFound.vue"),
            },
        ],
    });

    return router;
});
