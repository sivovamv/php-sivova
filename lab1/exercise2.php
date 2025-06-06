<?php

$quieter = 'Тише';
$go = 'едешь';
$further = 'дальше';

echo "Дано:\n";
echo "\$quieter = '$quieter'\n";
echo "\$go = '$go'\n";
echo "\$further = '$further'\n\n";

$proverb = "{$quieter} {$go}, {$further} будешь";

echo "Результат интерполяции:\n";
echo $proverb . "\n";
?> 
<!-- Интерполяция. Дано: $quieter = 'Тише'; $go = 'едешь'; $further = 'дальше'; Найти: Cобрать неторопливую пословицу, используя операцию 'интерполяция' и заданные переменные. -->