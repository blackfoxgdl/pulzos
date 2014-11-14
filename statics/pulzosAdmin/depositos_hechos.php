<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['password']))
{
    require_once('conexion.php');
    require_once('funciones_procesos.php');
    $connect = conectar();
    $valor = $_GET['t'];

    //PARTE PARA ACTUALIZAR A 1 EL DEPOSITO DE LA EMPRESA EN EL BANCO
    $sql = update_bank_charge($valor);
    
    $result = mysql_query($sql, $connect)
        or die('Error en la actualizacion de estado: ' . mysql_error());

    //PARTE PARA ACTUALIZAR LA FECHA DE REGISTRO DEL DEPOSITO
    $fecha_deposito = date('d-m-Y');
    $sql_comision = update_date_of_comision_user($valor, $fecha_deposito);

    $result_comision = mysql_query($sql_comision, $connect)
        or die('Error en la actualizacion de fecha de comision: ' . mysql_error());

    //PARTE DE LOS USUARIOS CON LAS COMISIONES
    $sql1 = get_all_bonification_users_company($valor);
    $result1 = mysql_query($sql1, $connect)
        or die('Error en la consulta de las comisiones: ' . mysql_error());
    
    /*while($row = mysql_fetch_array($result1))
    {
        echo "hola: " . $row['comisionRecibidaId'] . '<br />';
    }*/
    while($row = mysql_fetch_array($result1))
    {
        echo "hola: " . $row['comisionRecibidaId'] . "<br />";
        $sql_interno = check_users_total_money($row['comisionRecibidaUsuarioId']);
        $result_interno = mysql_query($sql_interno, $connect) or die('Error en la consulta interna 1: ' . mysql_error());
        $total_registros = mysql_num_rows($result_interno);
        echo "total: " . $total_registros;
        if($total_registros == 0)
        {
            $sql = "insert into money_total values(" . $row['comisionRecibidaUsuarioId'] . ', ' . $row['comisionRecibidaUsuarioBonificacion'] . ')';
            mysql_query($sql, $connect) or die('Error en la consulta de insercion de dinero total: ' . mysql_error());
        }
        else
        {
            $sql = check_users_total_money($row['comisionRecibidaUsuarioId']);
            $result2_interno = mysql_query($sql, $connect)
                or die('Error en la consulta del total del usuarios: ' . mysql_error());
            $row2 = mysql_fetch_row($result2_interno);
            $total_money = $row2[1] + $row['comisionRecibidaUsuarioBonificacion'];
            echo "<br />total hasta ahora: " . $total_money . "<br />";
            $sql2 = update_data_money_user($row['comisionRecibidaUsuarioId'], $total_money);
            mysql_query($sql2, $connect)
                or die('Error en la actualizacion del dinero: ' . mysql_error());
        }
    }
}
else
{
    header('Location: ingreso.php');
}
