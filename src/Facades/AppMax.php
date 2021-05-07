<?php

namespace Hdelima\AppMax\Facades;

use Illuminate\Support\Facades\Facade;

class AppMax extends Facade {
	
	protected static function getFacadeAccessor()
	{
		return 'Hdelima\AppMax\AppMaxFacadeAccessor';
	}
}