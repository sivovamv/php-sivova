<?php
// edit.php
require_once 'db_connect.php';

// Подключение к базе
$mysqli = get_db_connection();

$records = [];
// Получение списка для выбора
$result_list = $mysqli->query("SELECT id, last_name, first_name FROM contacts ORDER BY last_name, first_name");
while ($row = $result_list->fetch_assoc()) {
    $records[] = $row;
}

// Обработка выбора записи
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $mysqli->query("SELECT * FROM contacts WHERE id=$id");
    $record = $result->fetch_assoc();
} else {
    $record = null;
}

// Обработка формы
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    // Получение данных
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // Обновление записи
    $stmt = $mysqli->prepare("UPDATE contacts SET last_name=?, first_name=?, middle_name=?, gender=?, date_of_birth=?, phone=?, address=?, email=?, comment=? WHERE id=?");
    $stmt->bind_param('sssssssssi', $last_name, $first_name, $middle_name, $gender, $date_of_birth, $phone, $address, $email, $comment, $id);

    if ($stmt->execute()) {
        $message = '<span style="color:green;">Запись обновлена</span>';
        // Обновляем текущую запись
        $result = $mysqli->query("SELECT * FROM contacts WHERE id=$id");
        $record = $result->fetch_assoc();
    } else {
        $message = '<span style="color:red;">Ошибка обновления</span>';
    }

    $stmt->close();
}

// Вывод списка для выбора
$html = '<h2>Редактировать запись</h2>';

$html .= '<div>Выберите запись для редактирования:</div><ul>';
foreach ($records as $rec) {
    $style = (isset($_GET['id']) && $_GET['id'] == $rec['id']) ? 'style="font-weight:bold; color:red;"' : '';
    $html .= "<li $style><a href='?menu=edit&id={$rec['id']}'>{$rec['last_name']} {$rec['first_name']}</a></li>";
}
$html .= '</ul>';

// Если выбрана запись, показываем форму
if ($record) {
    $html .= $message;
    $html .= "<form method='post' action=''>
        <input type='hidden' name='id' value='{$record['id']}'>
        <label>Фамилия: <input type='text' name='last_name' value='" . htmlspecialchars($record['last_name']) . "' required></label><br>
        <label>Имя: <input type='text' name='first_name' value='" . htmlspecialchars($record['first_name']) . "' required></label><br>
        <label>Отчество: <input type='text' name='middle_name' value='" . htmlspecialchars($record['middle_name']) . "'></label><br>
        <label>Пол:
            <select name='gender' required>
                <option value='М'" . ($record['gender']=='М' ? ' selected' : '') . ">М</option>
                <option value='Ж'" . ($record['gender']=='Ж' ? ' selected' : '') . ">Ж</option>
            </select>
        </label><br>
        <label>Дата рождения: <input type='date' name='date_of_birth' value='" . htmlspecialchars($record['date_of_birth']) . "' required></label><br>
        <label>Телефон: <input type='text' name='phone' value='" . htmlspecialchars($record['phone']) . "'></label><br>
        <label>Адрес: <input type='text' name='address' value='" . htmlspecialchars($record['address']) . "'></label><br>
        <label>Е-mail: <input type='email' name='email' value='" . htmlspecialchars($record['email']) . "'></label><br>
        <label>Комментарий: <textarea name='comment'>" . htmlspecialchars($record['comment']) . "</textarea></label><br>
        <input type='submit' value='Обновить'>
    </form>";
}

$mysqli->close();

echo $html;
?>
