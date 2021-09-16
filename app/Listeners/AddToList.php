<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use App\Models\Lists;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddToList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(FileUploaded $event)
    {
        $model = new Lists();
        $model->file_id = $event->data['file_id'];
        $model->filename = $event->data['filename'];
        $model->link = $event->data['link'];
        $model->creator_email = $event->data['creator_email'];
        $model->download_count = 0;

        $model->save();
    }
}
