<template>
    <q-card
        bordered
        :style="{
            width: '100%',
            maxWidth: '420px',
        }">
        <!-- Actions -->
        <q-card-section v-if="allowActions" horizontal>
            <slot name="head" />
            <q-card-actions class="justify-around" vertical>
                <slot name="actions" />
            </q-card-actions>
        </q-card-section>

        <!-- Card Content -->
        <q-card-section v-if="title">
            <!-- Navigation: Go back -->
            <div class="flex items-center _overflow-hidden">
                <q-btn v-if="goBack" @click="goBack ? $router.go(-1) : ''" class="q-mr-sm" flat round text-color="primary" :icon="goBack ? 'arrow_back' : 'arrow_right'" />
                <p class="q-ma-none text-h6">{{ title }}</p>
            </div>

            <!-- Description -->
            <p v-if="subtitle" class="q-ml-sm q-mr-sm text-caption">{{ subtitle }}</p>

            <!-- Header Icon -->
            <q-separator v-if="iconHeader" class="q-mt-md q-mb-lg" />
            <div v-if="iconHeader" class="flex justify-center">
                <q-icon :name="iconHeader" color="primary" size="150px" />
            </div>

            <div v-if="title">
                <!-- Body -->
                <q-separator class="q-mt-md q-mb-lg" />
                <slot />
                <slot name="bottom_slot" />

                <!-- Note -->
                <p class="text-caption q-ml-sm q-mr-sm">
                    <em>{{ note }}</em>
                </p>
            </div>
        </q-card-section>
    </q-card>
</template>

<script>
export default {
    name: "PageWrapper",
    props: {
        goBack: Boolean,
        iconHeader: String,
        title: String,
        note: String,
        subtitle: String,
        allowActions: Boolean,
    },
};
</script>
