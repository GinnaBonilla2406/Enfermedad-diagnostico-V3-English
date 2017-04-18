<!--
* Autores: Ginna Bonilla - Jhon Moreno
-->
<?php 
	header("Content-Type: text/html; charset=UTF-8");
 ?>
<html ng-app="acumuladorApp">
	<head> 
		<center>
			<img width="1350" src="imagenes/imagen.jpg" class="img-responsive">
		</center>
		<title>Ayuda</title>
			<?php
				include ('BD.php');
				/*Se nombra una variable para crear un nuevo objeto*/
				$obj_o= new BD;
				/* trae la función estilos de bootstrap de la clase */
				echo $obj_o->estilos("bootstrap"); 
				
			?>
			<meta charset="UTF-8">
			<script type="text/javascript" src="js/angular.min.js"></script>
			<script type="text/javascript" src="js/nuevo.js"></script>
	</head>

	<body>
		<div ng-controller="acumuladorAppCtrl"><!--Super importante el controlador aquí-->
			<div class='container' >
			  	<br>
			  	<a href="index.php"><button class="btn btn-primary">Volver</button></a>

		  		<div class='row'>
			  		<div class='col-xs-12 col-md-4 '>
			  		<label><h2>Buscar</h2></label>
						<input type="text" class="form-control" ng-model="text_busqueda" ng-change="search();" placeholder="Ingrese lo que desea search"> 
						<br>
						<br>
					</div>
				</div>
				<hr>
				<div ng-repeat="x in campos">
					<div class='row'>
						<div class='col-xs-12 col-md-4 '>  
		                    <strong><li>{{ x.Titulo }}</li></strong>
		                    {{ x.Descripcion }} 
						</div>
							  
						<div class='col-xs-12 col-md-8 '>
						   	<img class="img img-responsive" src="{{ x.Imagen }}">
					    </div>
			    	</div>
			    	<br><hr>
				</div>			    
			</div>
		</div>
	</body>
</html>
