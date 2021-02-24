<?php

class Schedule
{
    private $conn;
    private $table_name = "schedule";
    public $region;
    public $departure_date;
    public $courier_name;
    public $arrival_date;
    private $duration;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function test()
    {
        $query = "SELECT courier_name FROM schedule WHERE courier_name = :courier_name AND duration > :checked";

        $stmt = $this->conn->prepare($query);

        $checked = $this->departure_date;

        $stmt->bindParam(":courier_name", $this->courier_name, PDO::PARAM_STR);
        $stmt->bindParam(":checked", $checked, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        }

        return true;
    }

    function create()
    {
        if ($this->test()) {
            $query = "INSERT INTO " . $this->table_name . "
                SET region=:region, departure_date=:departure_date,
                 courier_name=:courier_name, arrival_date=:arrival_date, duration=:duration";

            $stmt = $this->conn->prepare($query);

            $this->duration = ($this->arrival_date - $this->departure_date) + $this->arrival_date;

            $stmt->bindParam(":region", $this->region);
            $stmt->bindParam(":departure_date", $this->departure_date);
            $stmt->bindParam(":courier_name", $this->courier_name);
            $stmt->bindParam(":arrival_date", $this->arrival_date);
            $stmt->bindParam(":duration", $this->duration);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        return false;
    }

    function readAll()
    {
        $query = "SELECT id, region, departure_date, courier_name, arrival_date
                  FROM " . $this->table_name . " 
                  ORDER BY departure_date";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}