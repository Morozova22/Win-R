<?php
include 'styles.php';
include 'menubar.php';

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
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<!--    <script src="myjs.js"></script>-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<!--    <link rel="stylesheet" href="ms.css">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Расписание</title>
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->
    <style>
        #popUp {
            top: 0%;
            left: 92%;
            position: absolute;
            width: 600px;
            height: 350px;
            border-radius: 11px;
            background: #ffffff;
            margin-left: -300px;
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
        td {
            border: 1px solid #dadada;
            padding: 3px;
            text-align: center;
            cursor: pointer;

        }
        table{

        }
        tr{
            position: relative;
            height: 50px;
        }

        h5.modal-title{
            margin-left:8% ;
        }
        .row0{
            background-color: #C6DDFD;
        }
        .row1{
            background-color: #C5FFD3;
        }
        .row2{
            background-color: #FFC5D1;
        }
        .hh{
            display: none;
        }
        .btn-success{
            margin: 20px 0px 10px 10px;
            border: none;
            width: 80px;
            height: 80px;
            border-radius: 18px;
            background: #68CFEC;

        }
        .btn-success:hover{
            border-radius: 18px;
            background: #68CFEC;
            box-shadow:  10px 10px 15px #55aac2,
            -10px -10px 19px #7bf4ff;
        }
        .btn-success:active{
            border-color: yellow;
        }
        .btn-primary{
            margin: 20px 0px 10px 10px;
            border: none;
            width: 90px;
            height: 90px;
            border: #11EBFFFF;
            background: rgb(17, 235, 255);
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 4px );
            -webkit-backdrop-filter: blur( 4px );
            border-radius: 10px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
        .btn-primary:hover {
            width: 20px;
            height: 40px;
            position: fixed;
        }
        .btn-primary:active {

        }
        .btn-secondary{
            background-color: #FFCF35;
            border: none;
            border-radius: 5px;
        }

    </style>


    <button class="btn btn btn-secondary bton mb-1 bi-arrow-left-square"    value="2022-04-11" onclick="showUser(this.value)"></button>
    <button class="btn btn-secondary btan mb-1 bi-arrow-right-square"  value="2022-04-18" onclick="showUser(this.value)"></button>



<p id="fact" ></p>

</head>
<script>
    document.body.style.backgroundColor = "#EDF4FA";
</script>

<!--<h2 style="position: absolute; left: 200px; top:50px; font-size: 50px">Расписание</h2>-->
<!--<p style="position: absolute; left: 300px;">Week</p>-->

