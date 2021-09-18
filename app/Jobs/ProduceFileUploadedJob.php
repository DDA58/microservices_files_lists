<?php

namespace App\Jobs;

use App\Models\Lists;
use Psr\Log\LoggerInterface;
use Throwable;

class ProduceFileUploadedJob extends ABaseJob
{
    private const START_MESSAGE = 'Start [ProduceFileUploadedJob]';
    private const END_MESSAGE = 'End [ProduceFileUploadedJob]';
    private const ERROR_MESSAGE = 'Error [ProduceFileUploadedJob]';

    private array $data;

    public $queue = 'default';

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param LoggerInterface $logger
     * @throws Throwable
     */
    public function handle(LoggerInterface $logger) {
        $logger->info(static::START_MESSAGE, $this->data);

        try {
            $model = new Lists();
            $model->file_id = $this->data['file_id'];
            $model->filename = $this->data['filename'];
            $model->link = $this->data['link'];
            $model->creator_email = $this->data['creator_email'];
            $model->creator_id = $this->data['creator_id'];
            $model->download_count = 0;

            $model->save();
        } catch (Throwable $t) {
            $logger->error(static::ERROR_MESSAGE);
            throw $t;
        }

        $logger->info(static::END_MESSAGE);
    }
}
