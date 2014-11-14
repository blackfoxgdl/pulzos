<?php
/**
 * Controlador de los albums del negocio.
 * 
 * Cada negocio podra dar de alta los albums
 * que desee para poder subir fotos y mostrar
 * las imagenes en su perfil.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 03 March, 2011
 * @package albumNegocios
 **/
 
class albumNegocio extends CI_Model
{	
	/**
	 * Constructo del modelo de los
	 * albums del Negocio
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Guarda los datos del nuevo album
	 * de fotos que creara la empresa
	 *
	 * @params array datos a guardar del nuevo album
	 * @return flag Verdadero en exito o Falso en fallo
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function save($post)
	{
		if($this->db->insert('albumsnegocios', $post))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * Obtiene todos los albums del
	 * negocio relacionados con el id
	 * del mismo y hace un volcado de 
	 * estos para mostrar al usuario.
	 *
	 * @params string condicion para ver si hay albums o no
	 * @return mixed datos de lsoa albums del negocio
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get($condition=null)
    {
        $this->db->select('albumsnegocios.*, negocios.*')
                ->from('albumsnegocios')
                ->join('negocios', 'albumsnegocios.albumNegocioId = negocios.negocioUsuarioId', 'left');

        if($condition){
            $this->db->where($condition);   
        }else{
            $this->db->where('1=1');
        }
        $Q = $this->db->get();
        return $Q->result();
    }
	
	/**
	 * Metodo para realizar la actualizacion
	 * de los datos del album de fotos de los
	 * negocios
	 *
	 * @params int id del album
	 * @params mixed datos a actualizar del album
	 * @return flag Verdadero exito falso Fallido
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function edit($id, $data)
	{
		if($this->db->update('albumsnegocios', $data, array('albumId'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * Borra un album de negocios de
	 * la base de datos.
	 *
	 * @params int id del album a borrar
	 * @return flag Verdadero o Falso
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function delete($id)
	{
		if($this->db->delete('albumsnegocios', array('albumId'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * Se obtiene el id del negocio para
	 * ver si existen albums con ese id
	 * de negocio, se hace la consulta a
	 * la tabla de negocios
	 *
     * @params int id de negocio
     * @params string nombre de la tabla a obtener los datos
     * @params string campo para la condicion
     *
	 * @return mixed datos del negocio
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get_data($id,$tabla,$campo)
	{
		$this->db->where($campo,$id);
		$query = $this->db->get($tabla);
		return $query->row();
    }

    /**
     * Se obtienen los datos del negocio
     * por medio del id del mismo, con el
     * cual se podran crear los mapas del sitio
     * en este modulo
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
     * Se obtienen los datos de la ubicacion y el
     * giro de la empresa para conocer la ubicacion de
     * las mismas en la ciudad
     *
     * @params int id del giro, pais, ciudad
     * @params string nombre de la tabla
     *
     * @return mixed datos de la ciudad, pais, giro
     * @author blñackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Se obtiene el total de imagenes que hay en el
     * album de la empresa para poder visualizar una en el album,
     * asi saber de que trata cada uno de los mismo. En esta parte
     * se hara aleatoria cada que entre el usuario se pondra una
     * imagen diferente como portada hasta nuevo aviso
     *
     * @params int id del album del negocio
     * @return int total de registros en el album
     * @author blackfoxgdl <ruben.alosno21@gmail.com>
     **/
    public function get_count_pictures($id)
    {
        $this->db->where('imagenNegocioAlbumId', $id);
        $query = $this->db->count_all_results('imagennegocios');
        return $query;
    }

    /**
     * Con el numero dado se obtiene un numero de imagen
     * con la cual se obtendra la ruta de la misma y se colocara
     * como si fuera la foto que tendra el album al momento
     * de que los usuario ingresen a este
     *
     * @params int numero aleatorio
     * @params int id del album
     * 
     * @return mixed dato de la url donde se ubica la imagen
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_image_frontend($id) 
    {
        $this->db->where('imagenNegocioAlbumId',$id);
        $query = $this->db->get('imagennegocios');
        return $query->row();
    }
	/*
	  *contar las filas de los albums(cuantas fotos contiene el album)
	  *params int id del album
	  */
	  function contar_filas($id){
			  $query = $this->db->query('SELECT * FROM imagennegocios WHERE imagenNegocioAlbumId ='.$id);
			  $filas= $query->num_rows();
			  return $filas;
	  }
	  /*
	*Se utiliza para cortar el texto para que no salga todo si el texto es muy grande xD
	*/
	function cortar_texto($value,$lenght){
            $limited=$value;
         if (strlen($value) >= $lenght ){
                 $limited = substr($value,0,$lenght);
                 $limited .= "...";
         }
         return $limited;
  }
}
