# Dcat Admin Extension

### 演示地址
[demo: http://dcat.weiwait.cn (admin:admin)](http://dcat.weiwait.cn/admin/demo-distpickers/create 'user: admin psw: admin')

### 依赖扩展
1. [overtrue/easy-sms](https://github.com/overtrue/easy-sms)

### 通过 composer 安装扩展
```shell
  composer require weiwait/dcat-easy
```

### 通过选项卡使用
```php
    public function index(Content $content): Content
    {
        $tab = Tab::make();
        $tab->add('短信', new \Weiwait\DcatEasySms\Forms\SmsConfig());

        return $content->title('配置')
            ->body($tab->withCard());
    }
```

### 通知
```php
class SomeNotification extends Notification
{
    public function via()
    {
        return [\Weiwait\DcatEasySms\Channels\EasySmsChannel::class];
    }
    
    public function toEasySms($notifiable)
    {
        return [
            'to' => $notifiable,
            'template' => 'SMS_000001',
            'content' => '免模板消息内容',
            'data' => [
                'code' => '模板消息变量${code}'
            ]           
        ]
    }
}
```

### 可通知模型
```php
class User extends Model
{
    use Notifiable;
    
    public function routeNotificationForEasySms($notifiable)
    {
        return $this->phone;
    }
}

class SomeNotification extends Notification
{
    public function via()
    {
        return [\Weiwait\DcatEasySms\Channels\EasySmsChannel::class];
    }
    
    public function toEasySms($notifiable)
    {
        return [
            'template' => 'SMS_000001',
            'data' => [
                'code' => '模板消息变量${code}'
            ]           
        ]
    }
}
```

### 发送通知
```php
Notification::send('15626326950', new SomeNotification());

(new User())->nofity(new SomeNotification());
```

### 示例图片
![示例图片](https://github.com/weiwait/images/blob/main/dcat-sms.png?raw=true)
![示例图片](https://github.com/weiwait/images/blob/main/dcat-sms-ext-setting.png?raw=true)

### Donate

![示例图片](https://github.com/weiwait/images/blob/main/donate.png?raw=true)

### Dcat-admin 扩展列表
1. [单图裁剪](https://github.com/weiwait/dcat-cropper)
2. [区划级联+坐标拾取](https://github.com/weiwait/dcat-distpicker)
3. [smtp快速便捷配置](https://github.com/weiwait/dcat-smtp)
4. [sms channel 快速便捷配置](https://github.com/weiwait/dcat-easy-sms)
