<?php  if(! defined('BASEPATH')) exit('No direct Script Access Allowed.');
/** 
 * Controlador para el modulo de albumNegocios
 * el cual puede manipular todos los metodos
 * que se refieren a este modulo.
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package albumNegocios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
 
class albumNegocios extends MX_Controller 
{
	/**
	 * @ignore
	 * Estructura de la tabla albumNegocios:
	 * albumId: int(11) not null, PK, auto_increment
	 * albumNegocioId: int(11) not null
	 * albumNombre: varchar(140) not null
	 * albumFechaCreacion: int(11) not null
	 * albumLugar: varchar(140) not null
	 * albumDescripcion: text not null
	 * albumFechaModificacion: int(11)
	 **/
	 
	/**
	 * Constructor de la clase de
	 * albumNegocios para poder
	 * inicializar las librerias,
	 * metodos y modelos
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('albumNegocio', '', TRUE);
		$this->load->helper(array('html','url','form', 'avatar', 'apipulzos'));
        $this->load->library(array('session'));
	}
	
	/**
	 * Metodo que carga los
	 * albums del negocio para poder
	 * visualizarlos
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function index()
	{
	}
	
	/**
	 * Vizualiza los albums de los negocios
	 * creados hasta el momento, en caso de 
	 * no tenga ningun album creado, se
	 * redirecciona a la forma para crear
	 * uno nuevo
	 *
	 * @params int id del negocio para ver los albums
	 * @return mixed arreglo con datos del usuario
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function ver($id)
    {
        if($id)
        {
            $albums = $this->albumNegocio->get('albumNegocioId = ' . $id);
        }
        else
        {
            $albums = $this->albumNegocio->get('albumNegocioId = ' . $idN->negocioId);
        }
        if(empty($albums[0]))
        {
            redirect('albumnegocios/crear/'.$this->session->userdata('id'));
        }
        $this->load->view('albumnegocios/ver_inline', array('albums'=>$albums, 'negocios'=>$id));
	}
	
	/**
	 * Metodo que se encarga de registrar
	 * un nuevo album de fotos para los
	 * negocios y asi poderle cargar imagenes.
	 * SE usuara el id del usuario con albumNegocioId
     *
     * @params int id del negocio
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
    public function crear($id)
    {
        $datos['user_id'] = $this->albumNegocio->get_data($this->session->userdata('id'), 'negocios', 'negocioUsuarioId');
        $post = $this->input->post('Albums');
        if($post)
        {
			$post['albumNegocioId'] = $id;
			$post['albumFechaCreacion'] = time();
			$post['albumFechaModificacion'] = time();
            $resultado = $this->albumNegocio->save($post);
        }
        else
        {
            $this->load->view('albumnegocios/crear', $datos);
        }
	}
	
	/**
	 * Metodo para actualizar los datos
	 * del negocio como es la descripcion,
	 * nombre y lugar todo relacionado al
	 * album.
	 * 
	 * @params int id del album
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function editar($id)
    {
        $post = $this->input->post("EditarA");
        if($post)
        {
            $post['albumFechaModificacion'] = time();
            $result = $this->albumNegocio->edit($id, $post);
        }
        else
        {
            $datos['edicionAlbum'] = $this->albumNegocio->get_data($id, 'albumsnegocios', 'albumId');
            $this->load->view('albumnegocios/editar', $datos);
        }
	}
	
	/**
	 * Borra un album del perfil
	 * del usuario o empresa. Ya no se puede
     * recuperar el album. Los datos son pasados
     * desde el javascript que se tenga ligado a
     * esta funcion
	 *
	 * @params int id del album
	 * @returns void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function borrar($id)
    {
        $return = $this->albumNegocio->delete($id);
    }
}
