<?php

namespace Overlu\Log\Drivers;

use Overlu\Log\Driver;
use Overlu\Log\Utils\Request;

class Operation extends Driver
{
    public $type = null; // insert update delete
    public $owner = [];
    public $content_before = [];
    public $content_after = [];
    public $table = null;
    public $remark = null;

    /**
     * @param string|null $type
     * @param array $content_before
     * @param array $content_after
     * @param null $table
     * @param array $owner
     * @param null $remark
     * @return bool|mixed|string
     */
    public function push(string $type = null, array $content_before = [], array $content_after = [], $table = null, $owner = [], $remark = null)
    {
        $operation_log_data = [
            'site_id' => $this->getSiteId(),
            'project_code' => $this->getProjectCode(),
            'type' => $type ?? $this->type,
            'content_before' => json_encode($content_before ?? $this->content_before, JSON_UNESCAPED_UNICODE),
            'content_after' => json_encode($content_after ?? $this->content_after, JSON_UNESCAPED_UNICODE),
            'table' => $table ?? $this->table,
            'owner' => json_encode($owner ?? $this->owner, JSON_UNESCAPED_UNICODE),
            'remark' => $remark ?? $this->remark,
        ];

        return Request::post(env('LOGHUB_SERVER') . '/api/logs/operation', $operation_log_data);

    }

    /**
     * @param array $owner
     * @return Operation
     */
    public function owner(array $owner): Operation
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @param array $content_before
     * @param array $content_after
     * @return Operation
     */
    public function content(array $content_before = [], array $content_after = []): Operation
    {
        $this->content_before = $content_before;
        $this->content_after = $content_after;
        return $this;
    }

    /**
     * @param string $remark
     * @return Operation
     */
    public function remark(string $remark): Operation
    {
        $this->remark = $remark;
        return $this;
    }

    /**
     * @param string $table
     * @return Operation
     */
    public function table(string $table): Operation
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param string $type
     * @return Operation
     */
    public function type(string $type): Operation
    {
        $this->type = $type;
        return $this;
    }

}
