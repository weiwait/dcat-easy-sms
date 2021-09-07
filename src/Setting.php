<?php

namespace Weiwait\DcatEasySms;

use Dcat\Admin\Extend\Setting as Form;
use Dcat\Admin\Form\NestedForm;
use Weiwait\DcatEasySms\Models\SmsConfig;
use Weiwait\DcatEasySms\Models\SmsGateway;

class Setting extends Form
{
    public function form()
    {
        $this->tab('配置', function () {
            $this->number('timeout', '超时(秒)')->default(5);
        });

        $this->tab('新增服务', function () {
            $this->text('gateway', '短信服务商')->help('e.g aliyun');
            $this->text('name', '名称')->help('e.g 阿里云');
            $this->table('configs', '配置项', function (NestedForm $form) {
                $form->text('key');
            });
        });
    }

    public function handle(array $input): \Dcat\Admin\Http\JsonResponse
    {
        SmsConfig::set(['timeout' => $input['timeout']]);

        if ($input['gateway']) {
            if (!isset($input['configs']) || count($input['configs']) < 1) {
                return $this->response()->error('配置项错误');
            }

            SmsGateway::query()->create($input);
        }

        return $this->response()->success('配置成功');
    }

    public function default(): array
    {
        return [
            'timeout' => SmsConfig::get('timeout'),
        ];
    }
}
