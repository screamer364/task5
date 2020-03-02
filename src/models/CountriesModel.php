<?php

namespace src\models;

/**
 * Модель для работы с таблицей стран
 */
class CountriesModel extends BaseModel {
    /**
     * Передает в конструктор базового класса название таблицы
     */
    public function __construct() {
        parent::__construct('countries');
    }
}