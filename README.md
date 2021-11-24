# Notion Laravel Blog

## Pre-requisites

    - Docker

## install

- Execute docker-compose up --build to create and run the container
- Execute docker exec -it notion_blog_1
- Execute inside the container php artisan migrate --seed
- In order to run manually the cronJob you may need to execute php artisan posts:import
