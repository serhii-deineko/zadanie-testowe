<template>
    <div>
        <q-toolbar class="q-pa-md">
            <!-- User Account -->
            <div class="flex justify-end">
                <q-item clickable v-ripple>
                    <q-item-section class="text-h6">Account</q-item-section>
                    <!-- Dropdown -->
                    <q-menu class="q-pa-md column">
                        <q-btn @click="$emit('logoutUser')" class="btn-fixed-width" icon="logout" color="primary" label="Logout" flat />
                    </q-menu>
                </q-item>
            </div>
        </q-toolbar>
    </div>
</template>

<script>
export default {
    name: "FeaturesUser",
    emits: ["logoutUser"],
};
</script>
