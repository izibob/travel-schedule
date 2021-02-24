<?php
$cities = [
    'Санкт-Петербург', 'Уфа', 'Нижний Новгород',
    'Владимир', 'Кострома', 'Екатеринбург', 'Ковров',
    'Воронеж', 'Самара', 'Астрахань'
];

$durations = [2, 4, 2, 4, 2, 4, 2, 4, 2, 4];

$couriers = [
    'Иванов Иван Иванович', 'Петров Пётр Петрович', 'Сергеев Сергей Сергеевич',
    'Константинов Константин Константинович', 'Николаев Николай Николаеевич',
    'Егоров Егор Егорович', 'Павлов Павел Павлович', 'Игнатов Игнат Игнатович',
    'Валерьев Валерий Валерьевич', 'Платонов Платон Платонович'
];

$june_date = new DateTime("12-06-2019");
$june_timestamp = $june_date->getTimestamp();

$now_date = new DateTime();
$now_timestamp = $now_date->getTimestamp();

$count_id = 1;

$servername = "localhost";
$database = "travel-schedule";
$username = "args";
$password = "args";

$conn = mysqli_connect($servername, $username, $password,  $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i = $june_timestamp; $i < $now_timestamp; $i += 172800) {
    $index = mt_rand(0, (count($cities) -1));
    $city = $cities[$index];
    $arrival_date = ($durations[$index] / 2) * 86400 + $i;
    $courier = $couriers[mt_rand(0, (count($couriers) -1))];
    $departure_date = $i;
    $duration = ($arrival_date - $departure_date) + $arrival_date;

    $sql = "INSERT INTO schedule (id, region, departure_date, courier_name, arrival_date, duration)
            VALUES ('{$count_id}', '{$city}', '{$departure_date}', '{$courier}', '{$arrival_date}', '{$duration}')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully" . "<br><hr>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $count_id++;
}

mysqli_close($conn);