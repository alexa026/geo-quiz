<?php
namespace App;

class GeoCalculator
{
    protected $radius = 6371010;
    protected $currentLat;
    protected $currentLon;

    /**
     * GeoCalculator constructor with current base lat/long.
     *
     * @param $lat
     * @param $lon
     */
    public function __construct($lat, $lon)
    {
        $this->currentLat = deg2rad($lat);
        $this->currentLon = deg2rad($lon);
    }

    /**
     * Calculates the distance to location.
     *
     * @param $lat
     * @param $long
     * @return mixed
     */
    public function distanceTo($lat, $long) {
        $lat = deg2rad($lat);
        $long = deg2rad($long);
        return round(acos(sin($this->currentLat) * sin($lat) +
            cos($this->currentLat) * cos($lat) *
            cos($this->currentLon - $long)) * $this->radius, 2);
    }

    /**
     * Determinate if target is within a given radius.
     *
     * @param $lat
     * @param $long
     * @param $radius
     * @return bool
     */
    public function inRadius($lat, $long, $radius)
    {
        return $this->distanceTo($lat, $long) <= $radius;
    }
}