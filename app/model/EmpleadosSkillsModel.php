<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class EmpleadosSkillsModel extends Model
{
    protected $table = "empleado_skill";
    public $fillable = [
    	'id_empleado_skill'
		,'id_skill'
		,'id_empleado'
    ];   

}