<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    public function club()
{
    return $this->belongsTo(Club::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}