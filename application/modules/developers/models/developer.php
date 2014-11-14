<?php
/**
 * Modelo en el cual se definiran todos los metodos
 * que se usaran para obtener los datos de los usuarios y
 * para que los mismos se usen para obtener algun dato del
 * negocio y se puedan definir cuales negocios han aceptado
 * los terminos del uso de PayPulzos
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Jan 16, 2011
 * @packages Developers
 **/
class Developer extends CI_Model
{

    /**
     * Metodo constructor que se usa para poder
     * declarar las viariables y demas opciones
     * que se usaran en esta clase de manera global
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }
}
