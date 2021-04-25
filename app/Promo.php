<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    //
    protected $table = 'promo';
    protected $fillable = ['start_date', 'end_date', 'name', 'image', 'description', 'discount', 'created_at', 'updated_at'];
    protected $primaryKey = 'promo_id';
}
