<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class SkillModel extends Model
{
    protected $table = "skill";
    public $fillable = [
    	'id_skill'
        ,'nombre'
        ,'descripcion'
    ];   
}
            