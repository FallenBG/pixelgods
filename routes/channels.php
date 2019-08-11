<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('App.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

//Broadcast::channel('my-channel', function ($user) {
//    return $user;
//});

//Broadcast::channel('chat.{storyId}', function ($user, $storyId) {
Broadcast::channel('chat.{storyId}', function ($user, $storyId) {
    if ($user->id == '5') {
        return false;
    }

    if ($user->joinedStories()->where('story_id', '=', $storyId) || $user->ownedStories()->where('id', '=', $storyId)) {
        return array('name' => $user->name);
    }

});