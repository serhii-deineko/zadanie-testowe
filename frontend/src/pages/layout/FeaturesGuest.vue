<template>
    <div>
        <q-toolbar class="q-pa-md">
            <!-- User Profile -->
            <div class="flex justify-end">
                <q-btn @click="$emit('authUser')" flat icon="login" label="Log In" />
            </div>
        </q-toolbar>
    </div>
</template>

<script>
export default {
    name: "FeaturesGuests",
    emits: ["authUser"],

    data() {
        return {
            activeLink: "/",
        };
    },

    watch: {
        $route: function (to) {
            this.activeLink = to.path;
        },
    },
};
</script>
