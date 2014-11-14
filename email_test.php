<?php
echo "hola es una prueba si envia??";
$cabeceras = 'From: Pulzos <pulzos@pulzos.com>' . "\r\n";
mail("ruben@zavordigital.com", "hola", "hola", $cabeceras);

