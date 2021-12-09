<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Collection;

use Lovata\Buddies\Classes\Item\UserItem;
use Lovata\Toolbox\Classes\Collection\ElementCollection;
use PlanetaDelEste\BuddiesGroup\Classes\Store\UserListStore;

/**
 * Class UserCollection
 *
 * @package PlanetaDelEste\BuddiesGroup\Classes\Collection
 */
class UserCollection extends ElementCollection
{
    const ITEM_CLASS = UserItem::class;

    /**
     * @param string|int $sGroupCode Group code|id
     *
     * @return \PlanetaDelEste\BuddiesGroup\Classes\Collection\UserCollection
     */
    public function group($sGroupCode): UserCollection
    {
        $arResultIDList = UserListStore::instance()->group->get($sGroupCode);

        return $this->intersect($arResultIDList);
    }

    /**
     * @param string $sSort
     * @param string $sDirection
     *
     * @return \PlanetaDelEste\BuddiesGroup\Classes\Collection\UserCollection
     */
    public function sort(
        $sSort = UserListStore::SORT_BY_LATEST,
        $sDirection = UserListStore::SORT_BY_DESC
    ): UserCollection {
        $arResultIDList = UserListStore::instance()->sorting->get($sSort, $sDirection);

        return $this->applySorting($arResultIDList);
    }

    /**
     * @param string $sValue
     *
     * @return \PlanetaDelEste\BuddiesGroup\Classes\Collection\UserCollection
     */
    public function search(string $sValue): UserCollection
    {
        $arResultIDList = UserListStore::instance()->search->get($sValue);

        return $this->applySorting($arResultIDList);
    }
}
