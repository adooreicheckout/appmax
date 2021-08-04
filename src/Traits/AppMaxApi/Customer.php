<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait Customer
{
    public function createCustomer(array $data)
    {
        $this->endpoint = 'api/v3/customer';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'firstname' 				=> 'required|string|max:100',
			'lastname'					=> 'required|string|max:100',
			'email'						=> 'required|email|max:255',
			'telephone'					=> 'required|string|max:11',
			'postcode'					=> 'required|string|size:8',
			'address_street'			=> 'required|string|max:255',
			'address_street_number'		=> 'required|string|max:56',
			'address_street_complement'	=> 'nullable|string|max:255',
			'address_street_district'	=> 'required|string|max:255',
			'address_city'				=> 'required|string|max:255',
			'address_state'				=> 'required|string|size:2',
			'ip'						=> 'required|ip',
			'custom_txt'				=> 'nullable|string|max:255',
			'products.*.product_sku'	=> 'nullable|string|max:100',
			'products.*.product_qty'	=> 'nullable|integer',
			'tracking.utm_source'		=> 'nullable|string|max:255',
			'tracking.utm_campaign'		=> 'nullable|mstring|ax:255',
			'tracking.utm_medium'		=> 'nullable|string|max:255',
			'tracking.utm_content'		=> 'nullable|string|max:255',
			'tracking.utm_term'			=> 'nullable|string|max:255'
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}