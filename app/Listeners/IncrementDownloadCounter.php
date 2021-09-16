<?php

namespace App\Listeners;

use App\Events\FileDownloaded;
use App\Models\Lists;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementDownloadCounter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(FileDownloaded $event)
    {
        /** @var Lists $model */
        $model = Lists::find($event->data['file_id']);

        if (!$model->exists) {
            return;
        }
        $model->increment('download_count');
        $model->save();
    }
}
