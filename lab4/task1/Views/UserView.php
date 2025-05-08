<?php
namespace Views;

use Models\UserModel;

class UserView {
    /**
     * @var string цільова модель
     */
    private $model;

    /**
     * @param $model UserModel цільова модель
     */
    public function __construct(UserModel $model) {
        $this->model = $model;
    }

    /**
     * Виведення даних користувача через echo
     * @return void
     */
    public function render() {
        echo "Ім'я користувача: " . $this->model->getName();
    }
}
