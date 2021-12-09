<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Store\User;

use Lovata\Buddies\Models\User;
use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;

class SearchListStore extends AbstractStoreWithParam
{

    protected static $instance;

    /**
     * @inheritDoc
     */
    protected function getIDListFromDB(): array
    {
        return User::where('name', 'LIKE', "%{$this->sValue}%")
            ->orWhere('last_name', 'LIKE', "%{$this->sValue}%")
            ->orWhere('email', 'LIKE', "%{$this->sValue}%")
            ->orWhere('property', 'LIKE', "%{$this->sValue}%")
            ->lists('id');
    }
}
