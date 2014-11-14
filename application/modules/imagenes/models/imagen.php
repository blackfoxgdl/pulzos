<?php
/**
* Modelo con los mismos metodos que los demas
* TODO: Checar que onda con esto. A la mera con un padre quitamos tanto código 
* repetido
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright Zavordigital, 08 March, 2011
 * @package Imagenes
 **/
class Imagen extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'imagenes';
    }

    /**
     * Guardar el modelo en la DB. En caso de $condition se hará un update
     *
     * Save all method. No quiero repetir lo mismo 35 veces
     * TODO: Siempre va a retornar true
     *
     * @param mixed $data Informacion a guardar
     * @param string $condition condición opcional para hacer update
     *
     * @return bool flag
     * @author axoloteDeAccion
     **/
    public function save($data, $condition=null)
    {
        if($condition)
        {
            $this->db->update($this->table_name, $data, $condition);
            $return_data = 0;
        }else{
            $this->db->insert($this->table_name, $data);
            $return_data = $this->db->insert_id();
        }
        return $return_data;
    }

    /**
     * Retorna solo un registro o varios dependiendo de la $condition
     *
     * Dependiendo del valor de los parametros decide automáticamente cuantos 
     * y cuales registros traer. Nada complicado
     *
     * @param string $condition condicion a seguir
     *
     * @return mixed resultados
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get($condition=null)
    {
        // construir el query
        $this->db->select('imagenes.*, albums.*')
            ->from('imagenes')
            ->join('albums', 'imagenes.imagenAlbumId = albums.albumId', 'left');
        if($condition)
        {
            $this->db->where($condition);
        }else{
            $this->db->where('1 = 1');
        }
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * Borrar un registro de la DB
     * TODO: Verificar todas las banderas de éxito. Siempre retornan true
     *
     * @return bool Bandera de éxito
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->delete($this->table_name, array('imagenId'=>$id));
        return true;
    }

    /**
     * Se obtienen todos los datos del usuario al cual
     * pertenecen los albums y las imagenes que estan
     * siendio visualizadas. Esto es para el mapa de sitio
     *
     * @params int id del usuario
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
     * Se obtienen los datos de la ubicacion del usuario
     * digase su ciudad y el pais en donde radica.
     *
     * @params int id del pais o ciudad
     * @params string nombre de la tabla
     *
     * @return mixed datos de la ciudad o pais
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Get default user albums Else return 0
     *
     * @param integer $id ID of the user whose albums are to be checked
     *
     * @return integer album ID or 0 depending on findings
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_default_album($id)
    {
        $this->db->select('*')
            ->from('albums')
            ->where('albums.albumUsuarioId = '.$id)
            ->where('albums.albumDefault = 1');
        $Q = $this->db->get();
        if($Q->num_rows() == 0)
        {
            $this->db->insert('albums', 
                array(
                    'albumUsuarioId'=>$id,
                    'albumDefault'=>1,
                    'albumNombre'=>'Mis fotos de perfil',
                    'albumFechaCreacion'=>time(),
                    'albumLugar'=>'Mi Perfil',
                    'albumDescripcion'=>'Imágenes que he usado como fotos de perfil',
                ));
            $return_data = $this->db->insert_id(); 
        }else{
            $album = $Q->row();
            $return_data = $album->albumId;
        }
        return $return_data;
    }

    /**
     * Metodo que se usa para contar los datos de los usuarios que se tienen
     * actualmente en la tabla donde se guarda la ruta del tumbh nail con la cual
     * se usara para mostrar las imagenes de los usuarios, esto para  saber si se
     * inserta o actualizan los datos
     *
     * @params int id del usuario
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_data_thumbnail($id)
    {
        $this->db->where('thumbUsuarioId', $id);
        $total = $this->db->count_all_results('imagenes_thumb');
        return $total;
    }

    /**
     * Metodo que se usa para insertar la imagen thubmnail para que el mismo pueda
     * insertarse y guardarse y una vez que se use la aplicacion del usuario para
     * que se pueda mostrar una imagen necesaria sin necesidad de redimensionar desde
     * el movil
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_thumb($data)
    {
        $this->db->insert('imagenes_thumb', $data);
    }

    /**
     * Metodo que se usa para insertar la actualizacion de la imagen que se tiene actualmente
     * en su avatar, esto para que se pueda ver despues desde la parte del movil para que
     * el usuario pueda ver de forma mas rapida las imagenes
     *
     * @params string dato a actualizar
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_thumb($str, $id)
    {
        $this->db->update('imagenes_thumb', array('usuarioThumbName'=>$str), array('thumbUsuarioId'=>$id));
    }

    /**
     * Metodo que se usa para obtener todos los registros de los usuario
     * que se encuentran actualmente en la plataforma para conocer si tienen
     * algun avatar disponible o no
     *
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_data_user()
    {
        $this->db->where('statusEU', '0');
        $datos = $this->db->get('usuarios');
        return $datos->result();
    }
}
