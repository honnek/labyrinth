<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

        div.square2 {
            border: inset 5px #000000;
            background: #000000;
            width: 15px;
            height: 15px;
            display: flex;
            flex-direction: row;
        }

        div.square1 {
            border: solid 5px #ffffff;
            background: #ffffff;
            width: 15px;
            height: 15px;
            display: flex;
            flex-direction: row;
        }


        div.square3 {
            border: solid 5px #b60e0e;
            background: #ffffff;
            width: 15px;
            height: 15px;
            display: flex;
            flex-direction: row;
        }

        div.square4 {
            border: solid 5px #362d72;
            background: #ffffff;
            width: 15px;
            height: 15px;
            display: flex;
            flex-direction: row;
        }

        div.row {
            display: flex;
        }

        div.branchBackground {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #467762;

        }


    </style>
</head>
<body>

<?php
require __DIR__ . '/functions.php';
$labyrinth = generateArray();
$xCoordinates = getXCoordinatesOfValue($labyrinth, 'X');
$yCoordinates = getXCoordinatesOfValue($labyrinth, 'Y');
$traces = getArrayOfTraces($labyrinth);
$tree = makeTree($labyrinth, $traces, $xCoordinates['x'], $xCoordinates['y']);


?>
<br>
<br>
<div id="root">
    <?php (viewBoard($labyrinth));
    ?>
</div>
<br>
<br>
<form action="/mazeBasic.php">
    <button id="btn"><h1> GO </h1></button>
</form>


</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="maze.js"></script>

</html>
