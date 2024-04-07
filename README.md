# System Overview

Zadanie Testowe - 07.04.2024

-   by Serhii Deineko

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
    -   composer v.2.4.1
    -   postgresql, pgadmin4
-   node.js 18.7 (frontend)

## Frameworks

-   backend:
    -   Laravel 10
        -   Auth: Laravel Passport
-   frontend:
    -   Quasar 2.15.2
        -   VueJS Framework
    -   Axios
    -   Pinia
