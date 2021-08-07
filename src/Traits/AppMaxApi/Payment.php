<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait Payment
{
	public function createPayment(array $data)
    {
		$payment = '/credit-card';

		if( isset( $data['payment']['Boleto'] ) )
			$payment = '/boleto';

		$this->endpoint = 'api/v3/payment'. $payment ;

		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate( $data, [
			'cart.order_id'								=> 'required|integer',
			'customer.customer_id'						=> 'required|integer',
			'payment.CreditCard'						=> 'required_without:payment.Boleto',
			'payment.CreditCard.token'					=> 'nullable',
			'payment.CreditCard.upsell_hash'			=> 'nullable',
			'payment.CreditCard.number'					=> 'required_without_all:payment.CreditCard.token,payment.Boleto',
			'payment.CreditCard.cvv'					=> 'required_with:payment.CreditCard.number|string',
			'payment.CreditCard.month'					=> 'required_with:payment.CreditCard.number|integer',
			'payment.CreditCard.year'					=> 'required_with:payment.CreditCard.number|integer',
			'payment.CreditCard.document_number'		=> 'required_with:payment.CreditCard.number|size:11|string',
			'payment.CreditCard.name'					=> 'nullable|min:1|string',
			'payment.CreditCard.installments'			=> 'required_with:payment.CreditCard.number|integer',
			'payment.CreditCard.soft_descriptor'		=> 'nullable|string|max:13',
			'payment.Boleto'							=> 'required_without:payment.CreditCard',
			'payment.Boleto.document_number'			=> 'required_without:payment.CreditCard|size:11|string'
		]);

		$this->options[ 'json' ] = $data;

		$this->setAccessToken();

		return $this->doAppMaxRequest();
    }
}
