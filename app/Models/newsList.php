<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsList extends Model
{
    use HasFactory;
    protected $fillable = [
        'no',
        'photo',
        'title',
        'type',
        'detail',
    ];
}
