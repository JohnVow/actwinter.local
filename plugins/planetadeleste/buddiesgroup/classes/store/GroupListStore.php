<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use PlanetaDelEste\BuddiesGroup\Classes\Store\Group\SortingListStore;

/**
 * Class GroupListStore
 *
 * @package PlanetaDelEste\BuddiesGroup\Classes\Store
 * @property SortingListStore $sorting
 */
class GroupListStore extends AbstractListStore
{
    const SORT_CREATED_AT_ASC = 'created_at|asc';
    const SORT_CREATED_AT_DESC = 'created_at|desc';
    const SORT_NAME_ASC = 'name|asc';
    const SORT_NAME_DESC = 'name|desc';

    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('sorting', SortingListStore::class);
    }
}
