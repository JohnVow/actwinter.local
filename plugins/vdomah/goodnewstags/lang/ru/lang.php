<?php return [
    'plugin' => [
        'name' => 'GoodNewsTags',
        'description' => 'Добавляет тэги в статьям GoodNews'
    ],
    'tag' => [
        'label' => 'Тэги',
        'tab' => 'Тэги',
        'menu' => 'Тэги',
        'name' => 'Тэг',
    ],
    'component' => [
        'taglist' => [
            'name' => 'Список тэгов',
            'description' => 'Список тэгов, которые привязаны хоть к одной статье',
        ],
        'sorting_name_asc'     => 'По имени тэга (asc)',
        'sorting_name_desc'    => 'По имени тэга (desc)',
        'sorting_article_count_asc'  => 'По кол-ву статей прикрепленных к тегу (asc)',
        'sorting_article_count_desc' => 'По кол-ву статей прикрепленных к тегу (desc)',
        'empty_tags_redirect_page' => 'Страницу для переадрессации если параметр тега пуст',
        'tags_limit' => 'Кол-во тегов для отображения',
        'tags_limit_validation' => 'Недопустимый Формат. Ожидаемый тип данных - действительное число.',
        'tag_get_param' => 'Параметр для тегов в гет запросе',
        'tag_get_param_description' => 'Параметр для передачи значения выбранного тега',
    ],
];