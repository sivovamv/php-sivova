<?php
// delete.php

$mysqli = new mysqli('localhost', 'root', '', 'contacts_db');

if ($mysqli->connect_error) {
    die('Ошибка подключения к базе данных.');
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Получение фамилии для сообщения
    $res = $mysqli->query("SELECT last_name FROM contacts WHERE id=$id");
    $row = $res->fetch_assoc();
    $last_name = $row['last_name'];

    // Удаление записи
    $mysqli->query("DELETE FROM contacts WHERE id=$id");

    echo "Запись с фамилией $last_name удалена.";
} else {
    echo "Не выбрана запись для удаления.";
}

$mysqli->close();
?>
