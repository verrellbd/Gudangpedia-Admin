<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transaction';
    protected $fillable = [
        'user_id', 'payment_id', 'slot', 'state', 'insurance', 'pin', 'total_price', 'start_rent', 'end_rent', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'transaction_id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
