<?php
/**
 * Contolador que maneje todas las dinámicas del sistema. Refiriendose a las 
 * reglas de juego y el como se va a repartir el pastel. Manejar por lo pronto 
 * un bien de intercambio virtual que le llamaremos 'puntos' para hacer las 
 * pruebas por mientras
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 14 March, 2011
 * @package Dinamicas
 **/
class Dinamicas extends MX_Controller{

    /**
     * @ignore
     * dinamicaId: INT <primaryKey>
     * dinamicaUsuarioId: INT <Id del usuario al que pertenece esta dinámica>
     * dinamicaExperiencias: INT <Cantidad de experiencias que le quedan>
     * dinamicaFechaCreacion: INT <timestamp al momento de la transacción>
     * dinamicaFechaModificacion: INT <timestamp al momento de la modificacion>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'user_agent'));
        $this->load->helper(array('html', 'url'));
        $this->load->model('dinamica', '', true);
    }

    /**
     * Asignar experiencias a una empresa después de la compra.
     * Al realizar una compra de 'experiencias' aqui se le debe accesar con el 
     * monto a comprar y el id de usuario.
     * TODO: Encontrar una manera de validar
     *
     * @param integer $id id usuario a asignarle experiencias
     * @param integer $amount cantidad a abonar a la cuenta de usuario
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function comprar($id, $amount)
    {
        // Formatear para tener listo y guardar.
        $data = array(
            'dinamicaUsuarioId'=>$id,
            'dinamicaExperiencias'=>$amount,
        );

        // Verificar si es la primer compra o ya hay una cuenta existente.
        $model = $this->dinamica->get('dinamicaUsuarioId = '.$id);
        if(empty($model['dinamicaUsuarioId']))
        {
            $data['dinamicaFechaCreacion'] = time();
            $this->dinamica->save($data);
        }else{
            unset($data['dinamicaUsuarioId']);
            $data['dinamicaFechaModificacion'] = time();
            $this->dinamica->save($data, 'dinamicaUsuarioId = '.$id);
        }
        redirect($this->agent->referrer());
    }

    /**
     * Cobrar 'experiencias'
     * TODO: Agregar una validación para que no cualquiera quite pulzos
     *
     * @param integer INT ID del usuario cuya cuenta hay que modificar.
     * @param integer INT Cantidad de 'experiencias' a quitar.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function cobrar($id, $amount)
    {
        // Obtener el modelo
        $model = $this->dinamica->get('dinamicaUsuarioId = '.$id);
        if($model[0]->dinamicaExperiencias < $amount)
        {
            redirect($this->agent->referrer());
        }else{
            $new_amount = $model[0]->dinamicaExperiencias - $amount;
            $data = array('dinamicaExperiencias'=>$new_amount, 'dinamicaFechaModificacion'=>time());
            $this->dinamica->save($data, 'dinamicaUsuarioId = '.$id);
        }
    }
}
