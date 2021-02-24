<?php
class Courier {
    private $conn;
    private $table_name = "couriers";

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT id, first_name, last_name, middle_name
                FROM " . $this->table_name . "
                ORDER BY first_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}