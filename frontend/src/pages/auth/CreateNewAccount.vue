<template>
    <PageWrapper class="q-mt-lg">
        <CardWrapper :goBack="true" title="Create account" iconHeader="person_add">
            <!-- Registration -->
            <FormWrapper buttonText="Create account" @submit="registerUser(user.email, user.password)">
                <!-- Email -->
                <q-input filled type="email" v-model="user.email" label="Email">
                    <template v-slot:prepend>
                        <q-icon name="mail" />
                    </template>
                </q-input>

                <!-- Password -->
                <q-input filled type="password" v-model="user.password" label="Password">
                    <template v-slot:prepend>
                        <q-icon name="lock" />
                    </template>
                </q-input>
            </FormWrapper>
        </CardWrapper>
    </PageWrapper>
</template>

<script>
import { ref } from "vue";
import PageWrapper from "components/PageWrapper.vue";
import CardWrapper from "components/CardWrapper.vue";
import FormWrapper from "components/FormWrapper.vue";
import { regRules, passwordRequirements } from "src/modules/globals.js";

export default {
    name: "CreateNewAccount",
    components: {
        PageWrapper,
        CardWrapper,
        FormWrapper,
    },
    setup() {
        return {
            regRulesEmail: regRules.email,
            loading: ref(false),
        };
    },
    data() {
        return {
            user: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        async registerUser(email, password) {
            try {
                // Validate
                const passwordCheck = passwordRequirements(password);
                if (passwordCheck) throw passwordCheck;
                else if (!this.regRulesEmail.test(email)) throw "No valid email.";

                // Create User
                this.$toast.load();
                const response = await this.$axios.post("/create-account", {
                    email: email,
                    password: password,
                });
                this.$toast.success(response.data.message);
                this.$router.push("/login");
            } catch (error) {
                this.$toast.error(error.response ? error.response : error);
            } finally {
                this.$toast.done();
            }
        },
    },
};
</script>
