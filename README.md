# TechGear

<blockquote>
  TechGear is an Ecommerce website that sells electronics and gadgets. This project is built using Alpine JS and Tailwind CSS on top of Laravel. You can visit the live status of the site https://www.techgear.studio/.
</blockquote>
  
<p>
  <img src="https://github.com/lenard123/techgear/workflows/Deployment/badge.svg" />
</p>

## Tools Needed
- PHP (v8.0 or higher)
- MySQL (or MariaDB)
- Composer
- Git
- NPM (optional: use for frontend development)
- Text Editor (e.g. VSCode, Sublime Text)

## How to Setup
1. run `git clone https://github.com/lenard123/techgear`
2. run `cd techgear`
3. run `composer install`
4. run `cp .env.example .env` or `copy .env.example .env`
5. Open the .env file and setup your database connection
6. run `php artisan key:generate`
7. run `php artisan storage:link`
8. run `php artisan migrate:fresh --seed`
9. finally run `php artisan serve`

<p>If you have any questions regarding the installation; You can post it <a href='https://github.com/lenard123/techgear/discussions/categories/q-a'>here</a>.</p>


## Contributors

<a href="https://github.com/lenard123/techgear/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=lenard123/techgear" />
</a>
