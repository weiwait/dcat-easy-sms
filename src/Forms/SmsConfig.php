<?php

namespace Weiwait\DcatEasySms\Forms;

use App\Models\User;
use App\Notifications\BindPhoneVerifyCode;
use Dcat\Admin\Widgets\Form;
use Weiwait\DcatEasySms\Models\SmsGateway;

class SmsConfig extends Form
{
    public function form()
    {
        $gateways = SmsGateway::all();

        $sms = $this->radio('gateway', '服务商')
            ->options($gateways->pluck('name', 'gateway'));

        $gateways->each(function (SmsGateway $gateway) use ($sms) {
            $sms->when($gateway->gateway, function () use ($gateway) {
                foreach($gateway->configs as $config) {
                    $this->text($gateway->gateway . '@' . $config['key'], $config['key']);
                }
            });
        });
    }

    public function handle(array $input)
    {
        return \Weiwait\DcatEasySms\Models\SmsConfig::adminFormHandle($this, $input);
    }

    public function default(): array
    {
        return \Weiwait\DcatEasySms\Models\SmsConfig::all()->pluck('value', 'key')->toArray();
    }
}
