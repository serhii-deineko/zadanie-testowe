<template>
    <PageWrapper title="Dashboard" leftDrawer>
        <template #leftDrawer>
            <NavigationUser />
        </template>

        <!-- PDF Generator -->
        <div class="flex justify-center q-mt-md w-100">
            <CardWrapper title="PDF Generator (+ QR Code)" class="q-ma-sm">
                <FormWrapper buttonText="Create" buttonIcon="add" @submit="submitPDF(text, link)">
                    <q-input v-model="text" type="text" label="Enter your text" filled autogrow />
                    <q-input v-model="link" type="text" label="QR code" filled />
                </FormWrapper>
            </CardWrapper>
        </div>

        <!-- PDF preview -->
        <q-dialog v-model="showDialog">
            <q-card-section class="row no-wrap items-start">
                <q-card style="height: 80vh; width: 80vw">
                    <iframe :src="pdfUrl" frameborder="0" width="100%" height="100%"></iframe>
                </q-card>
                <q-btn class="q-ml-md" icon="close" color="white" text-color="black" unelevated round dense v-close-popup />
            </q-card-section>
        </q-dialog>
    </PageWrapper>
</template>

<script>
import NavigationUser from "src/pages/layout/NavigationUser.vue";
import PageWrapper from "components/PageWrapper.vue";
import CardWrapper from "components/CardWrapper.vue";
import FormWrapper from "components/FormWrapper.vue";

export default {
    name: "DashboardPage",

    components: {
        NavigationUser,
        PageWrapper,
        CardWrapper,
        FormWrapper,
    },

    data() {
        return {
            text: "",
            link: "https://hrpanorama.pl/",
            size: 14,
            showDialog: false,
            pdfUrl: "",
        };
    },

    methods: {
        async submitPDF(text, link) {
            try {
                // Display loading toast
                this.$toast.load();

                if (!this.text) throw new Error("You need to enter the text");

                // Generate PDF and get response
                const response = await this.$axios.post("/create-pdf", {
                    text: text,
                    link: link,
                });

                // Set pdfUrl and show the dialog
                if (response.data?.pdfUrl) {
                    this.pdfUrl = response.data.pdfUrl;
                    this.showDialog = true;

                    // Display success toast
                    this.$toast.success("PDF generated successfully");
                } else {
                    throw new Error("PDF URL not found in response");
                }
            } catch (error) {
                this.$toast.error(error.response ? error.response : error);
            } finally {
                // Reset form fields
                this.text = "";
                this.link = "https://hrpanorama.pl/";
            }
        },
    },
};
</script>
