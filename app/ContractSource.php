<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ContractSource extends Model
{
  	use SoftDeletes;
    protected $table = 'contract_sources';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
}
