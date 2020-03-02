<?php

namespace src\core;

use src\core\exceptions\DBNotConnectionException;

require_once __DIR__ . '/../libs/rb-mysql.php';

/**
 * Выполняет подключение к БД
 */
class DBConnector {
    /**
     * @var R $instance - хранит подключение к БД
     */
    private static $instance;

    /**
     * Синглтон для подключения к БД
     * 
     * @return R
     */
    public static function getConnect() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Создает подключение к БД
     */
    private function __construct() {
        $db = require_once __DIR__ . '/../config/config_db.php';

        \R::setup($db['dsn'], $db['user'], $db['pass']);
        \R::freeze(true);

        if (!\R::testConnection()) {
            throw new DBNotConnectionException('Нет соединения с БД');
        }
    }
}
