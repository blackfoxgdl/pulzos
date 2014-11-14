<?php if(! defined('BASEPATH')) exit('No script Access Allowed');
/**
 * Controlador donde se haran todas las operaciones de transacciones
 * de parte de la empresa hacia la administradora de pulzos, esto
 * para que tambien puedan ver un tipo estadistico de todas las transacciones
 * que se han completado correctamente y por cuanto se han hecho las mismas
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Oct 26, 2011
 * @package Transacciones
 **/
class transacciones extends MX_Controller
{
    /**
     * Constructor en el cual se van a declarar todas
     * las variables que se usaran de manera global en el metodo,
     * esto para que sean usadas de una manera mas sencilla
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaccion', '', TRUE);
        $this->load->helper(array('url', 'html', 'cyp', 'passworder', 'avatar', 'apipulzos', 'date', 'status', 'counters', 'emails'));
        $this->load->library(array('session', 'form_validation', 'user_agent'));
    }

    /**
     * Metodo que se usa para realizar las consultas de todas las transacciones
     * que se han realizado y se han completado por parte de la empresa para que
     * este pueda verlas y saber que tantas ha realizado por semana, dia o mes
     *
     * @params int id del negocio como negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function transacciones_completas($id)
    {

        $datos['todos'] = $this->transaccion->get_all_history_transactions($id);
        $this->load->view('transacciones/index', $datos);
    }

    /**
     * Metodo que se usa para poder actualizar lso status de los depositos
     * en los cuales se les mostrara al usuario que ya ha hecho la actualizacion
     * en el sistema de lo que le ha depositado a la plataforma pulzos para que
     * sus usuarios en esa quinena pueda disponer de dinero
     *
     * @params int id del historial
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function actualizar_transaccion($id)
    {
        
        $nombre = get_name_company($id);
        $timestamp = date('dmYHis');
        $transaccion = reference_number($nombre->negocioNombre, $timestamp);
        echo $transaccion;
        $this->transaccion->update_transaction($id, $transaccion);
    }

    /**
     * Metodo que se usa para mostrar los datos de los usuarios en cuanto a
     * las transacciones que se han hecho de manera general, las cuales los 
     * usuarios podran visualizarla si se presiona o se ingresa a esta seccion
     * con la cual los usuarios veran todas sus operaciones validas o
     * pendientes hasta el momento
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function movimientos_pendientes($id)
    {
        $datos['movimientos'] = $this->transaccion->get_all_transactions_user($id);
        $this->load->view('transacciones/pendientes_movs', $datos);
    }

    /**
     * Metodo que se usa para poder mostrar todos los datos de los estados de
     * cuenta de los usuarios para que ellos puedan visualizar las transacciones
     * que ha hecho el usuario, como lo que gasta asi como lo que se recibe, esto
     * para que el usuario sepa cuales son lso gastos que ha realizado
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function movimientos_cuenta($id)
    {
        $datos['salidas'] = $this->transaccion->get_transaction_off($id);
        $this->load->view('transacciones/edo_cuenta', $datos);
    }

    /**
     * Metodo que se usa para obtener todas las transacciones que se han realizado
     * por parte del usuario para realizar alguna forma de cambiar sus datos
     * o realizar los pagos que se hayan realizado por parte del usuario para que
     * el mismo pueda visualizar las que se han hecho por diferente mes y ano.
     *
     * @params int dia 
     * @params int mes
     * @params int año
     *
     * @return array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_off_transactions($dia, $mes, $ano)
    {
        $datos['salidas'] = $this->transaccion->get_off_by_month($dia, $mes, $ano);
        $datos['entradas'] = $this->transaccion->get_in_by_month($dia, $mes, $ano);
        $datos['dia'] = $dia;
        $datos['mes'] = $mes;
        $datos['ano'] = $ano;
    
        $this->load->view('transacciones/desglose', $datos);
    }

    /**
     * Metodo que se usa para realizar la solicitud de envio de los transfers
     * que se solicitaran por medio de web una vez que manden el formulario
     * y este correctamente llenado.
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function transfer()
    {
        $banks = $this->transaccion->get_bank_list();
        $datos['bancos'] = create_array($banks);
        $datos['usuarios'] = $this->transaccion->get_user_personal_data($this->session->userdata('id'));
        $this->load->view('transacciones/tranferencias', $datos);
    }

    /**
     * Metodo que se usa para el envio de los datos del usuario asi como los
     * datos que se necesitan para realizar el transfer con el cual se van
     * a quitar el dinero disponible para tranferirlo a las cuentas que se
     * hayan especificado.
     *
     * @params
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_transfer()
    {
        $post = $this->input->post('Transfer');
        $post['idUsuarioTransferenciaUsuario'] = $this->session->userdata('id'); 
        unset($post['llaveUsuarioTransferencia2']);
        $this->transaccion->save_data_transfer($post);
    }

    /**
     * Metodo que se usa para el envio de los datos de los usuarios, esto
     * es mas bien para actualizar los datos de los usuarios con los cuales
     * podra editarlos una vez que no los quiera poner ahi y que el usuario
     * quiera editarlos o cambiarlos
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_transfer()
    {
        $post = $this->input->post('Transfer');
        $post['idUsuarioTransferenciaUsuario'] = $this->session->userdata('id');
        unset($post['llaveUsuarioTransferencia2']);
        $this->transaccion->update_data_transfer($post, $this->session->userdata('id'));
    }

    /**
     * Metodo que se usa para cargar la vista de los retiros con el dinero que 
     * tiene disponible el usuario para que se pueda depositar en su cuenta
     * bancario ya que definio previamente
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function retirar_recursos()
    {
        $datos['recursos'] = $this->transaccion->get_data_total_money($this->session->userdata('id'));
        $this->load->view('transacciones/retiros', $datos);
    }

    /**
     * Metodo que se usa para poder realizar las solicitudes de retiro y guardarlas en
     * la base de datos asi mismo enviar un correo electronico a los dos participantes
     * en esta parte, en el retiro del dinero y el depositante.
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_recursos_usuarios()
    {
        $post = $this->input->post('Retiro');
        $fecha = date('dmYHis');
        $fecha_hora = date('d-m-Y H:i:s');
        $name = get_complete_username($this->session->userdata('id'));
        $post['retiroReferenciaUsuario'] = sha1($fecha.$name);
        $post['retiroFecha'] = $fecha_hora;
        $post['retiroIdUsuario'] = $this->session->userdata('id');
        $this->transaccion->save_retire_users($post);
        $data_user_money = $this->transaccion->get_all_history_data($this->session->userdata('id'));
        $money = $data_user_money->moneyTotalGanadoUsuario - $post['retiroMovimiento']; 
        $this->transaccion->update_retire_money($money, $data_user_money->moneyTotalUsuarioId);

        //EMAIL SENDING
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->load->library('email');
        $this->email->initialize($config);
       
        //GET TEMPLATE AND ASSIGN VARIABLES
        $datos_user_send = $this->transaccion->get_all_data_combinate($this->session->userdata('id'));
        $name_complete = $datos_user_send->nombre . ' ' . $datos_user_send->apellidos;
        $name_transfer = $datos_user_send->transferenciaNombreCompleto . ' ' . $datos_user_send->transferenciaApellidoPaterno . ' ' .$datos_user_send->transferenciaApellidoMaterno;
        $dato_banco = (int)$datos_user_send->idBancoTransferenciaUsuario;
        $nombre_banco = get_name_banco($dato_banco);
        $template = email_retire_money($name_complete, $post['retiroMovimiento']);
        
        //FORMAT TO SEND AN EMAIL
        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to($datos_user_send->email, $name_complete);
        $this->email->subject('Solicitud de Retiro de Dinero');
        $this->email->message($template);
        $this->email->send();

        $template1 = email_notification_admin($name, $post['retiroMovimiento'], $name_transfer, $datos_user_send->llaveUsuarioTransferencia, $nombre_banco->nombre);
        $this->email->from('atencion@pulzos.com', 'Pulzos');
        $this->email->to('mauricio@zavordigital.com', 'Mauricio Uro');
        $this->email->subject('Solicitud de Retiro de Dinero');
        $this->email->message($template1);
        $this->email->send();
    }

    /**
     * Metodo que se usa para poder actualizar los datos de los usuarios como
     * empresas en cuando al registro del numero de referencia de la ficha de
     * deposito con el cual el usuario puede realizar y respaldarse que ya se
     * realizo el deposito quincenal de cada una de las cuentas o historiales
     * que se tienen habilitados
     *
     * @params int id del historial
     * @params string numero de referencia
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_number_reference($id, $nR)
    {
        $this->transaccion->update_number($id, $nR);
    }
}
