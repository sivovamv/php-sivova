<?php
// Исходная строка
$str = 'a1b2c3';

// Регулярное выражение для поиска цифр
$pattern = '/\d/';

// Замена: для каждой цифры добавляем такую же рядом
$result = preg_replace_callback($pattern, function($matches) {
    return $matches[0] . $matches[0];
}, $str);

echo $result; // Вывод: a11b22c33
?>
