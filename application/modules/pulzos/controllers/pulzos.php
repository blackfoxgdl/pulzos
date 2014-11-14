<?php
/**
 * Pulzos son las acciones que los usuarios quieren realizar.
 *
 * El Usuario abre su app de pulzos y postea la actividad que quiere realizar 
 * ese dia en especial. según esto se le muestran empresas en rubros 
 * relacionados para que las seleccione e invite a su gente
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 03 March, 2011
 * @package Pulzos
 **/
class Pulzos extends MX_Controller{

    /**
     * @ignore
     * Estructura de la DB sugerida:
     * pulzoId: INT <primaryKey>
     * pulzoUsuarioId: INT <FK de usuario quien realiza el post>
     * pulzoAccion: VARCHAR 400 <Accion que el usuario quiere realizar>
     * pulzoFechaCreacion: INT <unix timestamp>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'user_agent'));
        $this->load->helper(array('url', 'form', 'html', 'avatar', 'apipulzos', 'cyp', 'date', 'status', 'counters'));
        $this->load->model('pulzo', '', true);
    }

    /**
     * Index que redirecciona a la vista de todos los
     * pulzos u ofertas que ha puesto el negocio para
     * que los usuario puedan tomarlas o aceptarlas
     * TODO: se tiene fecha de inicio y de terminacion
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($id)
    {
        $data['negocios'] = $this->pulzo->get_data_company($id);
        $data['dias'] = days();
        $data['meses'] = month();
        $this->load->view('pulzos/crear', $data);

    }

    /**
     * metodo donde se guarda el pulzo o la promocion que se esta dando
     * a conocer por medio de la empresa, la cual se posteara o mostrara
     * despues del lado derecho del perfil, donde podran ver todos los 
     * pulzos que han hecho hasta el dia, con un limite de 2
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl
     **/
    public function guardar_pulzo($id)
    {
        $post = $this->input->post("Pulzos");
        if($_FILES['imagenP']['name'] != '')
        {
            //para crear el registro del pulzo
            $value = time();
        
            //se crea la parte de la imagen del pulzo
            $file_path = './statics/img_eventos/'.$id.'/'.$value.'/';
            //se crea el directorio
            @mkdir($file_path, 0777, true);
            //preparar propiedades para la carga
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
            if($this->upload->do_upload('imagenP'))
            {
                //sacar informacion sobre el archivo
                $file_info = $this->upload->data();
        
                //se prepara la informacion a guardar
                $ano = date("Y");
                $valor = strtotime($ano."-".$post['mes']."-".$post['dia']);
                $valor2 = strtotime($ano."-".$post['mesT']."-".$post['diaT']);
                unset($post['mes']);
                unset($post['dia']);
                unset($post['diaT']);
                unset($post['mesT']);
                $post['pulzoUsuarioId'] = $id;
                $post['pulzoFechaInicio'] = $valor;
                $post['pulzoFechaFin'] = $valor2;
                $post['pulzoFechaCreacion'] = $value;
                $post['pulzoImagenRuta'] = './statics/img_eventos/'.$id.'/'.$value.'/'.$file_info['file_name'];
                $post['pulzoTipo'] = '0';
                $val = $this->pulzo->save_post($post);

                $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                             'planDescripcion'=>$post['pulzoTitulo'],
                                             'planFechaCreacion'=>time(),
                                             'planEmpresaPosteo'=>$id,
                                             'planEmpresaPulzoId'=>$val);
                $this->pulzo->save_plain_comment($datosMostrarUsuario);
            }
        }
        else
        {
            //para crear el registro del pulzo
            $value = time();
            $ano = date("Y");
            $valor = strtotime($ano."-".$post['mes']."-".$post['dia']);
            $valor2 = strtotime($ano."-".$post['mesT']."-".$post['diaT']);
            unset($post['mes']);
            unset($post['dia']);
            unset($post['diaT']);
            unset($post['mesT']);
            $post['pulzoUsuarioId'] = $id;
            $post['pulzoFechaInicio'] = $valor;
            $post['pulzoFechaFin'] = $valor2;
            $post['pulzoFechaCreacion'] = $value;
            $post['pulzoImagenRuta'] = '0';
            $val = $this->pulzo->save_post($post);

            $datosMostrarUsuario = array('planUsuarioId'=>$this->session->userdata('id'),
                                         'planDescripcion'=>$post['pulzoTitulo'],
                                         'planFechaCreacion'=>time(),
                                         'planEmpresaPosteo'=>$id,
                                         'planEmpresaPulzoId'=>$val);
            $this->pulzo->save_plain_comment($datosMostrarUsuario);
        }
    }

    /**
     * Metodo que se usara para borrar un pulzo que
     * ya no sea el correcto o se haya caducado el
     * pulzo que se tiene
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar($id)
    {
        $this->pulzo->delete_tags($id);
        $this->pulzo->delete_planes($id);
        $this->pulzo->delete_comments($id);
        $val = $this->pulzo->delete($id);
    }

    /**
     * Ver pulzos en la dB
     *
     * En si no sé si se mostrarán los pulzos en algún tipo de 'muro' que se me 
     * haría una reverenda mamada. Por eso por lo pronto esto va a mostrar los 
     * pulzos que tiene cada usuario para hacer un tipo panel con las imágenes 
     * de todos los amigos que han aceptado históricamente.
     *
     * @param integer $id ID del usuario del cual se requieren los pulzos
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     * */
    public function ver($id)
    {
        $data['pulzos'] = $this->pulzo->get($id, '0');
        $data['id'] = $id;
        $this->load->view('pulzos/pulzos', $data);
    }

    /**
     * Metodo que se usa para poder ver los siguientes 10 registros que se
     * tendran en la parte de pulzos, esto para no recargar todos de un putazo
     * y asi hacer mas dinamica y rapida la plataforma y no se alente
     * por lo mismo de cargar todos los registros de madrazo
     *
     * @params int id del negocio
     * @params int numero del ultimo registro mostrado
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function siguientes_pulzos($id, $num)
    {
        $datos['pulzos'] = $this->pulzo->get_next_ten_to_show($id, $num);
        $this->load->view('pulzos/ver_siguientes', $datos);
    }

    /**
     * Metodo que se encarga de sacar el valor del ultimo pulzo que se mostro una vez
     * que se haya presionado ver mas, esto para que se pueda actualizar el valor
     * y poder seguir mostrando los pulzos diferentes sin necesidad de hacer la repeticion
     * de los registros de los pulzos
     *
     * @params int id del usuario
     * @params int numero del ultimo registro mostrado
     *
     * @return json_encode para la actualizacion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_next_ten_datas($id, $num)
    {
        $ultimos_registros = $this->pulzo->get_next_ten_to_show($id, $num);
        $ultimo_mostrado = obtain_array_company($ultimos_registros);
        echo json_encode($ultimo_mostrado);
    }

    /**
     * Metodo que se usa para poder recargar los comentarios que se haran en
     * los diversos pulzos que tenga la empresa, esto se hace para no recargar la
     * pagina por cada comentario y asi solo recargar la parte de los comentarios
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function reload_comment($id)
    {
        $datos['anuncio'] = $this->pulzo->get_data_pulzo($id);
        $this->load->view('pulzos/reload_comment', $datos);
    }

    /**
     * Ver pulzo individual con todos sus comentarios
     *
     * Se mostrara el pulzo individualmente con todos los comentarios que se han hecho en este,
     * acerca del pulzo o dudas sobre el mismo. Estos comentarios
     * los haran los usuarios que esten interesados en el pulzo o promocion
     * y tambien puede contestar la empresa que realizo el pulzo
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_simple($id)
    {
        $datos['pulzo'] = $this->pulzo->get_data_pulzo($id);
        $this->load->view('pulzos/ver', $datos);
    }

    /**
     * Mostrar pulzos de todas las empresas
     *
     * Se mostraran los pulzos de las empresas de forma automatica, esto para que el usuario
     * pueda ver las ofertas que se estan presentando y cuales puede aprovechar para ganar
     * un poco de descuento o para ganar pulzos o incluso experiencias, las cuales el
     * negocio las dara
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function pulzos_usuarios()
    {
        $datos['usuarios'] = $this->pulzo->get_all_pulzos();
        $this->load->view('pulzos/busqueda');
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
        $this->pulzo->subcomments_save_data($post);
    }

    /**
     * Crear un nuevo pulzo
     *
     * A este hay que hecharle un poco más de coco a la implementación. Digo 
     * supongo que para no tener un mamarracho de funciones podemos utilizar 
     * este controlador tanto para el post submit y guardar la info como para 
     * generar los resultados de busqueda según lo que cada usuario está 
     * pensando hacer. Creo que habrá que pensar en una implementación alterna 
     * mientras ideamos ese sistema. Yo digo que usemos comboboxes con acciones 
     * y sustantivos.
     *
     * @param integer $id ID del usuario al cual asignarle el pulzo
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function crear($id=null)
    {
        if(! $id)
        {
            $id = $this->session->userdata('id');
        }     //obtener pulzo desde post
        $post = $this->input->post('Pulzos');
        if($post)
        {
            // preparar datos para inserción
            $post['pulzoUsuarioId'] = $id;
            $post['pulzoFechaCreacion'] = time();

            //realizar inserción
            $idP = $this->pulzo->save($post);
            $this->session->set_userdata('idP', $idp);
        }
        echo true;
    }

    /**
     * Editar no tiene sentido
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function editar()
    {
        // senseless
    } 

    /**
     * Metodo que se encarga de guardar los comentarios
     * que se hagan a los pulzos de las empresas y estos
     * deben ser mostrados en el perfil de empresas
     *
     * @params int id del negocio
     * @params int id del usuario
     * @params int id del pulzo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function pulzo_comentario($idN, $idU, $idP)
    {
        $post = $this->input->post('comentar_experiencia');
        if($post)
        {
            $post['comentarioNegocioId'] = $idN;
            $post['comentarioUsuarioId'] = $idU;
            $post['comentarioPulzoId'] = $idP;
        
            //guardar datos en la bd
            $val = $this->pulzo->save_comment($post);
        }
        $data['negocio'] = $idN;
        $data['usuario'] = $idU;
        $data['pulzos'] = $idP;
        $this->load->view('pulzos/review', $data);
    }

    /**
     * Metodo que se encarga de hacer que se muestre el formulario de los 
     * pulzos con los cuales las empresas podran crear sus ofertas y que los
     * usuarios puedan aprovecharlas
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
     public function crear_pulzo($id=null)
     {
         $negocios = $this->pulzo->get_data_company($this->session->userdata('idN'));
         $datos['negocios'] = $negocios;
         $subcategorias = $this->pulzo->get_all_subcategories();
         $datos['subcategorias'] = create_array_subcategories($subcategorias);
         $datos['dias'] = days();
         $datos['meses'] = month();
         $datos['inboxTN'] = $this->pulzo->inbox_company_total($negocios->negocioUsuarioId, '1');
         $header = $this->load->view('negocios/header_login',$datos, TRUE);
         $content = $this->load->view('pulzos/crear_pulzos', $datos, TRUE);
         $this->load->view('main/template', array('header'=>$header,'content'=>$content));
     }

    /**
     * Metodo que se encarga de mostrar los pulzos que estan con una 
     * subcategoria para poder mostrarlos dependiendo lo que los usuarios
     * quieran visualizar en cuanto a ofertas
     *
     * @params int id de la subcategoria
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mostrar_pulzos($sub, $over=null)
    {
        $datos['subcategoria'] = $this->pulzo->get_data_subcategory($sub);
        $datos['pulzos'] = $this->pulzo->get_pulzo_by_subcategory($sub);
       
        if(isset($over)){
            $this->load->view('pulzos/subcategoriasOver', $datos);
        }else{
             $this->load->view('pulzos/subcategorias', $datos);
        }
    }

    /**
     * Metodo que se encarga de mostrar los datos o los pulzos pero por
     * parte de los pulzos que se tengan por dia, esto son las actividades
     * por dia para los usuarios
     *
     * @params int id de la subcategoria
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mostrar_por_dia($id, $fecha)
    {
        $fechaHoy = unix_to_human(strtotime("+1 day"));
        $cort = explode(' ',$fechaHoy);
        $cor1 = explode('-',$cort[0]);
        $anio = $cor1[0];
        $mes = $cor1[1];
        $dia = $cor1[2];
        $hoyStamp = mktime(0, 0, 0, $mes, $dia, $anio);
        $datos['por_dia'] = $this->pulzo->get_data_by_day($id, $fecha, $hoyStamp);
        $this->load->view('pulzos/mostrar_por_dia', $datos);
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de los usuarios
     * para que vean las actividades por semana y estos puedan verlas para 
     * que las tomen en cuenta y asi dividirlas
     *
     * @params int id de la subcategoria
     * @params date fecha de inicio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mostrar_por_semana($id, $fecha)
    {
        $fechaHoy = unix_to_human(strtotime("+1 week"));
        $cort = explode(' ',$fechaHoy);
        $cor1 = explode('-',$cort[0]);
        $anio = $cor1[0];
        $mes = $cor1[1];
        $dia = $cor1[2];
        $hoyStamp = mktime(0, 0, 0, $mes, $dia, $anio);
        $datos['por_semana'] = $this->pulzo->get_data_by_week($id, $fecha, $hoyStamp);
        $this->load->view('pulzos/mostrar_por_semana', $datos);
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de los pulzos
     * que las empresas han posteado para que se puedan ver por parte de
     * los usuarios y estas las puedan tomar en cuenta
     *
     * @params int id de la subcategoria
     * @params date fecha de inicio
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function mostrar_por_mes($id, $fecha)
    {
        $fechaHoy = unix_to_human(strtotime("+1 month"));
        $cort = explode(' ',$fechaHoy);
        $cor1 = explode('-',$cort[0]);
        $anio = $cor1[0];
        $mes = $cor1[1];
        $dia = $cor1[2];
        $hoyStamp = mktime(0, 0, 0, $mes, $dia, $anio);
        $datos['por_mes'] = $this->pulzo->get_data_by_month($id, $fecha, $hoyStamp);
        $this->load->view('pulzos/mostrar_por_mes', $datos);
    }

    /**
     * Metodo que se usa para poder mostrar los datos del formulario
     * de la creacion de los pulzos para que el mismo pueda verse al 
     * momento que la empresa desee crearlos y asi poder hacer que el
     * formulario este visible con los datos correspondientes por parte 
     * del usuarios
     *
     * @params int id del negocios
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
	public function empresainicio($id=null)
	{
		$negocios = $this->pulzo->get_data_company($this->session->userdata('idN'));
        $datos['negocios'] = $negocios;
        $subcategorias = $this->pulzo->get_all_subcategories();
        $datos['subcategorias'] = create_array_subcategories($subcategorias);
        $datos['dias'] = days();
        $datos['meses'] = month();
        $datos['horas'] = hours();
        $datos['inboxTN'] = $this->pulzo->inbox_company_total($negocios->negocioUsuarioId, '1');
        $this->load->view('pulzos/empresainicio',$datos);
    }

    /**
     * Metodo que carga la categoria seleccionada con su subcategoria
     * abierta para que le usuario en caso de estar ahi poder
     * visualizar solamente la categoria y sus subcategorias que
     * selecciono
     *
     * @params int id del giro
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function ver_categoria($id)
    {
        $datos['giro'] = $this->pulzo->get_data_giro($id);
        $datos['id'] = $id;
        $this->load->view('pulzos/subcategoria_abierta', $datos);
    }
}
