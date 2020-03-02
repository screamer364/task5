<?php

namespace src\controllers;

/**
 * Базовый контроллер
 * 
 * Выполняет рендеринг страниц
 */
abstract class BaseController {
    /**
     * @var string title - тег <title> для страницы
     */
    protected $title;
    /**
     * @var string content - страницы html для вывода
     */
    protected $content;

    public function __construct() {
        $this->title = 'Страны';
        $this->content = '';
    }

    /**
     * Выводит главный шаблон с контентом на экран
     * 
     * @return void
     */
    public function render() {
        echo $this->build(
            __DIR__ . '/../views/main.html.php',
            [
                'title' => $this->title,
                'content' => $this->content
            ]
        );
    }

    /**
     * Создает вид для вставки в шаблон
     * 
     * @param string $template - название вида для подключения
     * @param array $params - массив с переменными для вставки в вид
     * 
     * @return string
     */
    protected function build(string $template, array $params = []) {
        ob_start();
        extract($params);
        require_once $template;

        return ob_get_clean();
    }
}
