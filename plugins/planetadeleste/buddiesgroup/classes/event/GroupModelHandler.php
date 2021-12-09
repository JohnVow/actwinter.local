<?php namespace PlanetaDelEste\BuddiesGroup\Classes\Event;

use Lovata\Buddies\Models\Group;
use Lovata\Buddies\Models\User;
use Lovata\Toolbox\Classes\Event\ModelHandler;
use PlanetaDelEste\BuddiesGroup\Classes\Item\GroupItem;

class GroupModelHandler extends ModelHandler
{
    protected $iPriority = 800;

    /**
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        Group::extend(
            function ($obModel) {
                $this->extendModel($obModel);
            }
        );
    }

    /**
     * @param Group $obModel
     */
    protected function extendModel($obModel)
    {
        $obModel->belongsToMany['users_count'] = [
            User::class,
            'table' => 'lovata_buddies_users_groups',
            'count' => true
        ];

        $obModel->rules['code'] = 'required|regex:/^[a-zA-Z0-9_\-]+$/|unique:lovata_buddies_groups';
        $obModel->addDynamicMethod(
            'getCachedField',
            function () {
                return [
                    'id',
                    'name',
                    'code',
                    'description',
                ];
            }
        );
    }

    protected function afterSave()
    {
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Group::class;
    }

    /**
     * @inheritDoc
     */
    protected function getItemClass()
    {
        return GroupItem::class;
    }
}
