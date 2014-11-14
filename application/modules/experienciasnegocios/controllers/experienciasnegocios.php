<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed.');
/**
 * Controlador que se usara para manipular todas las 
 * experiencias de vida que podra crear el negocio y 
 * asi el usuario poder tomarlo como paquete, el cual sera
 * una promocion ya armada solo para reservar, esto lo
 * hara el interesado
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 9, 2011
 * @package experienciasnegocios
 **/
class experienciasNegocios extends MX_Controller
{

    /**
     * Constructor, en cual se declaran las
     * librerias asi como los helpers y el
     * modelo que se usara en este controlador
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('experienciaNegocio', '', TRUE);
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'date', 'status'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
    }
    
    /**
     * Metodo inicial el cual se usa para cargar la vista del formulario
     * para crear los datos de experiencias y asi poderlas poner a disposicion
     * de los usuarios que a la mejor esten interesados en el mismo
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $datos['id'] = $id;
        $datos['dias'] = days();
        $datos['meses'] = month();
        
        $datos['inboxTN'] = $this->experienciaNegocio->get_experiencia($id, '1');
        $datos['negocios'] = $this->experienciaNegocio->get_data($id);
        $datos['negocio']=$this->experienciaNegocio->get_data($id);
		$this->load->view('experienciasnegocios/index', $datos);
    }

    /**
     * Metodo que se usara para guardar todas las experiencias de vida
     * que los negocios quieran dar de alta para que puedan ser aprovechadas
     * por los usuarios, esto se guarda ya sea con imagen o sin imagen en la
     * experiencia de vida
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar($id)
    {
        $post = $this->input->post('Pulzos');
        $imagenData = $_FILES['imagenE']['name'];
        if($imagenData != ""){
            $value = time();
            //se crea la ruta en la cual se guardara la imagen
            $file_path = "./statics/img_eventos/".$id.'/'.$value.'/';
            //se crea el directorio
            @mkdir($file_path, 0777, true);
            //se preparan las opciones que se tienen que pasar a la libreria
            $upload_settings = array(
                    'upload_path'=>$file_path,
                    'allowed_types'=>'gif|png|jpg|jpeg',
                    'max_size'=>'10000',
                    'max_width'=>'3000',
                    'max_height'=>'3000',
                    'remove_space'=>true,
                    'encrypt_name'=>true
                );

            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('imagenE'))
            {
                //se obtienen datos de la imagen
                $file_data = $this->upload->data();

                //se preparan los datos a insertar
                $ano = date("Y");
                $valor = strtotime($ano."-".$post['mes']."-".$post['dia']);
                $valor2 = strtotime($ano."-".$post['mesT']."-".$post['diaT']);
                unset($post['mes']);
                unset($post['dia']);
                unset($post['mesT']);
                unset($post['diaT']);
                $post['pulzoUsuarioId'] = $id;
                $post['pulzoFechaInicio'] = $valor;
                $post['pulzoFechaFin'] = $valor2;
                $post['pulzoFechaCreacion'] = $value;
                $post['pulzoTipo'] = '2';
                $post['pulzoImagenRuta'] = 'statics/img_eventos/'.$id.'/'.$value.'/'.$file_data['file_name'];  
                $post1 = $this->input->post("Experiencia1");
                $post['pulzoExperienciaId'] = $post1['tipoExperiencia1'] . ',' . $post1['tipoExperiencia2'];                
                if($post1['tipoExperiencia2'])
                {
                    $val = $this->experienciaNegocio->save($post);
                    $post1['nombre'] = $post1['tipoExperiencia1'];
                    $val1 = $this->experienciaNegocio->save_tag($post1['nombre'], $val);
                    unset($post1['nombre']);
                    unset($post['tipoExperiencia1']);
                    $post1['nombre'] = $post1['tipoExperiencia2'];
                    $val2 = $this->experienciaNegocio->save_tag($post1['nombre']); 
                    unset($post1['nombre']);
                    unset($post['tipoExperiencia2']);

                    $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                                 'planDescripcion'=>$post['pulzoTitulo'],
                                                 'planFechaCreacion'=>time(),
                                                 'planEmpresaPosteo'=>$id,
                                                 'planEmpresaPulzoId'=>$val);
                    $this->experienciaNegocio->save_plains_data($datosMostrarUsuario);
                }
                else
                {
                    $post['pulzoExperienciaId'] = $post1['tipoExperiencia1'];
                    $val = $this->experienciaNegocio->save($post);  
                    $post1['nombre'] = $post1['tipoExperiencia1'];
                    $val1 = $this->experienciaNegocio->save_tag($post1['nombre'], $val);
                    unset($post1['nombre']);
                    unset($post['tipoExperiencia1']);
                    unset($post['tipoExperiencia2']);

                    $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                                 'planDescripcion'=>$post['pulzoTitulo'],
                                                 'planFechaCreacion'=>time(),
                                                 'planEmpresaPosteo'=>$id,
                                                 'planEmpresaPulzoId'=>$val);
                    $this->experienciaNegocio->save_plains_data($datosMostrarUsuario);
                }
            }
        }
        else{
                $ano = date("Y");
                $valor = strtotime($ano."-".$post['mes']."-".$post['dia']);
                $valor2 = strtotime($ano."-".$post['mesT']."-".$post['diaT']);
                unset($post['mes']);
                unset($post['dia']);
                unset($post['mesT']);
                unset($post['diaT']);
                $post['pulzoUsuarioId'] = $id;
                $post['pulzoFechaInicio'] = $valor;
                $post['pulzoFechaFin'] = $valor2;
                $post['pulzoFechaCreacion'] = time();
                $post['pulzoTipo'] = '2';
                $post['pulzoImagenRuta'] = '0';
                $post1 = $this->input->post("Experiencia1");
                $post['pulzoExperienciaId'] = $post1['tipoExperiencia1'] . ',' . $post1['tipoExperiencia2'];                
                if($post1['tipoExperiencia2'])
                {
                    $val = $this->experienciaNegocio->save($post);
                    $post1['nombre'] = $post1['tipoExperiencia1'];
                    $val1 = $this->experienciaNegocio->save_tag($post1['nombre'],$val);
                    unset($post1['nombre']);
                    unset($post['tipoExperiencia1']);
                    $post1['nombre'] = $post1['tipoExperiencia2'];
                    $val2 = $this->experienciaNegocio->save_tag($post1['nombre'],$val); 
                    unset($post1['nombre']);
                    unset($post['tipoExperiencia2']);
                    $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                                 'planDescripcion'=>$post['pulzoTitulo'],
                                                 'planFechaCreacion'=>time(),
                                                 'planEmpresaPosteo'=>$id,
                                                 'planEmpresaPulzoId'=>$val);
                    $this->experienciaNegocio->save_plains_data($datosMostrarUsuario); 
                }
                else
                {
                    $post['pulzoExperienciaId'] = $post1['tipoExperiencia1'];
                    $val = $this->experienciaNegocio->save($post);  
                    $post1['nombre'] = $post1['tipoExperiencia1'];
                    $val1 = $this->experienciaNegocio->save_tag($post1['nombre'], $val);
                    unset($post1['nombre']);
                    unset($post['tipoExperiencia1']);
                    unset($post['tipoExperiencia2']);
                    
                    $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                                 'planDescripcion'=>$post['pulzoTitulo'],
                                                 'planFechaCreacion'=>time(),
                                                 'planEmpresaPosteo'=>$id,
                                                 'planEmpresaPulzoId'=>$val);
                    $this->experienciaNegocio->save_plains_data($datosMostrarUsuario); 
                }
        }
    }

    /**
     * Metodo que se encargara de mostrar los datos
     * con los cuales se podra ver todas las expeiencias
     * de vida que el usuario a estado mostrando
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id)
    {
        $datos['id'] = $id;
        $datos['experiencias'] = $this->experienciaNegocio->get($id, '2');
        $this->load->view('experienciasnegocios/ver', $datos);
    }

    /**
     * Metodo que se usa para poder obtener las siguientes 10
     * experiencias de vida, esto pasa una vez que se haya presionado el
     * boton o link para que le usuario las veas y asi hacer mas dinamica la
     * interactividad de la plataforma y mas rapida y no alentarla al cargar
     * todas las experiencias de vida de chingadazo
     *
     * @params int id del negocio
     * @params int numero de la ultima experiencia publicada
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_siguientes($id, $num)
    {
        $datos['experiencias'] = $this->experienciaNegocio->get_next_ten_experience($id, $num);
        $this->load->view('experienciasnegocios/siguientes_diez', $datos);
    }

    /**
     * Metodo que se usa para poder recargar los comentarios que
     * se esten haciendo en la experiencia de vida del negocio,
     * esto se usa para poder solamente refrescar los datos de los usuarios
     * en cuanto a comentarios y no refrescar toda la pagina como se tenia con
     * anterioridad
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_comment($id)
    {
        $datos['experiencia'] = $this->experienciaNegocio->get_experiencia($id, '2');
        $this->load->view('experienciasnegocios/recarga_comentarios', $datos);
    }

    /**
     * Metodo que se usa para obtener las siguientes 10
     * experiencias pero a diferencia del anterios se regresa
     * un archivo json para poder obtener cual es el ultimo
     * registro que se esta visualizando esto una vez que se ha
     * presionado el link de ver mas
     *
     * @params int id del negocio
     * @params int numero de la ultima experiencia publicada
     * 
     * @return json_encode con valor
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function see_next_ten_data($id, $num)
    {
        $registro_ultimo = $this->experienciaNegocio->get_next_ten_experience($id, $num);
        $ultimo_registro = obtain_array_company($registro_ultimo);
        echo json_encode($ultimo_registro);
    }

    /**
     * Metodo que se encarga de borrar las experiencias de vida
     * que no se quieren tener ya en el perfil del negocio,
     * esto porque ya pasaron o ya no esta esa promocion
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $val = $this->experienciaNegocio->delete($id);
    }

    /**
     * Metodo que se encarga de mostrar
     * las experiencias de forma individual, en la cual
     * se mostraran de forma detallada cada una
     * de las mismas
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_experiencia($id)
    {
        $datos['id'] = $id;
        $datos['experiencia'] = $this->experienciaNegocio->get_experiencia($id, '2');
        $this->load->view('experienciasnegocios/experiencia', $datos);
    }

    /**
     * Metodo que se usa para mostrar las experiencias de vida que se
     * busquen por medio de las etiquetas o la nube de tags que se hara
     * en el perfil de usuarios
     **/
    public function ver_etiquetas($str)
    {
        $datos['resultados'] = $this->experienciaNegocio->get_etiquetas($str);
        $this->load->view('experienciasnegocios/experiencia_etiqueta', $datos);
    }

