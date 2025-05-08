<?php
namespace Controllers;

use Models\UserModel;

/**
 * Контроллер користувача для зручної роботи
 */
class UserController {
    /**
     * @var string цільова модель користувача
     */
    private $model;

    /**
     * Конструктор контроллера
     * @param $model UserModel цільова модель
     */
    public function __construct(UserModel $model) {
        $this->model = $model;
    }

    /**
     * Встановлення імені користувача
     * @param $name string нове ім'я
     * @return void
     */
    public function setUserName(string $name) {
        $this->model->setName($name);
    }
}
