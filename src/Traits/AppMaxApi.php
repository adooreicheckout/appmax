<?php

namespace Hdelima\AppMax\Traits;
use Illuminate\Support\Facades\Validator;

trait AppMaxApi 
{
	use AppMaxApi\Customer;
	use AppMaxApi\Order;
	use AppMaxApi\Payment;
	use AppMaxApi\TokenCreditCard;
	use AppMaxApi\UpSell;
	use AppMaxApi\ReFund;
	use AppMaxApi\Tracking;

	public function setAccessToken()
	{
		$this->options[ 'json' ][ 'access-token' ] = $this->token;
	}

	public function validate( array $data, array $rules )
	{
		$validator = Validator::make( $data, $rules );

		if( $validator->fails() ) 
		{	
			$errors = $validator->errors();
			
			$text = '';

			foreach ($errors->all() as $message) 
				$text .= $message . PHP_EOL;

			throw new \Exception( $text );
		}
	}
}