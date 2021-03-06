<?php

    /**
     * Этот файл часть фреймворка DM Framework
     * Любое использование в коммерческих целях допустимо лишь при разрешении автора.
     *
     * @author damirazo <me@damirazo.ru>
     */

    use DMF\Core\Application\Application;

    /**
     * Отображение форматированной строки
     */
    function format()
    {
        $args = func_get_args();
        $args[0] = $args[0] . PHP_EOL;
        call_user_func_array('printf', $args);
    }