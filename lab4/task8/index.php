<?php

include ("Student.php");
include ("Programmer.php");

$student = new Student(170, 60, 20, "Politeh", 2);
echo "student : " . $student->getUniversity() . ", course: " . $student->getCourse() . "<br>";
$student->nextCourse();
$student->setHeight(175);
$student->setWeight(65);
echo "new height: " . $student->getHeight() . ", new weight: " . $student->getWeight() . ", course: " . $student->getCourse() . "<br>";


$programmer = new Programmer(180, 75, 30, ["PHP", "JavaScript"], 5);
echo "programmer knows languages: " . implode(", ", $programmer->getLanguages()) . ", experience: " . $programmer->getExperience() . " years<br>";
$programmer->addLanguage("PHP");
$programmer->setHeight(182);
$programmer->setWeight(78);
echo "new height: " . $programmer->getHeight() . ", new weight: " . $programmer->getWeight() . "<br>";
echo "new languages: " . implode(", ", $programmer->getLanguages()) . "<br>";

$student->create_child();
$programmer->create_child();

$student->cleanBedroom();
$student->cleanKitchen();
$programmer->cleanBedroom();
$programmer->cleanKitchen();
