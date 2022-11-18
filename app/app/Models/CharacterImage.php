<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_info_id',
        'user_id',
        'image_name',
        'image_path',
        'current_flg'
    ];
}
