<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';

    protected $fillable = [
        'name',
        'code',
        'category',
        'condition',
        'status',
        'description',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function checkins()
    {
        return $this->hasMany(Checkin::class);
    }
}