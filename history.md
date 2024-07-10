## Установка PHP

1. Скачиваем PHP v8.1.29 (php-8.1.29-Win32-vs16-x64.zip) в папку `D:/path-to-folder/git/c/PATH/php-v8.1.29`
1. Распаковываем php-8.1.29-Win32-vs16-x64.zip в папку `D:/path-to-folder/git/c/PATH/php-v8.1.29/php-8.1.29-Win32-vs16-x64`
1. Добавляем в PATH (переменные среды) `D:/path-to-folder/git/c/PATH/php-v8.1.29/php-8.1.29-Win32-vs16-x64`
1. Проверяем в командной строке, что php установлен
    ```cmd
    php -v
    ```

## Установка Composer

1. Скачиваем Composer-Setup.exe в папку `D:/path-to-folder/git/c/PATH/composer`
1. Запускаем Composer-Setup.exe
    1. Выбираем Develop режим
    1. Выбираем папку установки `D:/path-to-folder/git/c/PATH/composer/composer`
1. Проверяем в PATH (переменные среды), что добавлен `D:/path-to-folder/git/c/PATH/composer/composer`
1. Проверяем в командной строке, что composer установлен
    ```cmd
    composer --version
    composer
    ```

## Установка Symhony-cli

1. Скачиваем symfony-cli_windows_amd64.zip в папку `D:/path-to-folder/git/c/PATH/symfony-cli_windows_amd64`
1. Распаковываем symfony-cli_windows_amd64.zip в папку `D:/path-to-folder/git/c/PATH/symfony-cli_windows_amd64/symfony-cli_windows_amd64`
1. Добавляем в PATH (переменные среды) папку `D:/path-to-folder/git/c/PATH/symfony-cli_windows_amd64/symfony-cli_windows_amd64`
1. Проверяем в командной строке, что symfony-cli установлен
    ```cmd
    symfony version
    symfony
    ```

## Созаем проект Symhony

1. Создаем папку src `D:/path-to-folder/git/src`
1. Переходим с папку
    ```cmd
    cd src
    ```
1. Создаем проект
    ```cmd
    symfony new --webapp my_project
    ```

## Запускаем проект

1. Переходим в папку с проектом `D:/path-to-folder/git/src/my_project`
    ```cmd
    cd src
    cd my_project
    ```
1. Запускаем проект
    ```cmd
    symfony server:start
    ```

1. Проверяем в браузере http://127.0.0.1:8000/

## Проверка bin/console

1. Переходим в папку с проектом `D:/path-to-folder/git/src/my_project`
    ```bash
    cd src
    cd my_project
    ```

1. Запускаем проект
    ```bash
    bin/console
    bin/console --version
    bin/console make:
    ```

## Создаем контролер

1. Переходим в папку с проектом `D:/path-to-folder/git/src/my_project`
    ```bash
    cd src
    cd my_project
    ```

1. Создаем контролер

    ```bash
    bin/console make:controller
    ```

1. Пишем имя `DefaultController`
1. Создались файлы `my_project/src/Controller/DefaultController.php` и `my_project/templates/default/index.html.twig`
1. Проверяем создание контролера в браузере http://127.0.0.1:8000/default

## Создаем подключение к базе данных

1. Создаем файл `.env.local` `my_project/.env.local`
1. Создаем переменную DATABASE_URL
    ```
    DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.38&charset=utf8mb4"
    ```
    где
    - `mysql://app:` - имя пользователя `app`
    - `mysql://app:!ChangeMe!@` - пароль `!ChangeMe!`
    - `@127.0.0.1:3306/app?` - имя базы данных `app`
    - `mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.38&` - номер версии mysql

    Нужно установить MySQL запустив mysql-installer-community-8.0.38.0.msi
1. В php.ini нужно раскомментировать строчки
    ```ini
    extension=mysqli
    extension=pdo_mysql
    ```

## Создаем пустой entity

1. Создаем entity

    ```bash
    cd src
    cd my_project
    bin/console make:entity
    ```
1. Называем класс `Blog`
1. UX Turbo не будем использовать `no`
1. Создались файлы `my_project/src/Entity/Blog.php` и `my_project/src/Repository/BlogRepository.php`
1. Создаем атрибуты.
    - Вводим
        - New property name: title
        - Field type: string
        - Field length: 255
        - Can this field be null in the database (nullable) (yes/no): no

        Обновился файл `my_project/src/Entity/Blog.php`

        - Add another property? Enter the property name: text
        - Field type: text
        -  Can this field be null in the database (nullable) (yes/no): no

## Создаем пустую миграцию

1. Создаем пустую миграцию
    ```bash
    cd src
    cd src/my_project
    bin/console doctrine:migration:generate
    ```
1. Создался файл `src/my_project/migrations/Version<YYYY><MM><DD><hh><mm><ss>.php`

## Создаем миграцию из Entity

1. Сгенерируем миграцию, которая напишет SQL на основе анотаций из Entity
    ```bash
    cd src
    cd src/my_project
    bin/console doctrine:migration:diff
    # yes
    ```
1. Создался файл `src/my_project/migrations/Version<YYYY><MM><DD><hh><mm><ss>.php`
1. Запускаем миграцию
    ```bash
    cd src
    cd src/my_project
    bin/console doctrine:migration:migrate
    # yes
    ```
1. Проверяем таблицу в БД через командную строку mysql
    ```
    mysql -u root -p
    use gpi_symfony__my_project
    show tables;
    SELECT * FROM doctrine_migration_versions;
    ```

## Создание CRUD

1. Создадим CRUD
    ```bash
    cd src
    cd src/my_project
    bin/console make:crud
    ```

    - The class name of the entity to create CRUD: Blog
    - Choose a name for your controller class: BlogController
    - Do you want to generate PHPUnit tests?: no
