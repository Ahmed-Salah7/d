<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalRequest extends Model
{
    protected $fillable = [
        'worker_id',
        'customer_id',
        'duration_in_month',
        'start_rental',
        'cost',
        'other_cost',
        'attatches',
        'total_cost',
        'notes',
    ];

    public function worker(){
        return $this->belongsTo(Worker::class,'worker_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
