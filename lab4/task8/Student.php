<?php
include_once ("Human.php");

class Student extends Human
{
    private $university;

    public function getUniversity()
    {
        return $this->university;
    }

    public function setUniversity($university)
    {
        $this->university = $university;
    }

    private $course;
    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function __construct($height, $weight, $age, $university, $course)
    {
        parent::__construct($height, $weight, $age);
        $this->university = $university;
        $this->course = $course;
    }

    public function nextCourse()
    {
        $this->course += 1;
    }

    protected function child_message()
    {
        echo "student created child<br>";
    }

    function cleanBedroom()
    {
        echo "student cleaned bedroom<br>";
    }

    function cleanKitchen()
    {
        echo "student cleaned kitchen<br>";
    }
}












