<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Store\User;

use Lovata\Buddies\Models\User as UserModel;
use Lovata\Toolbox\Classes\Store\AbstractStoreWithTwoParam;
use PlanetaDelEste\BuddiesGroup\Classes\Store\UserListStore;

class SortingListStore extends AbstractStoreWithTwoParam
{
    protected static $instance;

    /**
     * @inheritDoc
     */
    protected function getIDListFromDB(): array
    {
        $arValue = explode('|', $this->sValue);
        $this->sValue = array_shift($arValue);
        $this->sAdditionParam = empty($arValue) ? UserListStore::SORT_BY_ASC : $arValue[0];

        return UserModel::orderBy($this->sValue, $this->sAdditionParam)->lists('id');
    }
}
