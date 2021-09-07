<?php

namespace Weiwait\DcatEasySms;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class DcatEasySmsServiceProvider extends ServiceProvider
{
	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		//

	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
