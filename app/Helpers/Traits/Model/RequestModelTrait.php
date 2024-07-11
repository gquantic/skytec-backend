<?php

namespace App\Helpers\Traits\Model;

/**
 * @property string $status
 * @method static mixed getStatusesKeys() return statuses as array
 * @method static mixed getStatusName() get status name as string
 */
trait RequestModelTrait
{
    /**
     * @var array|string[]
     */
    // Statuses
    public array $statuses = [];

    public function __construct()
    {
        $this->statuses = config('statuses.applications');
    }

    /**
     * @return array
     */
    public function getStatusesKeys(): array
    {
        return array_keys($this->statuses);
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return $this->statuses[$this->status];
    }
}
