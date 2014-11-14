<?php
/**
 * Actividades a realizar por el usuario
 *
 * Actividades se refiere a la parte del perfil donde irá la siguiente
 * premisa: ¿Que es lo que quiero hacer?
 * Lo separo en un módulo aparte porque también habrá que agregar algos
 * que saquen en tiempo real negocios relacionados con el rubro. Eso queda en 
 * secundario.. creo...
 *
 * TODO: Checar que la plantilla esté correcta. La escribí como guia más no
 * garatizo que sea sintácticamente correcta
 * TODO: Agregar funcionas con sufijo _json para el retorno ajax. Definir 
 * después
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 02 March, 2011
 * @package Actividades
 **/

class Actividades extends MX_Controller{
    /*
     * @ignore
     * Estructura de DB:
     * actividadId: INT <primaryKey>
     * actividadUsuarioId: INT <id del usuario que postea
     * actividadTexto: VARCHAR 400 <texto del post>
     * actividadFechaCreacion: INT <unixtimestamp de la fecha de creacion>
     */
    private $hola = "hola";
    private $adios = "adios";

    public function __construct()
    {
        // Inicialización de librerias y helpers necesarios
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
    }

    /**
     * Método por defecto.
     *
     * Controlador por defecto. Redirigir a ver
     * cuando se accese esto directamente
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index()
    {
        redirect('actividades/ver');
    }

    /**
     * Muestra actividades
     *
     * Recibe un parametro opcional. Si este está presente
     * Solo mostrar las actividades de la persona delimitada
     * Sino mostrar todas las actividades de todos los amigos
     * del usuario loggeado. 
     * TODO: Controles de privacidad. Pero hay que pensar una estructura
     * de el sitio completo
     *
     * @param integer $id ID del usuario indicado
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver($id)
    {
        //Insertar código aqui
    }

    /**
     * Crear actividad
     *
     * Este controlador crea una nueva 'actividad' en la DB
     * El chiste es validar el formulario de todas maneras
     * aqui aunque ya esté validado en frente y NO SOBRE INGENIAR
     * el problema no es tan complicado. Recuerden namespacear los 
     * formularios para evitar conflictos. Ejemplo:
     * <input type='text' name='Actividades[actividadTexto]' />
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function crear()
    {
        //Insertar código aqui.
    }

    /**
     * edición del dato
     * 
     * Para ser sinceros no creo que una vista de edición sea
     * necesaria.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function editar(){
        redirect('actividades/ver');
    }

    /**
     * borrar una actividad
     * 
     * Borrar una actividad que el usuario deseé. Esto en caso de
     * que se equivoque o algo asi. Nos quita chamba si lo hacemos
     * asi en lugar de preparar un método de edición. Verificar que el
     * usuario sea el dueño del elemento a borrar
     * TODO: Lo mismo delimitado anteriormente. Agregar controles de acceso 
     * a nivel sitio
     *
     * @param integer $id Id del elemento a borrar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id)
    {
        //Insertar código
    }
}
