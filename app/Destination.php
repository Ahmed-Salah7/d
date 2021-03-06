<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Destination extends Model
{
	use SoftDeletes;
    protected $table = 'destination';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
}
