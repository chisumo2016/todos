# REDIRECT USERS AND ADMINS TO  DIFFERENT PAGE .
    https://laratrust.santigarcor.me/
    - Using Laratrust
    - Register a new user
    - User  can login , will be redirected  to the dashboard page
    - User can broowsse to Todos -CRUD
    - We want the register user to be simple user, dont him to view the ToDoList Menu Item

    NB: Same login/register page and redirect to ddifferent route
        Admin and User 
            /adminDashboard
            /Userashboard
        
# INSTALLATIION
        composer require santigarcor/laratrust
        php artisan vendor:publish --tag="laratrust"
        php artisan config:clear

        AADMIN PANNEL
        https://laratrust.santigarcor.me/docs/8.x/usage/admin-panel.html#how-to-use-it
            register' => true,
            php artisan vendor:publish --tag=laratrust-assets --force
            php artisan laratrust:setup

        Create  the Seeder
            https://laratrust.santigarcor.me/docs/8.x/usage/seeder.html#seeder-configuration-file
                php artisan laratrust:seeder
                php artisan vendor:publish --tag="laratrust-seeder"
                composer dump-autoload

        Open config/laratrust_seeder.php
            Set the roles and permissiion to our application

        Attachh roles and permission
            https://laratrust.santigarcor.me/docs/8.x/usage/roles-and-permissions.html#setting-things-up
            . Need to add the role to the user
                app/Http/Controllers/Auth/RegisteredUserController.php
        I wantt to show only for the user who caan create a todo lidt
            .cheeck if the current logged in can create a todo list
                            Show and Hide menu items for user with permission
                https://laratrust.santigarcor.me/docs/8.x/usage/roles-and-permissions.html#checking-for-roles-permissions
            . $user->hasPermission('edit-user'); 

        I  can't see the Menu but i can visit the route
