<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KutuluInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_info_id',
        'user_id',
        'player_name',
        'character_title',
        'injury_value',
        'possession_item',
        'character_preference',
    ];
}