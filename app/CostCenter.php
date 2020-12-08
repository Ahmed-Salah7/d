<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CostCenter extends Model
{
    use SoftDeletes;
    protected $table = 'cost_centers';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
}
