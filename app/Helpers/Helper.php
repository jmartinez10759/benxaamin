<?php

    function checkPermission($name){
        if(Session::has('rol')){
            foreach (Session::get('rol')->permisos as $per)
            {
                if($per->name_holder == $name){
                    return true;
                }
            }
        }
        return false;
    }
   /**
	* imprime un arreglo formateado para debug
	* y detiene la ejecucion del script
	* @return array $array
	*/
	if(!function_exists('debuger')){

		function debuger($array, $die = true){
			echo '<pre>';
			print_r($array);
			echo '</pre>';
			if($die){
				die();
			}
		}
        
	}

	if(!function_exists('timestamp')){
		function timestamp(){
	    	return date('Y-m-d H:i:s');
	    }
	}
	
	if(!function_exists('format_decimal')){
		function format_decimal($number=0, $separador=''){
			return number_format($number, 3, '.', $separador);
		}
	}

	if(!function_exists('format_currency')){
		function format_currency($number=0, $sign='$'){
			return $sign.''.number_format($number, 2, '.', ',');
		}
	}

	if(!function_exists('format_date_short')){
		function format_date_short($date=false, $sign='-'){
			$fdate = date('Y'.$sign.'m'.$sign.'d', strtotime($date));
			return $fdate;
            #return date_format($fdate,"Y".$sign."m".$sign."d");
		}
	}

	if(!function_exists('format_date_long')){
		function format_date_long($date=false, $sign='-'){
			$fdate = date('Y{$sign}m{$sign}d', strtotime($date));
			return date_format($fdate,"Y{$sign}m{$sign}d H:i:s");
		}
	}

	if(!function_exists('format_date')){
		function format_date($date = false, $sign='-'){
			return date("d".$sign."m".$sign."Y", strtotime($date));
		}
	}

	   if(!function_exists('dropdown')){

        function dropdown($params){
            $data       = (isset($params['data']))?$params['data']:'';
            $name       = (isset($params['name']))?$params['name']:'';
            $id         = (isset($params['id']))?$params['id'] : $name;
            $event      = (isset($params['event']))?$params['event']:'';
            $selected   = (isset($params['selected']))?explode(',',$params['selected']):'';
            $value      = (isset($params['value']))?$params['value']:false;
            $text       = (isset($params['text']))?$params['text']:'';
            $class      = (isset($params['class']))?$params['class']:'';
            $disabled   = (isset($params['disabled']))?$params['disabled']:'';
            $requerido  = (isset($params['requerido']))?'data-required="true"':'';
            $multiple   = (isset($params['multiple']))?'multiple':'';
            $attr       = (isset($params['attr']))?$params['attr']:'';
            $title      = (isset($params['title']))?$params['title']:'';
            $leyenda    = (array_key_exists('leyenda' ,$params))?$params['leyenda']: '-----';
            #convierto el arreglo en objeto
            if ( !is_object($data) ) {
                $data = array_to_object($data);
            }
            $select = '';
            if( $data ){
                foreach ($data as $key => $values) {
                
                    $option_selected='';
                    if($selected){
                            $option_selected = (in_array($values->$value,$selected))?'selected':'';
                            $select.='<option value="'.$values->$value.'" '.$option_selected.'>'.($values->text).'</option>';
                    }else{
                        $select.='<option value="'.$values->$value.'"'.$option_selected.'>'.($values->$text).'</option>';
                    }
                }
                $opc='<select name="'.$name.'" id="'.$id.'" '.$multiple.' class="chosen-select '.$class.'" onchange="'.$event.'" data-campo="'.$name.'" '.$requerido.' title="'.$title.'" '.$attr.'>
                        <option value="" selected>'.$leyenda.'</option>
                        '.$select.'
                      </select>';
            }else{
                $opc='<select name="'.$name.'" id="'.$id.'" '.$multiple.' class="'.$class.'" onchange="'.$event.'">
                        <option value="" disabled selected>Sin contenido</option>
                      </select>';
            }
            return $opc;
        
        }
    }

    if(!function_exists('incCss')){
        function incCss($filename){
            #$cadena = '<link href="'.URLPATH.$filename.'" rel="stylesheet" type="text/css">';
            $cadena = '<link href="'.$filename.'" rel="stylesheet" type="text/css">';
            return $cadena;
        }
    }

    if(!function_exists('incJs')){
        function incJs($filename){
            #$cadena = '<script type="text/javascript" src="'.URLPATH.$filename.'"></script>';
            $cadena = '<script type="text/javascript" src="'.$filename.'"></script>';
            return $cadena;
        }
    }

    //Construye una tabla datatable
    if(!function_exists('data_table')){

        function data_table($data = array()){
            $html_result    = '';
            $titulos        = (is_array($data['titulos']))?$data['titulos']:false;
            $registros      = (is_array($data['registros']))?$data['registros']:false;
            $id             = isset($data['id'])? 'id="'.$data['id'].'"' : 'id="datatable"';
            $tbody          = '';
            if($titulos){
                $th = '';
                foreach($titulos as $titulo){$th .= '<th>'.$titulo.'</th>';}
                $thead = '<thead><tr>'.$th.'</tr></thead>';
                $tfoot = '<tfoot><tr>'.$th.'</tr></tfoot>';
            }
            if($registros){
                $tbody = '<tbody>';
                foreach($registros as $registro){
                    $tbody .= '<tr>';
                    foreach ($registro as $campo){
                        $tbody .= '<td>'.$campo.'</td>';
                    }
                    $tbody .= '</tr>';
                }
                $tbody .= '</tbody>';
            }
            $html_result .= '<table class="table table-striped table-bordered table-response highlight" '.$id.'>';
            $html_result .= $thead;
            $html_result .= $tbody;
            $html_result .='</table>';
            return $html_result;
        
        }
    }

    if(!function_exists('data_table_general')){

        function data_table_general( $data = array(), $keys=false ){

            $html_result    = '';
            $registros      = (is_array($data['registros']))?(object)$data['registros']:false;
            $id             = isset($data['id'])? 'id="'.$data['id'].'"' : 'id = "datatable"';
            $class          = isset($data['class'])? 'class="'.$data['class'].'"' : '';
            $class_thead    = isset($data['class_thead'])? 'class="'.$data['class_thead'].'"' : ' ';
            $class_tr       = isset($data['class_tr'])? 'class="'.$data['class_tr'].'"' : ' ';
            $attr           = isset($data['attr'])? 'class="'.$data['attr'].'"' : ' ';
            $tbody          = '';
            #debug($registros);
            #Se convierte en objeto si es que viene en array
           # $registros = ( is_array( $registros ) )? (object)$registros : $registros;
            #se verifica que si se establecieron titulos
            if( isset($data['titulos']) ){
                    $titulos       = (is_array($data['titulos']))?$data['titulos']:false;
                    $th = '';
                    foreach($titulos as $titulo){$th .= '<th>'.$titulo.'</th>';}
                    $thead = '<thead '.$class_thead.' ><tr>'.$th.'</tr></thead>';
                    $tfoot = '<tfoot><tr>'.$th.'</tr></tfoot>';
            }else
                if( isset( $keys ) ){
                    $th = '';
                    foreach($keys as $titulo){ $th .= '<th>'.$titulo.'</th>';}
                    $thead = '<thead '.$class_thead.' ><tr>'.$th.'</tr></thead>';
                    $tfoot = '<tfoot><tr>'.$th.'</tr></tfoot>';
            }
            if($registros){
                $tbody = '<tbody>';
                foreach($registros as $registro){
                    $tbody .= '<tr '.$class_tr.' '.$attr.'>';
                    #Se valida si es que requiere elegir titulos
                    if ( !empty( $keys) ) {
                        foreach ($keys as $indice => $titulo) {
                            $tbody .= '<td>'.$registro->$indice.'</td>';
                        }
                    }else
                        if ( empty( $keys ) ) {
                            foreach ($registro as $campo){
                                $tbody .= '<td>'.$campo.'</td>';
                            }
                        }
                    $tbody .= '</tr>';
                }
                $tbody .= '</tbody>';
            }
            $html_result .= '<table '.$class.' '.$id.'>';
            $html_result .= $thead;
            $html_result .= $tbody;
            $html_result .='</table>';

            return $html_result;
        
        }
    }

    if (!function_exists('build_acciones_usuario')) {

        function build_acciones_usuario($u = array(), $event= false, $texto = false, $color = false, $icon = false, $attr = false) {
                $event = ($event)? "onclick = ".$event."(".$u['id'].")": false;
                $texto = ($texto)?  $texto:false;
                $color = ($color)?  $color:false;
                $icon =  ($icon)?   $icon:false;
                $attr =  ($attr)?   $attr:false;

                $acciones = '<div class="btn-group">';
                $acciones .= '
                <button type = "button" class="'.$color.'" '.$event.' '.$attr.' >
                    <i class="'.$icon.'"> '.$texto.'</i>
                </button>';
                $acciones .= '</div>';
                return $acciones;
            }

    }
    
    if (!function_exists('build_acciones')) {

        function build_acciones($u = array(), $event= false, $texto = false, $color = false, $icon = false, $attr = false) {
                $event = ($event)? "onclick = ".$event."(".json_encode($u).")": false;
                $texto = ($texto)?  $texto:false;
                $color = ($color)?  $color:false;
                $icon =  ($icon)?   $icon:false;
                $attr =  ($attr)?   $attr:false;

                $acciones = '<div class="btn-group">';
                $acciones .= '
                <button type = "button" class="'.$color.'" '.$event.' '.$attr.' >
                    <i class="'.$icon.'"> '.$texto.'</i>
                </button>';
                $acciones .= '</div>';
                return $acciones;
            }

    }


    if (!function_exists('convert_object')) {

        function json_to_object ( $json = false ) {

            if ( $json ) {
                return json_decode($json);
            }
        
        }

    }

    if (!function_exists('array_to_object')) {

        function array_to_object ( $array = array() ) {
            if ( is_array( $array ) ) {
                return  json_decode( json_encode($array) );
            }
       
        }

    }

    if (!function_exists('build_icon')) {

        function build_icon($u = array(), $event= false, $icon = false, $attr = false) {
                
                $event = ($event)? "onclick = ".$event."(".json_encode($u).")": false;                
                $icon =  ($icon)?   $icon:false;
                $attr =  ($attr)?   $attr:false;

                $acciones = '<div class="btn-group" style="cursor: pointer;" '.$event.' '.$attr.' >';
                $acciones .= '<span class ="'.$icon.' element-viatico">';
                $acciones .= '<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span>';
                $acciones .= '</span>';
                $acciones .= '</div>';
                return $acciones;
                
            }

    }

    if (!function_exists('build_img')) {

        function build_img($u = array(), $event= false, $icon = false, $attr = false) {
                
                $event = ($event)? "onclick = ".$event."(".json_encode($u).")": false;                
                $icon =  ($icon)?   $icon:false;
                $attr =  ($attr)?   $attr:false;

                $acciones = '<div class="btn-group" style="cursor: pointer;" '.$event.' '.$attr.' >';
                $acciones .= '<img src ="'.asset($icon).'" width="50px" height="40px">';
                $acciones .= '</img>';
                $acciones .= '</div>';
                return $acciones;
                
            }

    }
    /**
     *Funcion para crear una vista en particular, en proyecto de travel
     */
    if (!function_exists('build_vista')) {
        
        function build_vista( $event = array(), $images = array(), $titulos = array() ){

            $html = '';
            $col = 12 / count( $titulos );
            for ($i=0; $i < count($titulos); $i++) { 
                #$event = ($event)? "onclick = ".$event[$i]: false;  
                $html .= '<div class="col-sm-'.$col.' panel_menu" >';
                    $html .= '<div class="about-item scrollpoint sp-effect1">';
                        $html .= '<p><div onclick="'.$event[$i].'" style="cursor: pointer;"><img src="'.$images[$i].'" alt=""></div></p>';
                        $html .= '<h3 class="font_menu">'.$titulos[$i].'</h3>';
                    $html .= '</div>';
                $html .= '</div>';
                
            }
            return $html;

        }


    }

    if (!function_exists('message')) {
        
        function message( $success = true,$register = array(), $message = false ){

            $arreglo = [
                'success'   => $success
                ,'result'   => $register
                ,'message'  => $message
            ];
            return json_encode( $arreglo );
        
        }

    }
    /**
     *recorre cualquier objeto o arreglo para enviar los datos deseados particular consultas ELOQUENT
     *@access public
     *@param $data instace [Description]
     *@return object
     */
    if (!function_exists('data_march')) {
        
        function data_march( $data = array() ){

            $response = [];
            $i = 0;
            foreach ($data as $key => $values) {

                foreach ($values->fillable as $key => $value) {
                    $response[$i][$value] = $values->$value;
                }
                $i++;
            }

            return array_to_object($response);

        }

    }