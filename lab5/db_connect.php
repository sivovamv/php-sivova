<?php
// db_connect.php

function get_db_connection() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'contacts_db';

    $mysqli = new mysqli($host, $user, $password, $database);

    if ($mysqli->connect_error) {
        die('Ошибка подключения к базе данных: ' . $mysqli->connect_error);
    }

    // Устанавливаем кодировку
    $mysqli->set_charset("utf8");

    return $mysqli;
}
?> 