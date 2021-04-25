<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payment';
    protected $fillable = [
        'method_id', 'start_date', 'promo_id', 'end_date', 'status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'payment_id';

    public function method()
    {
        return $this->belongsTo('App\Method', 'method_id', 'method_id');
    }

    public function promo()
    {
        return $this->belongsTo('App\Promo', 'promo_id', 'promo_id');
    }
}
