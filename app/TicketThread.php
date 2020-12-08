<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TicketThread extends Model
{
    use SoftDeletes;
   	protected $table = 'ticket_thread';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];

	public function User()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
