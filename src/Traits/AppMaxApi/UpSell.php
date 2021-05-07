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
			'hash' 				=> 'required|size:45',
			'products'			=> 'required',
			'products.*.sku'	=> 'required|max:100',
			'products.*.name'	=> 'required|max:255',
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