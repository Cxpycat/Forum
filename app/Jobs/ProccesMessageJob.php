<?php

namespace App\Jobs;

use App\Models\Image;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use App\Service\NotificationService;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProccesMessageJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Message
     */
    private Message $message;

    private array $data;

    /**
     * Create a new job instance.
     */
    public function __construct (Message $message, array $data)
    {
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle (): void
    {
        $ids = getId($this->data, '/@[\d]+/', '/@/');
        $image_ids = getId($this->data, '/img_id=[\d]+/', '/img_id=');

        Image::updateMessageId($image_ids, $this->message);

        Image::cleanFromStorage();

        Image::cleanFromTable();

        $this->message->answeredUsers()->attach($ids);

        $ids->each(function ($id) {
            NotificationService::store($this->message, $id, 'Вам ответили');
        });
    }

}
