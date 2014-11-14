<?php if(! defined('BASEPATH')) exit('No Script access Allowed');
/**
 * Controlador que se usa para el funcionamiento que
 * se tiene en la parte del formulario de money
 * back, esto para que se hagan todas las formulas y 
 * las transacciones que se tienen en las diferentes
 * cuentas de usuarios
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, Oct 10, 2011
 * @package Money
 **/
class money extends MX_Controller{

    /**
     * Metodo que se usa para la inicializacion de los
     * diferentes variables que se pueden usar asi como el
     * modelo, helpers y la libraries que se usaran en este
     * modulo
     *
     * @return void
     * @author 
     **/    
	public function __construct(){
        parent::__construct();
        $this->load->library(array('session', 'form_validation', 'user_agent', 'email'));
        $this->load->helper(array('passworder', 'cyp', 'apipulzos', 'avatar', 'invitacion', 'status', 'url', 'form', 'html', 'date', 'counters', 'emails'));
        $this->load->model('moneyBack', '', TRUE);
    }

    /**
     * Metodo inicial que se usa para cargar el formulario principal
     * de mi cartera para que el usuario pueda realizar la bonificacion
     * de sus compras o sus consumos
     *
     * @params int id del usuario
     * @return void
     * @author
     **/
    public function index($id, $negocio=null){
      if(isset($negocio)){
       $datos['negocio'] =  '1';
      }else{
          $datos['checkSocial']=$this->moneyBack->check_social_media($this->session->userdata('id'));
          $datos['checkNegocios']=$this->moneyBack->check_negocios();
          $datos['moneyUsuarios']=$this->moneyBack->get_moneyUsuario($this->session->userdata('id'));
		  $datos['totalGanado']=$this->moneyBack->get_totalGanadoUsuario($this->session->userdata('id'));
		  $datos['totalPendiente']=$this->moneyBack->get_comision_pendiente($this->session->userdata('id'));//pendiente status 0
		  
          //verificar si el total viene vacio 
          if(empty($datos['moneyUsuarios']))
          {
              $datos['total']=0;
          }
      
      }
      $this->load->view('money/money_formulario',$datos);
      
      
    }
    

