1. Set up env variables (APP, DB, APP_MODE, ADMIN_PASSWORD)

2. Install php, extensions and composer (sudo bash php-installer.sh in script folder)

3. Create directories (sudo bash set-directories.sh in script folder)

3. Create db, migrate tables and seed data (php artisan install:app)

HINT: Step 2,3,4 can be run all at once running sudo bash setup.sh