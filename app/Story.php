<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Story
 *
 * @property int $id
 * @property int $owner_id
 * @property string $title
 * @property string $description
 * @property string|null $genre
 * @property int|null $max_participants
 * @property int|null $chars_per_turn
 * @property int|null $skip_step
 * @property int|null $visible_history
 * @property string|null $notes
 * @property int $public
 * @property int $finished
 * @property int $published
 * @property int $deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereCharsPerTurn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereMaxParticipant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereSkipStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Story whereVisibleHistory($value)
 * @mixin \Eloquent
 */
class Story extends Model
{
    //
    protected $guarded = [];


    public function members()
    {
        return $this->belongsToMany(User::class, 'users_stories');
//        return $this->belongsToMany(Story::class, 'users_stories', 'story_id', 'user_id');
//        return $this->hasMany(UseSto::class, 'users_stories', 'story_id', 'user_id');

    }
    public function member()
    {
        return $this->belongsTo(User::class, 'users_stories');
//        return $this->belongsToMany(Story::class, 'users_stories', 'story_id', 'user_id');
//        return $this->hasMany(UseSto::class, 'users_stories', 'story_id', 'user_id');

    }

    public function entries()
    {
        return $this->hasMany(StoriesEntries::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class)->orderBy('created_at');
//        return $this->hasMany(Chat::class)
//            ->leftJoin('users', 'chats.user_id', 'users.id')
//            ->orderBy('chats.created_at');
    }


}
