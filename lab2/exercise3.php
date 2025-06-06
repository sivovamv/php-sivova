<?php
$array = ['a', '-', 'b', '-', 'c', '-', 'd'];

$pos = array_search('-', $array);

if ($pos !== false) {
    array_splice($array, $pos, 1);
}

print_r($array);
?>
<!-- array_search. Дан массив ['a', '-', 'b', '-', 'c', '-', 'd']. Найдите позицию первого элемента '-' и удалите его с помощью функции array_splice. -->