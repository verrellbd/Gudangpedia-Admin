<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected $fillable = [
        'type', 'size', 'high_size', 'wide_size', 'long_size', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'detail_id';
}
