<?php

define('HOST', 'localhost');
define('DB', 'pulzos_bueno');
define('USER_DB', 'root');
define('PASS_DB', 'zav060313');

function conectar()
{
    if(!$link = mysql_connect(HOST, USER_DB, PASS_DB))
    {
        echo "Error en la conexion a la base de datos";
        exit();
    }
    if(!mysql_select_db(DB, $link))
    {
        echo "Error en la seleccion de la base de datos";
        exit();
    }
    return $link;
}

?>