<script>

    let c,r;
    function timestampToDate(ts) {
        var d = new Date();
        d.setTime(ts);
        var days = ["Воскресенье", "Понедельник", "Вторник", "Среда",
            "Четверг", "Пятница", "Суббота"];
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
        newTable.id = 'tabless';
        for (var row = 0; row <= 8; row++) {
            var newRow = newTable.insertRow(row);
            for (var column = 0; column <= 7; column++) {
                <?php  $mondays = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,
       `week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-11';");
                $mondays = mysqli_fetch_all($mondays);
                foreach ($mondays as $monday) {
                }
                $my_dates[] = $monday[6];
                ?>
                var mmm = <?php echo json_encode($my_dates);?>;
                document.getElementById('fact').textContent=mmm;
                var mea = <?php echo json_encode($mondays);?>;
                var date1 = new Date(mmm);

                var newCell = newRow.insertCell(column);
                if(row == 0 && column == 0 ){
                    newCell.className = "hh";

                }
                if (row == 0 && column == 0) {
                } else if (row == 0 && column > 0) {
                    newCell.className = "yellow";
                    newCell.innerHTML = timestampToDate(date1.setDate(date1.getDate() + column - 1));
                } else if (row > 0 && column == 0 ) {

                    newCell.className = "hh";
                }
                else {
                    newCell.id = `start` + newCell.cellIndex.toString()+newRow.rowIndex.toString();

                }

                mea.forEach((el) => {
                    if (el[0] == 1) {
                        mtype = 'Лекционное занятие';
                    } else if (el[0] == 2) {
                        mtype = 'Практическое занятие';
                    } else {
                        mtype = 'Лабораторное занятие';
                    }
                    if (parseInt(el[1]) == row && parseInt(el[7]) == column) {
                        zan[row][column][countZan[row][column]] = 'Тип: ' + mtype + "<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>препод: "+ el[4]+ '<br>'+  'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];
                        //console.log(zan[row][column][countZan[row][column]]);
                        countZan[row][column] = countZan[row][column] + 1;
                        if(countZan[row][column]>1){
                            newCell.innerHTML= "<div style='padding: 7px; background: #4EC7BF; box-shadow:  7px 7px 20px #c9cfd5, " +
                                "-7px -7px 20px #ffffff; margin: 0px 8px 8px 0px; width: 160px; height: 150px; vertical-align: middle; border-radius: 5px; color: white; text-align: center;'>"
                                 +"<div style='font-size:25px;padding: 40px 0 0 0;'>"+'⚠' +"</div><div style='font-size:14px;'>" + 'Несколько предметов в это время'+"</div></div></div>";
                        }
                        else {

                            newCell.innerHTML = "<div style='padding: 7px; background: #ffffff; box-shadow:  8px 8px 18px #c9cfd5, " +
                                "-9px -9px 18px #ffffff; margin: 10px 8px 8px 0px; min-width: 160px; height: 160px; vertical-align: top; border-radius: 5px'>"
                                +"<div style='font-size:14px; color: #000000; text-align: left'>"+ el[3]+
                                + "</div>" + "<hr style='-webkit-margin-before: 0.1em; -webkit-margin-after:1.0em; border-collapse: collapse;'><div style='" +
                                " padding: 4px; border-radius: 5px; '>" + mtype
                                +"<br></div><div style='background:#68CFEC; padding: 5px; border-radius: 5px; display:inline-block;'>" + el[5] + "<br></div>" +
                                "<div style='display:inline-block; background:#02A89E; color: white; padding: 5px; border-radius: 5px; margin:5px;'>"
                                + el[2] + ' '+el[8] + "</div></div>";

                        }

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
                            //console.log(zan[rowIndex][colIndex]);
                            // zan[rowIndex][colIndex].foreach(e){}
                            if(JSON.stringify(zan[rowIndex][colIndex])!=JSON.stringify([0, 0, 0, 0])) {
                                $('#overlay').fadeIn(0,
                                    function () {
                                        $('#popUp')
                                            .css('display', 'block')
                                            .animate({opacity: 1, top: '55%'}, 0);

                                    });
                            }
                            else {
                                let r = document.getElementById('fff').lastChild;
                                let span1 = document.createElement('span');
                                document.getElementById('fff').removeChild(r);
                            }
                        });
                });
            })
        })
        $('td').click(function(){
                var colIndex = $(this).parent().children().index($(this));
            var rowIndex = $(this).parent().parent().children().index($(this).parent());
            let r = document.getElementById('fff');
            let span1 = document.createElement('span');
            r.appendChild(span1).textContent = 'Расписание на '+ rowIndex.toString() +' пару '+ timestampToDate(date1.setDate(date1.getDate() + colIndex - 1)).toString().replace('<br/><b>', ' ');
            date1 = new Date(mmm);
            // alert('Row: ' + rowIndex + ', Column: ' + colIndex);
            for(i=0;i<3;i++) {
                if(zan[rowIndex][colIndex][i]!=0) {
                    let p = document.getElementById('from-js' + i);
                    let span = document.createElement('span');
                    p.appendChild(span).innerHTML = zan[rowIndex][colIndex][i];
                    $('.row'+i).css('display', 'block');
                }
                else{
                    let p = document.getElementById('from-js' + i);
                    let span = document.createElement('span');
                    p.appendChild(span).textContent = '';
                    $('.row'+i).css('display', 'none');
                }

            }
        });

    }

    function showUser(str) {

        var xmlhttp=new XMLHttpRequest();
        // xmlhttp.onreadystatechange=function() {
        //     // alert(1);
        //
        //         //document.getElementById('tabless').innerHTML = this.responseText;
        //
        //
        // }
        document.getElementById("tabless").remove();
        xmlhttp.open("GET","test.php?q="+str,true);

        xmlhttp.send();

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
        newTable.id = 'tabless';
        mtype = document.createElement('div');
        for (var row = 0; row <= 8; row++) {
            var newRow = newTable.insertRow(row);
            for (var column = 0; column <= 7; column++) {
                if(str=='2022-04-11') {
                    <?php
                    $mondays2 = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,
       `week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-11';");
                    $mondays2 = mysqli_fetch_all($mondays2);
                    ?>
                    var mmm1 = str;
                    document.getElementById('fact').textContent=mmm1;
                    var mea = <?php echo json_encode($mondays2);?>;
                    var date1 = new Date(mmm1);
                }
                else {
                    <?php
                   //$id=$_GET['id'];
                   $mondays3 = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,
                       `week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-18';");
                   $mondays3 = mysqli_fetch_all($mondays3);
                    ?>
                    var mmm1 = str;
                    document.getElementById('fact').textContent=mmm1;
                    var mea = <?php echo json_encode($mondays3);?>;
                    var date1 = new Date(mmm1);
               }
                var newCell = newRow.insertCell(column);
                if(row == 0 && column == 0 ){
                    newCell.className = "hh";
                }
                if (row == 0 && column == 0) {
                } else if (row == 0 && column > 0) {
                    newCell.className = "yellow";
                    newCell.innerHTML = timestampToDate(date1.setDate(date1.getDate() + column - 1));
                } else if (row > 0 && column == 0 ) {

                    newCell.className = "hh";
                }
                else {
                    newCell.id = `start` + newCell.cellIndex.toString()+newRow.rowIndex.toString();
                }
                mea.forEach((el) => {
                    if (el[0] == 1) {
                        mtype = 'лекция';
                    } else if (el[0] == 2) {
                        mtype = 'практика';
                    } else {
                        mtype = 'лаба';
                    }
                    if (parseInt(el[1]) == row && parseInt(el[7]) == column) {

                        zan[row][column][countZan[row][column]] = 'Тип: ' + mtype + "<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>" + 'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];
                        //console.log(zan[row][column][countZan[row][column]]);
                        countZan[row][column] = countZan[row][column] + 1;
                        if(countZan[row][column]>1){
                            newCell.innerHTML= '⚠ Несколько предметов в это время ⚠ '+ "<div style='padding: 7px; background: #ffffff; box-shadow:  10px 10px 30px #c9cfd5, " +
                                "-10px -10px 30px #ffffff; margin: 10px 8px 8px 0px; min-width: 160px; height: 130px; vertical-align: top; border-radius: 5px'>"
                                +"<div style='font-size:14px; color: #000000; text-align: left'>"+ el[3]+
                                + "</div>" + "<hr style='-webkit-margin-before: 0.1em; -webkit-margin-after:1.0em; border-collapse: collapse;'><div style='" +
                                " padding: 4px; border-radius: 5px; '>" + mtype
                                +"<br></div><div style='background:#68CFEC; padding: 5px; border-radius: 5px; display:inline-block;'>" + el[5] + "<br></div>" +
                                "<div style='display:inline-block; background:#02A89E; color: white; padding: 5px; border-radius: 5px; margin:5px;'>"
                                + el[2] + ' '+el[8] + el[4]+ "</div></div>";

                        }
                        else {
                            newCell.innerHTML = "<div style='padding: 7px; background: #ffffff; box-shadow:  10px 10px 30px #c9cfd5, " +
                                "-10px -10px 30px #ffffff; margin: 10px 8px 8px 0px; min-width: 160px; height: 130px; vertical-align: top; border-radius: 5px'>"
                                +"<div style='font-size:14px; color: #000000; text-align: left'>"+ el[3]+
                                + "</div>" + "<hr style='-webkit-margin-before: 0.1em; -webkit-margin-after:1.0em; border-collapse: collapse;'><div style='" +
                                " padding: 4px; border-radius: 5px; '>" + mtype
                                +"<br></div><div style='background:#68CFEC; padding: 5px; border-radius: 5px; display:inline-block;'>" + el[5] + "<br></div>" +
                                "<div style='display:inline-block; background:#02A89E; color: white; padding: 5px; border-radius: 5px; margin:5px;'>"
                                + el[2] + ' '+el[8] + el[4]+ "</div></div>";

                        }
                        if(newCell.textContent.includes('практика')){
                            // newCell.className='yellow';
                            newCell.innerHTML = 'Тип: ' + `<div style="background: blueviolet; color: white; border-radius: 10px;" >`+mtype + `</div>` +"<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>" + 'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];
                        }
                    }
                })
            }
        }
        document.body.appendChild(newTable);
        var cells = document.querySelectorAll('td');
        var rrr = document.querySelectorAll('tr');
        rrr.forEach((t) => {
            cells.forEach((e) => {
                c = e.cellIndex;
                r = e.parentNode.rowIndex;
                e.addEventListener("click", () => {
                    //  $(document).ready(function () {
                    $(`td#start` + e.cellIndex.toString() + t.rowIndex.toString()).click(function (event) {
                        event.preventDefault();
                        var colIndex = $(this).parent().children().index($(this));
                        var rowIndex = $(this).parent().parent().children().index($(this).parent());
                        //console.log(zan[rowIndex][colIndex]);
                        // zan[rowIndex][colIndex].foreach(e){}
                        if (JSON.stringify(zan[rowIndex][colIndex]) != JSON.stringify([0, 0, 0, 0])) {
                            $('#overlay').fadeIn(0,
                                function () {
                                    $('#popUp')
                                        .css('display', 'block')
                                        .animate({opacity: 1, top: '55%'}, 0);

                                });
                        } else {
                            let r = document.getElementById('fff').lastChild;
                            let span1 = document.createElement('span');
                            document.getElementById('fff').removeChild(r);
                        }
                    });
                });
            })
        })
        $('td').click(function () {

            var colIndex = $(this).parent().children().index($(this));
            var rowIndex = $(this).parent().parent().children().index($(this).parent());
            let r = document.getElementById('fff');
            let span1 = document.createElement('span');
            r.appendChild(span1).textContent = 'Расписание на ' + rowIndex.toString() + ' пару ' + timestampToDate(date1.setDate(date1.getDate() + colIndex - 1)).toString().replace('<br/><b>', ' ');
            date1 = new Date(mmm1);
            // alert('Row: ' + rowIndex + ', Column: ' + colIndex);
            for (i = 0; i < 3; i++) {
                if (zan[rowIndex][colIndex][i] != 0) {
                    let p = document.getElementById('from-js' + i);
                    let span = document.createElement('span');
                    p.appendChild(span).innerHTML = zan[rowIndex][colIndex][i];
                    $('.row' + i).css('display', 'block');
                } else {
                    let p = document.getElementById('from-js' + i);
                    let span = document.createElement('span');
                    p.appendChild(span).textContent = '';
                    $('.row' + i).css('display', 'none');
                }

            }
        });


    }

