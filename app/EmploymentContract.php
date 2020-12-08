<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentContract extends Model
{
    use SoftDeletes;
    protected $table = 'employment_contracts';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }

    public function office()
    {
        return $this->belongsTo(Offices::class);
    }

    public function source()
    {
        return $this->belongsTo(ContractSource::class,'contract_source_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class,'profession_id');
    }
}
