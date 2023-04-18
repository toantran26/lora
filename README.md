## Guide install
Install the related dependencies run command line:
```bash
composer install
```
Next run command the under to generate  ```.env ``` file:
```bash
copy .env.example .env
```
Then, To generate key for project run command:
```bash
php artisan key:generate
```
And config environment in ```.env``` file:
```bash
APP_NAME="${project_name}"
APP_ENV=${environment}
APP_DEBUG=true
APP_URL=${domain}
```
In there:
- `APP_ENV` setup environment of project, it has the following values:
    - `local` environment location for developer.
    - `dev` environment for mode development (prepare to production).
    - `production` environment forproduction
    - `test` environment used to mode testing.
- `APP_DEBUG` setup debug
- `APP_URL` setup base url of project.
Next to, please run command the under to create database:
```bash
php artisan migrate
```
And finally, please run this command to create data test
```bash
php artisan db:seed --class=PermissionsSeeder
```
### Maintaince
Switch system to maintenance mode run command:
```bash
php artisan down
```
Maintenance mode with content:
```bash
php artisan down --message="Upgrading Database" --retry=60
```
Ban ip access system:
```bash
php artisan down --allow=127.0.0.1 --allow=192.168.0.0/16
```
### Configuration
Remove cache
```bash
php artisan cache:clear
```
Remove config cache
```bash
php artisan config:clear
```
## Author
Minh HVM - hoangminh99vp@gmail.com
