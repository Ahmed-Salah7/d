<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsAndAdvantage extends Model
{
	use SoftDeletes;
    protected $table = 'terms_and_advantages';	
	public $timestamps = true;	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
}
