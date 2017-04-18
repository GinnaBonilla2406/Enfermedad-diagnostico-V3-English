//Autores: Ginna Bonilla - Jhon Moreno


var acumuladorApp = angular.module( 'acumuladorApp', [] );      
    acumuladorApp.controller( "acumuladorAppCtrl",
        
        //[ "$scope",  //Originalmente solo se minificaba el scope.
        [ "$scope", "$http", //Esto es para minificar, pero interfiere con lo de php, hay que minificar las otras variables.
          
            //Esta es mi súper función en angular. 
            function( $scope, $http )
            {
                //Esta función me permite tomar los id de identificador en cual hace una consulta en php y me trae los resultado.  
                $scope.cargar_datos_php = function()
                {

                    //Trae los datos de una lista.
                    var lista = document.getElementById('datos');
                    //console.log( "Longitud total de elementos de la lista " + lista.length );
                    var sintomas="";

                    for (var i = 0 ; i < lista.length ; i++)  //---------------------
                    {
                        if (lista.item(i).selected ) //Bravo Moreno.
                        {
                            if (sintomas == ""){ 
                                sintomas +=lista.item(i).value;
                            }else{
                                sintomas +="," +lista.item(i).value;
                            }
                        }
                    } //.-------------------------------fin lista--------------------------

                    var cad2 = sintomas;
                    console.log(cad2);
                
                    if( cad2.length > 0 )
                    {
                        console.log("Cadena" + cad2);
                        //Aquí se hace el llamado a un php con conexión a MySQL.
                        //---Cuadro 8 ------------O Jooooooooooooooooooo --------------------------------
                        $http.get( 'llamado-php.php?cadena=' + cad2 ).success //-------O J O Moreno ---------- Error --- cAutriob warning danger
                        (
                            function( response ) 
                            { 
                                console.log( response );
                                $scope.campos = response.records;            
                            }
                        ); //----------------------------------------------------------------------   
                    }                 
                }

                //Esta función me permite realizar una consulta en mi manual técnico tecleando.
                $scope.search = function()
                { 
                    console.log("hola");
                    var busqueda = $scope.text_busqueda;    
                    console.log(busqueda);
                    //Aquí se hace el llamado a un php con conexión a MySQL.
                     $http.get( 'llamado-php.php?busqueda=' + busqueda )
                     .success(  
                        function( response ) { $scope.campos = response.records; } 
                    );                                    
                }
                //Esta función me permite ocultar un div y mostrar uno que este oculto.
                $scope.hiden=function()
                {
                    console.log("Ginna la más consona");
                    document.getElementById('mostrar').style.display="block";
                    document.getElementById('ocultar').style.display="none";
                }
            }
        ] //Si se minifica, se deben minificar todas las llamadas inyecciones, de lo contrario mejor no minifique nada.
    );

    
