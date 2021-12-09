<?php return [
    'plugin' => [
        'name' => 'GoodNewsTags',
        'description' => 'Add tags to GoodNews articles'
    ],
    'tag' => [
        'label' => 'Tags',
        'tab' => 'Tags',
        'menu' => 'Tags',
        'name' => 'Tag',
    ],
    'component' => [
        'taglist' => [
            'name' => 'Tag List',
            'description' => 'Tag list which belongs to at least one article.',
        ],
        'sorting_name_asc'     => 'By tag name (asc)',
        'sorting_name_desc'    => 'By tag name (desc)',
        'sorting_article_count_asc'  => 'By related articles count (asc)',
        'sorting_article_count_desc' => 'By related articles count (desc)',
        'empty_tags_redirect_page' => 'Page to redirect when tags parameter is empty',
        'tags_limit' => 'Tags limit to show',
        'tags_limit_validation' => 'Invalid format of the tags limit value',
        'tag_get_param' => 'Tag parameter for get request string',
        'tag_get_param_description' => 'Parameter to pass chosen tag value into get request.',
    ],
];