<?php
/**
 * Copyright 2012 Pulzos
 *
 * Clase que se usa para poder realizar los procesos que se necesitan
 * en cuanto a recuperar los datos necesarios por parte de los negocios
 * estos necesarios para realizar la obtencion de los datos que se guardaran
 * en algun lugar del comercio para que se conosca la referencia que el usuario
 * ha creado una vez que haya hecho su pedido
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @package PULZOS
 **/
class Pulzos{
    /**
     * Constructor, metodo donde se declaran las variables que se usaran de manera
     * global en la clase de pulzos, esto para el uso de los sitios que
     * vayan a implementar las clases de la clase PULZOS
     *
     * @version 1.0
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct($data){
        $this->message = '';
        $this->reference = '';
        $this->status = '';
        $this->code_company = '';
        $this->code = $data;
        $this->url = 'http://www.pulzos.zavordigital.com/inicio.php/connects/getDataTransaction/';
            //"localhost/pulzos/inicio.php/connects/getDataTransaction/";
            //'OBTENER LOS DATOS DE ACUERDO AL TOKEN DADO';//"localhost/pulzos/inicio.php/connects/getDataTransaction/";
        $this->url_checked = 'http://www.pulzos.zavordigital.com/inicio.php/connects/check_params_send/';//'localhost/pulzos/inicio.php/connects/check_params_send/';
            //'CHECKAR LOS TOKENS SEAN CORRECTOS';//"http://www.zavordigital.com/codePulzos/pruebas.php";
    }

    /**
     * Metodo que realiza la conexion para traer los datos necesarios para
     * que el comercio pueda realizar su transaccion por parte de la clase
     * de pulzos y pueda recibir los datos necesarios para que el mismo
     * pueda conocer los valores que tiene que manipular en sus archivos
     * para que quede registrada correctamente esta parte del pedido
     *
     * @return mixed data returned
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function getConnect($url)
    {
        $inicio = curl_init();

        curl_setopt($inicio, CURLOPT_URL, $url);
        curl_setopt($inicio, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($inicio, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($inicio, CURLOPT_TIMEOUT, 10);

        $valores = curl_exec($inicio);
        curl_close($inicio);

        return $valores;
    }
    
    /**
     * Metodo que se usa para poder validar datos que se enviaran y que
     * no sean corrompidos por otros usuarios al momento de mandarlos,
     * en caso de que no exista tal dato entoces regresara un error
     * al webmaster notificando el error por medio de un valor a 
     * mostrar a ellos
     *
     * @params string pass to check
     * @return mixed data to return
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function check_data_passcode($str)
    {
        $start = curl_init();

        curl_setopt($start, CURLOPT_URL, $str);
        curl_setopt($start, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($start, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($start, CURLOPT_TIMEOUT, 10);

        $execute = curl_exec($start);
        curl_close($start);

        return $execute;
    }

    /**
     * Metodo que se usa para poder obtener los datos de los mensajes que
     * se vayan mandando y dependiendo de cuales sean estos, se van manipulando
     * de una forma que el webmaster del comercio donde se agregue la clase
     * pulzos pueda mostrar un mensaje en caso de que el usuario no haya podido
     * completar la transaccion, el cual el caso es por el boton cancelar
     *
     * @params int id del status del mensaje
     * @return message
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function message_user($status)
    {
        switch($status)
        {
            case 1:
                    return "Pago Aceptado";
                    break;
            case 2:
                    return "Pago Rechazado. Fondos insuficientes.";
                    break;
            case 3:
                    return "Pago Rechazado. Cuenta Corrupta.";
                    break;
        }
    }

    /**
     * Parte en la cual se verifica el estado de los mensajes para
     * conocer cuales son los valores disponibles. Esta parte devolvera
     * ciertos datos para la empresa y que el webmaster del comercio
     * pueda manipular de una forma que pueda guardar el proceso en
     * su plataforma administrativa
     *
     * @params string status message
     * @return mixed different data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function validate_message($str)
    {
        $value = $this->check_data_passcode($this->url_checked.$str);
        $val = $this->string_decode($value);
        if($val['v_total'] == 1)
        {
            //Obtener los datos de la transaccion
            $data = $this->getConnect($this->url.$str.'/'.$val['messageTransaction']);
            $result = $this->string_decode($data);
            return $result;
        }
        else
        {
            //en caso de que el codigo sea incorrecto
            return $val;
        }
    }

    /**
     * Metodo de clase que se usa para poder obtener los valores de los
     * mensajes que hayan sido rechazados, esto es una forma de recibirlos
     * de un json para que el usuario pueda visualizarlos y recuperar estos
     * valores y pueda guardar o sustituir en su comercio electronico. Con estos
     * datos el usuario podra mostrar un mensaje en caso de que el pago se haya
     * cancelado por alguno u otra razon
     *
     * @params int status value
     * @return array with data for users
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function refuse_payment($int)
    {
       return ;
    }

    /**
     * Metodo que se realiza la obtencion de los datos una vez que los usuarios
     * ya hayan realizado la conexion a pulzos y que se haya hecho la
     * transaccion de forma correcta, con esto se podran visualizar y obtener
     * los datos a manipular por el webmaster
     *
     * @params mixed data to format
     * @return mixed array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function getDataShow($data)
    {
       $value = json_decode($data, TRUE);
       return $value;
    }

    /**
     * Metodo que se usa para poder realizar la forma en la que se vienen
     * los datos, saber si vienen de una forma que se requiere y no esten
     * corrompidos los datos o los que se usaran para manipular esta clase
     * y se pueda usar de una manera correcta
     *
     * @params string data to check
     * @return boolean flag returned
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function check_data($str)
    {
        return;
    }

    /**
     * Parte para poder realizar alguna obtencion de datos para que se pueda
     * realizar el proceso para obtener los datos que se tienen como 
     * parametro para que estos despues se puedan manipular en los procesos
     * que se llevan a cabo para la obtencion de resultaldos
     *
     * @params mixed data
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function params_decode($str)
    {
        return;
    }

    /**
     * Metodo necesario para poder decodificar los datos que regresa
     * el servidor para que puedan ser manipulados en las clases y
     * estos mismo puedan realizar la obtencion de los datos
     * del objeto devuelto
     *
     * @params string data returned
     * @return array string decode
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    protected function string_decode($str)
    {
        $val = json_decode($str, TRUE);
        return $val;
    }

    /**
     * Metodo util para obtener los resultados necesarios por parte del
     * webmaster del sitio donde se implementara la API del metodo de pagos
     * de pulzos, esto para que puedan guardarlo en su base de datos con
     * los datos que retornamos para que puedan tener un registro
     * de la transaccion realizada, aunque estas transacciones se
     * tienen en el sitio de pulzos
     *
     * @return mixed data returnes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function getValue()
    {
        $end = $this->validate_message($this->code);
        return $end;
    }
}
