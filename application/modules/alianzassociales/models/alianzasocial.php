<?php
/**
 * Modelo en el cual se podran manipular los diversos datos usados en este 
 * modelo, esto para tenerlo de una manera estructurada y asi poder conocer la 
 * manera en la cual se estan mostrando los datos y las funciones que 
 * interfieren en el mismo
 *
 * @version 1.0
 * @copyright ZavorDigital, Sep 13, 2011
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @package alianzasSociales
 **/
class alianzaSocial extends CI_Model{

    /**
     * Metodo constructor que se usa para declarar alguna variableglobal en la 
     * cual se usaran en toda la clase para podere declarar ciertos datos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }
}
