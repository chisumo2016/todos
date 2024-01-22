# REDIRECT USERS AND ADMINS TO  DIFFERENT PAGE .
    https://laratrust.santigarcor.me/
    - Using Laratrust
    - Register a new user
    - User  can login , will be redirected  to the dashboard page
    - User can broowsse to Todos -CRUD
    - We want the register user to be simple user, dont him to view the ToDoList Menu Item

   
        
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
                if (auth()->user()->hasPermission('todo.create'))
                {
                    $todos = Todo::where('user_id', auth()->id())->get();
        
                    return view('todos.index', compact('todos'));
                }else{
                    abort(404);
                }

# REDIRECT USERS AND ADMINS TO  DIFFERENT DASHBOARD  ROUTE   OR REDIRECT TO THE SAME 
         NB: Same login/register page and redirect to ddifferent route
        Admin and User 
            /adminDashboard
            /Userashboard


        Logged in user redirect to /dashboard butt show them different views(content)
        - By default every onne ttry to register will redirect to dashboard by default .
                http://todos-app.test/dashboard 
        - Comes from app/Providers/RouteServiceProvider.php
        - If someone is authenticated app/Http/Controllers/Auth/AuthenticatedSessionController.php
        - If the new user is registtered app/Http/Controllers/Auth/RegisteredUserController.php

        - Some modifiication has to be done once the user is registerd or logged in
                . open the user model
                             public function getRedirectRoute()
                            {
                                if ($this->hasRole('admin')){
                                    return 'adminDashboard';
                                }elseif ($this->hasRole('todolistuser')){
                                    return 'userdashboard';
                                }
                            }
        - Open the  app/Http/Controllers/Auth/AuthenticatedSessionController.php
            . in store method return redirect()->intended(Auth::user()->getRedirectRoute());
        - Open the  app/Http/Controllers/Auth/RegisteredUserController.php
            . in store method return return redirect(Auth::user()->getRedirectRoute());

        - Make the route  for admin and user dashbaord
                e.g
                Route::get('/userdashboard', function () {
                    return view('userdashboard');
                })->middleware(['auth', 'verified'])->name('userdashboard');

        - Make views for admin and user dashbaord
                resources/views/admindashboard.blade.php
                resources/views/userdashboard.blade.php

        TEST OUR AAPPLUCATIOMN
            .Register a new user
              http://todos-app.test/userdashboard
            .Log as admin 
                http://todos-app.test/admindashboard

        Make sure the addmin will see the admindashboard as user .The route wiill the same but different content
            .Row back all the  Rou
                return redirect()->intended(RouteServiceProvider::HOME);
            .They will  see the different content
                  Route::get('/dashboard', function () {
                    return view('dashboard');
                })->middleware(['auth', 'verified'])->name('dashboard');
            .For  that will uuse DashboardController
                     php artisan make:controller DashboardController
