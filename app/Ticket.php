<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ticket extends Model
{
   	use SoftDeletes;
   	protected $table = 'tickets';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
	public function User()
    {
        return $this->belongsTo('App\User','close_by','id');
    }
}
