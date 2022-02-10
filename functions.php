<?php
//phpinfo();die;
function generateArray(): array
{

    $array = file(__DIR__ . '/text.txt', FILE_IGNORE_NEW_LINES);

    return $array;
}


function getXCoordinatesOfValue(array $array, string $value): array
{
    $res = [];
    for ($row = 0; $row < count($array); $row++) {
        for ($col = 0; $col < strlen($array[0]); $col++) {
            if ($value === $array[$row][$col]) {
                $res = ['x' => $col, 'y' => $row];
            }
        }
    }


    return $res;
}


function getArrayOfTraces(array $array): array
{
    $result = [];
    for ($row = 0; $row < count($array); $row++) {
        for ($col = 0; $col < strlen($array[0]); $col++) {
            $result[$row][$col] = 0;
        }
    }


    return $result;
}


function checkingFourCells(array $array, array &$traces, int $coordX, int $coordY): array
{
    $result = [];
    $traces[$coordY][$coordX] = 1;
    $edgesY = ['min' => 0, 'max' => count($array) - 1];
    $edgesX = ['min' => 0, 'max' => strlen($array[0]) - 1];

    if ($coordX - 1 >= $edgesX['min'] && 0 === (int)$array[$coordY][$coordX - 1] && 0 === $traces[$coordY][$coordX - 1]) {
        $result[] = ['y' => $coordY, 'x' => $coordX - 1];
    }

    if ($coordX + 1 <= $edgesX['max'] && 0 === (int)$array[$coordY][$coordX + 1] && 0 === $traces[$coordY][$coordX + 1]) {
        $result[] = ['y' => $coordY, 'x' => $coordX + 1];
    }

    if ($coordY - 1 >= $edgesY['min'] && 0 === (int)$array[$coordY - 1][$coordX] && 0 === $traces[$coordY - 1][$coordX]) {
        $result[] = ['y' => $coordY - 1, 'x' => $coordX];
    }

    if ($coordY + 1 <= $edgesY['max'] && 0 === (int)$array[$coordY + 1][$coordX] && 0 === $traces[$coordY + 1][$coordX]) {
        $result[] = ['y' => $coordY + 1, 'x' => $coordX];
    }


    return $result;
}


function makeTree(array $labyrinth, array $traces, int $coordX, int $coordY): array
{
    $result = ['x' => $coordX, 'y' => $coordY];
    $suggestedCells = checkingFourCells($labyrinth, $traces, $coordX, $coordY);
    foreach ($suggestedCells as $cell) {
        $result['nextLvl'][] = makeTree($labyrinth, $traces, $cell['x'], $cell['y']);
    }

    return $result;
}


function drawTree(array $array, int $sectionDivider = 1): void
{
    $pointsAmount = 0;
    if (isset($array['nextLvl'])) {
        $pointsAmount = count($array['nextLvl']);
    }

    $nextSectionDivider = $sectionDivider * $pointsAmount;

    echo '<div class="branchBackground" style="width:' . ceil(1830 / $sectionDivider) . 'px;">';
    echo '<div class="row">' .
        '<div class="circle">' . $array['y'] . ' ; ' . $array['x'] . '</div>' .
        '</div>';
    echo '<div class="row">';

    if (isset($array['nextLvl'])) {
        foreach ($array['nextLvl'] as $point) {
            drawTree($point, $nextSectionDivider);
        }
    }
    echo '</div></div>';
}


//function countAmountOfWays(array $tree, int &$amount = 1)
//{
//    if (!isset($tree['nextLvl'])) {
//        $amount++;
//        return;
//    }
//    foreach ($tree['nextLvl'] as $branch) {
//        countAmountOfWays($branch, $amount);
//    }
//}

function getBranches(array $tree, array &$res = null): void
{

    if (!isset($res)) {
        $res = [[['x' => $tree['x'], 'y' => $tree['y']]]];
    }


    if (isset($tree['nextLvl'])) {
        $branches = $tree['nextLvl'];
        $tempAmountOfBranchesRes = count($res);

        // дублирование нужных путей
        if (count($branches) > 1) {
            for ($j = 0; $j < count($branches) - 1; $j++) {         //Проходим по путям
                for ($i = 0; $i < $tempAmountOfBranchesRes; $i++) {         //Проходим по клеткам
                    $resBranch = $res[$i];
                    $lastPoint = $resBranch[count($resBranch) - 1];
                    if ($lastPoint['x'] === $tree['x'] && $lastPoint['y'] === $tree['y']) {     //Если последний элемент записанный в res равен текущему элементу в дереве
                        $res[] = $res[$i];      //То добавим новый элемент в массив res
                    }
                }
            }
        }

        // заполнение путей точками
        for ($j = 0; $j < count($branches); $j++) {
            $branch = $branches[$j];
            for ($i = 0; $i < count($res); $i++) {
                $resBranch = $res[$i];
                $lastPoint = $resBranch[count($resBranch) - 1];
                if ($lastPoint['x'] === $tree['x'] && $lastPoint['y'] === $tree['y']) {
                    $res[$i][] = ['x' => $branch['x'], 'y' => $branch['y']];
                    break;
                }
            }
        }

        foreach ($tree['nextLvl'] as $way) {
            getBranches($way, $res);
        }

    }
}


function viewLabirinth(array $array): void
{

    for ($i = 0; $i < count($array); $i++) {

        echo '<div class="row">';


        for ($j = 0; $j < strlen($array[$i]); $j++) {

            if ($array[$i][$j] === 'X') {
                echo '<div class="square3" id="sqr-' . $i .'-' . $j . '"> </div>';
            }
            if ($array[$i][$j] === '1') {
                echo '<div class="square2" id="sqr-' . $i .'-' . $j . '"> </div>';
            }
            if ($array[$i][$j] === '0') {
                echo '<div class="square1" id="sqr-' . $i .'-' . $j . '"> </div>';
            }
            if ($array[$i][$j] === 'Y') {
                echo '<div class="square4" id="sqr-' . $i .'-' . $j . '"> </div>';

            }

        }
        echo '</div>';
    }

}


////drawTree($tree);

//drawTree($tree);


