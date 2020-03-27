<?php

namespace Overlu\Log;

use Overlu\Log\Drivers\Error;
use Overlu\Log\Drivers\Operation;
use Overlu\Log\Utils\Request;

class Log
{
    /**
     * @param $type : 操作日志 insert,update,delete
     * @param $content_before : 操作前的数据
     * @param $content_after : 操作后的数据
     * @param $table : 操作的数据表
     * @param $owner : 操作人[id,name]
     * @param $remark : 备注说明
     * @return bool|mixed|string
     * @throws \Exception
     */
    public static function operation($type, $content_before, $content_after, $table, $owner, $remark)
    {
        return (new Operation())->push($type, $content_before, $content_after, $table, $owner, $remark);
    }

    /**
     * @param \Exception $exception
     * @return bool|mixed|string
     * @throws \Exception
     */
    public static function error(\Exception $exception)
    {
        return (new Error())->push(
            $exception->getCode(),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
    }

    /**
     * @param $store_code : 日志库编码
     * @param $content : 内容
     * @param string $type : 日志级别: debug,info(默认),notice,warning,error,alert
     * @return bool|mixed|string
     */
    public static function push($store_code, $content, $type = 'info')
    {
        $log_data = [
            'site_id' => env('SITE_ID', 0),
            'project_code' => env('APP_CODE'),
            'store_code' => $store_code,
            'content' => json_encode($content, JSON_UNESCAPED_UNICODE),
            'type' => $type,
        ];

        return Request::post(env('LOGHUB_SERVER') . '/api/logs', $log_data);
    }

}
