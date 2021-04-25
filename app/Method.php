<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    //
    protected $table = 'method';
    protected $fillable = ['name', 'created_at', 'updated_at'];
    protected $primaryKey = 'method_id';
}
