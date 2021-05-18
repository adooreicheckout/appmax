<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;


trait Order
{
	public function createOrder( array $data )
	{
		$this->endpoint = 'api/v3/order';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'total' 			=> 'required_without:products.*.price',
			'products.*.sku'	=> 'required|max:100',
			'products.*.name'	=> 'required|max:255',
			'products.*.qty'	=> 'required|integer',
			'products.*.price' 	=> 'required_without:total',
			'products.*.weight'	=> 'nullable',
			'shipping'			=> 'nullable|numeric',
			'customer_id'		=> 'required|integer',
			'discount'			=> 'nullable|numeric',
			'freight_type'		=> 'nullable|string'
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();

		return $this->doAppMaxRequest();
	}
}