<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StoriesEntries
 *
 * @property int $user_id
 * @property int $story_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereUserId($value)
 * @mixin \Eloquent
 */
class UserStory extends Model
{
    //
    protected $table = 'users_stories';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function usersPerStory($story_id)
    {
        $this->whereStoryId($story_id)->count();
    }
}
