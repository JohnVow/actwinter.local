<?php namespace Site21\Fields\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Fields Back-end Controller
 */
class Fields extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $requiredPermissions = ['site21.fields.add_field_permission'];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Lovata.Shopaholic', 'shopaholic-menu-main', 'fields');

    }

}
