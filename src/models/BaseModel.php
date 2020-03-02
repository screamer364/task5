<?php

namespace src\models;

use src\core\DBConnector;

/**
 * Базовая модель для работы с таблицами в БД
 */
abstract class BaseModel {
    /**
     * @var string $table - название таблицы
     */
    protected $table;

    /**
     * Получает соединение с БД и сохраняет имя таблицы
     * 
     * @param string $table - название таблицы
     * 
     * @return void
     */
    public function __construct(string $table) {
        DBConnector::getConnect();
        $this->table = $table;
    }

    /**
     * Получает все данные из таблицы
     * 
     * @return array - массив с данными из таблицы
     */
    public function getAll() {
        return \R::findAll($this->table);
    }

    /**
     * Добавляет данные в таблицу
     * 
     * @param array $params - массив с данными для добавления
     * 
     * @return void
     */
    public function add(array $params) {
        $countries = \R::dispense($this->table);

        foreach ($params as $k => $v) {
            $countries[$k] = $v;
        }
        
        \R::store($countries);
    }

    // можно расширить класс и добавить методы для удаления, редактирования и т.д. для любой таблицы
    // надо только для каждой таблицы создать свою модель, которая будем наследоваться от базовой
}
