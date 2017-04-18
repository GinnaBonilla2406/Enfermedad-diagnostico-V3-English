<?php
class Errores
    {
        var $cadena_de_impresion;

        /**
        * El constructor de la clase.
        */
        public function Errores()
        {

        }

        /**
        * Esta función recoge valores para la futura impresión de errores.
        * @param        texto           El texto que se agregará a la actual impresión.
        */
        public function agregar_valores( $cadena )
        {
            $this->cadena_de_impresion .= $cadena."<br>";
        }

        /**
        * Se encarga de retornar el valor de impresión de la prueba de escritorio.
        * @return       texto       Cadena que contiene la prueba, errores, entre otras cosas.
        */
        public function retornar_cadena_errores()
        {
            return $this->cadena_de_impresion;
        }

        /**
        * La siguiente función se encarga de escribir algun dato en un archivo de texto, puede servir para escribir 
        * un log o un listado de errores. Aunque este método debería estar en una clase aparte porque el log
        * no es exclusivo de errores.
        * de errores.
        * @param  			texto  				Una cadena que será escrita en un archivo de texto.
        * @param 			texto 				Nombre de un archivo que será creado en la carpeta actual.
        */
        public function escribir_archivo_txt( $cadena, $nombre_archivo )
        {
            include( "config.php" ); //Aquí se traen los parámetros de la base de datos.
            //Hay que recordar que solo debería existir un archivo que permita dicha configuración.
            //Para este caso el config ajusta elementos adicionales de configuración además de la base de datos.

            if( $sn_escribir_log == "s" )
            {
                $archivo = fopen( $nombre_archivo.".txt", "w" ); //Esta instruccción crea el archivo.
                fwrite( $archivo, $cadena.PHP_EOL );
                fclose( $archivo );	
            }
        }
        
    }


?>


 if( isset( $_GET[ 'cadena' ] ) )
    {     
        include( "config.php" );
        
        /*Esta conexión se realiza para la prueba con angularjs*/
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        
    

        $conn = new mysqli( $servidor, $usuario, $clave, $bd );

        
        //Se busca principalmente por alias.
        $sql = "SELECT tb_enfermedades.enfermedad , COUNT(tb_resultados.id_enfermedades) as conteo_sintomas , (SELECT COUNT(tb_resultados.id_enfermedades) conteo_total FROM tb_resultados where tb_enfermedades.id_enfermedades = tb_resultados.id_enfermedades GROUP BY id_enfermedades) as conteo_total FROM tb_resultados , tb_enfermedades WHERE tb_resultados.id_enfermedades = tb_enfermedades.id_enfermedades AND tb_resultados.id_signos in(".$_GET[ 'cadena' ].") GROUP BY tb_resultados.id_enfermedades";

            //echo $sql;
        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
        $result = $conn->query( $sql );
        //echo $result;
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
        
        echo($outp);
    
    }
    else
    {
        if( isset( $_GET[ 'imagen' ] ) )
        {
      

          /*Esta conexión se realiza para la prueba con angularjs*/
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            
        

            $conn = new mysqli( $servidor, $usuario, $clave, $bd );

            
            //Se busca principalmente por alias.
             //Se busca principalmente por alias.
            $sql  = " SELECT * FROM manual_tecnico_angularjs  ";
            $sql .= " WHERE titulo LIKE '%".$_GET[ 'imagen' ]."%'  ";
            //$sql .= " ORDER BY id_manual DESC LIMIT 10 ";

                //echo $sql;
            //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
            $result = $conn->query( $sql );
            //echo $result;
            $outp = "";

            
            while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
            {
                //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
                if ($outp != "") {$outp .= ",";}

                $outp .= '{"Titulo":"'.$rs["titulo"].'",';            // <-- La tabla MySQL debe tener este campo.
                //$outp .= '"a":"'.$sql.'",';
                $outp .= '"Descripcion":"'.$rs["definicion"].'",';         // <-- La tabla MySQL debe tener este campo.
                $outp .= '"Imagen":"'.$rs["url"].'"}';     // <-- La tabla MySQL debe tener este campo.
            }
            
            $outp ='{"records":['.$outp.']}';
            $conn->close();
            
            echo($outp);
        }
    }

    
?> 
