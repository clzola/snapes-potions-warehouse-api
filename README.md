<p align="center"><img src="./logo.png" width="128"></p>

## Snape's Potions Warehouse

Professor Snape, a Hogwarts teachers, needs help with organizing his potions warehouse.
He needs a web application where he will be able to track information regarding amount of ingredients and
potions in his warehouse. Also application needs to store recipe for each potion.  
  
Note: This is only back-end part of the application. To see frontend follow this [link](https://github.com/clzola/snapes-potions-warehouse-admin). 

### Deployment

1. Clone repository
2. Run `composer install`
3. Create `.env` file (see `.env.example`)
4. Run `php artisan key:generate` to generate application key
5. Run `php artisan jwt:secret` to generate jwt secret key
6. Run `php artisan storage:link` to create symbolic link from "public/storage" to "storage/app/public"
7. Run `php artisan migrate` to create database
8. Run `php artisan config:cache` to create a cache file for faster configuration loading
9. Run `php artisan route:cache` to create a route cache file for faster route registration
