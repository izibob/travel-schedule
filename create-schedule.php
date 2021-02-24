<?php
include_once 'config/DataBase.php';
include_once 'objects/Courier.php';
include_once 'objects/City.php';

$database = new DataBase();
$conn = $database->getConnection();

$cities = new City($conn);
$couriers = new Courier($conn);

$page_title = "Создание расписания";

require_once "layout/layout_header.php";
?>

<span id="result"></span>

<div class='right-button-margin'>
    <a href='/' class='btn btn-default pull-right'>Просмотр всех расписаний</a>
</div>

<form method="post" action="/action-schedule.php">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Регион</td>
            <td>
                <?php $stmt = $cities->read(); ?>

                <select class='form-control' id='region' name='region'>
                    <option>Выбрать регион...</option>

                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <?php extract($row); ?>
                        <option data-i='<?= $duration ?>' value='<?= $city_name ?>'>
                            <?= $city_name ?>
                        </option>
                    <?php endwhile; ?>

                </select>
            </td>
        </tr>

        <tr>
            <td>Дата выезда из Москвы</td>
            <td><input type='date' name='departure_date' id="departure_date" class='form-control'/></td>
        </tr>

        <tr>
            <td>ФИО курьера</td>
            <td>
                <?php $stmt = $couriers->read(); ?>

                <select class='form-control' name='courier_name'>
                    <option>Выбрать курьера...</option>

                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <?php extract($row); ?>
                        <option value='<?= $last_name . " " . $first_name . " " . $middle_name?>'>
                            <?= $last_name . ' ' . $first_name . ' ' . $middle_name ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Дата прибытия в регион</td>
            <td><input type='text' name='arrival_date' id="arrival_date" value=" " readonly="readonly"
                       class='form-control'></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Создать"></td>
        </tr>

    </table>
</form>

<?php
require_once "layout/layout_footer.php";
?>
