### 日志中心SDK

#### Usage
```php
composer require overlu/loghub-sdk
```

##### 相关配置

1. 先在.env文件配置LOGHUB_HUB以及APP_CODE等参数（后续根据配置中心，自动添加更新）
```dotenv
LOGHUB_VERSION=1.0.1
SITE_ID=89
APP_CODE=mxu
LOGHUB_SERVER=http://loghub.test
```

2. 使用
#### 操作日志
```php
/**
 * @param $type : 操作日志 insert,update,delete
 * @param $content_before : 操作前的数据, array
 * @param $content_after : 操作的数据, array
 * @param $table : 操作的数据表, string
 * @param $owner : 操作人[id,name], array
 * @param $remark : 备注说明, string
 */
\Overlu\Log\Log::operation($type, $content_before, $content_after, $table, $owner, $remark);
```

##### Demo
```php
\Overlu\Log\Log::operation(
    'update',
    ['id' => 1, 'name' => 'lupeng'],
    ['name' => '陆鹏'],
    'user',
    ['id' => 9, 'name' => 'admins'],
    '更新用户名'
);
```

#### 错误日志
```php
/**
 * @param \Exception $exception
 */
\Overlu\Log\Log::error(\Exception $exception);
```

##### Demo
```php
try {
    do something...
} catch (Exception $exception) {
    \Overlu\Log\Log::error($exception);
}
```

#### 普通日志
```php
/**
 * @param $store_code : 日志库编码, string
 * @param $content : 内容, array
 * @param string $type : 日志级别: debug,info(默认),notice,warning,error,alert
 */
\Overlu\Log\Log::push($store_code, $content, $type);
```
##### Demo
```php
\Overlu\Log\Log::push('store1', ['message'=>'who do something'], 'info');
\Overlu\Log\Log::push('store2', ['message'=>'who do something error'], 'warning');
\Overlu\Log\Log::push('store3', ['message'=>'something bad'], 'alert');
```
