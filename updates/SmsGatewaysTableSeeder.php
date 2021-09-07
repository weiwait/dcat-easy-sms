<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SmsGatewaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sms_gateways')->delete();
        
        \DB::table('sms_gateways')->insert(array (
            0 => 
            array (
                'configs' => '[{"key": "access_key_id"}, {"key": "access_key_secret"}, {"key": "sign_name"}]',
                'created_at' => '2021-09-06 09:54:11',
                'gateway' => 'aliyun',
                'id' => 1,
                'name' => '阿里云',
                'updated_at' => '2021-09-06 09:54:11',
            ),
            1 => 
            array (
                'configs' => '[{"key": "app_key"}]',
                'created_at' => '2021-09-07 01:44:57',
                'gateway' => 'juhe',
                'id' => 2,
                'name' => '聚合数据',
                'updated_at' => '2021-09-07 01:44:57',
            ),
            2 => 
            array (
                'configs' => '[{"key": "sdk_app_id"}, {"key": "app_key"}, {"key": "sign_name"}]',
                'created_at' => '2021-09-07 01:46:03',
                'gateway' => 'qcloud',
                'id' => 3,
                'name' => '腾讯云',
                'updated_at' => '2021-09-07 01:46:03',
            ),
        ));
        
        
    }
}