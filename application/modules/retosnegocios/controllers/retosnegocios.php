<?php if(! defined('BASEPATH')) exit('No direct Script Access Allowed.');
/**
 * Controlador que se encargara de la parte
 * de los retos del negocio, esto para realizar el formulario,
 * las vistas individuales y globales, toma tu reto que va dirigido
 * al usuario asi como realizar las reservaciones pertinentes a
 * el negocio
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
class RetosNegocios extends MX_Controller{

    /**
     * Constructor de retos del negocio
     * en el cual se tienen que inicializar
     * las librerias y los helpers, asi como
     * el modelo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('retoNegocio', '', TRUE);
        $this->load->library(array('session', 'form_validation', 'user_agent'));
        $this->load->helper(array('avatar', 'url', 'html', 'cyp', 'apipulzos', 'passworder', 'status', 'date'));
    }

    /**
     * Metodo principal donde se mostrara el formulario
     * para realizaro crear los retos por parte de la empresa,
     * asi poder mostrar a los usuarios estas promociones. 
     * (Solo usuarios que siguen a la empresa)
     *
     * @params int id del negocio opcional
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id=null)
    {
        $datos['dias'] = days();
        $datos['meses'] = month();
        $datos['negocio'] = $this->retoNegocio->get_data($id);
        $datos['retos'] = $this->retoNegocio->get_tipo_pulzos($id, '1');
        $this->load->view('retosnegocios/index', $datos);
    }

    /**
     * Metodo que se usa para guardar los retos en la base
     * de datos y mostrarlos a los usuarios, una vez creados,
     * esta funcion se usa solo para guardar esto, ya sea con
     * una imagen o sin imagen
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_reto($id)
    {
        $post = $this->input->post("Pulzos");
        $imagenData = $_FILES['imagenR']['name'];
        if($imagenData != "")
        {
            $value = time();
            //se crea la ruta donde se guardarn la parte de imagenes de retos
            $file_path = "./statics/img_eventos/".$id."/".$value."/";
            //se crea el directorio
            @mkdir($file_path, 0777, true);
            //se preparan los parametros que se pasan en la libreria
            $upload_settings = array(
                    'upload_path'=>$file_path,
                    'allowed_types'=>'gif|jpg|jpeg|png',
                    'max_size'=>'10000',
                    'max_width'=>'3000',
                    'max_height'=>'3000',
                    'remove_spaces'=>true,
                    'encrypt_name'=>true
                );

            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('imagenR'))
            {
                //se obtiene la informacion de la imagen
                $file_info = $this->upload->data();
                
                //se prepara la infiormacion a insertar
                $ano = date('Y');
                $valor = strtotime($ano."-".$post['meses']."-".$post['dias']);
                if($post['pulzoTipoEventoId'] == 2)
                {
                    $post['pulzoDuracionReto'] = $post['meses'].'-'.$post['dias'].'-'.$ano.'-'.$post['hora'].'-'.$post['minuto'];
                    unset($post['hora']);
                    unset($post['minuto']);
                }
                else
                {
                    unset($post['hora']);
                    unset($post['minuto']);
                    $post['pulzoDuracionReto'] = '0';
                }
                unset($post['meses']);
                unset($post['dias']);
                $post['pulzoUsuarioId'] = $id;
                $post['pulzoFechaInicio'] = $valor;
                $post['pulzoTipo'] = "1";
                $post['pulzoFechaCreacion'] = $value;
                $post['pulzoImagenRuta'] = 'statics/img_eventos/'.$id.'/'.$value.'/'.$file_info['file_name'];
                $val = $this->retoNegocio->save($post);
                
                $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                             'planDescripcion'=>$post['pulzoTitulo'],
                                             'planFechaCreacion'=>time(),
                                             'planEmpresaPosteo'=>$id,
                                             'planEmpresaPulzoId'=>$val);
                $this->retoNegocio->save_comments_in_plains($datosMostrarUsuario);
            }
        }
        else
        {
            $ano = date("Y");
            $valor = strtotime($ano."-".$post['meses']."-".$post['dias']);
            if($post['pulzoTipoEventoId'] == 2)
            {
                $post['pulzoDuracionReto'] = $post['meses'].'-'.$post['dias'].'-'.$ano.'-'.$post['hora'].'-'.$post['minuto'];
                unset($post['hora']);
                unset($post['minuto']);
            }
            else
            {
                unset($post['hora']);
                unset($post['minuto']);
                $post['pulzoDuracionReto'] = '0';
            }
            unset($post['meses']);
            unset($post['dias']);
            $post['pulzoUsuarioId'] = $id;
            $post['pulzoFechaInicio'] = $valor;
            $post['pulzoImagenRuta'] = '0';
            $post['pulzoTipo'] = '1';
            $post['pulzoFechaCreacion'] = time();
         
            $val = $this->retoNegocio->save($post);

            $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                             'planDescripcion'=>$post['pulzoTitulo'],
                                             'planFechaCreacion'=>time(),
                                             'planEmpresaPosteo'=>$id,
                                             'planEmpresaPulzoId'=>$val);
            $this->retoNegocio->save_comments_in_plains($datosMostrarUsuario);
        }
    }

    /**
     * Metodo que se encargara de eliminar el reto
     * que ponga la empresa, esta opcion solamente
     * la podra ver el dueño del reto, pues las otras
     * personas solamente la podran comentar o recomendar
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $this->retoNegocio->delete($id);
    }

    /**
     * Metodo en el cual se guardaran todos los cambios en la parte de ver
     * con la cual se veran todos los pulzos que existan en el mismo, para
     * que el usuario pueda ver todos los retos disponibles por el negocios
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver($id)
    {
        $datos['retos'] = $this->retoNegocio->get($id, '1');
        $datos['id'] = $id;
        $this->load->view('retosnegocios/ver', $datos);
    }

    /**
     * Metodo que se usa para poder obtener los registros de los usuarios
     * en los cuales se mostraran una vez que se presione el link de
     * ver mas cosas con la necesidad de mostrarlos y cargarlos para que
     * el usuario pueda tener mas interactividad en la plataforma y hacerla
     * mas rapida
     *
     * @params int id del negocio
     * @params int numero del ultimo registro
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_siguientes($id, $num)
    {
        $datos['retos'] = $this->retoNegocio->get_next_ten_challenges($id, $num);
        $this->load->view('retosnegocios/ver_siguientes', $datos);
    }

    /**
     * Metodo que se usa para poder obtener los registros de los usuarios
     * y una vez que se hayan obtenido poder conocer cual es el reto
     * que se ha visto por ultima vez, esto para poder actualizar el
     * valor del ultimo registro
     *
     * @params int id del negocio
     * @params int numero del ultimo reto
     * 
     * @return json_encode con valor a actualizar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_last_number_challenge($id, $num)
    {
        $ultimo_reto = $this->retoNegocio->get_next_ten_challenges($id, $num);
        $ultimos = obtain_array_company($ultimo_reto);
        echo json_encode($ultimos);
    }

    /**
     * Metodo que se usa para poder recargar solamente el area de los
     * comentarios en la parte de los retos, esto es para evitar que
     * se recargue toda la pagina y asi tambien evitamos que podamos
     * ver los 10 que ya se habian desplegado
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_comment($id)
    {
        $datos['anuncios'] = $this->retoNegocio->get_data_pulzo($id);
        $this->load->view('retosnegocios/reload_comment', $datos);
    }

    /**
     * Metodo que se usa para mostrar el reto simple, esto para ver
     * el reto con mas detalle y no tan recortado como se muestra en
     * las otras vistas
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_reto($id)
    {
        $datos['reto'] = $this->retoNegocio->get_data_pulzo($id);
        $this->load->view('retosnegocios/reto', $datos); 
    }

    /**
     * Metodo que se encarga de mostrar todos los retos que haya 
     * pero estos van a ser vistos por el usuario sin necesidad
     * de solo filtrar por empresa, estos muestran el de todas
     * las empresas
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function retos_usuarios()
    {
        $datos['retos'] = $this->retoNegocio->get_all_retos();
        $this->load->view('retosnegocios/ver_todos', $datos);
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
        $this->retoNegocio->subcomments_save_data($post);
    }
}
