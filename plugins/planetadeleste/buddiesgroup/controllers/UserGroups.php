<?php namespace PlanetaDelEste\BuddiesGroup\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use Lovata\Buddies\Models\Group;

/**
 * User Groups Back-end Controller
 *
 * @mixin \Backend\Behaviors\ListController
 */
class UserGroups extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Lovata.Buddies', 'main-menu-buddies', 'usergroups');
    }

    /**
     * Deleted checked usergroups.
     *
     * @throws \Exception
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $usergroupId) {
                if (!$usergroup = Group::find($usergroupId)) continue;
                $usergroup->delete();
            }

            Flash::success(Lang::get('planetadeleste.buddiesgroup::lang.groups.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('planetadeleste.buddiesgroup::lang.groups.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
