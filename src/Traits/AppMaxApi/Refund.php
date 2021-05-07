<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait Refund
{
    public function createRefund(array $data)
    {
        $this->endpoint = 'api/v3/refund';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'order_id'			=> 'required|integer',
			'refund_type'		=> 'required|in:total,partial',
			'refund_amount'		=> 'required_if:refund_type,partial'
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}