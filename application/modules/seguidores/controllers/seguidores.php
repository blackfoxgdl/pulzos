<?php
/**
 * Controlador de seguidores en el cual
 * manejara la vista de las personas que
 * siguen a los negocios dependiendo su id
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 25 February, 2011
 * @package Seguidores
 **/

class Seguidores extends MX_Controller
{
	
	/**
	 * Constructor de seguidores
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('seguidor', '', true);
		$this->load->library('session');
		$this->load->helper(array('url', 'html', 'form', 'avatar', 'cyp', 'status', 'date', 'apipulzos', 'counters'));
	}
	
   /**
    * Funcion index para redireccionar a la
	* vista <ninguna - aun por definir>
	*
	* @return void
	* @author blackfoxgdl <ruben.alonso21@gmail.com>
	**/
   public function index()
   {
   }
   
   /**
    * Metodo que hace la funcionalidad de
	* que los usuarios puedan pulzar seguir a
	* los negocios que desean
	*
	* @params int id de usuario
	* @return void
	* @author blackfoxgdl <ruben.alonso21@gmail.com>
	**/
    public function seguir($id)
	{
		$this->id = $id;
		//obtener el id del negocio por medio del id del usuario
		$id_negocio = $this->seguidor->get_by_id($this->id);
		//obtener variable de sesion
		$id_usuario = $this->session->userdata('id');
		//crear arreglo para guardar seguidores
		$post = array(
			'seguidorUsuarioId'=>$id_usuario,
			'seguidorNegocioId'=>$id,
			'seguidorFechaCreacion'=>time(),
        );

        $post1 = array('amigoUsuarioId'=>$this->session->userdata('id'),
                       'amigoAmigoId'=>$id_negocio->negocioUsuarioId,
                       'amigoAceptado'=>'3',
                       'amigoFechaCreacion'=>time(),
                       'amigoTipo'=>'1');

        $post2 = array('amigoUsuarioId'=>$id_negocio->negocioUsuarioId,
                       'amigoAmigoId'=>$this->session->userdata('id'),
                       'amigoAceptado'=>'3',
                       'AmigoFechaCreacion'=>time(),
                       'amigoTipo'=>'1'
                       );

        //se guarda en amistad
        $this->seguidor->save_friend($post1);
        $this->seguidor->save_friend($post2);
		//se llama al modelo para guardar al seguidor
        $this->seguidor->save($post);

        //parte que se usa para guardar las cosas de cuando sigues a una empresa
        $posteo_seguidor = array('planUsuarioId'=>$this->session->userdata('id'),
                                 'planAmigoUsuarioId'=>$id_negocio->negocioUsuarioId,
                                 'planTipo'=>'7',
                                 'planDescripcion'=>'ahora esta siguiendo a',
                                 'planFechaCreacion'=>time());
        $this->seguidor->save_follower_message($posteo_seguidor);
	}
	
	/**
	 * Metodo que mostrara la vista de los seguidores que
	 * tiene el restaurante, todos estos jalados desde la
 	 * tabla de usuarios y mostrar la foto que tienen
	 * asignada
	 * 
	 * @params int id de la empresa
	 * @return array datos de los seguidores
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function ver($id)
    {
        $datos['negocio'] = $this->seguidor->get_pulzo_information($id);
        $this->load->view('seguidores/ver', $datos);
    }

    /**
     * Metodo que se usa para poder observar a los seguidores de
     * los seguidores que el negocio tiene y asi el mismo
     * saber cuales son los usuarios que los siguen
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_seguidores($id)
    {
        $seguidores = $this->seguidor->get_by_id($id);
        $datos['negocio'] = $seguidores;
        $datos['seguidores'] = $this->seguidor->get_followers($seguidores->negocioId);
        $this->load->view('seguidores/ver_seguidores', $datos);
    }
	
	/**
	 * Borrar el follower del usuario,
	 * se borra de la base de datos de
	 * la tabla de seguidores y vuelve
	 * a cargar el perfil del negocio 
	 * que se estaba siguiendo
	 *
     * @params int id de empresa o negocio
     * @params int id del usuario
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
    public function borrar($id, $id_negocio)
    {
        $compania = $this->seguidor->check_data_company($id_negocio);
        $value = $this->seguidor->delete_follower($id, $id_negocio);
        $this->seguidor->delete_friends($id, $compania->negocioUsuarioId);
        $this->seguidor->delete_friends($compania->negocioUsuarioId, $id);
    }

    /**
     * Metodo para mostrar al usuario cuales son los negocios o
     * empresas que esta siguiendo para poder ver y aprovechar las 
     * ofertas que haga el negocio.
     *
     * @params int id del usuario que sigue la empresa
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function siguiendo($id)
    {
        $datos['id_usuario'] = $id;
        $datos['seguidor'] = $this->seguidor->get_companies($id);
        $this->load->view('seguidores/seguidor', $datos);
    }

    /**
     * Metodo que se encarga de mostrar el pulzo mas reciente de todas las 
     * empresas que estas siguiendo, esto se realiza por id de la empresa y se 
     * acomodan asi los pulzos, aunque deben de llevar un orden por fecha
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function empresas($id)
    {
        $datos['mis_empresas'] = $this->seguidor->get_companies($id);
        $this->load->view('seguidores/pulzos_empresa', $datos);
    }

    /**
     * Metodo que se encarga de guardar los comentarios que el usuario
     * haga una vez que la empresa haya posteado su pulzo, esto es para
     * los usuarios en su opcion del menu de empresas las cuales se muestra
     * el ultimo pulzo que haya hecho
     *
     * @params int id del negocio
     * @params int id del usuario
     * @params int id del pulzo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_comentario_pulzo($idN, $idU, $idP)
    {
        $post = $this->input->post('comentar_pulzo');
        $datosGuardar = array('comentarioTexto'=>$post,
                              'comentarioNegocioId'=>$idN,
                              'comentarioUsuarioId'=>$idU,
                              'comentarioPulzoId'=>$idP,
                              'comentarioFechaCreacion'=>time());
        $this->seguidor->save_comment_pulzo($datosGuardar);
    }

    /**
     * Metodo que se usa para poder cargar todos los negocios que
     * se tengan en una ciudad especifica con la cual los usuarios
     * podran obtener los datos de los negocios que estan registrados
     * en pulzos y de los cuales pueden obtener bonificaciones
     *
     * @params int id de la ciudad
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com
     **/
    public function mostrar_negocios($id_ciudad=null)
    {
        if($id_ciudad != '')
        {
            $datos['negocios'] = $this->seguidor->get_all_companies_by_city($id_ciudad);
            $datos['total_negocios'] = $this->seguidor->count_total_company($id_ciudad);
            $datos['message'] = 'No hay negocios asignados a la ciudad de eleccion.';
        }
        else
        {
            $datos['negocios'] = '';
            $datos['message'] = 'No hay ciudad asigada a tu cuenta';
        }
            $this->load->view('seguidores/negocios_x_ciudad', $datos);
    }
}
