<?php
// Исходная строка
$str = 'bbb <tag>hello</tag> , world <tag>eee</tag>';

// Регулярное выражение для поиска содержимого между тегами
$pattern = '/<tag>(.*?)<\/tag>/';

// Замена содержимого тегов на '!'
$result = preg_replace($pattern, '!', $str);

echo $result; // Результат: bbb ! , world !
?>
