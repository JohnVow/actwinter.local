<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use PlanetaDelEste\BuddiesGroup\Classes\Item\GroupItem;
use PlanetaDelEste\BuddiesGroup\Classes\Store\GroupListStore;

/**
 * Class GroupCollection
 *
 * @package PlanetaDelEste\BuddiesGroup\Classes\Collection
 */
class GroupCollection extends ElementCollection
{
    const ITEM_CLASS = GroupItem::class;

    /**
     * Sort list by
     *
     * @param string|null $sSorting
     *
     * @return $this
     */
    public function sort($sSorting = null)
    {
        $arResultIDList = GroupListStore::instance()->sorting->get($sSorting);

        return $this->applySorting($arResultIDList);
    }
}
