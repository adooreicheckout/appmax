<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait Payment
{
	public function createPayment(array $data)
    {
        $this->endpoint = 'api/v3/payment/credit-card';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'cart.order_id'								=> 'required|integer',
			'customer.customer_id'						=> 'required|integer',
			'payment.CreditCard.number'					=> 'required|size:16',
			'payment.CreditCard.cvv'					=> 'required|between:2,4',
			'payment.CreditCard.month'					=> 'required|integer',
			'payment.CreditCard.year'					=> 'required|integer',
			'payment.CreditCard.document_number'		=> 'required|size:11',
			'payment.CreditCard.name'					=> 'nullable|min:1',
			'payment.CreditCard.installments'			=> 'required|integer',
			'payment.CreditCard.soft_descriptor'		=> 'nullable|max:13',
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}