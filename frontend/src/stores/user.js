"use strict";

import { defineStore } from "pinia";
import { LocalStorage } from "quasar";
import axios from "axios";

export const userStore = defineStore("user", {
    state: () => {
        return {
            access: false,
            user: {
                id: 0,
                email: "",
            },
        };
    },
    actions: {
        setUser(user) {
            this.user.id = user.id;
            this.user.email = user.email;
            this.access = true;
        },

        setToken(sessionToken) {
            LocalStorage.set(process.env.SESSION_NAME, sessionToken);
        },

        setSession() {
            const token = LocalStorage.getItem(process.env.SESSION_NAME);
            if (!token) throw "No token set.";
            axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        },

        removeToken() {
            LocalStorage.remove(process.env.SESSION_NAME);
        },

        removeSession() {
            axios.defaults.headers.common["Authorization"] = "";
            this.access = false;
            this.user = {
                id: 0,
                email: "",
            };
        },
    },
    persist: true,
});
