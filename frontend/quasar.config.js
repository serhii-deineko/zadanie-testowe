/* eslint-env node */
const { configure } = require("quasar/wrappers");

module.exports = configure(() => {
    return {
        eslint: {
            warnings: true,
            errors: true,
        },

        boot: ["defaults", "axios"],

        css: ["app.scss"],

        extras: ["roboto-font", "material-icons"],

        build: {
            env: require("dotenv").config().parsed,
            target: {
                browser: ["es2019", "edge88", "firefox78", "chrome87", "safari13.1"],
                node: "node16",
            },
            vueRouterMode: "hash",
        },

        devServer: {
            // https: true,
            open: true,
        },

        framework: {
            plugins: ["Notify", "Loading", "Dialog"],
        },

        animations: ["bounceInLeft", "bounceOutRight"],

        ssr: {
            pwa: false,
            prodPort: 3000,
            middlewares: ["render"],
        },

        pwa: {
            workboxMode: "generateSW",
            injectPwaMetaTags: true,
            swFilename: "sw.js",
            manifestFilename: "manifest.json",
            useCredentialsForManifestTag: false,
        },

        capacitor: {
            hideSplashscreen: false,
        },

        electron: {
            inspectPort: 5858,
            bundler: "packager",
            builder: {
                appId: "bumatools",
            },
        },

        bex: {
            contentScripts: ["my-content-script"],
        },
    };
});
