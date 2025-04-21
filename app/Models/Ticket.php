<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Ticket extends Model
{
    use Notifiable;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'priority',
        'file',
        'department_id'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
