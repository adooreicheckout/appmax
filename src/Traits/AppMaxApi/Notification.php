<?php

namespace Hdelima\AppMax\Traits\AppMaxApi;

trait Notification {
	
	public function getNotifications(int $page = 1, int $limit = 15 ) 
	{
		$this->endpoint = sprintf('app-max/notifications?page=%s&limit=%s', $page, $limit );

		$this->url = collect([ url('/'), $this->endpoint ])->implode('/');

		$this->verb = 'GET';

		return $this->doAppMaxRequest();
	}

	public function showNotification( int $id ) 
	{
		$this->endpoint = sprintf('app-max/notifications/%s', $id );

		$this->url = collect([ url('/'), $this->endpoint ])->implode('/');

		$this->verb = 'GET';

		return $this->doAppMaxRequest();
	}
	
	public function deleteNotification( int $id ) 
	{
		$this->endpoint = sprintf('app-max/notifications/%s', $id );

		$this->url = collect([ url('/'), $this->endpoint ])->implode('/');

		$this->verb = 'DELETE';

		return $this->doAppMaxRequest();
	}
	
	public function updateNotification( int $id, array $data ) 
	{
		$this->endpoint = sprintf('app-max/notifications/%s', $id );

		$this->url = collect([ url('/'), $this->endpoint ])->implode('/');

		$this->verb = 'POST';

		$this->validate($data, [
			'environment' 	=> 'nullable',
			'event'			=> 'nullable',
			'data'			=> 'nullable',
			'status'		=> 'nullable',
		]);

		$this->options[ 'json' ] = $data;

		return $this->doAppMaxRequest();
	}
}