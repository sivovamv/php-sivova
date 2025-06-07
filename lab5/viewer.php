<?php
// viewer.php
require_once 'db_connect.php';

function viewer($sort, $page) {
    // Подключение к базе данных
    $mysqli = get_db_connection();

    // Определение порядка сортировки
    switch ($sort) {
        case 'date_asc':
            $order_by = 'date_of_birth ASC';
            break;
        case 'surname_asc':
            $order_by = 'last_name ASC';
            break;
        case 'surname_desc':
            $order_by = 'last_name DESC';
            break;
        case 'date_desc':
        default:
            $order_by = 'id DESC'; // предполагается, что id — автоинкремент
            break;
    }

    $limit = 10;
    $offset = ($page - 1) * $limit;

    // Получение общего количества записей
    $result_total = $mysqli->query("SELECT COUNT(*) as total FROM contacts");
    $total_row = $result_total->fetch_assoc();
    $total_records = $total_row['total'];

    // Получение данных для текущей страницы
    $query = "SELECT * FROM contacts ORDER BY $order_by LIMIT $limit OFFSET $offset";
    $result = $mysqli->query($query);

    $html = '';

    if ($result) {
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Пол</th>
                    <th>Дата рождения</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                    <th>Е-mail</th>
                    <th>Комментарий</th>
                    <th>Действия</th>
                  </tr>';

        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['middle_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['date_of_birth']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['phone']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['address']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['comment']) . '</td>';
            $html .= '<td>
                        <a href="?menu=edit&id=' . $row['id'] . '">Редактировать</a> | 
                        <a href="?menu=delete&id=' . $row['id'] . '" onclick="return confirm(\'Вы уверены, что хотите удалить эту запись?\');">Удалить</a>
                     </td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        $total_pages = ceil($total_records / $limit);
        if ($total_pages > 1) {
            $html .= '<div style="margin-top:10px;">';

            for ($i = 1; $i <= $total_pages; $i++) {
                $style = ($i == $page) ? 'border:2px solid black; padding:2px;' : '';
                $html .= "<a href='?menu=view&sort=$sort&page=$i' style='margin-right:5px; cursor:pointer; $style'>$i</a>";
            }

            $html .= '</div>';
        }
    } else {
        $html .= 'Нет данных для отображения.';
    }

    $mysqli->close();

    return $html;
}
?>
