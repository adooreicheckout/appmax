<?php 

return [

	/**
	 * 
	 * AppMax Settings and API Credentials
	 * Created by Hebert Lima <hebert.dev@hotmail.com>
	 * 
	 */

	/*
	|--------------------------------------------------------------
	| Mode
	|--------------------------------------------------------------
	| 
	| Change between sandbox and production
	| Supported: "sandbox", "production"
	| 
	*/
	
	'mode' => env('APPMAX_MODE', 'sandbox'),

	'notify_url' => env('APPMAX_NOTIFY_URL', 'appmax/notifications'),

	'store_name' => env('APPMAX_STORE_NAME', 'AppMax'),

	'token' => env('APPMAX_TOKEN', ''),
];