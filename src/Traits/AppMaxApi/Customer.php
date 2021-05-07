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
			'firstname' 				=> 'required|max:100',
			'lastname'					=> 'required|max:100',
			'email'						=> 'required|email|max:255',
			'telephone'					=> 'required|max:11',
			'postcode'					=> 'required|size:8',
			'address_street'			=> 'required|max:255',
			'address_street_number'		=> 'required|max:56',
			'address_street_complement'	=> 'nullable|max:255',
			'address_street_district'	=> 'required|max:255',
			'address_city'				=> 'required|max:255',
			'address_state'				=> 'required|size:2',
			'ip'						=> 'required|ip',
			'custom_txt'				=> 'nullable|max:255',
			'products.*.product_sku'	=> 'nullable|max:100',
			'products.*.product_qty'	=> 'nullable|integer',
			'tracking.utm_source'		=> 'nullable|max:255',
			'tracking.utm_campaign'		=> 'nullable|max:255',
			'tracking.utm_medium'		=> 'nullable|max:255',
			'tracking.utm_content'		=> 'nullable|max:255',
			'tracking.utm_term'			=> 'nullable|max:255'
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}