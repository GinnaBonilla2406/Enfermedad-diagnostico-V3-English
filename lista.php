<!--
* Autores: Ginna Bonilla - Jhon Moreno
--> 
<html>
	<head>
		<title></title>		
	</head>
	<body ng-app="">
		<div class="container-fluid">
			<div class="row">
				<div class=" well">
					<label>Animales:</label> 
						<select ng-model="myVar" class="form-control">
						<option value=""></option>
						<option value="Cat">Gatos</option>
						<option value="Dogs">Perros</option>
						<option value="Horse">Caballos</option>	
						<option value="Cow">Vaca</option>
					</select>
				</div>
			</div>								
			<div class="row">
				<div ng-switch="myVar">
					<div ng-switch-when="Dogs">
						<h1>Perros</h1>
						<p>El perro o perro doméstico también llamado can es un mamífero carnívoro <br>
						de la familia de los cánidos, que constituye una subespecie del lobo (Canis lupus). <br>
						En 2001, se estimaba que había 400 millones de perros en el mundo.</p>
						<img width="500px" src="imagenes/perros.jpg" class="img-responsive">
						<button type="button" class="btn btn-primary btn-md" ng-click="hiden()"> Ejecutar Dianóstico</button>
						
					</div>

					<div ng-switch-when="Cat">
						<h1>Gatos</h1>
						<p>El gato o gato doméstico y coloquialmente llamado minino, michino, micho, mizo, miz, <br>
						morrongo o morroño; es una subespecie de mamífero carnívoro de la familia Felidae. <br>
						El gato está en convivencia cercana al ser humano desde hace unos 9500 años, <br>
						periodo superior al estimado anteriormente, que oscilaba entre 3500 y 8000 años.</p>
						<img width="500px" src="imagenes/gato.jpg" class="img-responsive">
						<button type="button" class="btn btn-primary btn-md" ng-click="hiden()"> Ejecutar Dianóstico</button>
					</div>

					<div ng-switch-when="Horse">
						<h1>Caballos</h1>
						<p>El caballo es un mamífero perisodáctilo domesticado de la familia de los équidos. <br>
						Es un herbívoro solípedo de gran porte, cuello largo y arqueado, poblado por largas crines.</p>
						<img width="500px" src="imagenes/caballo.jpg" class="img-responsive">
						<button type="button" class="btn btn-primary btn-md" ng-click="hiden()"> Ejecutar Dianóstico</button>
					</div>

					<div ng-switch-when="Cow">
						<h1>Vacas</h1>
						<p>
							Mamífero rumiante bóvido, hembra, de unos 150 cm de altura y 250 cm <br>
							de longitud, cuerpo muy robusto, pelo corto, cabeza gruesa provista de dos <br>
							cuernos curvos y puntiagudos, hocico ancho, papada en el pecho, y cola larga <br>
							con un mechón en el extremo; de él se aprovechan la leche, la carne y la piel.</p>
							<img width="500px" src="imagenes/vaca.png" class="img-responsive">
							<button type="button" class="btn btn-primary btn-md" ng-click="hiden()"> Ejecutar Dianóstico</button>
					</div>
				</div>		
			</div>								
		</div>			
	</body>
</html>
