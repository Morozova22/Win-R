<?php
include 'style.php';
include 'menu.php';
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'schedule');
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//header("Refresh: 10");
?>
<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="css/style.css">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<!--    <script src="myjs.js"></script>-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<!--    <link rel="stylesheet" href="ms.css">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расписание</title>
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->


</head>
<body>
    <style>
        #popUp {
            top: 0%;
            left: 92%;
            position: absolute;
            width: 250px;
            height: 800px;
            border-radius: 11px;
            background: #ffffff;
            margin-left: -128px;
            margin-top: -420px;
            display: none;
            opacity: 0;
            padding: 25px;
            z-index: 1000;
        }
        #popUp #close {
            cursor: pointer;
            position: absolute;
            width: 23px;
            height: 23px;
            top: 17px;
            right: 17px;
            display: block;
        }
        #overlay {
            z-index:4;
            background-color: rgba(150, 150, 150, 0.34);
            position:fixed;
            opacity:0.45;
            width:100%;
            height:100%;
            display:none;
            top:0;
            left:0;
        }
        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;

        .card {
            display: inline-block;
        }

        }
        .scrolling-wrapper-flexbox {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;

        .card {
            flex: 0 0 auto;
        }
        .laba{
            background: blue;
        }
    </style>

<script>
    document.body.style.backgroundColor = "#EDF4FA";
</script>

    <div id="container">
        <div class="row">
            <div class="col mt-3">
            </div>
        </div>
    </div>

<script>
   // document.ready(function ()){}
    let c,r;
    function timestampToDate(ts) {
        var d = new Date();
        d.setTime(ts);
        var days = ["Вс", "Пн", "Вт", "Ср",
            "Чт", "Пт", "Сб"];
        return    days[d.getDay()]+ "<br/><b>" + ('0'  + d.getDate()).slice(-2) + '.' + ('0' + (d.getMonth() + 1)).slice(-2) ;
    }
    window.onload = function () {
        let zan = [];
        let countZan = [];
        for (var row = 0; row <= 8; row++) {
            countZan[row] = [];
            zan[row] = [];
            for (var column = 0; column <= 7; column++) {
                countZan[row][column] = 0;
                zan[row][column] = [];
                for (var i = 0; i <= 3; i++) {
                    zan[row][column][i] = 0;
                }
            }
        }
        var mtype;
        var newTable = document.createElement('table');
        newTable.className = "tabl";
        for (var row = 0; row <= 8; row++) {
            var newRow = newTable.insertRow(row);
            for (var column = 0; column <= 7; column++) {
                <?php  $mondays = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,
       `week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-18';");
                $mondays = mysqli_fetch_all($mondays);
                foreach ($mondays as $monday) {
                }
                $my_dates[] = $monday[6];
                ?>
                var mmm = <?php echo json_encode($my_dates);?>;
                var mea = <?php echo json_encode($mondays);?>;
                var date1 = new Date(mmm)
                var newCell = newRow.insertCell(column);
            if (row === 0 && column === 0){
                newCell.className = "yell";
            }
                if (row == 0 && column === 0) {
                } else if (row === 0 && column > 0) {
                    newCell.className = "yellow";
                    newCell.innerHTML = timestampToDate(date1.setDate(date1.getDate() + column - 1));
                } else if (row > 0 && column === 0) {
                    newCell.className = "yell";

                } else {
                    newCell.id = `start` + newCell.cellIndex.toString()+newRow.rowIndex.toString();
                }

                mea.forEach((el) => {
                    if (el[0] == 1) {
                        mtype = 'Лекционное занятие';
                        el.className = "laba";
                    } else if (el[0] == 2) {
                        mtype = 'Практическое занятие';
                    } else {
                        mtype = 'Лабораторная работа';
                        mtype.innerHTML = "<div style='background: blue;'></div>";
                    }
                    el.className = "laba";
                    if (parseInt(el[1]) == row && parseInt(el[7]) == column) {
                        newCell.innerHTML =
                        "<div style='padding: 7px; background: #ffffff; box-shadow:  10px 10px 30px #c9cfd5, " +
                            "-10px -10px 30px #ffffff; margin: 10px 8px 8px 0px; min-width: 160px; height: 130px; vertical-align: top; border-radius: 5px'> <div style=''> "
                            +"<div style='font-size:14px; color: #000000; text-align: left'>"+ el[3]
                            + "</div><hr style='-webkit-margin-before: 0.1em; -webkit-margin-after:1.0em; border-collapse: collapse;'><div style='" +
                            " padding: 4px; border-radius: 5px; '>" + mtype
                            +"<br></div><div style='background:#68CFEC; padding: 5px; border-radius: 5px; display:inline-block;'>" + el[5] + "<br></div>" +
                            "<div style='display:inline-block; background:#02A89E; color: white; padding: 5px; border-radius: 5px; margin:5px;'>"
                            + el[2] + ' '+el[8] +"</div></div>";

                        zan[row][column][countZan[row][column]] = 'Тип: ' + mtype + "\n" + 'Группа: ' + el[2] + ' ' + el[8] + "\n" + 'Место: ' + el[5] + "\n" + 'Дисциплина: ' + el[3];
                        countZan[row][column] = countZan[row][column] + 1;

                    }
                })
            }
        }
        document.body.appendChild(newTable);
        var cells = document.querySelectorAll('td');
        var rrr = document.querySelectorAll('tr');
        rrr.forEach((t)=>
        {
            cells.forEach((e) => {
                c = e.cellIndex;
                r = e.parentNode.rowIndex;
                e.addEventListener("click", () => {
                  //  $(document).ready(function () {
                        $(`td#start` + e.cellIndex.toString()+t.rowIndex.toString()).click(function (event) {
                            event.preventDefault();
                            var colIndex = $(this).parent().children().index($(this));
                            var rowIndex = $(this).parent().parent().children().index($(this).parent());
                            console.log(zan[rowIndex][colIndex]);
                                $('#overlay').fadeIn(0,
                                    function () {
                                        $('#popUp')
                                            .css('display', 'block')
                                            .animate({opacity: 1, top: '55%'}, 0);

                                    });

                        });
                });
            })
        })
        $('td').click(function(){
            var colIndex = $(this).parent().children().index($(this));
            var rowIndex = $(this).parent().parent().children().index($(this).parent());
            //alert('Row: ' + rowIndex + ', Column: ' + colIndex);
            let p = document.getElementById('from-js');
            let span = document.createElement('span');
            p.appendChild(span).textContent = zan[rowIndex][colIndex];
        });

    }