    /**
     * Metodo que se usa para poder observar el money back del negocio para
     * cuando un usuario no tiene telefono celular con la aplicacion de pulzos
     * para el money back en la caja se lo pueden hacer con solo dar los datos
     * de su factura y su correo electronico con el cual esta registrado en
     * la plataforma de pulzos
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function forma_negocios($id)
    {
        $this->load->view('money/formulario_negocio');    
    }

    /**
     * Metodo que se usa para guardar los datos de las bonificaciones que este
     * haciendo la empresa directamente desde su negocio para que el usuario le
     * notifique que ha recibido su bonificacion y para activarla tienen que 
     * difundir un mensaje en sus redes sociales
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function guardar_bonificacion_negocio($id)
    {
        $post = $this->input->post('Money');
        $post['moneyNegocioId'] = $id;
        $registros = $this->moneyBack->user_data_email($post['moneyUsuarioEmail']);
        $total = $this->moneyBack->check_register($registros->id);
        if(empty($total))
        {
            $this->moneyBack->save_money_company($post);
            $post1 = array('usuarioMoneyUsuarioId'=>$registros->id,
                           'usuarioMoneyTotal'=>$post['moneyBackOtorgado'],
                           'usuarioMoneyStatus'=>'1');
            $this->moneyBack->save_money_user($post1);
        }
        else
        {
            $this->moneyBack->save_money_company($post);
            $nuevo_saldo = $total->usuarioMoneyTotal + $post['moneyBackOtorgado'];
            $this->moneyBack->update_money_user($total->usuarioMoneyUsuarioId, $nuevo_saldo);
        }
    }
    
 
    /**
     * Metodo de callback para poder checar que existe el email
     * y este registrado en la base de datos para saber si se le
     * da la bonificacion o no
     *
     * @params string correo
     * @return flag checar si existe o no
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    function exists_email($str)
    {
        if($this->moneyBack->exist_email($str) === TRUE)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
     /**
     * Metodo que se usa para guardar los datos de las bonificaciones que tenga
     * el usuario lo cual a ido acumulando conforme sus pulzos, y tambien
     * para que el negocio inserte la bonificacion del usuario directamente
     *
     * @params int id del usuario
     * @params string redirect 
     * @return void
     * @author jorgeLeon
     **/
    public function guardar_bonificacion_usuario($id)
    {
        $post = $this->input->post('moneyUser');
        if(isset($post['moneyRuta'])){
        $ruta=$post['moneyRuta'];
        unset($post['moneyRuta']);
        }
        $arregloCatego=$this->input->post('categorias');
            if($arregloCatego){
            $oferta ='';
            if(isset($arregloCatego)){
                foreach($arregloCatego as $categoria){
                   $oferta.=$categoria.',';
                }
                $post['moneyCategoriaDescuento']=$oferta;
            }
        }
        
        $userEmail=get_complete_userdata($id);
        $idNegocioUser=get_complete_userdata($post['moneyNegocioId']);
        $post['moneyUsuarioEmail']=$userEmail->email;
        $idMoneyCompany=$this->moneyBack->save_money_company($post);
        $dta_oferta = $this->moneyBack->datos_ofertas($post['moneyBackOfertaId']);
        $socialMedia=$this->moneyBack->checkMsj_social_media($dta_oferta->idMensajeOferta);
        
        //ARMAR MENSAJES DE REDES SOCIALES
        $mensajeRedSocial=array();
        if($socialMedia->mensajeFacebook!=''){
            $mensajeRedSocial['1']='Facebook:  '.$socialMedia->mensajeFacebook;
        }
        if($socialMedia->mensajeTwitter!=''){
            $mensajeRedSocial['2']='Twitter:  '.$socialMedia->mensajeTwitter;
        }
        if($socialMedia->mensajePulzos!=''){
            $mensajeRedSocial['3']='Pulzos:  '.$socialMedia->mensajePulzos;
        }
        //insercion de dinero al usuario
        $moneyUser =array();
        $moneyUser['usuarioMoneyUsuarioId']=$id;
        $moneyUser['usuariosMoneyBackId']=$idMoneyCompany;
        //***CAMBIO ya se le deduce al usuario *** Deducir por 2.8%
        $moneyUser['usuarioMoneyTotal']=$post['moneyBackOtorgado'];
        $verficarId=$this->moneyBack->get_moneyUsuario($id);
        $idMoneyUser=$this->moneyBack->save_money_user($moneyUser);
        
        //envio mensaje a la empresa o usuario* 
        $inbox['inboxnUsuarioRecibeId']=$post['moneyNegocioId'];
        $inbox['inboxnUsuarioId']=$id;
        $inbox['inboxnAsunto']='Discount';
        $inbox['inboxnStatus'] = '1';
        $inbox['inboxnFecha']= time();
        $inbox['inboxnMoneyUser']=$idMoneyUser;
        $inbox['inboxnOfertaId']= $post['moneyBackOfertaId'];
        $inbox['inboxnMoneyStatus']='1';
        //bandera empresa->usuario
        if(isset($ruta)){ //BONIFICACION USUARIO
            $inbox['ruta']=true;
            $inbox['inboxnMensaje']= 'Your discount was apply to your total.
                                      <br />Location:  <strong>'.get_complete_username($this->session->userdata('id')).'</strong><br />
                                      Total Amount: $' . $post['moneyMontoConsumo'] . '<br />
                                      Amount to Pay: $' . $post['moneyBackOtorgado'] . '<br /><br />
                                      Your post in your social networks: <br />' .
                                      $mensajeRedSocial;
                
                /*'Has solicitado una bonificación: <br> Lugar: <strong>'.get_complete_username($this->session->userdata('id')).'</strong><br>
                                     Folio: <strong> '.$post['moneyFolioFactura'].' </strong><br>
                                     Monto consumido de $ <strong>'.$post['moneyMontoConsumo'].' Pesos </strong><br>
                                     Bonificacion:<strong> $'.$post['moneyBackOtorgado'].' Pesos</strong><br><br>
                                     Se publicará el siguiente mensaje en tus redes sociales:<br><br>'.implode('<br>',$mensajeRedSocial) .
                                     '<br />';*/
            //<font color="RED">Importante: En algunas cuentas se retendran el 16% del Impuesto al Valor Agregado (IVA).</font>';
            //PART WHERE DECLARE THE EMAIL FORMAT
            /*$config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);

            //GET THE EMAIL TEMPLATE
            $datos_negocio_email = get_name_company($post['moneyNegocioId']);
            $template_email_user = bonification_email_template_user(get_complete_username($userEmail->id),
                                                                    $datos_negocio_email->negocioNombre,
                                                                    $post['moneyFolioFactura'],
                                                                    $post['moneyMontoConsumo'],
                                                                    $post['moneyBackOtorgado']);

            //DEFINE THE DATA FOR SEND EMAILS
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($userEmail->email, get_complete_username($userEmail->id));
            $this->email->subject('Has solicitado una bonificacion!');
            $this->email->message($template_email_user);
            $this->email->send();*/
        }else{ //BONIFICACION EMPRESA
            $inbox['inboxnMensaje']= 'User: <strong>' . get_complete_username($id). ' </strong></br>
                                      Total Amount: $' . $post['moneyMontoConsumo'] . '<br />
                                      Amount to Pay: $' . $post['moneyBackOtorgado'] . '<br /><br />'; 

/*'Usuario : <strong>'.get_complete_username($id).'</strong></br>
                                     Folio: <strong> '.$post['moneyFolioFactura'].' </strong></br> 
                                     Monto consumido:<strong> $'.$post['moneyMontoConsumo'].' Pesos. </strong></br>
                                     Bonificacion:<strong> $'.$post['moneyBackOtorgado'].' Pesos</strong>';*/

            //PLACE WHERE PUT CODE FOR THE REQUEST BONIFICATION
            /*$config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->load->library('email');
            $this->email->initialize($config);
    
            //PART OF THE TEMPLATE EMAIL
            $datos_negocio_email = get_name_company($post['moneyNegocioId']);
            $template_email = bonification_email_template($datos_negocio_email->negocioNombre,
                                                          get_complete_username($userEmail->id), 
                                                          $post['moneyFolioFactura'],
                                                          $post['moneyMontoConsumo'],
                                                          $post['moneyBackOtorgado']);

            //PART WHERE SEND THE EMAIL
            $this->email->from('atencion@pulzos.com', 'Pulzos');
            $this->email->to($datos_negocio_email->negocioEmail, $datos_negocio_email->negocioNombre);
            $this->email->subject(get_complete_username($userEmail->id) . ' ha realizado una solicitud de bonificacion!');
            $this->email->message($template_email);
            $this->email->send();*/
        }
        //VERIFICAR QUIEN ENVIA Y QUIEN RECIBE
        $status_user = get_status_user($this->session->userdata('id'));
        if($status_user == 0)
        {
            $recibe = $inbox['inboxnUsuarioRecibeId'];
            $envia = $inbox['inboxnUsuarioId'];
        }
        else
        {
            $recibe = $inbox['inboxnUsuarioId'];
            $envia = $inbox['inboxnUsuarioRecibeId'];
        }

        $id_inbox_insert = $this->moneyBack->send_inbox($inbox);
        //PARTE DONDE SE GUARDARAN LOS DATOS DE LA BITACORA
        /*$bitacora = array('bitacoraIbxnId'=>$id_inbox_insert,
                          'bitacoraUsuarioRecibeId'=>$recibe,
                          'bitacoraUsuarioEnviaId'=>$envia,
                          'bitacoraIbxMsj'=>$inbox['inboxnMensaje'],
                          'bitacoraIbxOferta'=>$post['moneyBackOfertaId'],
                          'bitacoraMoneyUsuario'=>$inbox['inboxnMoneyUser'],
                          'bitacoraIbxStatus'=>$inbox['inboxnMoneyStatus']);
        $this->moneyBack->save_bitacora($bitacora);*/
            $array_return = array('idOferta'=>$dta_oferta->ofertaId,
                                  'idUsuario'=>$id,
                                  'idBonificacion'=>$idMoneyUser);
            echo json_encode($array_return);
    }

