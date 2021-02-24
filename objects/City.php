<?php
class City {
    private $conn;
    private $table_name = "cities";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    function read() {
        $query = "SELECT id, city_name, duration
                FROM " . $this->table_name . "
                ORDER BY city_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}