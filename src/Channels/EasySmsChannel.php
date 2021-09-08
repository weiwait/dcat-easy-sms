<?php

namespace Weiwait\DcatEasySms\Channels;

use Illuminate\Notifications\Notification;
use Overtrue\EasySms\EasySms;
use Weiwait\DcatEasySms\Models\SmsConfig;
use Weiwait\DcatEasySms\Models\SmsGateway;

class EasySmsChannel
{
    public function send($notifiable, Notification $notification): array
    {
        $config = [
            'timeout' => SmsConfig::get('timeout', 5),
            // 默认发送配置
            'default' => [
                // 网关调用策略，默认：顺序调用
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

                // 默认可用的发送网关
                'gateways' => [
                    SmsConfig::get('gateway')
                ],
            ],
            'gateways' => array_merge([
                'file' => '/tmp/easy-sms.log',
            ], SmsGateway::gateways()),
        ];

        $msg = $notification->toEasySms($notifiable);

        $easySms = new EasySms($config);

        if (is_object($notifiable) && $to = $notifiable->routeNotificationFor('easySms', $notification)) {
            return $easySms->send($to, $msg);
        } else {
            return $easySms->send($msg['to'], $msg);
        }
    }
}
