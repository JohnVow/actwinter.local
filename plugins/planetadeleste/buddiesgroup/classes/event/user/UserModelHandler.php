<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Event\User;

use Lovata\Buddies\Classes\Item\UserItem;
use Lovata\Toolbox\Classes\Event\ModelHandler;
use Lovata\Buddies\Models\User;

/**
 * Class UserModelHandler
 *
 * @package PlanetaDelEste\BuddiesGroup\Classes\Event\User
 */
class UserModelHandler extends ModelHandler
{
    /** @var User */
    protected $obElement;

    /**
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        UserItem::extend(
            function ($obItem) {
                $this->extendItem($obItem);
            }
        );
    }

    /**
     * @param UserItem $obItem
     */
    protected function extendItem($obItem)
    {
        $obItem->addDynamicMethod(
            'getGroupsAttribute',
            function ($obItem) {
                /** @var UserItem $obItem */
                /** @var User $obModel */
                $obModel = $obItem->getObject();
                $arGroups = $obModel->groups;
                $obItem->setAttribute('groups', $arGroups);

                return $arGroups;
            }
        );

        $obItem->addDynamicMethod(
            'getFullNameAttribute',
            function ($obItem) {
                /** @var UserItem $obItem */
                $arFullName = [$obItem->name, $obItem->middle_name, $obItem->last_name];
                $arFullName = array_filter($arFullName);
                $sFullName = join(" ", $arFullName);
                $obItem->setAttribute('full_name', $sFullName);

                return $sFullName;
            }
        );
    }

    /**
     * Get model class name
     *
     * @return string
     */
    protected function getModelClass()
    {
        return User::class;
    }

    /**
     * Get item class name
     *
     * @return string
     */
    protected function getItemClass()
    {
        return UserItem::class;
    }
}