    /**
     * Metodo que se usa para mostrar todas las etiquetas de las
     * experiencias en el centro y asi definir cual es el
     * que mas te llama la atencion para mostrar las ofertas o los
     * pulzos relacionados con esta palabra
     **/
    public function ver_todas_etiquetas()
    {
        $datos['tags'] = $this->experienciaNegocio->get_all_tags();
        $this->load->view('experienciasnegocios/ver_todas', $datos);
    }

    /**
     * Metodo que se usa para comentar la experiencia de vida que haya
     * publicado el negocio, este proceso se hace para poder guardar el
     * registro en la base de datos
     *
     * @params int id del pulzo del usuario
     * @params int id del usuario
     * @params int id del pulzos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function comentarios_guardar($idN, $idU, $idP)
    {
        $post = $this->input->post('comentar_muro');
        $valores = array('comentarioNegocioId'=>$idN,
                         'comentarioUsuarioId'=>$idU,
                         'comentarioTexto'=>$post,
                         'comentarioPulzoId'=>$idP,
                         'comentarioFechaCreacion'=>time());
        $this->experienciaNegocio->save_comment($valores);
    }

    /**
     * Metodo que se usa para poder guardar los comentarios de un pulzo, reto 
     * o de una experiencia de vida para que el usuario o la empresa puedan 
     * comenzar a debatir sobre las promociones que este mismo esta creado para 
     * que los usuarios las aprovechen
     *
     * @params int id del pulzo, reto, experiencia del negocio
     * @params int id del usuario que esta posteando
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function subcomentarios_post_pulzos($idP, $idN, $idU)
    {
        $comentario = $this->input->post('comentar_negocios');
        $post = array('comentarioTexto'=>$comentario,
                      'comentarioNegocioId'=>$idN,
                      'comentarioUsuarioId'=>$idU,
                      'comentarioPulzoId'=>$idP,
                      'comentarioFechaCreacion'=>time());
        $this->experienciaNegocio->subcomments_save_data($post);
    }
}
