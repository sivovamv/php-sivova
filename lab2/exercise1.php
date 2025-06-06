<?php

$array = ['a', 'b', 'c', 'b', 'a'];

$counted = array_count_values($array);

foreach ($counted as $letter => $count) {
    echo "Буква '$letter' встречается $count раз(а).<br>";
}
?>

<!-- array_count_values. Дан массив с элементами 'a', 'b', 'c', 'b', 'a'. Подсчитайте сколько раз встречается каждая из букв. -->