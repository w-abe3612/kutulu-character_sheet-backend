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
        'player_name',
        'player_character',
        'character_title',
        'injury_value',
        'image_path',
        'ability_value_max',
        'ability_value_total',
        'specialized_skill_max',
        'specialized_skill_total',
        'possession_item',
        'character_preference',
        'delete_flg',
    ];
}
