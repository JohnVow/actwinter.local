<?php namespace Vdomah\GoodNewsTags\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;

use Lovata\GoodNews\Classes\Store\Article\PublishedListStore;
use Lovata\GoodNews\Classes\Store\Article\SortingListStore;
use Lovata\GoodNews\Classes\Store\Article\ListByCategoryStore;

/**
 * Class TagListStore
 * @package Vdomah\GoodNewsTags\Classes\Store
 * @author  Art Gek, alchemistt@ukr.net, OctoberDuck
 * @property PublishedListStore  $published
 * @property SortingListStore    $sorting
 * @property ListByCategoryStore $category
 */
class TagListStore extends AbstractListStore
{
    const SORT_NO = 'no';
    const SORT_NAME_ASC = 'name|asc';
    const SORT_NAME_DESC = 'name|desc';
    const SORT_ARTICLE_COUNT_ASC = 'articles_count|asc';
    const SORT_ARTICLE_COUNT_DESC = 'articles_count|desc';

    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('sorting', SortingListStore::class);
    }
}
