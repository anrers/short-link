## Install project
- `cp .env.example .env`
- `cd src ; cp .env.example .env ; cd ..`
- `docker compose up -d --build`
- `docker compose exec -u main_user php composer i`
- `docker compose exec -u main_user php php artisan migrate`
- `docker compose exec -u main_user php php artisan db:seed`

### swagger: http://localhost:83/swagger