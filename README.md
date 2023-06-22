<img align="right" width="120" src="./public/img/logo.png">

# TechGear

<hr/>

<blockquote>
  TechGear is an Ecommerce website that sells electronics and gadgets. This project is built using Alpine JS and Tailwind CSS on top of Laravel. You can visit the live status of the site https://techgear.lenard123.me/.
</blockquote>
  
<p>
  <img src="https://github.com/lenard123/techgear/workflows/Deployment/badge.svg" />
</p>

## Demo

You can visit the site here https://techgear.lenard123.me/

```
Demo Accounts

xilovynu@mailinator.com
Pa$$w0rd!

foqucub@mailinator.com
Pa$$w0rd!

# Admin Acount
admin@gmail.com
Pa$$w0rd!
```

## Tools Needed
- PHP (v8.0 or higher)
- MySQL (or MariaDB)
- Composer
- Git
- NPM (optional: use for frontend development)
- Text Editor (e.g. VSCode, Sublime Text)

## How to Setup
```shell
# First Clone the project (Git Required)
git clone https://github.com/lenard123/techgear

# Navigate to the project directory
cd techgear

# Install PHP Dependencies using composer
composer install

# Copy .env.example to .env
# (Windows)
copy .env.example .env

# (On Linux)
cp .env.example .env

# Before you proceed to the next
# configure your database first
# in the .env file

# Generate Application key
php artisan key:generate

# Link storage
php artisan storage:link

# Run database migration
#   this command will automatically import
#   the database tables and default data
php artisan migrate:fresh --seed

# Finally, you can now serve the application
php artisan serve

# You can now view the system on http://localhost:8000
```

<p>If you have any questions regarding the installation; You can post it <a href='https://github.com/lenard123/techgear/discussions/categories/q-a'>here</a>.</p>


## Contributors

<a href="https://github.com/lenard123/techgear/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=lenard123/techgear" />
</a>
