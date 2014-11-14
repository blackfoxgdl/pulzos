<?php
/**
 * Metodo que se usara para poder armar la consulta
 * del chequeo del password, el cual deben de coincidir
 * con el nombre de usuario y con el password para que
 * este arme la consulta a realizar
 *
 * @params string email del usuario
 * @params strong password del usuario
 * 
 * @return string cadena con la consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_query_loggin($user, $pass)
{	
    if( ($user=='jalomo@hotmail.es') || ($user=='ruben.alonso21@gmail.com') || ($user=='mauricio@zavordigital.com') || ($user=='aburto@zavordigital.com')|| ($user=='jorge_agl@hotmail.com') )
    {
		$sql = "select * from usuarios where email = '" . $user . "' and password = '" . $pass . "'";
		return $sql;	
    }
	else{
		return 'error';
    }
    //$sql = "select * from usuarios where email = '" . $user . "' and password = '" . $pass . "'";
    //return $sql;
}

/**
 * Metodo que se usa para poder obtener todas las empresas que estan dadas
 * de alta por el momento con alguna bonificacion que ya se haya realizado para
 * que se pueda conocer si tiene algun historial de deposito pendiente o
 * depositado en la empresa que tenfa las necesidades
 *
 * @return string con consulta a hacer
 * @author blackfoxgdl
 **/
function historial_de_deposito()
{
    $sql = "select * from historialDeposito left join negocios on historialEmpresaId = negocioId group by negocioId";
    return $sql;
}

/**
 * Metodo que se usa para obtener todos los registros de historial de deposito de la
 * empresa que se haya seleccionado para que los mismos los pueda visualizar el administrador
 * de la plataforma para que se revise el dinero que se esta depositando por parte de la empresa
 * en caso de que si coincida con las fechas, entonces se realizara el deposito en caso de que
 * no se tendra que dejar el deposito como en espera
 *
 * @params int id de la empresa
 * @return string con la consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_historial_completo_empresa($id)
{
    $sql = "select * from historialDeposito where historialEmpresaId = " . $id;
    return $sql;
}

/**
 * Metodo que se usa para obtener el nombre de la empresa y que esta se pueda mostrar como cabecera
 * en la parte de arriba del historial de deposito o de un estado de cuenta de las empresas, asi el
 * administrador sabra que empresa estara observando que ya ha depositado para que no haya ningun
 * error al momento de ya poner disponible el dinero del usuario
 *
 * @params int id de la empresa
 * @return string cadena con la consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_complete_companyname($id)
{
    $sql = "select * from negocios where negocioId = " . $id;
    return $sql;
}

/**
 * Metodo que se usa para obtener todos los datos de los depositoo o las bonificaciones que los usuarios
 * hayan recibido po parte de la empresa que se tiene actualmente en un estado visible. Con esta funcion
 * armaremos el query o la cadena con la cual se hara la consulta para que el usuario administrador
 * pueda  visualizar los detales de los depositos
 *
 * @params int id del historial deposito
 * @return string con query para consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_details_of_deposit($id)
{
    $sql = "select * from comisionRecibida where comisionRecibidaHistorialId = " . $id;
    return $sql;
}

/**
 * Metodo que se usa para poder obtener los datos del usuario que esta
 * recibiendo la bonificacion por parte del usuario para que este se
 * puedan obtener los datos que se necesitan mostrar en la parte del
 * administrador para conocer a quien se le deposito
 *
 * @params int id del usuario
 * @return string con el query
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_username_data($id)
{
    $sql = "select * from usuarios where id = " . $id;
    return $sql;
}

/**
 * Metodo que se usara para poder actualizar el dinero de los usuarios y darle a conocer
 * al administrador que la empresa ya deposito al banco, esto se hara por medio de los
 * distintos status que se crean por parte del area de historial deposito
 *
 * @params int id del historial del deposito
 * @return string query a realizar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function update_bank_charge($id)
{
    $sql = "update historialDeposito set historialStatusDeposito = 2 where idHistorial = " . $id;
    return $sql;
}

/**
 * Metodo que se usa para poder establecer todas las bonificaciones del usuario en una cuenta
 * concentradora en la cual el usuario vera su dinero disponible por el momento, en este caso
 * sera el que tiene para gastar, y asi se podra ver ya como se esta manejando la parte del usuario
 * en cuanto a su dinero total ya depositado en el banco con las bonificaciones
 *
 * @params int id del historial
 * @return string cadena con la consulta a realizar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_bonification_users_company($id)
{
    $sql = "select * from comisionRecibida where comisionRecibidaHistorialId = " . $id;
    return $sql;
}

/**
 * Metodo que se utiliza para poder verificar si ya tiene el usuario algun deposito bancario hecho, 
 * en caso de que no lo tenga usuario, se tendria que crear otra consulta, esto en otra funcion
 * que se declarar abajo
 *
 * @params int id del usuario
 * @return string de la consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function check_users_total_money($id)
{
    $sql = 'select * from money_total where moneyTotalUsuarioId = ' . $id;
    return $sql;
}

/**
 * Metodo que se usa para poder conocer los datos de los usuarios que ya estan registrados
 * en cuanto al valor disponible, esto para que el usuario pueda darle a conocer a la plataforma
 * su datos disponible para usarse
 *
 * @params int id del usuario
 * @params double dato a actualizar
 *
 * @return string de la consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function update_data_money_user($id, $money)
{
    $sql = "update money_total set moneyTotalGanadoUsuario = " . $money . " where moneyTotalUsuarioId = " . $id;
    return $sql;
}

/**
 * Metodo que se usa para poder actualizar los datos de los registros que entren en
 * el pago del historial de esa empresa para poder actualizar todas las fechas de
 * cuando fue realizado el deposito bancario
 *
 * @params int id del historial
 * @params string value to update
 *
 * @return string de la consulta
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function update_date_of_comision_user($id, $data)
{
    $sql = "update comisionRecibida set fechaDepositoComisionUsuario = '" . $data . "' where comisionRecibidaHistorialId = " . $id;
    return $sql;
    }
/**
 * 
 *
 * @return string de la consulta
 * @author jalomo
 **/
function update_desactivado($id)
{
    $sql = "update usuarios set codigoActivacion = 0 where id =  ". $id."";
    return $sql;
}

/**
 * 
 *
 * @return string de la consulta
 * @author jalomo
 **/
function update_activado($id,$codigo)
{
    $sql = "update usuarios set codigoActivacion ='".$codigo."'  where id = " . $id;
    return $sql;
}
/**
 * 
 *
 * @return string de la consulta
 * @author jalomo
 **/
function get_codigo_activacion($email,$nombre)
{	
	$time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    return sha1($email.$nombre.$time);
    
}
/**
 * 
 *
 * @return string de la consulta
 * @author jalomo
 **/
function get_activado($id)
{	$connect = conectar();
	 $sql = "SELECT codigoActivacion FROM usuarios WHERE id = ".$id."";
     $result = mysql_query($sql, $connect)or die('Error en la consulta: ' . mysql_error());
	 //$num_rows = mysql_num_rows($result);
	 $row = mysql_fetch_array($result);
	 $activado=$row['codigoActivacion'];
	 return $activado;
	 
			 
    
}
