<?php
// menu.php

function menu() {
    // Получение текущего активного пункта
    $current = isset($_GET['menu']) ? $_GET['menu'] : 'view';

    // Основное меню
    $menu_items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    $html = '<div style="margin-bottom:20px;">';

    foreach ($menu_items as $key => $label) {
        $color = ($current == $key) ? 'red' : 'blue';
        $html .= "<a href='?menu=$key' style='color:$color; margin-right:15px; text-decoration:none;'>$label</a>";
    }

    // Если выбран "Просмотр", добавляем дополнительные пункты сортировки
    if ($current == 'view') {
        $sorts = [
            'date_desc' => 'По дате (новые сначала)',
            'date_asc' => 'По дате (старые сначала)',
            'surname_asc' => 'По фамилии (А-Я)',
            'surname_desc' => 'По фамилии (Я-А)'
        ];

        // Получение текущего выбранного типа сортировки
        $current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'date_desc';

        $html .= '<div style="margin-top:10px;">';

        foreach ($sorts as $key => $label) {
            $color = ($current_sort == $key) ? 'red' : 'blue';
            $html .= "<a href='?menu=view&sort=$key' style='color:$color; font-size:smaller; margin-right:10px; text-decoration:none;'>$label</a>";
        }

        $html .= '</div>';
    }

    $html .= '</div>';

    return $html;
}
?>
