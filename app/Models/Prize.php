<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table='enevt_prize';
    protected $fillable=['name','description','member_id','events_id',];
}
