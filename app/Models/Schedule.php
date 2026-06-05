<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id', 'subject', 'day',
        'start_time', 'end_time',
        'room', 'instructor', 'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedStartAttribute(): string
    {
        return $this->start_time ? date('g:i A', strtotime($this->start_time)) : '';
    }

    public function getFormattedEndAttribute(): string
    {
        return $this->end_time ? date('g:i A', strtotime($this->end_time)) : '';
    }
}