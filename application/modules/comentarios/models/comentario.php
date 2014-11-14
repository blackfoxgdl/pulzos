<?php
/**
 * Guardar los comentarios en la base de datos y presentarlos cuando el request 
 * sea el adecuado
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigita, 28 March, 2011
 * @package Comentarios
 **/
class Comentario extends CI_Model{

    private $table_name = 'comentarios';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtener todos los resultados, a menos que halla una condición de por 
     * medio
     *
     * @param string $condition condición a obedecer
     *
     * @return mixed Array de objetos con la información requerida
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get($condition)
    {
        $this->db->select('comentarios.*, usuarios.*')
            ->from('comentarios')
            ->join('usuarios', 'comentarios.comentarioUsuarioId = usuarios.id');
        if($condition)
        {
            $this->db->where($condition);
        }else{
            $this->db->where('1=1');
        }
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * Guarda o hace update de acuerdo a los params
     * TODO: Validar información
     *
     * @param mixed $data Información a guardar
     * @param string $condition condición a obedecer en caso de update
     *
     * @return bool Operación exitosa
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save($data, $condition=null)
    {
        if($condition)
        {
            $this->db->update($this->table_name, $data, $condition);
        }else{
            $this->db->insert($this->table_name, $data);
        }
        return true;
    }

    /**
     * Borrar el comentario de la DB
     *
     * @return bool Bandera de éxito
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->where('comentarioId', $id);
        $this->db->delete($this->table_name);
        return true;
    }

    /**
     * Se obtienen los datos del usuario a mostrar al momento de 
     * querer comentar una imagen que se tiene en su album de 
     * fotos. Estos datos son para le mapa de sitio y asi saber
     * que parte del perfil se esta navegando.
     *
     * @params int id del usuario al que se esta visitando
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

    /**
     * Se usa para obtenes los datos de la ubicacion del
     * usuario, como lo es el pais y la ciudad a la que 
     * pertenece el mismo
     *
     * @params int id del pais o ciudad del usuario
     * @params string nombre de la tabla
     *
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row();
    }
}
