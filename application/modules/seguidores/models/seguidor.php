<?php
/**
 * Modelo para manipular los datos de los
 * usuarios y empresas, asi sabremos que usuario
 * sigue a cual empresa y podra visualizarlo desde
 * el menu de usuarios
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 05 April, 2011
 * @package Seguidores
 **/
 
class Seguidor extends CI_Model
{
	
	/**
	 * Constructor del modelo
	 * del modulod e seguidores de
	 * empresas
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function __construct()
	{
		parent::__construct();
	
    }
	
	/**
	 * Metodo que se encarga de guardar a los
	 * seguidores que tendran los negocios
	 * en la tabla seguidores
	 *
	 * @params array con tres valores id de usuario,
	 * id del negocio y fecha de creacion
	 * @return flag verdadero o falso
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function save($post)
	{
		if($this->db->insert('seguidores',$post))
		{
			return true;
		}
		else
		{
			return false;
		}
    }

    /**
     * Metodo que se encarga de guardar los datos del post de la
     * solicitud de seguir empresa, esto para poder mostrarlos tambien
     * como amigos de los usuarios, asi se maneja una bandera y se sabe quienes son tus amigos y quienes no
     *
     * @params mixed datos del negocios
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_friend($post)
    {
        if($this->db->insert('amigos',$post))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	/**
	 * Obtiene todos los datos del negocio por medio
	 * del id del negocio
	 *
	 * @params int id del negocio
	 * @return flag verdadero o falso
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get_by_id($id)
	{
		$this->db->where('negocioId', $id);
		$query = $this->db->get('negocios');
		return $query->row();
	}
	
	/**
	 * Se obtienen todos los usuarios que
	 * esten siguiendo a la empresa dependiendo
	 * el id de la consulta de la empersa
	 * 
	 * @params int id de empresa
	 * @return object datos de tabla seguidores
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get_followers($id)
	{
		$this->db->select('seguidores.*, usuarios.*')
				 ->from('seguidores')
				 ->join('usuarios', 'usuarios.id = seguidores.seguidorUsuarioId','right')
				 ->where('seguidorNegocioId = ' . $id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	 * Metodo para checar los datos de la
	 * compañia o negocio, esto para mostrar
	 * los datos a los usuarios que esten
	 * observando a los seguidores
	 *
	 * @params int id de la empresa
	 * @return object datos del negocio seleccionado
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function check_data_company($id)
	{
		$this->db->where('negocioId',$id);
		$query = $this->db->get('negocios');
		return $query->row();
	}
	
	/**
	 * Se obtienen los valores de las tablas de
	 * pais, ciudad y giro para poder mostrarlo
	 * en la vista de los seguidores que tiene la
	 * empresa
	 *
	 * @params int id del giro, ciudad, pais de empresa
	 * @params string tabla a la cual se hara el query
	 * @return object con datos del renglon que haga match
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function get_location_company($id, $tabla)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($tabla);
        return $query->row();
    }
	
	/**
	 * Borra al usuario que ya no quiera seguir
	 * una empresa o un negocio, a esto se le pasa
	 * el id de empresa y el id del usuario que esta
 	 * quiere borrar el follower
	 *
	 * @params int id de usuario
	 * @params int id de negocio
	 * @return flag verdadero en caso de exito o
	 *	falso en caso de falla en la ejecucion
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function delete_follower($id, $idN)
	{
		if($this->db->delete('seguidores',array('seguidorUsuarioId'=>$id,
												'seguidorNegocioId'=>$idN)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

    /**
     * Metodo que se encarga de borrar las relaciones que se tengan en la 
     * tabla de amigos con los cuales se debe de borrar la relacion que se
     * tenga para que ya no haya ninguna relacion de la misma
     *
     * @params int id del usuario
     * @params int id del negocio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_friends($idU, $idN)
    {
        $this->db->where('amigoUsuarioId', $idU);
        $this->db->where('amigoAmigoId', $idN);
        $this->db->delete('amigos');
    }

    /**
     * Se obtendran todos los datos de las empresas
     * que esta siguiendo el usuario y asi poder
     * accesar directamente a su perfil.
     *
     * @params int id del usuario
     * @return mixed valores de la empresa que esta siguiendo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_companies($id)
    {
        $query = $this->db->query('SELECT * FROM negocios LEFT JOIN seguidores ON negocios.negocioId = seguidores.seguidorNegocioId WHERE seguidorUsuarioId='.$id);
        return $query->result();
    }

    /**
     * Se obtienen los datos del usuario
     * que esta logueado para mostrar el
     * mapa de sitio correspondiente
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

    /**
     * Se obtiene la ubicacion del usuario como lo
     * es el pais y la ciudad en la cual actualmente
     * reside.
     *
     * @params int id del pais o ciudad
     * @params string nombre del tabla
     *
     * @return mixed datos del pais o ciudad
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Metodo que se encarga de guardar un nuevo comentario del pulzo
     * al que se este refiriendose el usuario, esto se guardara en la
     * tabla de comentarios y es para la parte de empresas, donde aparece
     * el pulzo mas reciente de la misma
     *
     * @params array datos a guardar en la tabla
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_comment_pulzo($data)
    {
        $this->db->insert('comentarios', $data);
    }

    /**
     * Metodo que se usa para obtener los datos de los negocios junto con sus 
     * pulzos para poder visualizarlos de manera mas especifica, esto es para 
     * poder ver todos sus comentarios y asi tambien poder comentar en el mismo 
     * pulzo
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzo_information($id)
    {
        $query = $this->db->query('select * from negocios left join pulzos on pulzoUsuarioId = negocioId where pulzoId = ' . $id);
        return $query->row();
    }

    /**
     * Metodo que se usa para poder realizar la insercion del mensaje que
     * aparecera en la parte de los usuarios en cuanto al posteo
     * de que ahora estas siguiendo a tal empresa, asi informandolo a tus
     * amigos y que ellos puedan conocer a la empresa tambien
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_follower_message($data)
    {
        $this->db->insert('planesusuarios', $data);
    }

    /**
     * Metodo que se usa para poder obtener los datos de las empresas
     * que se encuentran dependiendo el estado donde se encuentre el 
     * usuario, esto para poder obtener todos y que el usuario pueda
     * conocer donde estan habilitados los puntos de pulzos
     *
     * @params int id de la ciudad
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_companies_by_city($id)
    {
        $datos = $this->db->query('select * from negocios left join usuarios on negocioUsuarioId = id where codigoActivacion != "0" and negocioCiudad = ' . $id);
        return $datos->result();
    }

    /**
     * Metodo que se usa para obtener el total de negocios que se tienen
     * actualmente registrados en la ciudad, esto para que el usuario
     * pueda visualizar los negocios que disponen de pulzos para otorgar
     * los pulzos
     *
     * @params int id de la ciudad
     * @return int total de negocios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_total_company($id)
    {
        $this->db->select('*');
        $this->db->from('negocios');
        $this->db->join('usuarios', 'negocioUsuarioId = id', 'left');
        $this->db->where('negocioCiudad', $id);
        $this->db->where('codigoActivacion != 0');
        $total = $this->db->count_all_results();
        return $total;
    }
}
