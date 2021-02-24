<?php
include_once 'config/DataBase.php';
include_once 'objects/Schedule.php';

$database = new Database();
$db = $database->getConnection();

$schedule = new Schedule($db);

$stmt = $schedule->readAll();
$num = $stmt->rowCount();

$page_title = "Вывод расписания";

require_once "layout/layout_header.php";
?>

<div class='left-margin'>
    <a id="sort-asc" href='#' class="btn btn-default col-4 ml-auto mr-100 bg-success pull-left">Sort-asc</a>
</div>
<div class='left-margin'>
    <a id="sort-desc" href='#' class='btn btn-default mr-auto ml-3 pull-left mr-3'>Sort-desc</a>
</div>

<div class='right-button-margin'>
    <a href='create-schedule.php' class='btn btn-default pull-right'>Добавить расписание</a>
</div>

<?php if ($num > 0): ?>

    <table id="nav" class='table table-hover table-responsive table-bordered'>
        <tr>
            <th>Регионы</th>
            <th>Дата выезда из Москвы</th>
            <th>ФИО курьера</th>
            <th>Дата прибытия в регион</th>
        </tr>

        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

            <?php extract($row); ?>

            <tr data-sort="<?= $departure_date ?>">
                <td><?= $region ?></td>
                <td><?= date('d.m.Y', $departure_date) ?></td>
                <td><?= $courier_name ?></td>
                <td><?= date('d.m.Y', $arrival_date) ?></td>
            </tr>

        <?php endwhile; ?>

    </table>

<?php else: ?>
    <div class='alert alert-info'>Расписания не найдены.</div>
<?php endif; ?>

<?php require_once "layout/layout_footer.php"; ?>
