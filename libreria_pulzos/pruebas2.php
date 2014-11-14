<?php
$valor1 = $_GET['result'];

require_once('pulzos.php');
$valores = new Pulzos($valor1);
$cosas = $valores->getValue();
echo "Datos a recibir: <br />" . $cosas['messageTransaction'] . '<br />' . $cosas['noTransaction'] . '<br />' . $cosas['totalTransaction'];
