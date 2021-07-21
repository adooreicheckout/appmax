<?php

namespace Hdelima\AppMax\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMaxNotification extends Model
{
    use HasFactory;

	protected $fillable = [
		'environment',
		'event',
		'status',
		'data'
	];

	protected $casts = ['data' => 'array'];
}
