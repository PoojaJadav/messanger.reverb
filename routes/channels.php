<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {

    return (int) $user->id === (int) $id;
});

Broadcast::channel('Chat.{receiver_id}', function ($user, $receiver_id) {
    logger()->debug(sprintf('User %s = Receiver  %s', $user->id, $receiver_id));

    return $user->id === (int) $receiver_id;
});
