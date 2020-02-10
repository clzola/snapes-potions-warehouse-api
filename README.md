<p align="center"><img src="./logo.png" width="128"></p>

## Snape's Potions Warehouse

This is a hobby project. Idea is that Snape (a Hogwarts teacher) needs help with his potions.  
He needs an application where he will track ingredients, potions and recipes he has in his warehouse along
with additional information.

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
