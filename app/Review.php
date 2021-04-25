<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'review';
    protected $fillable = ['storage_id', 'description', 'rate'];
    protected $primaryKey = 'review_id';
}
