<?php namespace Vdomah\GoodNewsTags\Classes\Handlers;

use Lovata\GoodNews\Controllers\Articles;
use Lovata\Toolbox\Classes\Event\AbstractExtendRelationConfigHandler;

class AticlesControllerHandler extends AbstractExtendRelationConfigHandler
{

    protected function getControllerClass() : string
    {
        return Articles::class;
    }

    /**
     * Get path to config file
     * @return string
     */
    protected function getConfigPath() : string
    {
        return "$/vdomah/goodnewstags/controllers/tags/_articles_config_relation.yaml";
    }
}