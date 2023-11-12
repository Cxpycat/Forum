<?php

namespace App\Events;

use App\Http\Resources\Notification\NotificationResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreNotificationEvent implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $notification;

    /**
     * Create a new event instance.
     */
    public function __construct($notification)
    {
        //
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('users.notifications.' . $this->notification->user_id),
        ];
    }

    public function broadcastAs()
    {
        return 'user_notifications';
    }


    public function broadcastWith()
    {
        return [
            'data' => NotificationResource::make($this->notification)->resolve(),
        ];
    }

}
