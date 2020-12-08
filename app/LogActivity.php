<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class LogActivity extends Model
{
    protected $table = 'activity_log';   
    public $timestamps = true;  
    protected $guarded = [];
}