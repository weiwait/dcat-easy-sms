<?php

namespace Weiwait\DcatEasySms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SmsGateway extends Model
{
    protected $casts = [
        'configs' => 'array',
    ];

    protected $fillable = [
        'gateway', 'name', 'configs'
    ];

    public static function gateways(): array
    {
        return self::all()->map(function (self $gateway) {
            return [$gateway->gateway => collect($gateway->configs)->map(function ($item) use ($gateway) {
                return [$item['key'] => SmsConfig::get($gateway->gateway . '@' . $item['key'])];
            })->collapse()];
        })->collapse()->toArray();
    }
}
