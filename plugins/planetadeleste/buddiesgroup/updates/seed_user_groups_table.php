<?php namespace PlanetaDelEste\BuddiesGroup\Updates;

use Lovata\Buddies\Models\Group;

class SeedUserGroupsTable extends \Seeder
{
    public function run()
    {
        Group::firstOrCreate(['code' => 'guest'],[
            'name' => 'Guest',
            'description' => 'Default group for guest users.'
        ]);

        Group::firstOrCreate(['code' => 'registered'],[
            'name' => 'Registered',
            'description' => 'Default group for registered users.'
        ]);
    }
}
