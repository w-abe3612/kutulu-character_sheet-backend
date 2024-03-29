<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CharacterInfos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'player_character',
        'player_name',
        'public_page_token'
    ];
}
