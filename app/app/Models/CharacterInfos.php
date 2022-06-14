<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterInfos extends Model
{
    use HasFactory;
    /**
     * 
     */
    public function ability_values()
    {
        return $this->hasMany(AbilityValues::class,'character_info_id','id');
    }

    /**
     * 
     */
    public function flavor_infos()
    {
        return $this->hasMany(FlavorInfos::class,'character_info_id','id');
    }

    /**
     * 
     */
    public function specialzed_skills()
    {
        return $this->hasMany(SpecialzedSkills::class,'character_info_id','id');
    }
}
