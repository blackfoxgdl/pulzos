<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('../../library/conexion.php');
require_once('../../library/emails_desktop.php');
$r=$_POST['registro'];
$secret='ElAxolot3d34ccion3smi43r003';
$password=sha1($secret.$r['pass']);
$fechaNac=$r['ano'].'-'.$r['mes'].'-'.$r['dia'];

$usuario['nombre']=$r['nombre'];
$usuario['apellidos']=$r['apellido'];
$usuario['username']=null;
$usuario['email']=$r['correo'];
$usuario['password']=$password;
$usuario['sexo']="2";
$usuario['edad']=$fechaNac;
$usuario['pais']="0";
$usuario['ciudad']="0";
$usuario['creacion']=date("Y-m-d H:m:s");
$usuario['codigoActivacion']=null;
$usuario['codigoRecuperacion']="0";
$usuario['statusRecuperacion']="1";
$usuario['statusIngreso']="1";
$usuario['statusEU']="0";

$db->AutoExecute('usuarios',$usuario,'INSERT');
/*mysql_query('
INSERT INTO usuarios (nombre, apellidos, username, email, password, sexo, edad, pais, ciudad, creacion, codigoActivacion, codigoRecuperacion, statusRecuperacion, statusIngreso, statusEU) VALUES 
("'.$r['nombre'].'", "'.$r['apellido'].'", null, "'.$r['correo'].'", "'.$password.'", 2, "'.$fechaNac.'", 0, 0,  "'.date("Y-m-d H:m:s").'", null, 0, 1, 1, 0)
') or die (mysql_error());*/

mysql_query('INSERT INTO personal VALUES ("'.mysql_insert_id().'",  null, null, null, null, null, null, null, null, null, 1)') or die (mysql_error());

//EMAIL SEND FOR THE NEW ACCOUNT USER
$codigo = generar_codigo($r['correo'], $r['nombre']);
$url_send = 'http://www.pulzos.com/inicio.php/usuarios/recuperar_password/'.mysql_insert_id().'/'.$codigo;
$from = $r['correo'];
$subject = 'Bienvenido a Pulzos';
$name_complete = $r['nombre'] . ' ' . $r['apellido'];
$message = new_user_welcome($name_complete, mysql_insert_id(), $r['correo'], $url_send);
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers.= 'To: ' . $r['correo'] . "\r\n";
$headers.= 'From: Pulzos <atencion@pulzos.com>' . "\r\n";
mail($from, $subject, $message, $headers);
echo "->".$message;
?>
