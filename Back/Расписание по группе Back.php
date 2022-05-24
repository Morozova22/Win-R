<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'schedule');
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//header("Refresh: 10");
$gr = $_POST['gr'];
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <title>Расписание</title>
    <!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->
    <style>
        #popUp {
            top: 12%;
            left: 50%;
            height: 500px;
            position: fixed;
            width: 500px;
            border-radius: 11px;
            background: #fef;
            margin-left: -200px;
            margin-top: -290px;
            display: none;
            opacity: 0;
            padding: 17px;
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
            background-color:#010;
            position:fixed;
            opacity:0.86;
            width:100%;
            height:100%;
            display:none;
            top:0;
            left:0;
        }
        table{
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 3px;
            text-align: center;

        }
        tr{
            position: relative;
            height: 50px;
        }
        .yellow{
            background-color:yellow ;
            font-weight: bold;
            text-align: center;
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

    </style>
</head>
<body>
<script >
    // document.ready(function ()){}
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
        for (var row = 0; row <= 8; row++) {
            var newRow = newTable.insertRow(row);
            for (var column = 0; column <= 7; column++) {
                <?php  $mondays = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,
       `week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-18' and `groups`='$gr' ;");
                $mondays = mysqli_fetch_all($mondays);
                foreach ($mondays as $monday) {
                }
                $my_dates[] = $monday[6];
                ?>
                var mmm = <?php echo json_encode($my_dates);?>;
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
                            newCell.innerHTML= '⚠ Несколько предметов в это время ⚠ '+'<br>Тип: ' + mtype + "<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>" + 'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];;
                        }
                        else {
                            newCell.innerHTML = 'Тип: ' + mtype + "<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>" + 'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];

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
