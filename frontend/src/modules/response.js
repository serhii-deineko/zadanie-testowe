"use strict";
import { Loading, QSpinnerGears, Notify } from "quasar";
import { userStore } from "src/stores/user";

export class ResponseHandler {
    constructor(router, app) {
        this.loading = false;
        this.app = app;
        this.message = "";
        this.router = router;
        this.progressBar = null;
        this.notify = null;
        this.position = "bottom-right";
        this.durationSuccess = 1900;
        this.durationError = 3400;
        this.class = "toaster-container";
        this.defaultLoadMessage = "Processing...";
        this.defaultSuccessMessage = "Your settings have been saved.";
        this.defaultErrorMessage = "Ops, some error occured.";
    }

    showNotify(message, type, duration) {
        this.notify = Notify.create({
            position: this.position,
            type: type,
            message: message,
            timeout: duration,
            classes: this.class,
        });
    }

    load() {
        this.loading = true;
        Loading.show({
            boxClass: "page-loading-block",
            spinner: QSpinnerGears,
            message: "Loading data. Please wait...",
        });
        return true;
    }

    done() {
        this.loading = false;
        Loading.hide();
        return false;
    }

    success(successMessage = this.defaultSuccessMessage) {
        this.loading = false;
        this.done();
        if (this.notify) this.notify();
        this.showNotify(successMessage, "positive", this.durationSuccess);
        return successMessage;
    }

    error(responseError) {
        try {
            this.loading = false;
            this.done();
            if (typeof responseError === "string") this.message = responseError;
            else if (typeof responseError === "object") {
                // Serverside
                if (responseError.data) {
                    this.errorHandling(responseError, this.router);
                    this.message = responseError.data.message ? responseError.data.message : responseError.status ? responseError.status : this.defaultErrorMessage;
                } else if (responseError.message) {
                    // Clientside
                    this.message = responseError.message;
                }
            }
        } catch (error) {
            this.message = error.message ? error.message : error; // Only Client or Custom Message
        } finally {
            try {
                if (this.notify) this.notify();
                this.showNotify(this.message, "negative", this.durationError);
            } catch (error) {
                console.log("Toast_Notification_Error", error);
            }
        }
        console.log("Error Response:", this.message);
        return this.message;
    }

    errorHandling(serverResponse, router) {
        // Not authenticated
        if (serverResponse.status === 401) {
            userStore().removeSession();
            router.push("/login");
            throw serverResponse.data.message ? serverResponse.data.message : "Hmm, some error occured. Please try again.";
        } else if (serverResponse.status === 422) {
            router.push("/");
        }
    }
}
