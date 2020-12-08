<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoices';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function Customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function contract()
    {
        return $this->belongsTo('App\EmploymentContract', 'contract_id', 'id');
    }

    public function CustomerDetail()
    {
        return $this->belongsTo('App\CustomerDetail', 'customer_id', 'customer_id');
    }

}
