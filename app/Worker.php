<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'sponser_name',
        'nationality_id',
        'profession_id',
        'age',
        'enter_date',
        'passport_number',
        'office_id',
        'accoumodation_type_id',
        'religion_id',
        'qualifications_and_rxperience_id',
        'passport_image',
        'additional_attchements',
        'notes',
    ];

    public function scopeUsed($query,$id=null)
    {
        return $query
            ->doesnthave('transferOfSponsorshipRequest')
            ->doesnthave('relay')
            ->doesnthave('rentalRequest')
            ->orWhereHas('rentalRequest',function ($q){
                return !$q->whereRaw('NOW() >= DATE_ADD(start_rental, INTERVAL +duration_in_month MONTH)');
            })
            ->orWhere('id',$id);
    }

    public function nationality(){
        return $this->belongsTo(Nationalitie::class,'nationality_id');
    }

    public function profession(){
        return $this->belongsTo(Profession::class,'profession_id');
    }

    public function religion(){
        return $this->belongsTo(Religion::class,'religion_id');
    }

    public function accoumodationType(){
        return $this->belongsTo(AccoumodationType::class,'accoumodation_type_id');
    }
    public function office(){
        return $this->belongsTo(Offices::class,'office_id');
    }

    public function rentalRequest(){
        return $this->hasMany(RentalRequest::class,'worker_id');
    }

    public function transferOfSponsorshipRequest(){
        return $this->hasMany(TransferOfSponsorshipRequest::class,'worker_id');
    }

    public function relay(){
        return $this->hasMany(Relay::class,'worker_id');
    }
}
