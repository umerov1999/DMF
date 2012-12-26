<?php

    /**
     * Файл системных настроек
     */

    use DMF\Core\Storage\Config;

    /** Активация дебагового режима */
    Config::set('debug', DEBUG);

    /** Настройки подключения к базе данных */
    Config::set(
        'database', [
            // Включение поддержки БД
            'enable'   => true,
            // Драйвер для подключения к БД (в настоящий момент не поддерживается)
            'driver'   => 'mysql',
            // Хост БД
            'host'     => '127.0.0.1',
            // Порт БД
            'port'     => 3306,
            // Логин пользователя БД
            'user'     => 'root',
            // Пароль пользователя БД
            'password' => 'azo73122',
            // Имя БД по умолчанию
            'name'     => 'framework',
            // Префикс к именам таблиц в БД
            'prefix'   => 'dm_'
        ]
    );