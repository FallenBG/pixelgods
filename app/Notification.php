<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property int $story_id
 * @property int $story_entry_id
 * @property string $notification
 * @property int $seen
 * @property string $seen_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereStoryEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUserId($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    //
    protected $guarded = [];
}
