<?php

namespace App\Jobs;

use App\Models\Lists;
use Psr\Log\LoggerInterface;
use Throwable;

class ProduceUserProfileUpdatedJob extends ABaseJob
{
    private const START_MESSAGE = 'Start [ProduceFileUploadedJob]';
    private const END_MESSAGE = 'End [ProduceFileUploadedJob]';
    private const ERROR_MESSAGE = 'Error [ProduceFileUploadedJob]';

    public $queue = 'default';

    private array $user;

    /**
     * @param array $user
     */
    public function __construct(array $user)
    {
        $this->user = $user;
    }

    public function handle(LoggerInterface $logger) {
        $logger->info(static::START_MESSAGE, $this->user);

        try {
            Lists::where('creator_id', $this->user['id'])
                ->update(['creator_email' => $this->user['email']]);;
        } catch (Throwable $t) {
            $logger->error(static::ERROR_MESSAGE);
            throw $t;
        }

        $logger->info(static::END_MESSAGE);
    }
}
