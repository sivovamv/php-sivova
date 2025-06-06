<?php

$mysqli = new mysqli('localhost', 'root', '', 'contacts_db');

if ($mysqli->connect_error) {
    die('Ошибка подключения к базе данных.');
}

$message = '';
$records = [];

$result_list = $mysqli->query("SELECT id, last_name, first_name FROM contacts ORDER BY last_name, first_name");
while ($row = $result_list->fetch_assoc()) {
    $records[] = $row;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $res = $mysqli->query("SELECT last_name FROM contacts WHERE id=$id");
    $row = $res->fetch_assoc();
    $last_name = $row['last_name'];

    if ($mysqli->query("DELETE FROM contacts WHERE id=$id")) {
        $message = "<span style='color:green;'>Запись с фамилией $last_name удалена.</span>";

        $records = [];
        $result_list = $mysqli->query("SELECT id, last_name, first_name FROM contacts ORDER BY last_name, first_name");
        while ($row = $result_list->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        $message = "<span style='color:red;'>Ошибка при удалении записи.</span>";
    }
}

$html = '<h2>Удалить запись</h2>';
$html .= $message;

if (count($records) > 0) {
    $html .= '<div>Выберите запись для удаления:</div><ul>';
    foreach ($records as $rec) {
        $html .= "<li><a href='?menu=delete&id={$rec['id']}' onclick='return confirm(\"Вы уверены, что хотите удалить запись {$rec['last_name']} {$rec['first_name']}?\");'>{$rec['last_name']} {$rec['first_name']}</a></li>";
    }
    $html .= '</ul>';
} else {
    $html .= '<div>Нет записей для удаления.</div>';
}

$mysqli->close();

echo $html;
?>
