## Vehicle Buy

Key components
- Laravel 10
- php 8.1
- composer 2.6.5
- inertia/react
- sail
- breeze
- vite
- node v18.16.0
- npm 9.5.1

This application was developed on WSL2 Ubuntu.

Installation
- Clone/unzip files on webserver
- navigate to the newly created root folder and run the following commands in bash:
- ./vendor/bin/sail up (this will take a few minutes the first time as theres quite a bit to pull)
- ./vendor/bin/sail php artisan migrate
- ./vendor/bin/sail php artisan db:seed
- npm run dev

You should now be able to navigate to localhost to access the site index.

From there you can use the top navigation to select a vehicle category, Cars or Vans, to begin browing the vehicles.
They are presented in paginated chunks of 5 and can be filtered and/or ordered using the options presented. 
Clicking on the randonly seeded names will open a modal with more details.
  
