<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Event;

use Lovata\Buddies\Controllers\Users;
use Lovata\Buddies\Models\User;
use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

class ExtendUserFieldsHandler extends AbstractBackendFieldHandler
{

    /**
     * @inheritDoc
     */
    protected function extendFields($obWidget)
    {
        $arAdditionalFields = [
            'groups' => [
                'label'       => 'planetadeleste.buddiesgroup::lang.user.groups',
                'tab'         => 'lovata.buddies::lang.tab.data',
                'type'        => 'relation',
                'emptyOption' => 'planetadeleste.buddiesgroup::lang.user.empty_groups',
            ]
        ];

        $obWidget->addTabFields($arAdditionalFields);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    protected function getControllerClass(): string
    {
        return Users::class;
    }
}
