<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_field() }}">
	<title>Empleados</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<center><h2> Empleados </h2></center>
		<div class="col-sm-offset-2 col-sm-8">
			   <form action="{{route('save_empleado')}}" method="POST">
			   	{{csrf_field()}}
				  <div class="form-group">
				    <label for="">Nombre:</label>
				    <input type="text" class="form-control" id="nombre" name="nombre">
				  </div>
				  
				  <div class="form-group">
				    <label for="">Email:</label>
				    <input type="text" class="form-control" id="email" name="email">
				  </div>
				  
				  <div class="form-group">
				    <label for="">Puesto:</label>
				    <input type="text" class="form-control" id="puesto" name="puesto">
				  </div>

				  <div class="form-group">
				    <label for="">Fecha Nacimiento:</label>
				    <input type="text" class="form-control" id="fecha"  name="fecha_nacimiento">
				  </div>
				  <div class="form-group">
				    <label for="">Domicilio:</label>
				    <input type="text" class="form-control" id="domicilio"  name="domicilio">
				  </div>

				  <button type="submit" class="btn btn-primary">Guardar</button>

			   </form> 


		</div>

		<div class="table-response">
			{!! $table_empleados !!}
		</div>





	</div>


<script type="text/javascript">
	$().ready(function(){
		$('#fecha').datepicker({"dateFormat":"dd/mm/yy"});
	});



</script>

</body>
</html>