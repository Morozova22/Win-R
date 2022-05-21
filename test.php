<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'schedule');
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
    table{
        border-collapse: collapse;
    }
    td{
        border: 1px solid black;
        padding: 3px;
        text-align: center;
    }
    .yellow{
        background-color:yellow ;
        font-weight: bold;
        text-align: center;
    }
</style>


</head>
<body>

<script>

    function timestampToDate(ts) {
        var d = new Date();
        d.setTime(ts);
        var days = ["Воскресенье", "Понедельник", "Вторник", "Среда",
            "Четверг", "Пятница", "Суббота"];


        return    days[d.getDay()]+ "<br/><b>" + ('0'  + d.getDate()).slice(-2) + '.' + ('0' + (d.getMonth() + 1)).slice(-2) ;
    }
    window.onload = function (){
        var mtype;
        var newTable = document.createElement('table')

        for (var row = 0; row<=8; row++){
            var newRow  = newTable.insertRow(row);
            for (var column=0;column<=7;column++){
                <?php  $mondays = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,`week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-11';");
                $mondays = mysqli_fetch_all($mondays);
                foreach ($mondays as $monday) {
                }
                    $my_dates[]=$monday[6];
                ?>
                var mmm = <?php echo json_encode($my_dates);?>;
                var mea = <?php echo json_encode($mondays);?>;

                var date1 = new Date(mmm)
                var newCell = newRow.insertCell(column);
                if(row==0 && column === 0){
                }
                else if(row === 0 && column>0){
                    newCell.className= "yellow";
                    newCell.innerHTML = timestampToDate(date1.setDate(date1.getDate() + column-1));
                }

                else if(row>0 && column === 0){
                    newCell.className= "yellow";
                    newCell.innerHTML = row;
                }

                    mea.forEach((el)=>{
                        if(el[0]==1){
                            mtype = 'лекция';
                        }
                        if(el[0]==2){
                            mtype = 'практика';
                        }
                        else{
                            mtype = 'лаба';
                        }
                        if(parseInt(el[1]) ==row && parseInt(el[7])==column){
                            newCell.innerHTML = 'Тип: '+ mtype +"<br/><b>"+'Группа: ' + el[2]+' ' +el[8]+"<br/><b>" + 'Место: '+ el[5] +"<br/><b>"+ 'Дисциплина: ' + el[3];
                        }
                    })

            }
        }
        document.body.appendChild(newTable);
    }

</script>
</body>
</html>