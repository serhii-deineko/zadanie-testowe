<template>
    <q-scroll-area class="fit">
        <q-list padding>
            <!-- Dashboard -->
            <q-item @click="$router.push('/dashboard')" clickable v-ripple>
                <q-item-section avatar>
                    <q-icon name="dashboard" />
                </q-item-section>
                <q-item-section> Dashboard </q-item-section>
            </q-item>

            <!-- Dashboard -->
            <q-item @click="$router.push('/settings')" clickable v-ripple>
                <q-item-section avatar>
                    <q-icon name="settings" />
                </q-item-section>
                <q-item-section> Settings </q-item-section>
            </q-item>
        </q-list>
    </q-scroll-area>
</template>

<script>
export default {
    name: "NavigationLabelDashboard",
};
</script>
