<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use PlanetaDelEste\BuddiesGroup\Classes\Store\User\ListByGroupStore;
use PlanetaDelEste\BuddiesGroup\Classes\Store\User\SearchListStore;
use PlanetaDelEste\BuddiesGroup\Classes\Store\User\SortingListStore;

/**
 * Class UserListStore
 *
 * @package PlanetaDelEste\BuddiesGroup\Classes\Store
 *
 * @property ListByGroupStore $group
 * @property SortingListStore $sorting
 * @property SearchListStore  $search
 */
class UserListStore extends AbstractListStore
{
    const SORT_BY_NAME = 'name|asc';
    const SORT_BY_NAME_DESC = 'name|desc';
    const SORT_BY_EMAIL = 'email|asc';
    const SORT_BY_EMAIL_DESC = 'email|desc';
    const SORT_BY_LATEST = 'created_at|desc';
    const SORT_BY_OLDEST = 'created_at|asc';
    const SORT_BY_ASC = 'asc';
    const SORT_BY_DESC = 'desc';

    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('group', ListByGroupStore::class);
        $this->addToStoreList('sorting', SortingListStore::class);
        $this->addToStoreList('search', SearchListStore::class);
    }
}
