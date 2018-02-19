<?php

namespace App\Http\Controllers\Web;

use App\Model\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class EmpleadoWebController extends MasterWebController
{
    
    public function __construct(){
        parent::__construct();
    }
    /**
     *Metodo web donde se crea la pantalla del formulario para agregar los empleados
     *@access public
     *@return void
     */
    public function index(){

    	$url = 'http://'.$this->_domain.'/benxaamin.dev/api/empleados';
    	$headers = ['Content-Type' => 'application/json'];
    	$datos = [];
    	$method = "get";
    	$response = self::endpoint($url,$headers,$datos,$method);
    	#debuger($response);
    	$registros = [];
    	$i = 0;
    	$params = [];
    	if ($response->result) {
    		foreach ( $response->result as $response ) {

    			$registros[] = [
    				'nombre' 			 => $response->nombre
    				,'email' 			 => $response->email
    				,'puesto' 			 => $response->puesto
    				,'fecha_nacimiento'  => $response->fecha_nacimiento
    				,'domicilio' 		 => $response->domicilio
    				,'edit' 			 => build_acciones(['id_empleado' => $response->id_empleado],'update_empleados','Editar','btn btn-primary')
    				,'borrar' 			 => build_acciones(['id_empleado' => $response->id_empleado],'delete_empleados','Borrar','btn btn-danger')
    			];

    		}

    	}

    	 $titulos = [

                    ''
                    ,'Nombre'
                    ,'Email'
                    ,'Puesto'
                    ,'Fecha Nacimiento'
                    ,'Direccion'
                    ,''
                    ,''
                ];
        $table = array(
                'titulos'       => $titulos
                ,'registros'    => $registros
                ,'class'        => "table table-hover table-striped table-response"
                ,'class_thead'   => "head"
        );

    	$data = [
    		'table_empleados' => data_table_general($table)
    	];
    	#debuger($data);
    	return view('api/empleado',$data);    	

    }
    /**
     *Metodo web donde se crea la pantalla del formulario para agregar los empleados
     *@access public
     *@return void
     */
    public function create( Request $request){

    	$empleados = [];
    	foreach ($request->all() as $key => $value) {
    		if ($key != "_token") {
    			$empleados[$key] = $value;
    		}
    		if ($value == null) {
    			return redirect()->route('lista_empleado');
    		}
    	}

    	$url = 'http://'.$this->_domain.'/benxaamin.dev/api/empleados';
    	$headers = ['Content-Type' => 'application/json'];
    	$datos = ['data' => $empleados ];
    	$method = "post";
    	$response = self::endpoint($url,$headers,$datos,$method);
    	if ($response->success == true) {
    		return redirect()->route('lista_empleado');
    	}


    }



}
