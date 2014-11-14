<?php
/**
 * Capa de abstracción de la tabla inbox
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 17 May, 2011
 * @package inbox
 **/
class Inbox extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Guardar información en la DB
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     * TODO: Agregar algún tipo de check de operación
     **/
    public function save($data)
    {
        $this->db->insert('inboxn', $data);
    }

    /**
     * Obtener resultados de buzon de entrada
     *
     * @param string $condition Condición para obtener datos
     *
     * @return mixed Rows en la base de datos
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_entrada($condition=null)
    {
        $this->db->select('*')
            ->from('usuarios')
            ->join('inbox', 'inbox.inboxUsuarioRecibeId = usuarios.id', 'left')
            ->where($condition);
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * Obtener resultados de buzon de salida
     *
     * @param string $condition Condición para obtener datos
     *
     * @return mixed Rows en la base de datos
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_salida($condition=null)
    {
        $this->db->select('*')
            ->from('usuarios')
            ->join('inbox', 'inbox.inboxUsuarioId = usuarios.id', 'left')
            ->where($condition);
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * borrar el registro de la DB
     *
     * @param integer $id Id del comentario a borrar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->where('inboxId', $id);
        $this->db->delete('inbox');
        return true;
    }

    /**
     * Cambiar el status a leido
     *
     * @param integer $id Id del mensaje
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     * TODO: Agregar validaciones
     **/
    public function leido($id)
    {
        $this->db->where('inboxId', $id);
        $this->db->update('inbox', array('inboxStatus'=>1));
        return true;
    }

    /**
     * Se obtienen los datos del usuario, el cual se usaran al
     * momento de enviar mensajes para poder obtener ciertos datos
     * que se guardarn en la DB
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_company($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }
}
