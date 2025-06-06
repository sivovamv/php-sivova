<?php
session_start();

if (!isset($_SESSION['country'])) {
    header('Location: exercise4html.php');
    exit;
}

echo 'Ваша страна: ' . $_SESSION['country'];
?>