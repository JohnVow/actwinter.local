<?php namespace PlanetaDelEste\BuddiesGroup;

use Event;
use PlanetaDelEste\BuddiesGroup\Classes\Event\ExtendBackendMenuHandler;
use PlanetaDelEste\BuddiesGroup\Classes\Event\ExtendUserFieldsHandler;
use PlanetaDelEste\BuddiesGroup\Classes\Event\GroupModelHandler;
use PlanetaDelEste\BuddiesGroup\Classes\Event\User\UserModelHandler;
use System\Classes\PluginBase;

/**
 * BuddiesGroup Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['Lovata.Buddies'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'planetadeleste.buddiesgroup::lang.plugin.name',
            'description' => 'planetadeleste.buddiesgroup::lang.plugin.description',
            'author'      => 'PlanetaDelEste',
            'icon'        => 'icon-users'
        ];
    }

    public function boot()
    {
        Event::subscribe(GroupModelHandler::class);
        Event::subscribe(ExtendBackendMenuHandler::class);
        Event::subscribe(ExtendUserFieldsHandler::class);
        Event::subscribe(UserModelHandler::class);
    }


    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'planetadeleste.buddiesgroup.access_groups' => [
                'tab' => 'planetadeleste.buddiesgroup::lang.plugin.name',
                'label' => 'planetadeleste.buddiesgroup::lang.permissions.access_groups'
            ],
        ];
    }
}
