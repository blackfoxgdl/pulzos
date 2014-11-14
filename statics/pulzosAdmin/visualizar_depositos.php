<?php
session_start();

if(isset($_SESSION['user']) && isset($_SESSION['password']))
{
    $id_consultar = $_GET['e'];
    require_once('funciones_procesos.php');
    require_once('conexion.php');
    $connect = conectar();

    //Obtener las transacciones por fechas
    $sql1 = get_historial_completo_empresa($id_consultar);
    $result_externo = mysql_query($sql1, $connect)
        or die('Error en la consulta: ' . mysql_error());

    //Obtener el nombre de la empresa
    $sql2 = get_complete_companyname($id_consultar) ;
    $result_name = mysql_query($sql2, $connect)
        or die('Error en la consulta del usuario: ' . mysql_error());
    $company = mysql_fetch_row($result_name);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/screen.css" />
        <link rel="shortcut icon" href="http://www.pulzos.com/statics/img/pulzos.ico" />
        <!-- script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script -->
        <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".detalles").click(function(event){
                    event.preventDefault();
                    ids = $(event.currentTarget).attr('flag');
//                    alert('holas: ' + ids);
                    $("#historial"+ids).show();
                    $("#deta"+ids).hide();
                    $("#ocul"+ids).show();
                });

                $(".ocultes").click(function(event){
                    event.preventDefault();
                    ido = $(event.currentTarget).attr('flag');
                    $('#historial'+ido).hide();
                    $("#ocul"+ido).hide();
                    $("#deta"+ido).show();
                });

            /*    $(".depositos").click(function(event){
                    event.preventDefault();
                    url = $(event.currentTarget).attr('href');
                    idH = $(event.currentTarget).attr('flag');
                    $.get(url,
                          function(data){
                              //alert('hola: ' + data.id);
                              /*$("#depo"+idH).hide();
                              $("#confirm"+idH).show();*//*
                          });
                    $("#depo"+idH).hide();
                    $("#confirm"+idH).show();
                });*/
            });
        </script>
    </head>
    <body>
        <div class="container showgrid" style="margin-top: 20px">
            <div class="span-24">
                <div class="span-12 last">
                    <?php echo $company[2]; ?>
                </div>
                <div class="prepend-8">
                    <a href="cerrar_session.php">
                        cerrar sesion
                    </a>
                </div>
            </div>
            <div class="span-24" style="margin-top: 40px">
                <div class="span-2">
                    Fecha Inicio
                </div>
                <div class="span-2">
                    Fecha Fin
                </div>
                <div class="span-7">
                    No. de Referencia
                </div>
                <div class="span-4">
                    Total Desposito
                </div>
                <div class="span-5 last">
                    Estado de Transaccion
                </div>
                <div class="span-5 last">
                    &nbsp;
                <div>
            </div>
            <div class="span-24" style="margin-bottom: 10px">
                <?php
                    while($row = mysql_fetch_array($result_externo))
                    {
                        $fecha_inicio = $row['historialFechaInicio'];
                        $fecha_fin = $row['historialFechaFin'];
                        $status = $row['historialStatusDeposito'];
                        $codeMain = $row['historialCodigo'];
                        $quincenaTotal = $row['historialTotalQuincenal'];
                        $id_historial = $row['idHistorial'];
                        
                        echo "<div class='span-24'>";
                            echo "<div class='span-2'>" .
                                    date('d-m-Y', $fecha_inicio) .
                                 "</div>";
                            echo "<div class='span-2'>" .
                                    date('d-m-Y', $fecha_fin) .
                                 "</div>";
                            echo "<div class='span-7'>";
                                 if(empty($codeMain))
                                 {
                                    echo "&nbsp;";
                                 }
                                 else
                                 {
                                    echo $codeMain;
                                 }
                            echo "</div>";
                            echo "<div class='span-4'>" .
                                    '$ ' . $quincenaTotal .
                                 "</div>";
                            echo "<div class='span-5 last'>";
                                 if($status == 0)
                                 {
                                    echo "Pendiente de deposito";
                                 }
                                 if($status == 1)
                                 {
                                    echo "Procesando deposito";
                                 }
                                 if($status == 2)
                                 {
                                     echo "Deposito realizado";
                                 }
                            echo "</div>";
                            echo "<div class='span-4'>";
                                 if($status == 0)
                                 {
                                     echo "<a href='#' style='margin-right: 10px' class='detalles' id='deta$id_historial' flag='$id_historial'> Detalles </a>
                                           <a href='#' style='margin-right: 10px; display: none' class='ocultes' id='ocul$id_historial' flag='$id_historial'> Ocultar </a>
                                           <font style='color: RED'> Pendiente </font>";
                                 }
                                 elseif($status == 1)
                                 {
                                     echo "<a href='#' style='margin-right: 10px' class='detalles' id='deta$id_historial' flag='$id_historial'> Detalles </a>
                                           <a href='#' style='margin-right: 10px; display: none' class='ocultes' id='ocul$id_historial' flag='$id_historial'> Ocultar </a>
                                           <a href='depositos_hechos.php?t=$id_historial' class='depositos' id='depo$id_historial' flag='$id_historial'> Depositado </a>
                                           <font style='display: none; color: GREEN' id='confirm$id_historial'> Confirmado </font>";
                                 }
                                 elseif($status == 2)
                                 {
                                     echo "<a href='#' style='margin-right: 10px' class='detalles' id='deta$id_historial' flag='$id_historial'> Detalles </a>
                                           <a href='#' style='margin-right: 10px; display: none' class='ocultes' id='ocul$id_historial' flag='$id_historial'> Ocultar </a>";
                                     echo "<font style='color: GREEN'>Confirmado</font>";

                                 }
                            echo "</div>";
                            echo "<div class='span-24' style='display: none' id='historial$id_historial'>";
                                  echo "<div class='span-24'>";
                                    echo "<div class='span-7'>";
                                        echo "Nombre del usuario";
                                    echo "</div>";
                                    echo "<div class='span-7'>
                                            No. de Referencia
                                          </div>
                                          <div class='span-5'>
                                            Fecha de Transaccion
                                          </div>
                                          <div class='span-3 last'>
                                            Bonificacion
                                          </div>
                                          <div class='span-1 last'>
                                            &nbsp;
                                          </div>";
                                  echo "</div>";
                                  echo "<div class='span-24'>";
                                      //Obtener los valores de detalles de los depositos o bonificaciones hechas
                                      $sql3 = get_details_of_deposit($id_historial);
                                      $query_interno = mysql_query($sql3, $connect) or die('Error en la consulta: ' . mysql_error());
                                      while($row_interno = mysql_fetch_array($query_interno))
                                      {//WHILE PARA LOS DETALLES DE LAS COMISIONES RECIBIDAS DEL USUARIO
                                          $numero_referencia = $row_interno['comisionRecibidaNumeroReferencia']; 
                                          $fecha_recibida_comision = $row_interno['comisionRecibidaFechaTransaccion'];
                                          $dinero_usuario = $row_interno['comisionRecibidaUsuarioBonificacion'];
                                          $id_usuario_recibe = $row_interno['comisionRecibidaUsuarioId'];

                                          //PARTE PARA OBTENER LOS NOMBRES DE LOS USUARIOS
                                          $sql_users = get_username_data($id_usuario_recibe);
                                          $result_users = mysql_query($sql_users, $connect) or die('Error en la consulta: ' . mysql_error());
                                          $users_data = mysql_fetch_row($result_users);
                                          echo "<div class='span-7'>" .
                                                    $users_data[1] . ' ' . $users_data[2] .                                              
                                               "</div>";
                                          echo "<div class='span-7'>" .
                                                    $numero_referencia .
                                               "</div>";
                                          echo "<div class='span-5'>" .
                                                    date('d-m-Y', $fecha_recibida_comision) .
                                               "</div>";
                                          echo "<div class='span-3'>" .
                                                    '$ ' . $dinero_usuario .
                                               "</div>";
                                          echo "<div class='span-1 last'>&nbsp;</div>";
                                      }
                                  echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
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
