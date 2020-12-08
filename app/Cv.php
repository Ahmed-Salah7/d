<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Cv extends Model
{
    use SoftDeletes;
    protected $table = 'cv';   
    public $timestamps = true;  
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function Office()
    {
        return $this->belongsTo('App\Offices','office_id','id');
    }

    public function contracts(){
        return $this->hasMany(EmploymentContract::class,'cv_id');
    }

    public function scopeUsed($query,$id=null)
    {
        return $query
            ->doesnthave('contracts')
            ->orWhere('id',$id);
    }


    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('office', function (Builder $builder) {
            if(auth()->user()->office_id) {
                $builder->where('office_id', auth()->user()->office_id);
            }
        });
    }

}
