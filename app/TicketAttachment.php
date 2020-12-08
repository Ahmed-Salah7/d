<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TicketAttachment extends Model
{
    use SoftDeletes;
   	protected $table = 'ticket_attachment';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
}
