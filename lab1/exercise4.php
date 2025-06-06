<?php
$a = 2;
$b = 2.0;
$c = '2';
$d = 'two';
$g = true;
$f = false;

$variables = [
    'a' => $a,
    'b' => $b,
    'c' => $c,
    'd' => $d,
    'g' => $g,
    'f' => $f
];

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Переменная</th><th>Исходный тип</th><th>Значение</th><th>Приведено к int</th></tr>";

foreach ($variables as $name => $value) {
    $originalType = gettype($value);
    $intValue = (int)$value;
    echo "<tr>";
    echo "<td>$name</td>";
    echo "<td>$originalType</td>";
    echo "<td>$value</td>";
    echo "<td>$intValue</td>";
    echo "</tr>";
}

echo "</table>";
?>
<!-- Приведение типов. Дано:$a = 2; $b = 2.0;$c = ‘2’;$d = ‘two’;$g = true;$f = false; Найти: Привести переменные к типу integer. На экран вывести данные в форме таблицы со столбцами: исходный тип, полученное значение. -->
