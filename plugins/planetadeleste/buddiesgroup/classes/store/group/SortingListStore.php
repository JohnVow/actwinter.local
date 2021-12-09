<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Store\Group;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;
use Lovata\Buddies\Models\Group;
use PlanetaDelEste\BuddiesGroup\Classes\Store\GroupListStore;

/**
 * Class SortingListStore
 *
 * @package PlanetaDelEste\BuddiesGroup\Classes\Store\Group
 */
class SortingListStore extends AbstractStoreWithParam
{
    protected static $instance;

    /**
     * Get ID list from database
     *
     * @return array
     */
    protected function getIDListFromDB(): array
    {
        $arElementIDList = [];

        if (!$this->sValue) {
            $arElementIDList = $this->getDefaultList();
        } else {
            list($sColumn, $sDirection) = explode("|", $this->sValue);
            if ($sColumn) {
                if (!$sDirection) {
                    $sDirection = 'asc';
                }
                $arElementIDList = Group::orderBy($sColumn, $sDirection)->lists('id');
            }
        }

        return $arElementIDList;
    }

    /**
     * Get default list
     *
     * @return array
     */
    protected function getDefaultList(): array
    {
        return Group::lists('id');
    }
}
