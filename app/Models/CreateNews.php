<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateNews extends Model
{
    use HasFactory;

    protected $table = 'create_news';

    protected $fillable = ['title', 'club_name', 'status', 'description', 'date', 'image_path'];
}