    /**
     **/
    public function buscar_negocio($data=null)
    {
        if(isset($data)){
            $unir1=str_replace("_", "",$data);
            $nombres=trim($unir1);
            $datos['busqueda']=$this->moneyBack->check_negocios($nombres);
            $this->load->view('money/busqueda_negocio',$datos);
        }else{
            $post=$this->input->post('buscar');
            $datos['busquedaN']=$this->moneyBack->check_negocios($post);
            $this->load->view('money/busqueda_negocio',$datos);
        }
    }

    /**
     * Metodo que se usa para obtener las ofertas que han
     * dado de alta los negocios recibiendo el id del negocio
     *
     * @params int $id <idNegocio> 
     * @return void
     * @author jorgeLeon
     **/
    public function buscar_oferta_negocio($idOfer=null)
    {
        if(isset($idOfer))
        {
            $datos['negocioOfertas']=$this->moneyBack->get_ofertas_negocios($idOfer);
            $this->load->view('money/busqueda_oferta',$datos);
        }else{
            $id = $this->input->post('idOferta');
            $datos['negocioOfertas']=$this->moneyBack->get_ofertas_negocios($id);
            $this->load->view('money/busqueda_oferta',$datos);
        }
        
    }
    public function oferta_busqueda_Id(){
        $idOfertas=$this->input->post('ofertaId');$chk=true;
        $datos['negocioOfertas']=$this->moneyBack->datos_ofertas($idOfertas, $chk);
        $this->load->view('money/busqueda_oferta',$datos);
    }
    /** Metodo que sirve cuando una empresa bonifica
     * directamente a un usuario desde su interfaz,
     * para validar si el mail existe. Recibe
     * como parametro el mail.
     *  
     * @param string email 
     * @return true, false
     * @author JorgeLeon
     */
    public function validarEmail(){
        $valEmail=$this->input->post('email');
        $eval;
        $datos=$this->moneyBack->value_email($valEmail);
        if(empty($datos)){
            $eval=false;
        }else{
            $eval=$datos->id;
            echo $eval;
        }
    }
    /**Metodo que se utiliza para verificar que 
     * el folio no se repita, es decir que no 
     * se encuentre 2 veces en la base de datos
     * 
     * @return true, false
     * 
     * @param string folio
     * @param int idNegocio
     * 
     * @author JorgeLeon
     **/
    public function validar_folio(){
        $folio=$this->input->post('folio');
        $idNegocio=$this->input->post('idNegocio');
        $datos=$this->moneyBack->value_folio($folio, $idNegocio);
        $flag;
        if(empty($datos)){
            //cuando no exites
            $flag=false;
            echo $flag;
        }else{
            //cuando exite
            $flag=true;
            echo $flag;
        }
    }

    /**
     * Metodo que se usara para poder obtener todos los datos de las ofertas
     * en las cuales la empresa tiene activas para que el mismo usuario
     * seleccione su oferta y pueda realizar lo que se debe al momento de 
     * seleccionar el negocio. No se que dije pero esta parte es para
     * obtener las ofertas de las empresas que eten activas
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function create_select_dinamically($id)
    {
        $id = str_replace('%20', '', $id);
        $total_ofertas = $this->moneyBack->company_data_offerts($id);
        $p = '<option value="0">Seleccion una oferta</option>';
        foreach($total_ofertas as $resumen)
        {
            $p.= "<option value='" . $resumen->ofertaId . "'>";
            $p.= $resumen->planDescripcion;
            $p.= "</option>";
        }
        echo $p;
    }
}
