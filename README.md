# test.system
### Система тестирования, поддерживающая вопросы с нечеткой логикой и возможностью выбора нескольких вариантов ответа

#### 1. Инициализация БД (перенос БД на хост систему и создание пользователя БД с привилегированными правами)

1. Для Linux
   -  из корня проекта выполнить: `make init-db`
2. Для Windows
    - выполнить первоначальный запуск контейнеров 
       ```shell
      docker compose up -d
      ```
    - создать БД и пользователя БД с привилегированными правами:

   ```shell
   # Заходим в запущенный контейнер пользователем postgres
   docker exec -it -u postgres ts-db bash psql

   # Выполняем SQL
   psql
   CREATE USER ts_dba WITH ENCRYPTED PASSWORD 'ts_dba';
   CREATE DATABASE ts;
   GRANT ALL PRIVILEGES ON DATABASE ts TO ts_dba;
   \q

   # Выходим из контейнера
   exit
   ````

3. Запуск сервисов в контейнерах

   Из корня проекта выполнить: 
   ```shell
      docker compose up -d
   ```
4. Миграция БД к последней версии

   ```shell
   docker-compose exec php php bin/console doctrine:migrations:migrate
   ```
