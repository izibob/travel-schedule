<?php
$servername = "localhost";
$database = "travel-schedule";
$username = "args";
$password = "args";

$conn = mysqli_connect($servername, $username, $password,  $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE cities (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
city_name VARCHAR(30) NOT NULL,
duration INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table cities created successfully" . "<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO cities (id, city_name, duration) VALUES 
    (1, 'Санкт-Петербург', 2),
    (2, 'Уфа', 4),
    (3, 'Нижний Новгород', 2),
    (4, 'Владимир', 4),
    (5, 'Кострома', 2),    
    (6, 'Екатеринбург', 4),
    (7, 'Ковров', 2),
    (8, 'Воронеж', 4),
    (9, 'Самара', 2),
    (10, 'Астрахань', 4)";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully" . "<br><hr>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "CREATE TABLE couriers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
middle_name VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table couriers created successfully" . "<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO couriers (id, first_name, last_name, middle_name) VALUES 
    (1, 'Иван', 'Иванов', 'Иванович'),
    (2, 'Пётр', 'Петров', 'Петрович'),
    (3, 'Сергей', 'Сергеев', 'Сергеевич'),
    (4, 'Константин', 'Константинов', 'Константинович'),
    (5, 'Николай', 'Николаев', 'Николаеевич'),
    (6, 'Егор', 'Егоров', 'Егорович'),
    (7, 'Павел', 'Павлов', 'Павлович'),
    (8, 'Игнат', 'Игнатов', 'Игнатович'),
    (9, 'Валерий', 'Валерьев', 'Валерьевич'),
    (10, 'Платон', 'Платонов', 'Платонович')";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully" . "<br><hr>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "CREATE TABLE schedule (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
region VARCHAR(30) NOT NULL,
departure_date INT NOT NULL,
courier_name VARCHAR(100) NOT NULL,
arrival_date INT NOT NULL,
duration INT NOT NULL   
)";

if ($conn->query($sql) === TRUE) {
    echo "Table schedule created successfully" . "<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

mysqli_close($conn);
