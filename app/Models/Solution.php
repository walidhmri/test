<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = ['user_id', 'teket_id', 'title', 'description', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teket()
    {
        return $this->belongsTo(Teket::class);
    }
}
