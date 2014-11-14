<?php
/**
 * Modelo para imagenNegocios. Se usara
 * para todas las operaciones que se tengan
 * que hacer en este modulo para imagenNegocio
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package imagenNegocios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
 
class imagenNegocio extends CI_Model
{
	
	/**
	 * Constructor del modelo de
	 * las imagenes del negocio
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Guarda la nueva imagen que se agrego
	 * al album del negocio
	 *
	 * @params mixed datos de la imagen a guardar
	 * @return flag Verdadero exito
	 *				Falso no exito
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function save($post, $condition=null)
	{
        if($condition)
        {
            $this->db->update('imagennegocios', $post, $condition);
            $return_data = 0;
        }
        else
        {
            $this->db->insert('imagennegocios', $post);
            $return_data = $this->db->insert_id();
        }
        return $return_data;
	}
	
	/**
	 * Actualiza los datos que se deseen 
	 * cambiar referentes a la informacion
	 * de la imagen
	 * 
	 * @params mixed datos a modificar de la imagen
	 * @params string condicion con posibilidad que sea nulo el valo
	 * @return flag Verdadero exito
	 *				Falso no exito
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function edit($data, $condition=null)
	{
		if($this->db->update('imagennegocios', $data, $condition))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

    /**
     * Editar los datos informativos de las
     * imagenes de los albums, dependiendo cual se quiera 
     * modificar para que al momento de mostrar la
     * imagen aparesca la descripcion y el titulo
     *
     * @params int id de la imagen
     * @params int id del album
     * @params int id del negocio
     *
     * @return flag true or false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function edit_data($data, $id)
    {
        if($this->db->update('imagennegocios', $data, array('imagenId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	/**
	 * Se obtienen todos los datos relacionados
	 * a la imagen del negocio son la relacion
	 * en los albums del negocio
	 *
	 * @params string condicion posibilidad nula
	 * @return mixed arreglo de datos
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get($condition=null)
    {
        // construir el query
        $this->db->select('imagennegocios.*, albumsnegocios.*')
            ->from('imagennegocios')
            ->join('albumsnegocios', 'imagennegocios.imagenNegocioAlbumId = albumsnegocios.albumNegocioId', 'left');
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
     * Se obtiene los datos de la imagen que
     * se selecciono para la vista
     *
     * @params int id de la imagen
     * @return mixed datos de la imagen
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_imagen_data($id)
    {
        $query = $this->db->query("select * from imagennegocios left join albumsnegocios on imagenNegocioAlbumId = albumId where imagenId=" . $id);
        return $query->row();
    }
	
	/**
	 * Se obtienen los datos del negocio de
	 * la tabla negocios con el id del 
	 * usuario de session en caso de que 
	 * exista
	 * 
	 * @params int id de usuario que inicio sesion
	 * @return mixed datos del negocio
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get_data($id)
	{
		$this->db->where('negocioUsuarioId',$id);
		$query = $this->db->get('negocios');
		return $query->row();
	}
	
	/**
	 * Metodo para borrar la imagen relacionada
	 * al album de lose negocios
	 *
	 * @params int id de la imagen a borrar
	 * @return flag Verdadero exito
	 *				Falso no exito
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function delete($id)
	{
		if($this->db->delete('imagennegocios', array('imagenId'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

    /**
     * Se obtienen todos los datos del negocio o la empresa de la
     * cual estan viendo sus albums de fotos, esto solamentes para
     * mostrarlo en el mapa de sitio
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_bussines_data($id)
    {
        $this->db->where('negocioUsuarioId', $id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Se obtiene la la ubicacion del negocio o la empresa
     * asi como el giro al que pertenece. Esto para mostrarlo
     * en el mapa de sitio que este relacionado con las empresas
     * o los negocios
     *
     * @params int id del pais, ciudad o giro
     * @params string nombre de las tablas
     *
     * @return mixed datos de pais, ciudad o giro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Se obtienen los datos en general del album por medio del
     * id del mismo
     *
     * @params int id del album
     * @return mixed datos del album
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_album($id)
    {
        $this->db->where('albumId',$id);
        $query = $this->db->get('albumsnegocios');
        return $query->row();
    }

    /**
     * Get default user albums Else return 0
     *
     * @param integer $id ID of the user whose albums are to be checked
     *
     * @return integer album ID or 0 depending on findings
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_default_album($id)
    {
        $this->db->select('*')
            ->from('albumsnegocios')
            ->where('albumsnegocios.albumNegocioId = '.$id)
            ->where('albumsnegocios.albumNegocioDefault = 1');
        $Q = $this->db->get();
        if($Q->num_rows() == 0)
        {
            $this->db->insert('albumsnegocios', 
                array(
                    'albumNegocioId'=>$id,
                    'albumNegocioDefault'=>1,
                    'albumNombre'=>'Mis fotos de perfil',
                    'albumFechaCreacion'=>time(),
                    'albumLugar'=>'Mi Perfil',
                    'albumDescripcion'=>'Mis Avatars',
                    'albumFechaModificacion'=>time(),
                ));
            $return_data = $this->db->insert_id(); 
        }else{
            $album = $Q->row();
            $return_data = $album->albumId;
        }
        return $return_data;
    }

    /**
     * Metodo que se encarga de actualizar todos los registros de las imagenes
     * que se tienen actualmente en la parte de las geo etiquetas del negocio
     * para que estas se esten actualizando completo y no se vean de diferentes 
     * imagenes en las etiquetas
     *
     * @params int id del negocio
     * @params string ruta de la imagen
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_img_geotag($id, $str)
    {
        $this->db->update('scribbles_comments', array('scribbleImagenUsuario'=>$str), array('scribbleUsuarioId'=>$id));
    }

     /**
     **/
    public function count_data_thumbnail($id)
    {
        $this->db->where('thumbUsuarioId', $id);
        $total = $this->db->count_all_results('imagenes_thumb');
        return $total;
    }

    /**
     **/
    public function save_thumb($data)
    {
        $this->db->insert('imagenes_thumb', $data);
    }

    /**
     **/
    public function update_thumb($str, $id)
    {
        $this->db->update('imagenes_thumb', array('usuarioThumbName'=>$str), array('thumbUsuarioId'=>$id));
    }

    /**
     **/
    public function get_all_data_user()
    {
        $value = $this->db->query('select * from usuarios left join negocios on negocioUsuarioId = id where statusEU = 1');
        return $value->result();
    }
}
