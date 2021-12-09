<?php

return [
    'plugin' => [
        'name' => 'Buddies Group',
        'description' => 'Add groups to Buddies User model',
    ],
    'permissions' => [
        'access_groups' => 'Manage User Groups',
    ],
    'user' => [
        'groups' => 'Groups',
        'empty_groups' => 'There are no user groups available.',
    ],
    'group' => [
        'label' => 'Group',
        'id' => 'ID',
        'name' => 'Name',
        'description_field' => 'Description',
        'code' => 'Code',
        'code_comment' => 'Enter a unique code used to identify this group.',
        'created_at' => 'Created',
        'users_count' => 'Users',
    ],
    'groups' => [
        'menu_label' => 'Groups',
        'all_groups' => 'User Groups',
        'new' => 'New Group',
        'delete_selected_confirm' => 'Do you really want to delete selected groups?',
        'list_title' => 'Manage Groups',
        'delete_confirm' => 'Do you really want to delete this group?',
        'delete_selected_success' => 'Successfully deleted the selected groups.',
        'delete_selected_empty' => 'There are no selected groups to delete.',
        'return_to_list' => 'Back to groups list',
        'return_to_users' => 'Back to users list',
        'create_title' => 'Create User Group',
        'update_title' => 'Edit User Group',
        'preview_title' => 'Preview User Group',
    ],
];
