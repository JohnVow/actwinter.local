<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Store\User;

use Lovata\Buddies\Models\User;
use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;

class ListByGroupStore extends AbstractStoreWithParam
{
    protected static $instance;

    /**
     * @inheritDoc
     */
    protected function getIDListFromDB(): array
    {
        return User::whereHas(
            'groups',
            function ($obQuery) {
                /** @var \October\Rain\Database\Builder $obQuery */
                $sColumn = is_numeric($this->sValue) ? 'id' : 'code';
                return $obQuery->where($sColumn, $this->sValue);
            }
        )->lists('id');
    }
}
