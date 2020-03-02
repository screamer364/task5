<?php

require_once __DIR__ . '/src/libs/functions.php';

use src\core\exceptions\Error404Exception;
use src\core\exceptions\DBNotConnectionException;

error_reporting(-1);

const ROOT = '/';

spl_autoload_register(function($className) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// роутинг в таком видел оставил, т.к. в регулярных выражениях не очень разбираюсь,
// а копипастить не хотелось.
$params = explode('/', $_GET['q']);

foreach ($params as $key => $value) {
    if ($value === '') {
        unset($params[$key]);
    }
}

if (count($params) > 2) {
    die('Ошибка 404');
}

try {
    $controller = isset($params[0]) && $params[0] !== '' ? $params[0] : 'countries';
    $controller = 'src\\controllers\\' . ucfirst(strtolower($controller)) . 'Controller';
    
    if ($controller !== 'src\\controllers\CountriesController') {
        // исключение нужно только для 404 ошибки, так что не стал создавать отдельный класс Error404Exception,
        // а просто пробрасываю обычное
        // а в catch отправляю заголовки и подключаю шаблон 404 ошибки
        throw new Error404Exception();
    }
    
    $action = isset($params[1]) && $params[1] !== '' ? $params[1] : 'index';
    $action = strtolower($action) . 'Action';
    
    if ($action !== 'indexAction' && $action !== 'addAction') {
        throw new Error404Exception();
    }
    
    $controller = new $controller();
    $controller->$action();
    $controller->render();
} catch (Error404Exception $e) {
    header("HTTP/1.0 404 Not Found");
    require_once __DIR__ . '/src/views/404.html.php';
} catch (DBNotConnectionException $e) {
    die($e->getMessage());
}


