# Setup

## Initialization

-   npm install
-   setup .env file

## Architecture

-   quasar (framework)
-   vue-router (spa-approach)
-   apis (axios-request)
-   store (pinia)
-   modules (static classes)
    -   globals.js
    -   response.js (this.$toast. | load() | success(Str) | error( Obj., Str))

## Structure

-   src/App.vue, application initialization
-   src/router
    -   index.js, setup routes
-   src/store
    -   index.js, initialization of Pinia
    -   user.js, manage userinterface
-   src/modules
    -   globals.js
    -   response.js
-   src/boot
    -   default.js, setup projectattributes
    -   axios.js, setup requesthandling
