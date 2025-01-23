<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'club_id']; // Add 'club_id' if you're linking comments to a club

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}

