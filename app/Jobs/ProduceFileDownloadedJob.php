<?php

namespace App\Jobs;

use App\Models\Lists;
use Psr\Log\LoggerInterface;
use Throwable;

class ProduceFileDownloadedJob extends ABaseJob
{
    private const START_MESSAGE = 'Start [ProduceFileDownloadedJob]';
    private const END_MESSAGE = 'End [ProduceFileDownloadedJob]';
    private const ERROR_MESSAGE = 'Error [ProduceFileDownloadedJob]';

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
            /** @var Lists $model */
            $model = Lists::find($this->data['file_id']);

            if (!$model->exists) {
                return;
            }
            $model->increment('download_count');
            $model->save();
        } catch (Throwable $t) {
            $logger->error(static::ERROR_MESSAGE);
            throw $t;
        }

        $logger->info(static::END_MESSAGE);
    }
}
