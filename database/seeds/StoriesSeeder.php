<?php

use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 2)->create()->each(function ($user) {
            factory(\App\Story::class, 10)->create(['owner_id' => $user->id]);
        });
    }
}
