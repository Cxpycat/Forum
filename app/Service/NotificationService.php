<?php

namespace App\Service;

use App\Models\Notification;
use App\Events\StoreNotificationEvent;

class NotificationService
{

    static function store ($message, $user_id = null, $title)
    {
        $user_id = $user_id ?? $message->user_id;
        $notification = Notification::create([
            'title' => $title,
            'user_id' => $user_id,
            'url' => route('themes.show', $message->theme_id) . '#' . $message->id,
        ]);
        event(new StoreNotificationEvent($notification));
    }

}
