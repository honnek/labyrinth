<?php
include __DIR__ . '/functions.php';
$labyrinth = generateArray();
$xCoordinates = getXCoordinatesOfValue($labyrinth, 'X');
$yCoordinates = getXCoordinatesOfValue($labyrinth, 'Y');
$traces = getArrayOfTraces($labyrinth);
$tree = makeTree($labyrinth, $traces, $xCoordinates['x'], $xCoordinates['y']);


getBranches($tree, $branches);

$branches[] = $yCoordinates;


echo json_encode($branches);
