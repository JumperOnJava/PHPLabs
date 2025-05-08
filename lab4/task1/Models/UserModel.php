<?php
namespace Models;
/**
 * Модель користувача що зберігає його доні
 */
class UserModel {
    private $name = "Невідомий користувач";

    /**
     * Встановлення імені користувача
     * @param $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string ї'мя користувача
     */
    public function getName() {
        return $this->name;
    }
}
