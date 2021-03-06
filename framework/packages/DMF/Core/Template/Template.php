<?php

    /**
     * Этот файл часть фреймворка DM Framework
     * Любое использование в коммерческих целях допустимо лишь при разрешении автора.
     *
     * @author damirazo <me@damirazo.ru>
     */

    namespace DMF\Core\Template;

    use DMF\Core\Application\Application;
    use DMF\Core\Http\Response;
    use DMF\Core\OS\OS;
    use DMF\Core\Template\Exception\TemplateNotFound;
    use DMF\Core\Template\Tag\UrlTag\UrlTagTokenParser;

    /**
     * Class Template
     * Базовый класс для реализации шаблонов
     *
     * @package DMF\Core\Template
     */
    class Template
    {

        /** @var string Имя шаблона */
        protected $template_name;
        /** @var array Массив данных для шаблона */
        protected $data;
        /** @var int Код HTTP ответа */
        protected $http_response_code;

        /** @var string Расширение у шаблонов */
        public static $template_extension = 'twig';

        /**
         * Инициализация объекта шаблона
         * @param string $template_name      Имя шаблона
         * @param array  $data               Массив данных для шаблона
         * @param int    $http_response_code Код HTTP ответа
         */
        public function __construct($template_name, $data = [], $http_response_code = 200)
        {
            $this->template_name = $template_name;
            $this->data = $data;
            $this->http_response_code = $http_response_code;
            return $this->render();
        }

        /**
         * Рендеринг шаблона
         * @return \DMF\Core\Http\Response
         * @throws TemplateNotFound
         */
        public function render()
        {
            $debug = DEBUG;
            $app = Application::get_instance();
            if (OS::file_exists(
                APP_PATH . $app->module->name . _SEP . 'View' . _SEP . $this->template_name . '.twig')) {
                // Объект загрузчика
                $loader = new \Twig_Loader_Filesystem(
                    APP_PATH . Application::get_instance()->module->name . _SEP . 'View'
                );
                // Объект окружения
                $twig = new \Twig_Environment($loader, [
                    'cache' => DATA_PATH . 'cache' . _SEP . 'templates',
                    'debug' => $debug
                ]);

                // Глобальные переменные
                foreach (Context::data() as $name => $value) {
                    $twig->addGlobal($name, $value);
                }

                // Кастомные теги
                foreach (Tag::$data as $tag) {
                    $twig->addTokenParser($tag);
                }

                // Возвращаем отрендеренный шаблон
                $response = $twig->render($this->template_name . '.' . self::$template_extension, $this->data);
                return new Response($response, $this->http_response_code);
            } else {
                throw new TemplateNotFound('Шаблон ' . $this->template_name . ' отсутствует!');
            }
        }

    }
