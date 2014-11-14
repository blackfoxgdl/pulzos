<?php 
/**
 * Access to albums table.
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 01 March, 2011
 * @package Albums
 **/

class Album extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'albums';
    }

    /**
     * gets albums according to several conditions
     *
     * @param mixed condition to meet
     * @return mixed Albums related to a user
     * @author axoloteDeAccion
     **/
    public function get($condition=null)
    {
        $this->db->select('albums.*, usuarios.*')
                ->from('albums')
                ->join('usuarios', 'albums.albumUsuarioId = usuarios.id', 'left');

        if($condition){
            $this->db->where($condition);   
        }else{
            $this->db->where('1=1');
        }
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * Guardar la información en DB
     *
     * TODO: Agregar validación de éxito. Siempre retorna true
     *
     * Acepta dos parametros, la información a guardar y una condición. En 
     * caso de que la condición no se pase como parametro funciona como un 
     * insert. Si si se pasa funciona como un update.
     *
     * @param mixed $data Información que se tiene que guardar en la DB
     * @param string $condition En caso de update
     *
     * @return bool Flag de éxito en la operación
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save($data, $condition=null)
    {
        //verificar si condition fué pasado
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
     * Borrar el registro de la DB
     * TODO: Validación. Siempre retorna true
     *
     * @param integer $id id del registro a eliminar
     *
     * @return bool true
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->delete($this->table_name, array('albumId'=>$id));
        return true;
    }

    /**
     * Se obtienen todos los datos del usuario
     * para poder realizar y mostrar el mapa de
     * sitio en donde se señalara en que seccion
     * se encuentra el usuario
     *
     * @params int id del usuario
     * @return mixed datos del usuario logueado
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

    /**
     * Se obtienen los datos de la ubicacion, digase
     * la ciudad y el pais en la cual el usuario esta
     * localizado o es su residencia actual
     *
     * @params int id de la ciudad o pais del usuario
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
     * Se usa para obtener la primer imagen del album y asi
     * poder mostrarla cuando el usuario se vaya a los albums
     * de un amigo, en el cual se podran mostar dichas fotos
     *
     * @params int id del album
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_image_frontend($id)
    {
        $this->db->where('imagenAlbumId', $id);
        $query = $this->db->get('imagenes');
        return $query->row();
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
  /*
  *contar las filas de los albums(cuantas fotos contiene el album)
  *params int id del album
  */
  function contar_filas($id){
          $query = $this->db->query('SELECT * FROM imagenes WHERE imagenAlbumId ='.$id);
		  $filas= $query->num_rows();
       	  return $filas;
  }
  /*
  *cuenta las imagenes de los anexos
  *params int id del usuario
  */
  function contar_filas_anexo($id){

		  $query = $this->db->query('SELECT foto
			FROM anexos
			INNER JOIN planesusuarios ON planesusuarios.planId = anexos.anexosPlanId
			WHERE planesusuarios.planUsuarioId ='.$id);
		  $anexo= $query->num_rows();
       	  return $anexo;
  }
  
}
