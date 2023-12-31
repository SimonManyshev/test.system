### <span style="color:green">Общее</span>

#### Собрать приложение
```shell
docker compose up -d --build
```

#### Очистить и прогреть кеш приложения
```shell
docker compose exec php bin/console cache:clear
```

#### Войти в php-контейнер
```shell
docker compose exec php /bin/sh
```

#### Установить пакеты
```shell
docker compose exec php composer install
```

#### Обновить пакеты
```shell
docker compose exec php composer update
```
```shell
docker compose exec php composer update -W
```
#### Показать рецепты
```shell
docker compose exec php composer recipes
```

### <span style="color:green">Миграции</span>

#### Создать пустую миграцию
```shell
make migrations-generate
```
или
```shell
docker-compose exec php php bin/console doctrine:migrations:generate
```

#### Выполнить миграции до последней версии
```shell
make migrations-migrate
```
или
```shell
docker-compose exec php php bin/console doctrine:migrations:migrate
```

#### Выполнить одиночную миграцию
```shell
docker-compose exec php php bin/console doctrine:migrations:execute --up 'DoctrineMigrations\Version20220124093125'
```
