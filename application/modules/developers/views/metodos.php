<?php
/**
 * Vista de los metodos o pasos que se tienen
 * en la parte de la api de pulzos para que 
 * este pueda darle a conocer al usuario como
 * poder usar la clase
 **/
?>
<div class="span-19 last">
    <div class="prepend-7 span-11 last" style="margin-top: 20px">
        <span style="color: #660068">
            <strong style="font-size: 18px">PayPulzos</strong>
        </span>
    </div>
    <div class="span-19 last" style="color: #660068; margin-top: 20px">
        <div style="margin-left: 30px; width: 680px; text-align: justify; font-size: 14px">
            La integraci&oacute;n de PayPulzos a tu Sitio Web te da la oportunidad de accesar al m&aacute;s moderno sistema de pagos y recompensas en l&iacute;nea. Es muy sencillo y en este documento te guiaremos paso a paso durante todo el proceso.
            <br /><br />
            Primero que nada, debes tener una cuenta como Negocio dentro de Pulzos.com y haber aceptado los T&eacute;rminos, Condiciones y Comisiones dentro de la Plataforma.
            <br /><br />
            Una vez listo lo anterior, descarga el paquete que contiene la librer&iacute;a completa para PHP <a href="https://github.com/Pulzos/Pulzos-API" target="_blank" style="text-decoration: none; color: #660068"><font style="color: GREEN; font-style: italic">aqu&iacute;</font></a>.
            <br /><br />
            Despu&eacute;s de descomprimir el contenido del paquete, es necesario copiar el archivo <font style="font-style: italic">Pulzos.php</font> a la ruta deseada, de preferencia en el mismo directorio donde est&eacute;n el resto de librer&iacute;as de su Sitio.
            <br /><br />
            Se debe declarar una variable donde se recibir&aacute; la respuesta desde Pulzos.com una vez finalizada la transacci&oacute;n y hecha la redirecci&oacute;n:
            <br /><br />
            <div class="span-19 last">
                <div class="redondeo-code-box prepend-2 span-13" style="border: solid 1px #DEDEDE; padding: 10px 10px 10px 10px; margin-left: 50px; color: #888888; background-color: #FFFFFF">
                    //Creación y asignación del valor regresado por URL en la variable<br />
                    //@result = nombre de la variable que regresa el sitio Pulzos<br /><br />
                    $var1 = $_GET['result'];
                </div>
            </div>
            <div class="span-19 last" style="margin-top: 15px">
                &nbsp;
            </div>
            <br /><br />
            Ahora, realizamos  una llamada al archivo de la clase Pulzos, para tener acceso a todos los m&eacute;todos que requerimos y llevar a cabo la conexi&oacute;n exitosamente:
            <br /><br />
            <div class="span-19 last">
                <div class="redondeo-code-box prepend-2 span-13" style="border: solid 1px #DEDEDE; padding: 10px 10px 10px 10px; margin-left: 50px; color: #888888; background-color: #FFFFFF">
                    //Llamada al archivo de la clase de Pulzos<br /><br />
                    require_once('path_to_file/pulzos.php);
                </div>
            </div>
            <div class="span-19 last" style="margin-top: 15px">
                &nbsp;
            </div>
            <br /><br />
            Creamos una instancia de la clase Pulzos, pasando como par&aacute;metro la variable de respuesta declarada anteriormente:
            <br /><br />
            <div class="span-19 last">
                <div class="redondeo-code-box prepend-2 span-13" style="padding: 10px 10px 10px 10px; border: solid 1px #DEDEDE; color: #888888; margin-left: 50px; background-color: #FFFFFF">
                    //Instancia que se necesita para accesar a la clase de Pulzos<br />
                    //Se le pasa como parámetro el valor que se retorna por parte de PayPulzos<br /><br />
                    $obj = new Pulzos($var1);
                </div>
            </div>
            <div class="span-19" style="margin-top: 15px">
                &nbsp;
            </div>
            <br /><br />
            Posteriormente, debemos definir una variable donde se recibirán los par&aacute;metros de respuesta una vez terminado el proceso de retorno de la clase Pulzos, con el m&eacute;todo getValue():
            <br /><br />
            <div class="span-19 last">
                <div class="redondeo-code-box prepend-2 span-13" style="padding: 10px 10px 10px 10px; border: solid 1px #DEDEDE; color: #888888; margin-left: 50px; background-color: #FFFFFF">
                    //Creación de variable y asignación de variable contenedora de valores para<br />
                    //manipulación en comercio electrónico<br /><br />
                    $rsp = $obj->getValue();
                </div>
            </div>
            <div class="span-19 last" style="margin-top: 15px">
                &nbsp;
            </div>
            <br /><br />
            En esta variable tendremos un arreglo asociativo que contiene los siguientes valores:
            <br /><br />
            <div class="span-19 last">
                <div class="span-1" style="color: GREEN">
                    <font style="font-style: italic">a)</font>
                </div>
                <div class="span-17" style="margin-left: -25px">
                    <font style="font-style: italic">noTransaction</font> (N&uacute;mero de Transacci&oacute;n). Folio de Identificaci&oacute;n de la operaci&oacute;n en la Plataforma Pulzos.com. 
                    <br />
                    Este folio tiene el siguiente formato:
                </div>
                <div class="span-19" style="margin-left: 50px">
                    P-XXXXXXXXXX	 (donde X=d&iacute;gito)
                </div>
            </div>
            <div class="span-19 last">
                <div class="span-1" style="color: GREEN">
                    <font style="font-style: italic">b)</font>
                </div>
                <div class="span-17" style="margin-left: -25px">
                    <font style="font-style: italic">totalTransaction</font> (Monto Total de la Transacci&oacute;n). Cantidad en Pesos Mexicanos que ampara la operaci&oacute;n efectuada.
                </div>
            </div>
            <div class="span-19 last">
                <div class="span-1" style="color: GREEN">
                    <font style="font-style: italic">c)</font>
                </div>
                <div class="span-17" style="margin-left: -25px">
                    <font style="font-style: italic">messageTransaction</font> (Respuesta de la Transacción). Mensaje de respuesta de la Operación.<br /> Existen las siguientes posibilidades:
                </div>
                <div class="span-19" style="margin-left: -30px">
                    <div class="prepend-2 span-16">
                        <font style="font-style: italic">I) Transacción Completa:</font> Pago y transacción finalizada OK.
                    </div>
                    <div class="prepend-2 span-16">
                        <font style="font-style: italic">II) Transacción Incorrecta:</font> Transacción incompleta debido a un fallo al momento de concretar el pago.
                    </div>
                    <div class="prepend-2 span-16">
                        <font style="font-style: italic">III) Código Incorrecto:</font> Código corrupto. Imposible continuar operación.
                    </div>
                    <div class="prepend-2 span-16">
                        <font style="font-style: italic">IV) No se realizó la Transacción:</font> Operación incompleta debido a errores varios.
                    </div>
                    <div class="prepend-2 span-16">
                        <font style="font-style: italic">V) No hay registro Actual:</font> No existe ninguna referencia al código enviado.
                    </div>
                </div>
            </div>
            <br /><br />
            <div class="span-19 last" style="margin-top: 20px">
                <div class="redondeo-code-box prepend-2 span-13" style="padding: 10px 10px 10px 10px; border: solid 1px #DEDEDE; color: #888888; margin-left: 50px; background-color: #FFFFFF">
                    //Mensaje de la transacci&oacute;n<br />
                    $resp1 = $valor['messageTransaction'];
                    <br /><br />
                    //Folio de la Transacci&oacute;n<br />
                    $resp2 = $valor['noTransaction'];
                    <br /><br />
                    //Total de Transacci&oacute;n<br />
                    $resp3 = $valor['totalTransaction'];
                </div>
            </div>
            <div class="span-19 last" style="margin-top: 20px">
                &nbsp;
            </div>
        </div>
    </div>
</div>
