<?php
include_once 'config/DataBase.php';
include_once 'objects/Schedule.php';

$database = new DataBase();
$conn = $database->getConnection();

$schedule = new Schedule($conn);

if (isset($_POST['region'])) {
    $schedule->region = $_POST['region'];
    $schedule->departure_date = strtotime($_POST['departure_date']);
    $schedule->courier_name = $_POST['courier_name'];
    $schedule->arrival_date = strtotime($_POST['arrival_date']);

    if ($schedule->create()) {
        $data[] = 'You entered:' . $_POST['region'];
        exit(json_encode($data));
    }
}
