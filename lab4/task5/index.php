<?php

class Circle
{
    public function __construct(float $x, float $y, float $radius)
    {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function __toString(): string
    {
        return "Коло з центром в ({$this->x}, {$this->y}) і радіусом {$this->radius}";
    }

    private $x;
    public function getX(): float
    {
        return $this->x;
    }
    public function setX(float $x)
    {
        $this->x = $x;
    }

    private $y;
    public function getY(): float
    {
        return $this->y;
    }
    public function setY(float $y)
    {
        $this->y = $y;
    }

    private $radius;
    public function getRadius(): float
    {
        return $this->radius;
    }
    public function setRadius(float $radius)
    {
        $this->radius = $radius;
    }

    public function intersects(Circle $circle): bool
    {
        $diffx = $circle->getX() - $this->x;
        $diffy = $circle->getY() - $this->y;
        $distanceMin = $circle->getRadius() + $this->radius;

        $distance = sqrt(pow($diffx, 2) + pow($diffy, 2));

        return $distance < $distanceMin;
    }
}

$c1 = new Circle(0, 0, 10);

$c1->setRadius(8);
echo "radius: ". $c1->getRadius() ."<br>";
$c1->setX(-1);
echo "x: ".$c1->getX() ."<br>";
$c1->setY(-2);
echo "y: ".$c1->getY() ."<br>";

$c2 = new Circle(5, 0, 10);
$c3 = new Circle(0, 25, 10);

echo $c1->intersects($c2) ? "true " : "false ";
echo $c1->intersects($c3) ? "true " : "false ";
