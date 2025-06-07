<?php
// add.php
require_once 'db_connect.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $comment = $_POST['comment'] ?? '';

    // Подключение к базе
    $mysqli = get_db_connection();

    // Валидация и добавление в базу
    $stmt = $mysqli->prepare("INSERT INTO contacts (last_name, first_name, middle_name, gender, date_of_birth, phone, address, email, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssssss', $last_name, $first_name, $middle_name, $gender, $date_of_birth, $phone, $address, $email, $comment);

    if ($stmt->execute()) {
        $message = '<span style="color:green;">Запись добавлена</span>';
    } else {
        $message = '<span style="color:red;">Ошибка: запись не добавлена</span>';
    }

    $stmt->close();
    $mysqli->close();
}

// Форма для добавления
$html = '<h2>Добавить новую запись</h2>';
$html .= $message;
$html .= '<form method="post" action="">
    <label>Фамилия: <input type="text" name="last_name" required></label><br>
    <label>Имя: <input type="text" name="first_name" required></label><br>
    <label>Отчество: <input type="text" name="middle_name"></label><br>
    <label>Пол:
        <select name="gender" required>
            <option value="М">М</option>
            <option value="Ж">Ж</option>
        </select>
    </label><br>
    <label>Дата рождения: <input type="date" name="date_of_birth" required></label><br>
    <label>Телефон: <input type="text" name="phone"></label><br>
    <label>Адрес: <input type="text" name="address"></label><br>
    <label>Е-mail: <input type="email" name="email"></label><br>
    <label>Комментарий: <textarea name="comment"></textarea></label><br>
    <input type="submit" value="Добавить">
</form>';

echo $html;
?>
