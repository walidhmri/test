<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'priority',
        'file'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
