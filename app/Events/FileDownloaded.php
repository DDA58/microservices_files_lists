<?php

namespace App\Events;

use App\Models\File;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class FileDownloaded
{
    use \Illuminate\Foundation\Bus\Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    public array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        var_dump($this->data);
    }
}

