<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Event;

use Backend;
use Lovata\Toolbox\Classes\Event\AbstractBackendMenuHandler;

class ExtendBackendMenuHandler extends AbstractBackendMenuHandler
{

    /**
     * @inheritDoc
     */
    protected function addMenuItems($obManager)
    {
        $arMenuItemData = [
            'label' => 'planetadeleste.buddiesgroup::lang.groups.menu_label',
            'url' => Backend::url('planetadeleste/buddiesgroup/usergroups'),
            'icon' => 'icon-users',
            'permissions' => ['planetadeleste.buddiesgroup.access_groups'],
            'order' => 600,
        ];

        $obManager->addSideMenuItem(
            'Lovata.Buddies',
            'main-menu-buddies',
            'usergroups',
            $arMenuItemData
        );
    }
}
