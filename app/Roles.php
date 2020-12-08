<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Roles extends Model
{
    use SoftDeletes;
    protected $table = 'roles';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];

}
