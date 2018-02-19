<?php

namespace App\Http\Controllers\Web;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MasterWebController extends Controller
{
    
    public $_client;
    public $_tipo_user;
    public $_domain = "127.0.0.1:8080";
    protected $_tipo = "application/json";

    public function __construct(){
        $this->_client = new Client();
        $this->_domain = $_SERVER['HTTP_HOST'];
    }
    /**
     *Metodo general para consumir endpoint utilizando una clase de laravel
     *@access protected
     *@param  url [description]
     *@param  header [description]
     *@param  data [description]
     *@return json [description]
     */
    protected function endpoint( $url = false, $headers = array(), $data = array(),$method=false ){

            $response = $this->_client->$method( $url, ['headers'=> $headers, 'body' => json_encode( $data ) ]);
            $zonerStatusCode = $response->getStatusCode();
            return json_decode($response->getBody());

    }
    /**
	 *Se crea un metodo para mostrar los errores dependinedo la accion a realizar
	 *@access protected
	 *@param int $id []
	 *@return string $errores
	 */
	protected function show_error($id = false, $datos = array()) {

		$errors = [
			#0
			[
				'success' => false,
				'message' => "Acceso Denegado",
				'error'	  => [
					'description' => "No tiene permisos para realizar esta accion",
					'result' 	  => $datos
				 ]

			],
			#1
			[
				'success' => false,
				'message' => "Error en la transaccion",
				'error'	  => [
					'description' => "Token expiro y/o cambio, favor de verificar",
					'result' 	  => $datos
				 ]

			],
			#2
			[
				'success' => false,
				'message' => "Peticion Incorrecta",
				'error'	  => [
					'description' => "El Servicio de Internet es Incorrecto",
					'result' 	  => $datos
				 ]

			],
			#3
			[
				'success' => false,
				'message' => "Identificador diferente y/o vacio",
				'error'	  => [
					'description' => "Ingrese correctamente los campos a consultar",
					'result' 	  => $datos
				 ]

			],
			#4
			[
				'success' => false,
				'message' => "Sin Registros",
				'error'	  => [
					'description' => "No se encontro ningun registro",
					'result' 	  => $datos
				 ]
			],
			#5
			[
				'success' => false,
				'message' => "Sin Registros",
				'error'	  => [
					'description' => "Ingrese datos para poder realizar la inserccion de registros",
					'result' 	  => $datos
				 ]
			]

		];
            return $errors[$id];
	}
    /**
     *Metodo para establecer si se realizo con exito la peticion
     *@access private 
     *@param $codigo [description]
     *@return string [description]
     */
     private function get_status_message( $codigo=false ) {

		     $estado = array(
		       200 => 'OK',
		       201 => 'Created',
		       202 => 'Accepted',
		       204 => 'No Content',
		       301 => 'Moved Permanently',
		       302 => 'Found',
		       303 => 'See Other',
		       304 => 'Not Modified',
		       400 => 'Bad Request',
		       401 => 'Unauthorized',
		       403 => 'Forbidden',
		       404 => 'Not Found',
		       405 => 'Method Not Allowed',
		       500 => 'Internal Server Error'
		   );

		    $respuesta = ($estado[$codigo]) ? $estado[$codigo] : $estado[500];
		    return $respuesta;
   	}
   	/**
     *Metodo donde se destruyen las sessiones cuando el token cambio y/o expiro
     *@access public 
     *@return void
     */
    public function tipo_accion( $method = array(), $clase_name = false, $request = false  ){

        #if ( $this->verify_permison() ) { die( view('auth.session_expire') ); };
        switch ($this->_tipo_user) {

            case 19: 
                foreach ($method[$this->_tipo_user] as $key => $value) {
                    
                    if ($_SERVER['REQUEST_URI'] == $key) {
                        return call_user_func($clase_name.'::'.$value, $request);   
                    }

                }
                die('No cuenta con permisos para realizar esta accion');
                break;
            case 44:
                foreach ($method[$this->_tipo_user] as $key => $value) {
                    
                    if ($_SERVER['REQUEST_URI'] == $key) {
                        return call_user_func($clase_name.'::'.$value, $request);   
                    }

                }
                die('No cuenta con permisos para realizar esta accion');

                break;
            case 45:
                foreach ($method[$this->_tipo_user] as $key => $value) {
                    
                    if ($_SERVER['REQUEST_URI'] == $key) {
                        return call_user_func($clase_name.'::'.$value, $request);   
                    }

                }
                die('No cuenta con permisos para realizar esta accion');

                break;
            case 21:

                foreach ($method[$this->_tipo_user] as $key => $value) {
                    
                    if ($_SERVER['REQUEST_URI'] == $key) {
                        return call_user_func($clase_name.'::'.$value, $request);   
                    }

                }
                die('No cuenta con permisos para realizar esta accion');
                break;

        }

    }
    /**
     *Metodo master donde se manda un mensaje de que la session expiro
     *@access public 
     *@return void
     */
    public function session_expire(){

        #if ( $this->verify_permison() ) { die( view('auth.session_expire') ); };

    }
    /**
     *Metodo donde parsea la cadena del query string 
     *@access public
     *@return array $datos [description]
     */
    public function parser_string(){

        $datos = [];
        if ($_SERVER['QUERY_STRING']) {
            $params = explode("&", $_SERVER['QUERY_STRING']);
            $params = implode("=", $params);
            $params = explode("=", $params);
            $i = 1;
            foreach ($params as $key => $value) {
                if ($key%2 == 0 ) {
                   $datos[$value] = $params[$i];
                }
                $i++;
            }
        }
        return $datos;
    }
    /**
     *Metodo donde muestra el mensaje de success
     *@access protected
     *@param array $data [description]
     *@return json
     */
    protected function _message_success( $code = false, $data = array() ){

        $code = ( $code )? $code : 200 ;
        $datos = [
            "success"   => true
            ,"message"   => "Transaccion exitosa."
            ,"code"      => "CPA-".$code
            ,"result"    => $data
        ];

        return json_encode($datos);
    }



}
