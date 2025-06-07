<?php

$test_emails = [
    'mymail@mail.ru',
    'my.mail@mail.ru',
    'invalid.email',       
    '@nodomain.com',       
];

// Регулярное выражение для проверки email
$email_pattern = '/^[a-zA-Z0-9][a-zA-Z0-9\._-]*[a-zA-Z0-9]@[a-zA-Z0-9][a-zA-Z0-9\.-]*[a-zA-Z0-9]\.[a-zA-Z]{2,}$/';

// Функция для проверки email
function validateEmail($email) {
    global $email_pattern;
    return preg_match($email_pattern, $email) === 1;
}

// Проверяем каждый email
foreach ($test_emails as $email) {
    $is_valid = validateEmail($email);
    echo "Email: <b>" . htmlspecialchars($email) . "</b> - ";
    echo $is_valid ? "<span style='color: green;'>Корректный</span>" : "<span style='color: red;'>Некорректный</span>";
    echo "<br>";
}


// Функция для проверки одного email
function checkEmail($email) {
    global $email_pattern;
    if (validateEmail($email)) {
        echo "Email адрес '$email' является корректным";
    } else {
        echo "Email адрес '$email' НЕ является корректным";
    }
}


?>
