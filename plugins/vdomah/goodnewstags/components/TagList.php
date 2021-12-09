<?php namespace Vdomah\GoodNewsTags\Components;

use Url;
use Lang;
use Event;
use Cms\Classes\Page;
use Illuminate\Support\Collection;
use Vdomah\GoodNewsTags\Classes\Store\TagListStore;
use Vdomah\GoodNewsTags\Models\Tag;
use Lovata\Toolbox\Classes\Component\SortingElementList;

class TagList extends SortingElementList
{
    const EVENT_GOOD_NEWS_TAGS_TAGLIST_TAG_PARAM_EMPTY = 'vdomah.goodnewstags.taglist.tag_param_empty';

    public function componentDetails()
    {
        return [
            'name'        => 'vdomah.goodnewstags::lang.component.taglist.name',
            'description' => 'vdomah.goodnewstags::lang.component.taglist.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        $arProperties = [
            'sorting' => [
                'title' => 'lovata.goodnews::lang.component.property_sorting',
                'type' => 'dropdown',
                'default' => TagListStore::SORT_NAME_ASC,
                'options' => [
                    TagListStore::SORT_NAME_ASC     => Lang::get('vdomah.goodnewstags::lang.component.sorting_name_asc'),
                    TagListStore::SORT_NAME_DESC    => Lang::get('vdomah.goodnewstags::lang.component.sorting_name_desc'),
                    TagListStore::SORT_ARTICLE_COUNT_DESC => Lang::get('vdomah.goodnewstags::lang.component.sorting_article_count_desc'),
                    TagListStore::SORT_ARTICLE_COUNT_ASC  => Lang::get('vdomah.goodnewstags::lang.component.sorting_article_count_asc'),
                ],
            ],
            'tagsLimit' => [
                'title'             => 'vdomah.goodnewstags::lang.component.tags_limit',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'vdomah.goodnewstags::lang.component.tags_limit_validation',
                'default'           => '10',
            ],
            'tagParameterName' => [
                'title'       => 'vdomah.goodnewstags::lang.component.tag_get_param',
                'description' => 'vdomah.goodnewstags::lang.component.tag_get_param_description',
                'default'     => 'tag',
                'type'        => 'string'
            ],
            'emptyTagRedirectPage' => [
                'title'       => 'vdomah.goodnewstags::lang.component.empty_tag_redirect_page',
                'type'        => 'dropdown',
                'default'     => '',
            ],
        ];

        return $arProperties;
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     *
     * @return Collection
     */
    public function make()
    {
        $obQuery = Tag::has('articles')->withCount('articles');

        switch ($this->property('sorting')) {
            case TagListStore::SORT_NAME_ASC:
                $obQuery = $obQuery->orderBy('name');
                break;
            case TagListStore::SORT_NAME_DESC:
                $obQuery = $obQuery->orderByDesc('name');
                break;
            case TagListStore::SORT_ARTICLE_COUNT_DESC:
                $obQuery = $obQuery->orderByDesc('articles_count');
                break;
            case TagListStore::SORT_ARTICLE_COUNT_ASC:
                $obQuery = $obQuery->orderBy('articles_count');
                break;
        }

        $obQuery = $obQuery->limit($this->property('tagsLimit', 10));

        return $obQuery->get();
    }

    public function onAjaxRequest()
    {
        return true;
    }

    public function getArticleIdsByTag()
    {
        $arArticleIdsByTag = [];

        if ($sTagParamName = $this->property('tagParameterName')) {
            $sTag = get($sTagParamName);

            if ($sTag) {
                if ($obTag = Tag::whereName($sTag)->first()) {
                    $arArticleIdsByTag = $obTag->articles->lists('id');
                }
            }
        }

        return $arArticleIdsByTag;
    }

    public function onRun()
    {
        if ($sTagParamName = $this->property('tagParameterName')) {
            $sTag = get($sTagParamName);

            if ($sTag === '') {
                $result = Event::fire(self::EVENT_GOOD_NEWS_TAGS_TAGLIST_TAG_PARAM_EMPTY, ['tag' => $sTag]);

                if (empty($result)) {
                    $url = Url::to($this->property('empty_tag_redirect_page'));

                    return redirect($url);
                }
            }
        }
    }

    public function getEmptyTagRedirectPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function tagHttpQueryString($obTag) : string
    {
        return http_build_query([$this->property('tagParameterName') => $obTag->slug]);
    }
}