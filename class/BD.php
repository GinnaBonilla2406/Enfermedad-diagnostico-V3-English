<?php

/**
*Autores: Ginna Bonilla - Jhon Moreno
*Esta clase contiene todas la funciones  
*/
include('Graficos.php');

class BD extends Graficos
{

			public $conexion; //variable publica
			/**
			*esta funcion es el constructor.			
			*/
			function BD ()
			{
				$this->conexion=$this->crear_conexion();
				//echo "nacio la clase BD";
			}
			/**
			*esta funcion se encarga de crear la conexion con el servidor.			
			*@return 		caracteres 		retorna mysqli_connect.
			*/
			 function crear_conexion ()
			 {
			 	include('config.php');
			 	return mysqli_connect($servidor,$usuario,$clave,$bd);
			 }
			 




			/**
			*esta función sirve para mostrar el formulario el cual contiene *un select que trae los datos de una tabla
			*@param 	texto  		parametro de entrada que contiene $nombre_lista
			*@param 	texto 		parametro de entrada que contiene tabla
			*@param 	texto 		parametro de entrada que contiene campo_llave_primaria
			*@param 	texto 		parametro de entrada que contiene $campos_a_mostrar
			*/

			function traer_lista_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar ) 
			{	//Se hace la conexión con la base de datos
				include( "config.php" ); 
				$salida = "";

				//------------SQL Se traen datos----------------------------------------------------
				//Selecciona todos los campos de una tabla
				$sql = "SELECT * FROM  $tabla "; 
				if( $sn_diagnostico_clinico == "s" ) echo "<div class='contenedor-sql-pruebas'>".$sql."</div>";
				

				$conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
				$resultado = $conexion->query( $sql );

						
						
						           
						$salida.="<label for='exampleInputEmail1'><h2>Sintomas</h2>  </label><br>";
						$salida.="<select ng-model='id_sintomas' ng-change='cargar_datos_php()' id='datos' multiple size='10' class='form-control' name='$nombre_lista' >";
						$contador=0;
						
				while ($fila = mysqli_fetch_assoc($resultado)) 
					
				{ 
					$contador ++;
					
		    		if ($fila != '..' && $fila !='.' && $fila !='')
		    		{
		                //echo" $fila;
		         	$salida.= "<option value='$fila[$campo_llave_primaria]' >" . $contador . " - ". $fila[$campo_a_mostrar]."</option>"; //Se muestra en un select los datos que contien una tabla

		        	}
		      
				}
				$salida.="</select>";	//cierra la etiqueta 
				
			

				//retorna todo lo que contiene la variable $salida 

				return $salida;	
			}

			/**
			*esta funcion se encarga realizar la consulta en una tabla.
			*
			*@param 		texto 			Es el nombre de la tabla.
			*@param 		texto 			campo clave.
			*@param 		texto 			campo a buscar.	
			*@return 		caracteres 		retorna la consulta.
			*/
			

			Function consultar($valores)
			{
				include( "config.php" );
        	
		        /*Esta conexión se realiza para la prueba con angularjs*/
		        header("Access-Control-Allow-Origin: *");
		        header("Content-Type: application/json; charset=UTF-8");
		        
		        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
		        
		        //Se busca principalmente por alias.
		     		

		     		$sql = "SELECT tb_enfermedades.enfermedad , COUNT(tb_resultados.id_enfermedades) as conteo_sintomas , (SELECT COUNT(tb_resultados.id_enfermedades) conteo_total FROM tb_resultados where tb_enfermedades.id_enfermedades = tb_resultados.id_enfermedades GROUP BY id_enfermedades) as conteo_total FROM tb_resultados , tb_enfermedades WHERE tb_resultados.id_enfermedades = tb_enfermedades.id_enfermedades AND tb_resultados.id_signos in($valores) GROUP BY tb_resultados.id_enfermedades";
				 	//echo $sql;
		        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
		       
		       	//$this->imprimir($sql);
		        $result = $this->conexion->query( $sql );	
		        
		        $outp = "";
		       
		        
		        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
		        {
		            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
		            if ($outp != "") {$outp .= ",";}

		            $outp .= '{"Enfermedad":"'.$rs["enfermedad"].'",';            // <-- La tabla MySQL debe tener este campo.
		            $outp .= '"a":"'.$sql.'",';
		            $outp .= '"conteo_sintomas":"'.$rs["conteo_sintomas"].'",';         // <-- La tabla MySQL debe tener este campo.
		            $outp .= '"conteo_total":"'.$rs["conteo_total"].'"}';     // <-- La tabla MySQL debe tener este campo.
		            
		          
		        }
		        
		        $outp ='{"records":['.$outp.']}';
		       	$conn->close();
		        
		        return $outp;
		 		//echo $sql;
		 
		 	
		 		//return $sql;
			}


			function buscar()
			{
				    
			        include( "config.php" );
			        
			        /*Esta conexión se realiza para la prueba con angularjs*/
			        header("Access-Control-Allow-Origin: *");
			        header("Content-Type: application/json; charset=UTF-8");
			        
			        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
			        
			        //Se busca principalmente por alias.
			        
			        $consulta = explode(",", $_GET['busqueda']);
			        //echo $consulta;
			        $sql  = " SELECT * FROM tb_manuales  WHERE ";
			        for ($i=0; $i < count($consulta); $i ++) { 
			        	
			        	$sql .= " titulo LIKE '%".$consulta[$i]."%'";
			        	$sql .= " OR definicion LIKE '%".$consulta[$i]."%'";
			        	if ($i < (count($consulta)-1)) $sql.=" or ";
			        	
			        }
			        
			        
			        //echo $sql;
			        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
			        $result = $conn->query( $sql );
			        
			        $outp = "";
			        
			        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
			        {
			            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
			            if ($outp != "") {$outp .= ",";}
			            
			            $outp .= '{"Titulo":"'.$rs["titulo"].'",';
			            $outp .= '"Descripcion":"'.utf8_encode($rs["definicion"]).'",';     // <-- La tabla MySQL debe tener este campo.
			            $outp .= '"Imagen":"'.$rs["url"].'"}';            // <-- La tabla MySQL debe tener este campo.
			        }
			        
			        $outp ='{"records":['.$outp.']}';
			        $conn->close();
			        
			        echo($outp);
			    
			     
			}
			
}	


 ?>
