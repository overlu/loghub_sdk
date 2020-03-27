<?php


namespace Overlu\Log;


class Driver
{
    /**
     * Driver constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (!$this->check()) {
            throw new \Exception("Permission verification failed.");
        }
    }

    /**
     * 获取站点ID
     * @return mixed|null
     */
    protected function getSiteId()
    {
        return env('SITE_ID', 0);
    }

    /**
     * 获取操作日志库编码
     * @return string
     */
    protected function getOperationCode()
    {
        return 'operation';
    }

    /**
     * 获取错误日志库编码
     * @return string
     */
    protected function getErrorCode()
    {
        return 'error';
    }

    protected function getProjectCode()
    {
        return env('APP_CODE');
    }

    /**
     * @return bool
     */
    protected function check()
    {
        // TODO 安全验证
        return true;
    }

}
