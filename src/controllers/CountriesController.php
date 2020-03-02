<?php

namespace src\controllers;

use src\models\CountriesModel;

/**
 * Контроллер работы со странами
 * 
 * Выполняет добавление и загружает страны из/в БД
 */
class CountriesController extends BaseController {
    /**
     * Вывод списка стран
     *
     * @return void
     */
    public function indexAction() {
        $countriesModel = new CountriesModel();
        $countries = $countriesModel->getAll();

        $this->title = 'Список стран';
        $this->content = $this->build(__DIR__ . '/../views/countries.html.php', ['countries' => $countries]);
    }

    /**
     * Добавление страны в БД
     *
     * @return void
     */
    public function addAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // создаем модель, тем самым открывая соединение с БД 
            // и записывая в базовую модель название таблицы, с которой будем работать
            $countriesModel = new CountriesModel();
            $country = trim(htmlspecialchars($_POST['country']));

            // проверку сделал только на пустое поле
            if ($country === '') {
                $err = 'Поле не должно быть пустым';
            } else {
                // здесь вызываем метод для добавления в таблицу,
                // и передаем массив с ключами, совпадающими с полями таблицы
                $countriesModel->add(['country_name' => $country]);
                // после добавления, делаем редирект на главную
                redirect(ROOT);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $err = '';
        }

        $this->title = 'Добавить страну';
        $this->content = $this->build(__DIR__ . '/../views/add.html.php', ['err' => $err]);
    }
}
