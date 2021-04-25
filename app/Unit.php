<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['box_id', 'detail_id', 'slot', 'created_at', 'updated_at', 'price'];
    protected $primaryKey = 'unit_id';

    public function box()
    {
        return $this->belongsTo('App\Box', 'box_id', 'box_id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction', 'unit_id', 'unit_id');
    }
}