$(document).ready(function(){

       $('#close, #overlay').click(function () {

           $('#popUp')
               .animate({opacity: 0, top: '35%'}, 490,
                   function () {
                       let r = document.getElementById('fff').lastChild;
                       let span1 = document.createElement('span');
                       document.getElementById('fff').removeChild(r);
                       for(i=0;i<3;i++) {

                           let p = document.getElementById('from-js'+i).lastChild;
                           let span = document.createElement('span');
                           document.getElementById('from-js'+i).removeChild(p);

                           //p.appendChild(span).textContent = '';
                       }

                       $(this).css('display', 'none');
                       $('#overlay').fadeOut(100);
                   }
               );
       });
   });

</script>

<div class="modal fade" tabindex="-1" role="dialog" id="shGroup">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Посмотреть расписание группы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="test1.php" method="post">
                    <div class="form-group">
                        <small>Введите шифр группы</small>
                        <input type="text" class="form-control" name="gr">
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit"  class="btn btn-primary" >Посмотреть расписание</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="#0" style="display: none" id="start"  class="modal fade" >Нажми на ссылку</a>
<div id="popUp">
    <div class="modal-header">
        <h5 class="modal-title" id="fff"></h5>
        <span id="close">&times;</span>
    </div>
    <div class="modal-body">
        <div class="container">
            <div class="row0">
                <div class="col mt-2">
                    <div id="from-js0"></div>
                </div>
            </div>
            <div class="row1">
                <div class="col mt-2">
                    <div id="from-js1"></div>
                </div>
            </div>
            <div class="row2">
                <div class="col mt-2">
                    <div id="from-js2"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>
<div id="overlay"></div>

<div class="modal fade" tabindex="-1" role="dialog" id="shTeach">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Посмотреть расписание группы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="test2.php" method="post">
                    <div class="form-group">
                        <small>Введите преподавателя:</small>
                        <input type="text" class="form-control" name="teach">
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit"  class="btn btn-primary" >Посмотреть расписание</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="shAud">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Посмотреть расписание аудитории:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="test3.php" method="post">
                    <div class="form-group">
                        <small>Введите преподавателя:</small>
                        <input type="text" class="form-control" name="aud">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit"  class="btn btn-primary" >Посмотреть расписание</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="container">
    <div class="row">
        <div class="col mt-3">
        </div>
    </div>
</div>

<!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>