<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
   	use SoftDeletes;
   	protected $table = 'invoice_items';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
	
}
