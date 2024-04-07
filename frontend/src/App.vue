<template>
    <div id="app-wrapper">
        <div id="app-design"></div>
        <q-layout view="hhh LpR fff">
            <!-- Header Top -->
            <q-header reveal elevated height-hint="98">
                <q-toolbar>
                    <q-btn v-if="$user.access" @click="$drawerLeft.value = !$drawerLeft.value" flat dense round icon="menu" aria-label="Menu" />
                    <q-toolbar-title class="text-h6"> Zadanie Testowe </q-toolbar-title>

                    <FeaturesUser v-if="$user.access" @logoutUser="logoutUser()" />
                    <FeaturesGuest v-else @authUser="authUser()" />
                </q-toolbar>
            </q-header>

            <!-- Content -->
            <q-page-container id="app-content">
                <router-view @authorize="() => authUser()" @removeSession="() => removeSession()" class="q-pt-lg" />
            </q-page-container>
        </q-layout>
    </div>
</template>

<script>
import FeaturesGuest from "src/pages/layout/FeaturesGuest.vue";
import FeaturesUser from "src/pages/layout/FeaturesUser.vue";

export default {
    name: "App",
    components: {
        FeaturesGuest,
        FeaturesUser,
    },

    data() {
        return {
            loading: false,
            activeLink: "/",
        };
    },

    watch: {
        $route: function (to) {
            this.activeLink = to.path;
        },
    },

    methods: {
        async authUser() {
            try {
                this.$toast.load();
                // Check Session Storage
                // Bearer Token - OAuth2
                this.$user.setSession();
                const response = await this.$axios.get("/auth");
                this.$user.setUser(response.data);
                this.$toast.success("Session started");
                this.$router.push("/dashboard");
            } catch (error) {
                this.$router.push("/login");
                if (error.response) {
                    this.removeSession();
                    this.$toast.error(error.response);
                }
            } finally {
                this.$toast.done();
            }
        },

        async logoutUser() {
            try {
                this.$toast.load();
                const response = await this.$axios.post("/logout");
                this.$toast.success(response.data.message);
                this.removeSession();
            } catch (error) {
                this.$toast.error(error.response ? error.response : error);
            } finally {
                this.$toast.done();
            }
        },

        removeSession() {
            this.$user.removeToken();
            this.$user.removeSession(this.$env.SESSION_NAME);
            this.$router.push("/");
        },
    },
};
</script>
