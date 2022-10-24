<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialzedSkills extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_info_id',
        'skill_name',
        'skill_order',
        'skill_param',
        'skill_type',
        'skill_value',
        'user_id',
    ];
}
