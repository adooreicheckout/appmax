<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait Tracking
{
    public function createTracking(array $data)
    {
        $this->endpoint = 'api/v3/order/delivery-tracking-code';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'order_id'					=> 'required|integer',
			'delivery_tracking_code'	=> 'required|max:255'
		]);
		
		$this->options[ 'json' ] = $data;

		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}