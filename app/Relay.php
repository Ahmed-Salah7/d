<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relay extends Model
{
    protected $fillable = [
        'worker_id',
        'contract_number',
        'passport_number',
        'customer_id',
        'reason_deportation',
        'date_deportation',
        'airport',
        'attatches',
        'notes',
    ];

    public function worker(){
        return $this->belongsTo(Worker::class,'worker_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
