<template>
    <PageWrapper class="q-mt-lg">
        <CardWrapper title="Log In" iconHeader="account_circle" goBack>
            <!-- Auth -->
            <FormWrapper @submit="loginUser(login.email, login.password)" buttonText="Login">
                <!-- Email -->
                <q-input filled type="email" v-model="login.email" label="Enter email" />
                <!-- Password -->
                <q-input filled type="password" v-model="login.password" label="Enter password" />
            </FormWrapper>

            <div class="row">
                <q-btn @click="$router.push('create-account')" flat class="col-12 q-pa-md" label="Create an account" />
            </div>
        </CardWrapper>
    </PageWrapper>
</template>

<script>
import PageWrapper from "components/PageWrapper.vue";
import CardWrapper from "components/CardWrapper.vue";
import FormWrapper from "components/FormWrapper.vue";

export default {
    name: "UserLogin",
    components: {
        PageWrapper,
        CardWrapper,
        FormWrapper,
    },

    emits: ["authorize"],

    data() {
        return {
            login: {
                email: "",
                password: "",
            },
        };
    },

    methods: {
        async loginUser(email, password) {
            try {
                if (!password || !email) throw "Please enter credentials.";
                this.$toast.load();
                const response = await this.$axios.post("/login", {
                    email: this.login.email,
                    password: this.login.password,
                });

                // Login
                this.$user.setToken(response.data.token);
                this.$emit("authorize");
            } catch (error) {
                // Wrong Credentials
                this.$toast.error(error.response ? error.response : error);
            } finally {
                this.login.password = "";
            }
        },
    },
};
</script>
