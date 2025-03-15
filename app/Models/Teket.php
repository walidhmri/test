<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Teket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'priority'
    ];
   
}
