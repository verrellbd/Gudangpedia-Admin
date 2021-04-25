<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    //
    protected $table = 'transaction_item';
    protected $fillable = [
        'unit_id', 'transaction_id'
    ];
    protected $primaryKey = 'transaction_item_id';
    public $timestamps = false;

    public function unit()
    {
        return $this->belongsTo('App\Unit', 'unit_id', 'unit_id');
    }
}
