<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait TokenCreditCard
{
    public function createTokenCreditCard(array $data)
    {
        $this->endpoint = 'api/v3/tokenize/card';
        
		$this->url = collect([ $this->config['api_url'], $this->endpoint ])->implode('/');

        $this->verb = 'POST';

		$this->validate($data, [
			'card.name'				=> 'nullable|min:1',
			'card.number'			=> 'required|size:16',
			'card.cvv'				=> 'required|min:2|max:4',
			'card.month'			=> 'required|integer',
			'card.year'				=> 'required|integer',
		]);

		$this->options[ 'json' ] = $data;
		
		$this->setAccessToken();
		
		return $this->doAppMaxRequest();
    }
}