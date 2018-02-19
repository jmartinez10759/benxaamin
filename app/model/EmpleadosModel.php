<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class EmpleadosModel extends Model
{
    protected $table = "empleados";
    public $fillable = [
    	'id_empleado'
		,'nombre'
		,'email'
		,'puesto'
		,'fecha_nacimiento'
		,'domicilio'
    ];   
}