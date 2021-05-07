<?php

namespace Hdelima\AppMax;

use Exception;
use Hdelima\AppMax\Services\AppMax as AppMaxClient;

class AppMaxFacadeAccessor {
	
	public static $provider;

	public static function getProvider()
	{
		return self::$provider;
	}

	public static function setProvider()
	{
		self::$provider = new AppMaxClient();

		return self::getProvider();
	}
}
