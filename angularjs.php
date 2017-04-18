<!--
* Autores: Ginna Bonilla - Jhon Moreno
-->
<html ng-app="acumuladorApp"><!--Hay que observar que aquí se inicia el ng-app-->
        <head>
            <title>Ej de AngularJS</title>
            <script type="text/javascript" src="js/angular.min.js"></script><!--En esta linea realizamos la conexion con el angular sin esto no nos funciona. -->
        </head>

        <body>

            <div ng-controller="acumuladorAppCtrl"><!--controlador-->
                    <input type="text" ng-model="text.busqueda" ng-change="busqueda();">

                   <!-- en esta linea traemos la información de una tabla de determinados campos en un select. -->
                    <?php echo $obj_o->traer_lista_informacion( "sintomas[] ", "tb_signos_y_sintomas","id_signos", "signos_y_sintomas"); ?>
                    <br>
                    <label>Diagn&oacute;stico:</label>
                    <br>
                    <!--Siclo en angula  que me muestra toda la información del resultado de la consulta.  -->
                    <div ng-repeat="x in campos">
                        <div class='table-responsive' >
                            <table class='table table-hover' border='2px'>
                                <tr tr class='success'> 
                                    <th>Enfermedad:</th>
                                    <th>Sintomas Encontrados:</th>
                                    <th>Sintomas en total</th>
                                </tr> 
                             
                                <tr>
                                    <td>{{ x.Enfermedad }}</td>  
                                    <td>{{ x.conteo_sintomas }}</td>   
                                    <td>{{ x.conteo_total }}</td> 
                                </tr>   
                            </table> 
                            {{ x.a }}
                        </div>
                    </div> 
                     <!-- en esta linea traemos la información de una tabla de determinados campos en un select. -->
                    <div ng-repeat="x in campos">
                            <div class='table-responsive' >
                                    <table class='table table-hover' border='2px'>
                                            <tr tr class='success'> 
                                                <th>Titulo:</th>
                                                <th>Descripci&oacute;n:</th>
                                                <th>Imagen</th>
                                            </tr> 
                                         
                                            <tr>
                                                <td>{{ x.Titulo }}</td>  
                                                <td>{{ x.Descripcion }}</td>   
                                                <td>{{ x.Imagen }}</td> 
                                            </tr>   
                                    </table> 
                                    {{ x.a }}
                            </div>
                    </div> 
            </div>

            <!-- Aquí se incluye el otro archivo js para probar que el código se puede colocar en otro archivo  -->
            <script type="text/javascript" src="js/nuevo.js"></script>

        </body>
</html>
