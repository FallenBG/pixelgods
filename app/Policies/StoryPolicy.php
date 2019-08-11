<?php

namespace App\Policies;

use App\Story;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryPolicy
{

    use HandlesAuthorization;

//
    public function manage(User $user, Story $story)
    {
        return $user->is($story->owner);

    }//end update()

    public function update(User $user, Story $story)
    {
        return $user->is($story->owner) || $story->members->contains($user);

    }//end update()
}
