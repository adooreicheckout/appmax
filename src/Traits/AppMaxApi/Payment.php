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
			'payment.CreditCard'						=> 'required_without:payment.Boleto',
			'payment.CreditCard.token'					=> 'nullable',
			'payment.CreditCard.upsell_hash'			=> 'nullable',
			'payment.CreditCard.number'					=> 'required_without:payment.CreditCard.token,payment.CreditCard.upsell_hash,payment.Boleto|size:16',
			'payment.CreditCard.cvv'					=> 'required_without:payment.CreditCard.token,payment.CreditCard.upsell_hash,payment.Boleto|between:2,4',
			'payment.CreditCard.month'					=> 'required_without:payment.CreditCard.token,payment.CreditCard.upsell_hash,payment.Boleto|integer',
			'payment.CreditCard.year'					=> 'required_without:payment.CreditCard.token,payment.CreditCard.upsell_hash,payment.Boleto|integer',
			'payment.CreditCard.document_number'		=> 'required_without:payment.Boleto|size:11',
			'payment.CreditCard.name'					=> 'nullable|min:1',
			'payment.CreditCard.installments'			=> 'required_without:payment.Boleto|required|integer',
			'payment.CreditCard.soft_descriptor'		=> 'nullable|max:13',
			'payment.Boleto'							=> 'required_without:payment.CreditCard',
			'payment.Boleto.document_number'			=> 'required_without:payment.CreditCard|size:11'
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}