<?php
include_once ("Human.php");

class Programmer extends Human
{
    private $languages;

    public function getLanguages()
    {
        return $this->languages;
    }

    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }
    private $experience;

    public function getExperience()
    {
        return $this->experience;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function __construct($height, $weight, $age, $languages, $experience)
    {
        parent::__construct($height, $weight, $age);
        $this->languages = $languages;
        $this->experience = $experience;
    }
    public function addLanguage($language)
    {
        if (!in_array($language, $this->languages)) {
            $this->languages[] = $language;
        }
    }

    protected function child_message()
    {
        echo "programmer created child<br>";
    }


    function cleanBedroom()
    {
        echo "programmer cleaned bedroom<br>";
    }

    function cleanKitchen()
    {
        echo "programmer cleaned kitchen<br>";
    }
}













