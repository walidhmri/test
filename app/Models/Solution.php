<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = ['user_id', 'ticket_id', 'title', 'description', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
