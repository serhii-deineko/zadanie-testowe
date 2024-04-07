# Initialization

-   php artisan --version
-   composer install
-   create .env file
-   setup .env file

## Migrage Database

-   php artisan migrate
-   php artisan passport:install --force
-   Enter Client Secrets in .env File

## Seed First User

-   php artisan db:seed --class=UserSeeder

## Storage

-   php artisan storage:link

## Login

-   Usercredits: admin@admin.com
-   Password: admin

# System Requirements

## System Modules

-   User Management
    -   Registration
    -   User
        -   Login + Auth
            -   Logout
        -   User Profile
            -   Change Password
            -   Delete Account

## Environment

-   API-Testing: Postman
-   Backend: Laravel 10
-   FrontEnd: -
-   Database: PSQL & PGADMIN4
-   Auth: Laravel Passport (Oauth 2.0)
-   Storage: Public Disk

### Hosts

-   Github: Code Management
-   Localhost: GCP
