# System Overview

Zadanie Testowe - 07.04.2024

-   by Serhii Deineko <serhii.deineko@gmail.com>

## Security / Dependencies Check

-   go "/frontend":
    -   npm audit
    -   npm audit fix --force
-   go "/backend":
    -   composer outdated
    -   composer update

## Folder Structure

-   backend
    -   see Readme.md
-   frontend
    -   see Readme.md

# System Requirements

## Environment

-   php 8.2 (backend)
    -   composer 2.4.1
    -   postgresql, pgadmin4
-   node.js 18.7 (frontend)
    -   vite 1.8.0

## Frameworks

-   backend:
    -   Laravel 10
        -   Auth: Laravel Passport
-   frontend:
    -   Quasar 2.15.2
        -   VueJS 3.4.21
    -   Axios
    -   Pinia
