<?php

require_once 'menu.php';
require_once 'viewer.php';

$active_menu = isset($_GET['menu']) ? $_GET['menu'] : 'view';

switch ($active_menu) {
    case 'view':
        // Передача параметров сортировки и страницы
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date_desc'; // по умолчанию сортировка по дате
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $content = viewer($sort, $page);
        break;
    case 'add':
        $content = include 'add.php';
        break;
    case 'edit':
        $content = include 'edit.php';
        break;
    case 'delete':
        $content = include 'delete.php';
        break;
    default:
        $content = viewer('date_desc', 1);
        break;
}

// Вывод меню
echo menu();

// Вывод основного контента
echo $content;
?>