$(document).ready(function(){

       $('#close, #overlay').click(function () {

           $('#popUp')
               .animate({opacity: 0, right: '35%'}, 490,
                   function () {
                       let p = document.getElementById('from-js').lastChild;
                       let span = document.createElement('span');
                       document.getElementById('from-js').removeChild(p);
                       //p.appendChild(span).textContent = '';
                       $(this).css('display', 'none');
                       $('#overlay').fadeOut(100);
                   }
               );
       });
   });

</script>
<a href="#0" style="display: none" id="start">Нажми на ссылку</a>
<div id="popUp">
    <span id="close">X</span>
        <p id="from-js"><p>
    </p>
    </p>
</div>
<div id="overlay"></div>

<!--<div class="dad" ><a href="#0" class="cd-popup-trigger" >View Pop-up</a>-->
<!--    <div class="cd-popup" role="alert" >-->
<!--        <div class="cd-popup-container">-->
<!--            <p>Are you sure you want to delete this element?</p>-->
<!--            <ul class="cd-buttons">-->
<!--                <li><a href="#0">Yes</a></li>-->
<!--                <li><a href="#0">No</a></li>-->
<!--            </ul>-->
<!--            <a href="#0" class="cd-popup-close img-replace">Close</a>-->
<!--        </div></div>-->

</body>
</html>