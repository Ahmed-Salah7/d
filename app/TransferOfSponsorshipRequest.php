<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferOfSponsorshipRequest extends Model
{
    protected $fillable = [
        'customer_id_current',
        'worker_id',
        'customer_id_new',
        'date_transfer_sponsorship',
        'cost_transfer_sponsorship',
        'expiration_date_experiment',
        'daily_salary',
        'attatches',
        'notes',
    ];

    public function worker(){
        return $this->belongsTo(Worker::class,'worker_id');
    }

    public function customer_current(){
        return $this->belongsTo(Customer::class,'customer_id_current');
    }

    public function customer_new(){
        return $this->belongsTo(Customer::class,'customer_id_new');
    }

}
