<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    //
    protected $table = 'box';
    protected $fillable = ['storage_id', 'detail_id', 'created_at', 'updated_at', 'price'];
    protected $primaryKey = 'box_id';

    public function storage()
    {
        return $this->belongsTo('App\Storage', 'storage_id', 'storage_id');
    }

    public function detail()
    {
        return $this->belongsTo('App\Detail', 'detail_id', 'detail_id');
    }

    public function unit()
    {
        return $this->hasMany('App\Unit', 'unit_id', 'unit_id');
    }
}
