<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Chat
 *
 * @property int $id
 * @property int $user_id
 * @property int $story_id
 * @property string $message
 * @property int $deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereUserId($value)
 * @mixin \Eloquent
 */
class Chat extends Model
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
