<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StoriesEntries
 *
 * @property int $id
 * @property int $user_id
 * @property int $story_id
 * @property string $entry
 * @property int $deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoriesEntries whereUserId($value)
 * @mixin \Eloquent
 */
class StoriesEntries extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

}
