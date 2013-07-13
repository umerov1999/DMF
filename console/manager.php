<?php

    /**
     * Доступные аргументы:
     * syncdb [model] - Сгенерировать структуру БД для всех моделей [указанной модели]
     */

    /** @var array $args Массив аргументов */
    $args = $_SERVER['argv'];

    /** @var string $version Версия консоли */
    $version = '0.1a';

    /**
     * Преобразование строки в кодировку CP866
     * @param string $string Строка для преобразования
     * @return string Строка в кодировке CP866
     */
    function c($string)
    {
        return iconv('UTF-8', 'CP866', $string).PHP_EOL;
    }

    // Выводим отладочную информацию
    echo c('--------------------------------------');
    echo c('DMF Interactive Console (DMFIC) v ' . $version);
    echo c('PHP ' . PHP_VERSION);
    echo c('--------------------------------------');

    // Если обнаружен лишь один аргумент, то прерываем работу консоли
    if (count($args) <= 1) {
        die(c('No arguments are specified to select the desired action!'));
    }

    // Название запрашиваемого действия
    $action = $args[1];

    // Загрузка скрипта, реализующего требуемое действие
    switch ($action) {
        // Синхронизация таблиц в БД и моделей
        case 'syncdb':
            require_once 'syncdb.php';
            break;
        // Указанное действие не реализовано
        default:
            echo c('Action ' . $action . ' is not specified!');
            break;
    }

    echo c('--------------------------------------');
