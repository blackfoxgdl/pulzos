<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la parte de las conecciones
 * que se haran de sitios ligados a la plataforma
 * pulzos para realizar los pagos que se requieran mientras
 * el usuarios tenga dinero en su cuenta. Este controlador manejara
 * tambien la creacion de los botones que se tengan para el diseño
 * de la imagen que se ligara a la api de pulzos y se pueda integrar
 * a la parte de comercios electronicos
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, March 06, 2011
 * @package Connects
 **/
class Connects extends MX_Controller{

    /**
     * Metodo constructor en el cual se
     * declararan los valores iniciales del
     * controlados conect que se usaran durante toda la
     * plataforma
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Connect', '', TRUE);
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'date', 'status', 'emails', 'counters'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
    }

    /**
     * Metodo principal en el cual se creara la pantalla de logueo
     * para que el usuario que desee pagar con pulzos algun producto que
     * desee comprar entonces tendra que loguearse con su correo y con su
     * contraseña para que puedan ver los detalles de la plataforma y conocer
     * ya todos los datos del usuario y del producto y que va a pagar
     *
     * @params int id del negocio como negocio
     * @params double total a pagar
     * @params string url return
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function index($idN, $tp, $url)
    {
        $this->form_validation->set_rules('email', 'Correo Electronico', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');

        $this->form_validation->set_message('required', 'Ingresa tu correo electronico');
        $this->form_validation->set_message('valid_email', 'Ingresa un correo electronico valido');
        $this->form_validation->set_message('required', 'Ingresa tu contraseña');

        if($this->form_validation->run() == TRUE)
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->session->set_userdata('email', $email);
            redirect('connects/pagos/'.$idN.'/'.$tp.'/'.$url);
        }
        else
        {
            $datos['id_negocio'] = $idN;
            $datos['total'] = $tp;
            $datos['url'] = $url;
            $header = $this->load->view('connects/header', '', TRUE);
            $content = $this->load->view('connects/index', $datos, TRUE);
            $this->load->view('main/template', array('header'=>$header,
                                                     'content'=>$content,
                                                     'included_file'=>array('statics/js/usuarios/guardar.js')));
        }
    }

    /**
     * Metodo que se usa para poder mostrar las vistas de los usuarios
     * que se tienen actualmente logueados en la parte de pago de los
     * usuarios para que estos puedan pagar con su dinero disponible en 
     * la parte de pulzos
     *
     * @params int id del negocio
     * @params double cantidad a pagar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function pagos($id, $total, $url)
    {
        $datos['usuarios'] = $this->Connect->get_user_data($this->session->userdata('email'));
        $datos['empresas'] = $this->Connect->get_company_data($id);
        $datos['total'] = $total;
        $value = http_request($url);
        if(!empty($value))
        {
            $datos['url'] = $url;
        }
        else
        {
            $datos['url'] = 'http://'.$url;
        }
        $header = $this->load->view('connects/header', '', TRUE);
        $content = $this->load->view('connects/pagos', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo que se encarga de guardar los datos de la transaccion que se
     * llevo a cabo en la plataforma de pulzos, esto para llevar un registro
     * exacto de todos los datos necesarios para que este correctamente
     * completada la transaccion en pulzos
     *
     * @params
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_payments()
    {
        $fecha_hora = date('d-m-Y H:i:s');
        $post = $this->input->post('Payments');
        $post['transaccionFechaHora'] = $fecha_hora;
        $val = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
        $post['transaccionCodigoVenta'] = 'P-'.$val;
        $post['transaccionToken'] = '0';
        $return = $this->Connect->save_transaction($post);
        if($return > 0)
        {
            $money_usuario = $this->Connect->get_data_money_user($post['transaccionUsuarioId']);
            $total = $money_usuario->moneyTotalGanadoUsuario - $post['transaccionTotalPagar'];
            $return2 = $this->Connect->update_money_user($total, $post['transaccionUsuarioId']);
            if($return2 == 1)
            {
                $id_negocio = $post['transaccionNegocioId'];
                $time_creation = $val;
                $id_transaccion = $return;
                $data_company = $this->Connect->get_data_company($post['transaccionNegocioId']);
                $id_negocio_usuario = $data_company->negocioUsuarioId;
                $valor = $id_transaccion.'_'.$id_negocio.'_'.$id_negocio_usuario.'_1_'.$time_creation;
                $decode = base64_encode($valor);
                $this->Connect->update_payment_code($decode, $id_transaccion);
                redirect('connects/redireccion_usuario/'.$id_negocio.'/'.$id_transaccion.'/'.$time_creation.'/'.$id_negocio_usuario);
            }
            else
            {
                echo "mal";
            }
        }
        else
        {
            echo "bailo berta";
        }
    }

    /**
     * Metodo que se usa para realizar las redirecciones de los usuarios
     * a los que se les haya aceptado el pago por medio de la plataforma
     * internacional pulzos, con los cuales estos mismos seran redireccionados
     * a la misma parte del otro sitio para que puedan hacer ahi lo que se
     * desee con el valor regresado
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function redireccion_usuario($id1, $id2, $time, $id3)
    {
        $datos['id_negocio'] = $id1;
        $datos['id_transaccion'] = $id2;
        $datos['time_creation'] = $time;
        $datos['id_negocio_usuario'] = $id3;
        $header = $this->load->view('connects/header', '', TRUE);
        $content = $this->load->view('connects/redireccion', $datos, TRUE);
        $this->load->view('main/template', array('header'=>$header,
                                                 'content'=>$content));
    }

    /**
     * Metodo que se usara para redireccionar los datos de los usuarios
     * que han pagado por medio de la plataforma internacion de pulzos
     * los cuales tienen que redireccionar de nueva cuenta al comercio
     * electronico donde se encontraba antes de ser redireccionado a la 
     * parte de pagos paypulzos
     *
     * @params int id del negocio
     * @params int id de la transaccion
     * @params int id del negocio como usuario
     * @params int timestamp
     *
     * @return string cadena codificada
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function redirect($id1, $id2, $id3, $time)
    {
        $val = rand(10000, 65535);
        $val2 = rand(10000, 65535);
        $data_encode = $val2 . '+' . $id2 . '_' . $id1 . '_' . $id3 . '_1_' . $time . '+' . $val;
        $value = base64_encode($data_encode);
        $value = str_replace('=','.',$value);
        //SE NECESITA ESPECIFICAR LAS URL DE DONDE SE IRA EN CASO DE QUE SE HAYA
        //HECHO CON EXITO LA OPERACION
    	redirect('http://localhost/pulzos/libreria_pulzos/pruebas2.php?result=' . $value);
    }

    /**
     * Metodo que se usa para obtener los datos de los usuarios con los cuales
     * seran obtenidos una vez que el token ha sido aceptado por la clase y 
     * asi se puedan obtener los datos necesarios del servidor de pulzos 
     * para que el mismo se puedan realizar de una manera correcta
     *
     * @params string token transaction
     * @return array userdata
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function getDataTransaction($code, $message)
    {
        $code_valid = check_validate_code($code);
        if($code_valid == 1)
        {
            if(strcmp($message,'Codigo') == 0)//COMPARAR CODIGOS CORRECTOS
            {
                //valores a regresar en caso de que sea correcto
                $value = decode_string($code);
                $value2 = decode_pk($code);
                $cut = explode('_', $value2);
                $valor = $this->Connect->check_code($cut[0]);
                if($valor == 1)//COMPARAR NUMERO DE REGISTROS
                {
                    $row = $this->Connect->getPersonalData($cut[0]);
                    if(strcmp($value, $row->transaccionToken) == 0)//COMPARAR CODIGOS
                    {
                        $array = array('statusCode'=>'1',
                                       'messageTransaction'=>'Transaccion completa',
                                       'noTransaction'=>$row->transaccionCodigoVenta,
                                       'totalTransaction'=>$row->transaccionTotalPagar,
                                       'v_total'=>'1');
                    }
                    else//COMPARAR CODIGOS ELSE
                    {
                        $array = array('statusCode'=>'0',
                                       'messageTransaction'=>'Codigo incorrecto.',
                                       'noTransaction'=>'',
                                       'totalTransaction'=>'',
                                       'v_total'=>'0');
                    }
                }
                else//COMPARAR NUMERO REGISTROS ELSE
                {
                    $array = array('statusCode'=>'0',
                                   'messageTransaction'=>'No se realizo la transaccion.',
                                   'noTransaction'=>'',
                                   'totalTransaction'=>'',
                                   'v_total'=>'0');
                }
            }
            else//COMPARAR CODIGOS CORRECTOS ELSE
            {
                $array = array('statusCode'=>'0',
                               'messageTransaction'=>'Transaccion incorrecta.',
                               'noTransaction'=>'',
                               'totalTransaction'=>'',
                               'v_total'=>'0');
            }
        }
        else
        {
            $array = array('statusCode'=>'0',
                           'messageTransaction'=>'Codigo incorrecto.',
                           'noTransaction'=>'',
                           'totalTransaction'=>'',
                           'v_total'=>'0');
        }
        echo json_encode($array);
    }

    /**
     * Metodo que se encarga de revisar el token que se esta pasando de parte
     * de la clase para recibir los datos del usuario una vez que este haya hecho
     * la forma de pago del usuario con el cual el mismo puede recibir informacion
     * de los procesos de la transaccion que se tiene realizada, esto una vez que
     * haya sido aceptada por los negocios de ecommerce
     *
     * @params string code encode
     * @return mixed data returned
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_params_send($str)
    {
        $code_valid = check_validate_code($str);
        if($code_valid == 1)
        { 
            $value = decode_string($str);
            $value2 = decode_pk($str);
            $cut = explode('_', $value2);
            $valor = $this->Connect->check_code($cut[0]);
            if($valor == 1)
            {
                $row = $this->Connect->getPersonalData($cut[0]);
                if(strcmp($value, $row->transaccionToken) == 0)
                {
                   
                    $array = array('v_total'=>'1',
                                   'messageTransaction'=>'Codigo correcto.',
                                   'statusCode'=>'1',
                                   'noTransaction'=>'',
                                   'totalTransaction'=>'');
                  
                }
                else
                {
                 
                    $array = array('v_total'=>'0',
                                   'messageTransaction'=>'Codigo incorrecto.',
                                   'statusCode'=>'0',
                                   'noTransaction'=>'',
                                   'totalTransaction'=>'');
                 
                }
            }
            else
            {
                
                $array = array('v_total'=>'0',
                               'messageTransaction'=>'No hay registro actual.',
                               'statusCode'=>'0',
                               'noTransaction'=>'',
                               'totalTransaction'=>'');
            }
    
        }
        else
        {
            
            $array = array('v_total'=>'0',
                           'messageTransaction'=>'Codigo incorrecto.',
                           'statusCode'=>'0',
                           'noTransaction'=>'',
                           'totalTransaction'=>'');
        }
        echo json_encode($array);
    }
}
