<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'schedule');

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (!$connect) {
    die('Error connect to database!');
}

$file_name ="schedule.json";
$data = file_get_contents($file_name);
$array = json_decode($data, true);


foreach ($array as $row){
    $gr = $row["groups"];
    $teach = $row["teachers"];
    $aud = $row["auditories"];
    if(!$gr){
        $ttt = null;
    }
    else {
        $ttt = implode(",", $gr);
    }

    if(!$teach){
        $te = null;
    }
    else {
        $te = implode(",", $teach);
    }

    if(!$aud){
        $ad = null;
    }
    else {
        $ad = implode(",", $aud);
    }


        $sql = "INSERT INTO `schedule` (`id`, `type`, `day`, `pair`, `week_begining`, `groups`, `subgroup_number`, `discipline`, `teachers`, `auditories`) VALUES ('" . $row["id"] . "', '" . $row["type"] . "', '" . $row["day"] . "', '" . $row["pair"] . "', '" . $row["week_begining"] . "', '$ttt', '" . $row["subgroup_number"] . "', '" . $row["discipline"]. "', '$te', '$ad');";

        if(!mysqli_query($connect, $sql))
    {
        die('Error : '.mysqli_errno($connect). ": ".mysqli_error($connect). "\n");
    }

}
?>

<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <title>Operating system</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col mt-1">
            <div>
                <h2 style="color: #2e3033;font-family: cursive, 'Snell Roundhand'; "> <center>Информация о процессах</center></h2>
            </div>
            <table class="table shadow">

                <tr>
                    <th>Тип занятия</th>
                    <th>Номер пары</th>
                    <th>Группа</th>
                    <th>Дисциплина</th>
                    <th>Учитель</th>
                    <th>Локация</th>
                    <th>Дата</th>
                </tr>
                <?php
                $mondays = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,`week_begining`,`day` FROM `schedule` WHERE `day`='2';");
                $mondays = mysqli_fetch_all($mondays);
                foreach ($mondays as $monday) {
                    ?>
                    <tr>
                        <?php
                        if($monday[0]==1){
                            $mtype = 'лекция';
                        }
                        if($monday[0]==2){
                            $mtype = 'практика';
                        }
                        else{
                            $mtype = 'лаба';
                        }
                        ?>
                        <td><?=$mtype?></td>
                        <td><?=$monday[1]?> пара</td>
                        <td><?=$monday[2]?> </td>
                        <td><?=$monday[3]?> </td>
                        <td><?=$monday[4]?> </td>
                        <td><?=$monday[5]?> </td>
                        <?php
                        $date = date_create($monday[6]);
                        date_modify($date,  $monday[7].'day- 1 day');
                        ?>
                        <td> <?=date_format($date, 'd.m.Y')?></td>

                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
