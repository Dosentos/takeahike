<?php

class Destination {
    private $title;
    private $center;
    private $coordinates;
    private $location;

    public function __construct($title, $center, $coordinates, $location) {
        $this->title = $title;
        $this->center = $center;
        $this->coordinates = $coordinates;
        $this->location = $location;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getCenter() {
        return $this->center;
    }

    public function getCoordinates() {
        return $this->coordinates;
    }

    public function getLocation() {
        return $this->location;
    }
}

?>