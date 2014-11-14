<?php
/**
 * Modelo para las consultas que abarcaran la seccion
 * de la parte de connects, pues con este archivos solo
 * se influiran los datos que se estan pasando para que
 * usuario pueda loguearse y poder realizar pagos de algunos
 * productos que se desee mientras se tengan los fondos
 * suficientes
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, March 06, 2011
 * @package Connects
 **/
class Connect extends CI_Model{

    /**
     * Metodo constructor que se usa para
     * declarar ciertas variables en las cuales
     * los usuarios podran usar de manera globla..
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Metodo que se usa para obtener los datos del usuario por
     * medio del correo electronico en el cual se obtendran y
     * se le mostraran a los usuarios con los cuales se mostraran
     * una vez que se muestre la forma de pago de los usuarios
     *
     * @params string correo electronico
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($str)
    {
        $this->db->where('email', $str);
        $datos = $this->db->get('usuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder obtener la informacion de la
     * empresa dependiendo el id de la misma que se este pasando
     * esto para que el usuario vea a que empresa le va a pagar
     * y no desconfie de que el pago no sera aceptado o que el pago
     * sera incorrecto
     *
     * @params int id de al empresa
     * @return mixed datos de la empresa
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_company_data($id)
    {
        $this->db->where('negocioId', $id);
        $datos = $this->db->get('negocios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para insertar los datos de la transaccion
     * que se realizo para el usuario tenga ya su resultado en la db para
     * que el mismo se pueda guardar la transaccion y tengamos tambien algun
     * dato de respaldo de lo que pago y a quien pago. Ademas en esta parte
     * se tiene que restar el dinero del total que se tiene disponible
     *
     * @params
     * @return boolean TRUE O FALSE
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_transaction($data)
    {
        if($this->db->insert('transacciones_pagadas', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para actualizar los datos de los usuarios en cuanto
     * al dinero que se tiene disponible actualmente para gastarlo en cualquier
     * otra plataforma y con la cual los usuarios puedan ya ver reflejadas las compras
     * que hayan hecho, esto para saber la proxima vez el dinero pero actualizado
     *
     * @params double total actualizado
     * @params itn id del usuario
     *
     * @return booleand TRUE O FALSE
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_money_user($total, $id)
    {
        if($this->db->update('money_total', array('moneyTotalGanadoUsuario'=>$total), array('moneyTotalUsuarioId'=>$id)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Metodo que se usa para poder obtener los datos del usuario en los cuales
     * estos datos son para actualizar los datos del dinero ganado con los del dinero
     * que se vana  gastar para que se vea reflejado en su cuenta y saber en que parte se
     * ha gastado y cuanto le queda para gastar en pagos de manera virtual.
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_money_user($id)
    {
        $this->db->where('moneyTotalUsuarioId', $id);
        $datos = $this->db->get('money_total');
        return $datos->row();
    }

    /**
     * Metodo que se usa para conocer los datos de los negocios como
     * usuarios con los cuales se obtendran todos los datos relacionados
     * a este para poder manipularlos al antojo
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_company($id)
    {
        $this->db->where('negocioId', $id);
        $datos = $this->db->get('negocios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar los cambios de los
     * codigos que se genera en la transaccion que se haga del comercio
     * electronico con el usuario, el cual se usara para identificar
     * al momento de obtener los datos los registros del usuario en cuanto
     * al numero de referencia con la compra
     *
     * @params string code transaction
     * @params int id transaction
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_payment_code($code, $id)
    {
        $this->db->update('transacciones_pagadas', array('transaccionToken'=>$code), array('transaccionCompletaId'=>$id));
    }

    /**
     * Metodo que se usa para poder obtener los valores y saber si hay
     * alguna coincidencia con el codigo que se esta mandando para que
     * al momento de hacerse el chequeo de los datos se conosca si es
     * un token valido o si es un token invalido en las transacciones
     * que se estan realizando
     *
     * @params string transaction id
     * @return int number of register
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_code($code)
    {
        $this->db->where('transaccionCompletaId', $code);
        $data = $this->db->count_all_results('transacciones_pagadas');
        return $data;
    }

    /**
     * Metodo que se usa para poder extraer los datos de las transacciones
     * pagadas con las cuales los usuarios podran obtener ciertos datos
     * entre los cuales se obtiene un codigo para la comparacion del
     * codigo y conocer si es igual o no
     *
     * @params int transaction id
     * @return mixed row data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function getPersonalData($id)
    {
        $this->db->where('transaccionCompletaId', $id);
        $data = $this->db->get('transacciones_pagadas');
        return $data->row();
    }
}
