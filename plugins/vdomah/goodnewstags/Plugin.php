<?php namespace Vdomah\GoodNewsTags;

use Event;
use Backend;
use Vdomah\GoodNewsTags\Components\TagList;
use Lovata\GoodNews\Controllers\Articles;
use Lovata\GoodNews\Models\Article;
use System\Classes\PluginBase;
use Vdomah\GoodNewsTags\Classes\Handlers\AticlesControllerHandler;

class Plugin extends PluginBase
{
    public $require = ['Lovata.Toolbox', 'Lovata.GoodNews'];

    public function registerComponents()
    {
        return [
            TagList::class => 'TagList',
        ];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Event::subscribe(AticlesControllerHandler::class);

        $this->extendModel();
        $this->extendForm();
        $this->extendSideMenu();
    }

    public function extendModel()
    {
        Article::extend(function($model) {
            $model->belongsToMany['tags'] = [
                'Vdomah\GoodNewsTags\Models\Tag',
                'table' => 'vdomah_goodnewstags_article_tag',
            ];
        });
    }

    public function extendForm()
    {
        Articles::extendFormFields(function($form, $model, $context) {

            if (!$model instanceof Article)
                return;

            $form->addTabfields([
                'tags' => [
                    'label'     => 'vdomah.goodnewstags::lang.tag.label',
                    'tab'       => 'vdomah.goodnewstags::lang.tag.tab',
                    'type'      => 'taglist',
                    'mode'      => 'relation',
                    'span'      => 'left',
                    'path'      => '$/vdomah/goodnewstags/views/_tags.htm'
                ],
            ]);
        });
    }

    public function extendSideMenu()
    {
        Event::listen('backend.menu.extendItems', function($manager) {
            $menu = [
                'side-good-news-tags' => [
                    'label' => 'vdomah.goodnewstags::lang.tag.menu',
                    'icon' => 'icon-tags',
                    'code' => 'tags',
                    'owner' => 'Lovata.GoodNews',
                    'url' => Backend::url('vdomah/goodnewstags/tags'),
                    'order' => 400,
                ],
            ];

            $manager->addSideMenuItems('Lovata.GoodNews', 'main-good-news', $menu);
        });
    }
}
