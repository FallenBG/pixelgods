<?php
/**
 * Created by PhpStorm.
 * User: FallenBG
 * Date: 07-Aug-19
 * Time: 11:01 AM
 */

namespace Tests\Factory;


use App\Story;
use App\User;

class StoryFactory
{
    public $user = null;
    public $participants;
    public $skip_step;

    public function ownedBy(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function participants($participants)
    {
        $this->participants = $participants;

        return $this;
    }

    public function skipStep($skip_step)
    {
        $this->skip_step = $skip_step;

        return $this;
    }

    public function create()
    {
//        dd('KUR');
        $story = factory(Story::class)->create([
            'owner_id' => $this->user ?? factory(User::class),
        ]);

//        if ($this->participants) {
//            $story->max_participant = $this->participants;
//        }
//        if ($this->skip_step) {
//            $story->skip_step = $this->skip_step;
//        }
//        factory(LeagueMember::class, $this->membersCount)->create([
//            'league_id' => $league->id,
//        ]);

        return $story;
    }
    
}