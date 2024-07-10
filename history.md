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
