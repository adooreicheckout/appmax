<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait UpSell
{
    public function createUpSell(array $data)
    {
        $this->endpoint = 'api/v3/order/upsell';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'hash' 				=> 'required|string',
			'products'			=> 'required',
			'products.*.sku'	=> 'required|string|max:100',
			'products.*.name'	=> 'required|string|max:255',
			'products.*.qty'	=> 'required|integer',
			'overwrite_cart'	=> 'required|boolean',
			'installments'		=> 'nullable|integer',
			'shipping'			=> 'nullable|numeric',
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}