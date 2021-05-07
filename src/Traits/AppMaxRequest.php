<?php
namespace Hdelima\AppMax\Traits;

use RuntimeException;

trait AppMaxRequest {

	use AppMaxHttpClient, AppMaxApi;

	public $mode;

	protected $token;

	private $config;

	protected $options;

	public function setCredentials( $credentials )
	{
		if( empty( $credentials ) )
			throw new RuntimeException('Empty configuration provided. Please provide valid configuration for AppMax API.');

		$this->setEnvironment( $credentials );

		$this->setProviderConfig( $credentials );

		$this->setHttpClientConfig();
	}

	private function setConfig( array $config = [])
	{
		$config = function_exists('config') ? config('appmax') : $config;

		$this->setCredentials( $config );
	}

	private function setEnvironment( $credentials )
	{
		$this->mode = 'sandbox';

		if( !empty( $credentials['mode'] ) )
			$this->setValidateApiMode( $credentials['mode'] );
	}

	private function setValidateApiMode( $mode ) {
		$this->mode = !in_array( $mode, ['sandbox', 'production']) ? 'sandbox' : $mode;
	}

	private function setProviderConfig( $credentials )
	{
		$this->setOptions( $credentials );
	}
}