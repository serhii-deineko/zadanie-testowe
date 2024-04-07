<template>
    <PageWrapper leftDrawer>
        <template #leftDrawer>
            <NavigationUser />
        </template>

        <div class="flex justify-center q-mt-md w-100">
            <!-- Credentials -->
            <CardWrapper class="q-ma-sm" title="Credentials">
                <p><b>ID:</b>&nbsp;{{ $user.user.id }}</p>
                <p><b>Email:</b>&nbsp;{{ $user.user.email }}</p>
            </CardWrapper>

            <!-- Reset Password -->
            <CardWrapper class="q-ma-sm" title="Reset Password">
                <FormWrapper buttonText="Change password" buttonIcon="lock" @submit="submitPassword(password.current, password.new, password.confirm)">
                    <q-input filled type="password" v-model="password.current" label="Confirm current password" />
                    <div>
                        <q-input filled type="password" v-model="password.new" label="Enter new password" />
                        <q-input filled type="password" v-model="password.confirm" label="Confirm new password" />
                    </div>
                </FormWrapper>
            </CardWrapper>

            <!-- Delete Account -->
            <CardWrapper title="Delete Account" class="q-ma-sm">
                <FormWrapper buttonText="Delete account" buttonIcon="delete" buttonColor="red" @submit="deleteAccount()">
                    <q-input filled type="password" v-model="deletePassword" label="Confirm by password" />
                </FormWrapper>
            </CardWrapper>
        </div>
    </PageWrapper>
</template>

<script>
import { ref } from "vue";
import NavigationUser from "src/pages/layout/NavigationUser.vue";
import PageWrapper from "components/PageWrapper.vue";
import CardWrapper from "components/CardWrapper.vue";
import FormWrapper from "components/FormWrapper.vue";

export default {
    name: "UserAccountSettings",
    components: {
        PageWrapper,
        CardWrapper,
        FormWrapper,
        NavigationUser,
    },

    emits: ["removeSession"],

    setup() {
        return {
            errorMessage: "",
            loading: ref(false),
        };
    },
    data() {
        return {
            password: {
                current: "",
                new: "",
                confirm: "",
            },
            deletePassword: "",
        };
    },
    methods: {
        async submitPassword(current, newPw, confirmed) {
            try {
                if (!current) throw "Please enter new password.";
                else if (!confirmed || newPw !== confirmed) throw "Password does not match.";
                this.$toast.load();
                const response = await this.$axios.post("user-change-password", {
                    password_current: current,
                    password: newPw,
                    password_confirmation: confirmed,
                });
                this.$toast.success(response.data.message);
            } catch (error) {
                this.$toast.error(error.response ? error.response : error);
            } finally {
                this.password.current = "";
                this.password.new = "";
                this.password.confirm = "";
            }
        },

        async deleteAccount() {
            try {
                if (!this.deletePassword) throw "Please enter password.";
                this.$toast.load();
                const response = await this.$axios.post("user-delete-account", {
                    password: this.deletePassword,
                });
                this.$toast.success(response.data.message);
                this.$emit("removeSession");
            } catch (error) {
                const errorMessage = error.response ? error.response : error;
                this.$toast.error(errorMessage);
            }
        },
    },
};
</script>
