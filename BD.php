<?php
/**
*Autores: Ginna Bonilla - Jhon Moreno
*Esta clase contiene todas la funciones  
*/

include('class/Graficos.php');

	class BD extends Graficos
	{
		public $connetion; //variable publica
		/**
		*esta funcion es el constructor.			
		*/
		function BD ()
		{
			$this->connetion=$this->create_connetion();
			
		}
		/**
		*esta funcion se encarga de crear la conexion con el servidor.			
		*@return 		caracteres 		retorna mysqli_connect.
		*/
		 function create_connetion ()
		{
		 	include('config.php');
		 	
		 	return mysqli_connect($Server,$user,$key,$bd);
		}

		/**
		*esta función sirve para mostrar el formulario el cual contiene *un select que trae los datos de una tabla
		*@param 	texto  		parametro de entrada que contiene $nombre_lista
		*@param 	texto 		parametro de entrada que contiene tabla
		*@param 	texto 		parametro de entrada que contiene campo_llave_primaria
		*@param 	texto 		parametro de entrada que contiene $campos_a_mostrar
		*/

		function carry_list_information( $name_list, $table, $field_key_primary, $field_at_show ) 
		{	//Se hace la conexión con la base de datos
			
			include( "config.php" ); 
			 
			$exit = "";

			//------------SQL Se traen datos----------------------------------------------------
			//Selecciona todos los campos de una tabla
			$sql = "SELECT * FROM  $table "; 
			//if( $sn_diagnostico_clinico == "s" ) echo "<div class='contenedor-sql-pruebas'>".$sql."</div>";
			

			$connetion = mysqli_connect( $Server,$user,$key,$bd );
			$result = $connetion->query( $sql );
       
				$exit.="<label for='exampleInputEmail1'>	Signos y Sintomas  </label><br>";
				$exit.="<select ng-model='id_sintomas' ng-change='cargar_datos_php()' id='datos' multiple size='10' class='form-control' 
				name='$name_list' >";
				$counter=0;
					
			while ($row = mysqli_fetch_assoc($result)) 	
			{ 
				$counter ++;
	    		if ($row != '..' && $row !='.' && $row !='')
	    		{
	                //echo" $fila;
	         	$exit.= "<option value='$row[$field_key_primary]' >" . $counter . " - ". $row[$field_at_show]."</option>"; //Se muestra en un select los datos que contien una tabla
	        	}
			}
			$exit.="</select>";	//cierra la etiqueta 
			//retorna todo lo que contiene la variable $salida 

			return $exit;	
		}

		/**
		*esta funcion se encarga realizar la consulta en una tabla.
		*
		*@param 		texto 			Es el nombre de la tabla.
		*@param 		texto 			campo clave.
		*@param 		texto 			campo a buscar.	
		*@return 		caracteres 		retorna la consulta.
		*/
		
		function consult($value)
		{
			
			include( "config.php" );
    	
			//echo "Ojooooooooooo ".$Server." ".$user." ".$key." ".$bd;

	        /*Esta conexión se realiza para la prueba con angularjs*/
	        header("Access-Control-Allow-Origin: *");
	        header("Content-Type: application/json; charset=UTF-8");
	        
	        $conn = new mysqli( $Server,$user,$key,$bd );
	        
	        //Se busca principalmente por alias.
	     		
	     		$sql = "SELECT tb_enfermedades.enfermedad , COUNT(tb_resultados.id_enfermedades) as conteo_sintomas , (SELECT COUNT(tb_resultados.id_enfermedades) conteo_total FROM tb_resultados where tb_enfermedades.id_enfermedades = tb_resultados.id_enfermedades GROUP BY id_enfermedades) as conteo_total FROM tb_resultados , tb_enfermedades WHERE tb_resultados.id_enfermedades = tb_enfermedades.id_enfermedades AND tb_resultados.id_signos in($value) GROUP BY tb_resultados.id_enfermedades";
			 	//echo $sql;
	        //La tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
	       
	       	//$this->imprimir($sql);
	        $result = $this->connetion->query( $sql );	

	        $outp = "";
	        
	        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
	        {
	            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
	            if ($outp != "") {$outp .= ",";}

	            $outp .= '{"Enfermedad":"'.$rs["enfermedad"].'",';            // <-- La tabla MySQL debe tener este campo.
	            //$outp .= '"a":"'.$sql.'",';
	            $outp .= '"conteo_sintomas":"'.$rs["conteo_sintomas"].'",';         // <-- La tabla MySQL debe tener este campo.
	            $outp .= '"conteo_total":"'.$rs["conteo_total"].'"}';     // <-- La tabla MySQL debe tener este campo. 
	        }
	        
	        $outp ='{"records":['.$outp.']}';
	       	$conn->close();
	        
	        return $outp;

	 		//echo $sql;		 	
	 		//return $sql;
		}


		/**
		* Ohjo Boton busqueda.
		*
		*
		*/
		function search()
		{
			
			    
	        include( "config.php" );
	        
	        /*Esta conexión se realiza para la prueba con angularjs*/
	        header("Access-Control-Allow-Origin: *");
	        header("Content-Type: application/json; charset=UTF-8");
	        header("Content-Type: text/html; charset=UTF-8");
	        
	        $conn = new mysqli( $Server,$user,$key,$bd );
	        
	        //Se busca principalmente por alias.
	        
	        $consult = explode(",", $_GET['busqueda']);
	        //echo $consulta;
	        if($_GET['busqueda'] == "manual técnico" || $_GET ['busqueda']=="uml") 
		        {
		        	$sql = "SELECT * FROM tb_manuales";
		        }else{

	        $sql  = " SELECT * FROM tb_manuales  WHERE ";
	        for ($i=0; $i < count($consult); $i ++) 
	        { 
	        	
	        	$sql .= " titulo LIKE '%".$consult[$i]."%'";
	        	$sql .= " OR definicion LIKE '%".$consult[$i]."%'";
                $sql .= " OR palabras LIKE '%".$consult[$i]."%'";

	        	if ($i < (count($consult)-1)) $sql.=" or ";
	        }

	         		}
	        
	        //echo $sql;
	        //La tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
	        $result = $conn->query( $sql );
	        
	        $outp = "";
	        
	        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
	        {
	            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
	            if ($outp != "") {$outp .= ",";}
	            
	            $outp .= '{"Titulo":"'. utf8_encode($rs["titulo"]).'",';
	            $outp .= '"Descripcion":"'. utf8_encode($rs["definicion"]).'",';     // <-- La tabla MySQL debe tener este campo.
	            $outp .= '"Imagen":"'.$rs["url"].'"}';            // <-- La tabla MySQL debe tener este campo.
	        }
	        
	        $outp ='{"records":['.$outp.']}';
	        $conn->close();
	        
	         return $outp;
		}		
	}	
 ?>   
