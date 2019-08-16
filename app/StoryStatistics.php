<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\StoryStatistics
 *
 * @property int $id
 * @property int $user_id
 * @property int $story_id
 * @property int $words
 * @property int $chars
 * @property int $entries
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StoryStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StoryStatistics extends Model
{
    //
    protected $table = 'story_user_statistics';

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
