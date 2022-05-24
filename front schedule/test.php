<?php
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

    <title>Расписание</title>
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->
</head>

<body>
    <style>
        .slider {
            width: 300px;
            text-align: center;
            overflow: hidden;
        }
        .slides {
            display: ;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }
        .slides::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        .slides::-webkit-scrollbar-thumb {
            background: #666;
            border-radius: 10px;
        }
        .slides::-webkit-scrollbar-track {
            background: transparent;
        }
        .slides > div {
            scroll-snap-align: start;
            flex-shrink: 0;
            width: 300px;
            height: 300px;
            margin-right: 50px;
            border-radius: 10px;
            background: #eee;
            transform-origin: center center;
            transform: scale(1);
            transition: transform 0.5s;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 100px;
        }
        .slider > a {
            display: inline-flex;
            width: 1.5rem;
            height: 1.5rem;
            background: white;
            text-decoration: none;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 0 0.5rem 0;
            position: relative;
        }
        .slider > a:active {
            top: 1px;
            color: #1c87c9;
        }
        .slider > a:focus {
            background: #eee;
        }
        /* Навигационной кнопки не требуется  */
        @supports (scroll-snap-type) {
            .slider > a {
                display: none;
            }
        }
        html, body {
            height: 100%;
            overflow: hidden;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #1c87c9, #ffcc00);
            font-family: 'Ropa Sans', sans-serif;
        }
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
            background-color: rgba(100, 100, 100, 0.35);
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
        .yellow{
            background-color:yellow ;
            font-weight: bold;
            text-align: center;
        }
    </style>



<div class="slider">
    <a href="#slide-1">11.04.22-18.04.22</a>
    <a href="#slide-2">19.04.22-24.04.22</a>
    <div class="slides">
        <div id="slide-1">
            <table class="table table-bordered table-hover" id="slider-1" >
            <script>
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
                            <?php  $mondays = mysqli_query($connect, "SELECT `type`,`pair`,`groups`,`discipline`,`teachers`,`auditories`,`week_begining`,`day`,`subgroup_number` FROM `schedule` where `week_begining`='2022-04-11';");
                            $mondays = mysqli_fetch_all($mondays);
                            foreach ($mondays as $monday) {
                            }
                            $my_dates[] = $monday[6];
                            ?>
                            var mmm = <?php echo json_encode($my_dates);?>;
                            var mea = <?php echo json_encode($mondays);?>;
                            var date1 = new Date(mmm)
                            var newCell = newRow.insertCell(column);

                            if (row == 0 && column === 0) {
                            } else if (row === 0 && column > 0) {
                                newCell.className = "yellow";
                                newCell.innerHTML = timestampToDate(date1.setDate(date1.getDate() + column - 1));
                            } else if (row > 0 && column === 0) {
                                newCell.className = "yellow";
                                newCell.innerHTML = row;
                            } else {
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
                                    newCell.innerHTML = 'Тип: ' + mtype + "<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>" + 'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];
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
                            /*по нажатию на крестик закрываю окно*/

                            // });
                            //})
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
                            .animate({opacity: 0, top: '35%'}, 490,
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
            </table>
        </div>
        <div id="slide-2">
            <table class="table table-bordered table-hover"  id="slider-2">
            <script>
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

                            if (row == 0 && column === 0) {
                            } else if (row === 0 && column > 0) {
                                newCell.className = "yellow";
                                newCell.innerHTML = timestampToDate(date1.setDate(date1.getDate() + column - 1));
                            } else if (row > 0 && column === 0) {
                                newCell.className = "yellow";
                                newCell.innerHTML = row;
                            } else {
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
                                    newCell.innerHTML = 'Тип: ' + mtype + "<br>" + 'Группа: ' + el[2] + ' ' + el[8] + "<br>" + 'Место: ' + el[5] + "<br>" + 'Дисциплина: ' + el[3];
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
                            /*по нажатию на крестик закрываю окно*/

                            // });
                            //})
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
                            .animate({opacity: 0, top: '35%'}, 490,
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
            </table>
        </div>
    </div>
</div>

<a href="#0" style="display: none" id="start">Нажми на ссылку</a>
<div id="popUp">
    <span id="close">X</span>
        <p id="from-js"><p>
    </p>
    </p>
</div>
<div id="overlay"></div>

<script>
    $(document).ready(function() {
        $('.nav-link-collapse').on('click', function() {
            $('.nav-link-collapse').not(this).removeClass('nav-link-show');
            $(this).toggleClass('nav-link-show');
        });
    });
</script>
</body>
</html>