<?php
// Исходная строка
$str = 'aeeea aeea aea axa axxa axxxa';

// Регулярное выражение для поиска слов, начинающихся и заканчивающихся на 'a',
// с одной или более буквами 'e' или 'x' между ними
$pattern = '/a(?:e+|x+)a/';

// Находим все совпадения
if (preg_match_all($pattern, $str, $matches)) {
    echo "Найдены следующие слова:\n";
    foreach ($matches[0] as $match) {
        echo "- $match\n";
    }
    
    echo "\nВсего найдено слов: " . count($matches[0]);
} else {
    echo "Совпадений не найдено";
}
?>
