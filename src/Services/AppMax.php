<?php

namespace Hdelima\AppMax\Services;

use Exception;
use Hdelima\AppMax\Traits\AppMaxRequest as AppMaxApiRequest;

class AppMax {
	use AppMaxApiRequest;

	public function __construct( $config = '' )
	{
		if ( is_array( $config ) )
			$this->setConfig( $config );

		$this->bodyParams = 'form_params';

		$this->options = [];

		$this->options['headers'] = [
			'Accept' => 'application/json',
		];
	}
	
	protected function setOptions( $credentials )
	{
		$this->config['api_url'] = "https://homolog.sandboxappmax.com.br";

		if( $this->mode === 'production' ) 
			$this->config['api_url'] = 'https://admin.appmax.com.br';
		
		if ( empty( $credentials['token'] ) )
			throw new RuntimeException("Please provide valid Access-Token for $credentials[store_name] store to use AppMax API.");

		$this->config['token'] = $credentials['token'];
	}
}