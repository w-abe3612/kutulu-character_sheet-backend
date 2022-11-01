<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CharacterInfos extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_info_id',
        'user_id',
        'public_page_token'
    ];
}
