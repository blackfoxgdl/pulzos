<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['password']))
{
    require_once('conexion.php');
    require_once('funciones_procesos.php');
    $connect = conectar();

    $query = historial_de_deposito();
    $result = mysql_query($query, $connect) 
              or die('Error en la consulta: ' . mysql_error()); 
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/screen.css" />
        <link rel="shortcut icon" href="http://www.pulzos.com/statics/img/pulzos.ico" />
        <title> Menu principal de administrador de pulzos </title>
         <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
             
            });
        </script>
    </head>
    <body>
        <div class="container showgrid">
            <div class="span-24 last"><!-- DIV HEADER INICIO -->
                <div class="prepend-4 span-12">
                    Administrador de pulzos
                </div>
                <div class="prepend-6">
                    <a href="cerrar_session.php">
                        Cerrar sesion
                    </a>
                </div>
            </div><!-- DIV HEADER FIN -->
            <div class="span-24" style="margin-top: 50px; text-decoration:none;">
                <?php
                    while($row = mysql_fetch_array($result))
                    {//WHILE PARA MOSTRAR TODOS LOS DATOS
                        $nombreEmpresa = $row['negocioNombre'];
                        $negocioId = $row['negocioId'];
						$negocioEmail=$row['negocioEmail'];
						$negocioUsuarioId=$row['negocioUsuarioId'];
        			
                        echo "<div class='span-5'>" .
                                $nombreEmpresa .
                              "</div>";
                        echo "<div class='span-2 '>" .
                                "<a href='visualizar_depositos.php?e=" . $negocioId . "'style='margin-top: 50px; text-decoration:none;'>
                                    Revision
                                 </a>" .
                             "</div> ";
						echo "<div class='span-3 '>" .
                                "
                                    Transacciones
                                 " .
                             "</div> ";
						if(get_activado($negocioUsuarioId )=='0' || get_activado($negocioUsuarioId )=='NULL')
						{	
							echo "<div class='span-4 '>" .
									"<a href='activar_desactivar.php?e=" . $negocioId . "&m=".$negocioEmail."&n=".$nombreEmpresa."&a=1&id=".$negocioUsuarioId."'style='margin-top: 50px; text-decoration:none;'>
										<font style='color: RED'> Activado </font>
									 </a> &nbsp";
						}
						else
						{ 
							echo "<div class='span-4 '>" .
									"<a href='activar_desactivar.php?e=" . $negocioId . "&m=".$negocioEmail."&n=".$nombreEmpresa."&a=1&id=".$negocioUsuarioId."'style='margin-top: 50px; text-decoration:none;'>
										<font style='color: GREEN'> Activado </font>
									 </a> &nbsp";
						}
						
						if(get_activado($negocioUsuarioId )=='0' || get_activado($negocioUsuarioId )=='NULL')
						{	 
							echo " 
								 <a href='activar_desactivar.php?e=" . $negocioId . "&a=0&id=".$negocioUsuarioId."'style='margin-top: 50px; text-decoration:none;'>
										<font style='color: GREEN'> Desactivado </font>
									 </a> " .
								 "</div> <br>";	
						}
						else
						{
							echo " 
							 <a href='activar_desactivar.php?e=" . $negocioId . "&a=0&id=".$negocioUsuarioId."'style='margin-top: 50px; text-decoration:none;'>
                                   <font style='color: RED'> Desactivado </font>
                                 </a> " .
                             "</div> <br>";	
						}	    
                    }//WHILE PARA MOSTRAR TODOS LOS DATOS
                ?>
            </div>
        </div>
    </body>
</html>
<?php
}
else
{
    header('location: ingreso.php');
}
?>
