<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'customers';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function contracts()
    {
        return $this->hasMany(EmploymentContract::class);
    }
}
