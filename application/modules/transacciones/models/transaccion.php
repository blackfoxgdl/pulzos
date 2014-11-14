<?php
/**
 * Modelo de las transacciones donde se haran todas las operaciones
 * necesarias por parte de este modulo hacia la base de datos, ya sea
 * insercion, actualizacion, obtencion y eliminacion de algun dato,
 * registro o un conjunto de registros
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Oct 26, 2011
 * @package Transacciones
 **/
class transaccion extends CI_Model
{
    /**
     * Constructor donde se declararan variables que se usaran
     * por parte del modelo para alguna operacion que se 
     * desee hacer de manera global
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Metodo que se usa para poder obtener todas las transacciones que
     * se han llevado a cabo por medio de las bonificaciones de las
     * empresas con el usuario, esto para que se puedan observar todas
     * las transacciones completadas
     *
     * @params int id de la empresa
     * @return mixed datos a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_complete_transactions($id)
    {
        $this->db->where('comisionRecibidaEmpresaId', $id);
        $datos = $this->db->get('comisionRecibida');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder obtener las transacciones de las fechas que
     * son del 1 al 15 y asi poder mostrar el historial que se tienen y asi
     * hacer un solo historial para mostrarlo en la lista de estados de cuenta,
     * y que el negocio sepa que tantos impactos tuvo la quincena
     *
     * @params int fecha inicio
     * @params int fecha fin
     * @params int id del negocio
     *
     * @return mixed datos que coincidan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_first_fortnight($inicio, $final, $id)
    {
        $this->db->where();
        $this->db->where();
        $datos = $this->db->get('');
        return $datos->result();
    }

    /**
     * Metodo que se usa para obtener todos los datos del historial del deposito que se
     * tiene actualmente por parte de la empresa, estos van diferenciados por fecha de inicio
     * i fecha fin, o bueno eso no importa tanto, jajajajaja, o si porque a partir de
     * ahi se traen los datos de las transacciones que se usaran para que se muestren todos
     * los impactos que se han tenido
     *
     * @params int id de la empresa como empresa
     * @return mixed datos de coincidencia
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_history_transactions($id)
    {
        $this->db->where('historialEmpresaId', $id);
        $datos = $this->db->get('historialDeposito');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder actualizar los registros en la base
     * de datos para que el mismo pueda señalar que ya se ha actualizado
     * en el sistema el deposito que se ha hecho para que el usuario pueda
     * disponer de su dinero, asi la empresa sabra que ya no tiene deudas
     *
     * @params int id del registro a actualizar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_transaction($id, $code)
    {
        $this->db->update('historialDeposito', array('historialStatusDeposito'=>'1', 'historialCodigo'=>$code), array('idHistorial'=>$id));
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de la transaccion
     * principal por parte del usuario con el cual se podran crear los numeros
     * de referencia por cada grupo de transacciones que se hara por quincena,
     * esto para al momento que realicen el deposito pueda conocer la parte de
     * pulzos a que usuarios se les tienen que depositar y cual es la cantidad,
     * y si en realidad deposito la empresa
     *
     * @params int id del historial
     * @return mixed datos del registro con todos los campos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_history_transaction($id)
    {
        $this->db->where('idHistorial', $id);
        $valores = $this->db->get('historialDeposito');
        return $valores->row();
    }

    /**
     * Metodo que se usara para poder obtener todos los movimientos que ha hecho
     * o ha realizado el usuario, para que el mismo pueda visualizar los datos
     * de sus bonificaciones que ha hecho y si ya tienen la transaccion disponible
     * o si esta aun en pendiente
     *
     * @params int id del usuario
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_transactions_user($id)
    {
        $datos = $this->db->query('select * from money_usuario right join money_back on usuariosMoneyBackId = moneyBackId where usuarioMoneyUsuarioId = ' . $id . ' and usuarioMoneyStatus != 2');
        return $datos->result();
    }

    /**
     * Metodo que se usa para obtener todas las transacciones de los
     * usuarios que se tienen actualmente registradas como salidas del mismo
     * para que pueda ver en que gasto sus datos y asi no solo vera que se
     * le descuenta de su total disponible
     *
     * @params int id del usuario
     * @return mixed data array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_transaction_off($id)
    {
        $this->db->where('comisionRecibidaUsuarioId', $id);
        $datos = $this->db->get('comisionRecibida');
        return $datos->result();
    }

    /**
     * Metodo que se encarga de sacar todas las salidas que se
     * tengan por parte del usuario para que el mismo pueda
     * ver en sus estados de cuentas con los cuales el usuario
     * vera todos los movimientos que ha hecho en cuanto a salidas
     *
     * @params int dia
     * @params int mes
     * @params int año
     *
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_off_by_month($dia, $mes, $ano)
    {
        $this->db->where('transaccionUsuarioId', $this->session->userdata('id'));
        $datos = $this->db->get('transacciones_pagadas');
        return $datos->result();
    }

    /**
     * Metodo que se encarga de sacar todas las entradas que ha tenido
     * el usuario en cuanto a las bonificaciones que se han confirmado
     * por parte de pulzos hacia el usuario con el cual podra ver sus
     * ingresos que ya estan disponibles
     *
     * @params int dia
     * @params int mes
     * @params int año
     *
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_in_by_month($dia, $mes, $ano)
    {
        $datos = $this->db->query('select * from historialDeposito right join comisionRecibida on comisionRecibidaHistorialId = idHistorial where historialStatusDeposito = 2 and comisionRecibidaUsuarioId =' . $this->session->userdata('id'));
       return $datos->result(); 
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de los bancos que
     * son necesarios para llenar una lista desplegable, las cual podra ser
     * seleccionada por el usuario que desee colocar su clabe de transferencia
     *
     * @return array bank data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_bank_list()
    {
        $datos = $this->db->get('bancos');
        return $datos;
    }

    /**
     * Metodo que se usa para poder visualizar todos los datos del usuario que
     * guardara su llave para que despues pueda solicitar los transfer sin
     * la necesidad de estarlo teclenado correctamente, esto para que el usuario
     * no se le dificulte el proceso
     *
     * @params int id del usuario
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_personal_data($id)
    {
        $this->db->where('id', $id);
        $datos = $this->db->get('usuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para guardar los datos de los usuarios en cuanto a las llaves
     * clabes se refieren para que se pueda realizar el transfer correctamente sin
     * necesidad de que el usuario este tecleando cada rato su llave
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_data_transfer($data)
    {
        $this->db->insert('tranferencias_usuarios', $data);
    }

    /**
     * Metodo que se usa para poder realizar los posteos de los usuarios en cuanto
     * a actualizaciones se llaman, las cuales los usuarios podran realizar lo que
     * ellos crean mas conveniente para que los usuarios puedan realizar este proceso
     * de transferencias bancarias
     *
     * @params mixed array data
     * @params int id del usuario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data_transfer($data, $id)
    {
        $this->db->update('tranferencias_usuarios', $data, array('idUsuarioTransferenciaUsuario'=>$id));
    }

    /**
     * Metodo que se usa para guardar los datos de los usuarios en cuanto a la informacion
     * de los retiros de los recursos de los usuarios con los cuales el usuario podra
     * visualizar que se necesita para el retiro del mismo
     *
     * @params mixed array data
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_retire_users($data)
    {
        $this->db->insert('retiros', $data);
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de
     * los usuarios a lo que se refiere a la cantidad total que
     * tiene para gastar como disponible actualmente en la plataforma
     * de pulzos
     *
     * @params int id del usuario
     * @return mixed data array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_total_money($id)
    {
        $this->db->where('moneyTotalUsuarioId', $id);
        $datos = $this->db->get('money_total');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar las actualizaciones
     * que se necesita para poder actualizar el dinero de la tabla 
     * que es necesaria para que el usuario pueda ver reflejada en
     * su dinero final
     *
     * @params double datos a actualizar
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_retire_money($money, $id)
    {
        $this->db->update('money_total', array('moneyTotalGanadoUsuario'=>$money), array('moneyTotalUsuarioId'=>$id));
    }

    /**
     * Metodo que se usa para poder realizar los datos de los recursos
     * de cada usuario para que el mismo pueda actualizarse una vez que
     * haga algun retiro, esto siempre y cuando la validacion sea verdadera
     * y que haya mas dinero del que se desea retirar, en caso de que no
     * tenga mas del que desea retirar le mostrara una excepcion
     *
     * @params int id del usuario
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_history_data($id)
    {
        $this->db->where('moneyTotalUsuarioId', $id);
        $datos = $this->db->get('money_total');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar los datos de los usuarios
     * con los cuales se podran enviar al correo electronico de la persona
     * que realizara las transferencias a los otros usuarios estos para
     * que pueda ya poner disponible al usuario su money
     *
     * @params int id del usuario
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_data_combinate($id)
    {
        $datos = $this->db->query('select * from usuarios left join tranferencias_usuarios on idUsuarioTransferenciaUsuario = id where id = ' . $id);
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar las actualizaciones de los
     * datos correspondientes en los cuales las empresas podran colocar el
     * numero de referencia con el cual se realizo el deposito dado y asi
     * ampararse de que ya se ha depositado el monto correcto
     *
     * @params int id del historial
     * @params string numero de referencia
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_number($id, $nR)
    {
        $this->db->update('historialDeposito', array('historialDepositoReferencia'=>$nR), array('idHistorial'=>$id));
    }
}
