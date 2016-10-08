<?php
namespace App;

class Location
{
    public $latitude;
    public $longitude;

    public function __constructor($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}