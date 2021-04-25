<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    //
    protected $table = 'storage';
    protected $fillable = ['user_id', 'name', 'address', 'code', 'description', 'city', 'rate', 'image', 'image1', 'image2', 'image3', 'start_contract', 'end_contract'];
    protected $primaryKey = 'storage_id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
