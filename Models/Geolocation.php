<?php
require_once __DIR__ . "/Database.php";

class Geolocation extends Database
{
  protected $table = "geolocations";
    public function getGeolocations()
    {
        return $this->select("SELECT * FROM $this->table");
    }

    public function getGeolocation($id)
    {
        return $this->select("SELECT * FROM $this->table WHERE id = ?", ["i", $id]);
    }

    public function saveGeolocation($input)
    {
        return $this->create("INSERT INTO $this->table (longitude, latitude, radius, city) VALUES (?, ?, ?, ?)", ["ssds",$input['longitude'],$input['latitude'],$input['radius'],$input['city']]);
    }

    public function updateGeolocation($input)
    {
      return $this->update("UPDATE $this->table SET longitude=?, latitude=?, radius=?, city=? WHERE id=?", ["ssdsi",$input['longitude'],$input['latitude'],$input['radius'],$input['city'],$input['id']]);
    }

    public function deleteGeolocation($id)
    {
        return $this->delete("DELETE FROM $this->table WHERE id = ?", ["i", $id]);
    }
}