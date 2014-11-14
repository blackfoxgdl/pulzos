<?php
/**
 * Modelo el cual se encargara de la interaccion de los procesos
 * de money back que haga la empresa o el usuario que quieran su
 * devolucion para que se pueda registrar en el mismo los usuarios
 * o empresas que ya se hizo el money back
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, Oct 13, 2011
 * @package Money
 **/
class moneyBack extends CI_Model{
    
    /**
     * Constructor del modelo
     * @author icharlydy <icharlydy@gmail.com>
     **/
    function __construct(){
        parent::__construct();
    }

    /**
     * Metodo que se usa para guardar los datos por parte de la empresa
     * que esta haciendo el reembolso o el money back al usuario para que
     * el mismp pueda realizar sus bonificaciones de lo que compra y la empresa
     * pueda tambien esto deducirlo de impuestos
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_money_company($data)
    {
        unset($data['ofertaId']);
        unset($data['statusTipoBonificacion']);
        $this->db->insert('money_back', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para poder guardar el registro que tendra el usuario para
     * que el mismo pueda despues en su cuenta visualizar cuanto es la cantidad de
     * dinero que ha acumulado en todos sus money back
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_money_user($data)
    {
        $this->db->insert('money_usuario', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para poder actualizar el registro en caso de que el
     * usuario sea el mismo que haya hecho ya varios money back, esto para que no
     * se esten guardando varios registros del mismo usuario porque despues habra
     * conflicto al momento de hacer alguna operacion
     *
     * @params int id del usuario
     * @params mixed datos a guardar
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_money_user($id, $data)
    {
        $this->db->where('usuarioMoneyUsuarioId', $id);
        $this->db->update('money_usuario', array('usuarioMoneyTotal'=>$data));
    }

    /**
     * Obtener los datos del usuario por medio del email que este ha
     * dado, este proceso se lleva a cabo en caso de que el usuario
     * exista con el correo dado, para poder guardar y checar antes
     * si ya tienen money back recibidos o es el primero
     *
     * @params string email usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function user_data_email($email)
    {
        $this->db->where('email', $email);
        $datos = $this->db->get('usuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar todos los conteos de los usuario
     * para conocer si ya existen con algun money back o es su primer money
     * back para ya sea insertar o actualizar los registros en la db
     *
     * @params int id del usuario
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_register($id)
    {
        $this->db->where('usuarioMoneyUsuarioId', $id);
        $totales = $this->db->get('money_usuario');
        return $totales->row();
    }

    /**
     * Metodo que se usa para poder checar si los usuarios estan
     * registrados en la plataforma de pulzos para desde ahi partir y
     * poder hacerles su money back y asi poder registrar la devolucion
     * de dinero, en caso de que no este registrado no se podra hacer su
     * dinero
     *
     * @params string email usuario
     * @return bool true or false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function exist_email($str)
    {
        $this->db->where('email', $str);
        $contador = $this->db->count_all_results('usuarios');
        if($contador != 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function save_tokens_money($data)
    {
        $this->db->insert('social_media_empresa', $data);
    }
    
    /**
     * Metodo que sirve para obtener el dinero que tiene el usuario
     * en la base de datos segun lo que halla dado de alta en el
     * formulario de money, filtrado por su id. Añadiendo el total
     * @params int id usuario $id <idUsuario>
     * @return busqueda filtrado por $id
     * @author JorgeLeon
     **/
    public function get_moneyUsuario($id)
    {
        $query=$this->db->query('SELECT usuarioMoneyId,usuarioMoneyUsuarioId,usuarioMoneyTotal,SUM(usuarioMoneyTotal) as total
                                 FROM money_usuario
                                 WHERE
                                 usuarioMoneyUsuarioId ='.$id.' and usuarioMoneystatus = 1 group by usuarioMoneyId,usuarioMoneyUsuarioId,usuarioMoneyTotal');
        
		
		
		$count = $this->db->count_all_results();
		if($count != 0)
		{						 
        return $query->row();
		}
		else
		{
		return false;
		}
    }
    
    public function check_social_media($id)
    {
        $this->db->where('socialUsuarioId',$id);
        $query=$this->db->get('social_media');
        return $query->row();
    }

    public function check_negocios($data=null)
    {
        if(isset($data))
        {
            $query = $this->db->query("SELECT negocios.negocioId, negocios.negocioNombre, ofertas_negocios.tipoDescuento, COUNT(ofertas_negocios.tipoDescuento) as contador
                                        FROM negocios LEFT JOIN ofertas_negocios ON negocios.negocioId = ofertas_negocios.idNegocioOferta
                                        WHERE  negocioNombre like '".$data."%' and ofertaActivacion = 1 GROUP BY negocioNombre");
            return $query->result();
        }else{
            $query=$this->db->get('negocios');
            return $query->result();
        }
    }
     /**
     * Metodo que sirve para obtener las ofertas de los negocios conforme
     * las han dado de alta, filtradas por su id
     * @params int id negocio ($id) <idNegocio>
     * @return busqueda filtrado por $id
     * @author JorgeLeon
     **/
    public function get_ofertas_negocios($id){
        $query=$this->db->query('SELECT 
                                    *
                                 FROM
                                    ofertas_negocios
                                 LEFT JOIN productos_categorias ON ofertas_negocios.ofertaId = productos_categorias.idOfertas
                                 WHERE
                                    idNegocioOferta ='.$id.' and ofertaActivacion= 1');
        return $query->result();
    }
    
    public function send_inboxUser($inbox){
        $this->db->insert('inboxn', $inbox);
        if($inbox['inboxnAsunto']!=''){
            $id = $this->db->insert_id();
            $this->db->where('inboxnId',$id);
            $aleatorio=$id.$inbox['inboxnUsuarioId'].$inbox['inboxnUsuarioRecibeId'];
            $this->db->update('inboxn', array('inboxnConversacionId'=>$aleatorio));
        }else{
            
            return false;
        }
    }
    /**
     * Metodo que sirve para enviar un inbox al negocio o al usuario 
     * despues que el usuario o que el negocio
     * capturo los datos del money back
     * @params array los datos a insertar a inbox ($inbox)
     * @return 
     * @author JorgeLeon
     **/
    public function send_inbox($inbox){
        $this->db->where('negocioId',$inbox['inboxnUsuarioRecibeId']);
        $query=$this->db->get('negocios');
        $negocio=$query->row();
        $inbox['inboxnUsuarioRecibeId']=$negocio->negocioUsuarioId;
        
        //bandera
        if(isset($inbox['ruta'])){
        unset($inbox['ruta']);
        $recibe=$inbox['inboxnUsuarioId'];
        $inbox['inboxnUsuarioId']=$inbox['inboxnUsuarioRecibeId'];
        $inbox['inboxnUsuarioRecibeId']=$recibe;
        }
        $this->db->insert('inboxn', $inbox);
        
        //añadir id Conversacion aleatoria
        if($inbox['inboxnAsunto']!=''){
            $id = $this->db->insert_id();
            $this->db->where('inboxnId',$id);
            $aleatorio=$id.$inbox['inboxnUsuarioId'].$inbox['inboxnUsuarioRecibeId'];
            $this->db->update('inboxn', array('inboxnConversacionId'=>$aleatorio));
            return $id;
        }else{
            return false;
        }
    }
    /**
     * Metodo que es llamado en la seccion en la que el negocio
     * captura los datos de bonificacion para el usuario y sirve 
     * para verificar si el mail del usuario existe!
     * 
     * @params string data ($data)
     * @return true false
     * @author JorgeLeon
     **/
    public function value_email($data){
        $this->db->where('email',$data);
        $this->db->where('statusEU','0');
        $query=$this->db->get('usuarios');
        return $query->row();
    }
    /**
     * Metodo que es llamado en la seccion en la que el negocio
     * captura los datos de bonificacion para el usuario y sirve 
     * para verificar si el folio ya fue dado de alta! 
     * 
     * @params string folio ($folio)
     * @return true, false
     * @author JorgeLeon
     **/
    public function value_folio($folio, $idNegocio){
        $this->db->where('moneyFolioFactura',$folio);
        $this->db->where('moneyNegocioId',$idNegocio);
        $query=$this->db->get('money_back');
        return $query->row();
    }
    
     /**
     * Metodo que es llamado en la seccion en la que el negocio
     * captura los datos de bonificacion para el usuario y sirve 
     * para verificar si el folio ya fue dado de alta! 
     * 
     * @params int id 
     * @return resultado
     * @author JorgeLeon
     **/
    public function checkMsj_social_media($id){
        $this->db->where('socialEmpresaId', $id);
        $query = $this->db->get('social_media_empresa');
        return $query->row();
    }

    public function chkOfertaId($id){
        $this->db->where('idNegocioOferta',$id);
        $this->db->order_by('ofertaId', 'DESC');
        $this->db->limit('1');
        $query=$this->db->get('ofertas_negocios');
        return $query->row();
    }

    /**
     * Metodo que se encarga de insertar la bonificacion que se mando en
     * la biacora del historial de solicitudes de bonificacion, esto para 
     * conocer correctamente cual es el usuario que esta enviando y cual esta
     * recibiendo, y esto es para cualquier problema aqui se ira guardando todos
     * los datos con esto
     *
     * @params mixed arreglo con datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_bitacora($data)
    {
        $this->db->insert('bitacora_uno', $data);
    }
	
	/*
	 *Metodo que revisa si el id del usuario esta regitrado en money_total, si el usuario 
	 *ya esta regitrado actualiza moneyTotalGanadoUsuario, sino existe,
	 * inserta el id y el totalgando del usuario.
	 *
	 *@params int, id del usuario 
	 *@params double, total ganado 
	 *@return void
	 *@author jalomo
	*/
	public function insert_totalGanado($id,$totalGanado)
	{
		$this->db->where('moneyTotalUsuarioId',$id);
		$this->db->from('money_total');
		$count = $this->db->count_all_results();
		if($count != 0)
		{
		    $this->db->where('moneyTotalUsuarioId', $id);
			$this->db->update('money_total', array('moneyTotalGanadoUsuario'=>$totalGanado));
		}
		else
		{
		    $this->db->insert('money_total', array('moneyTotalUsuarioId'=>$id,'moneyTotalGanadoUsuario'=>$totalGanado)); 
		}
    }
	
	/*
 	 *Metodo para obtener el total ganado del usuario, 
	 *segun la suma del usuarioMoneyTotal 
	 *con status 3 (deposito hecho).
	 *
	 *@params int, id del usuario 
	 *@return totalGanado
	 *@author jalomo
	*/
	public function get_totalGanado($id)
    {
        $query=$this->db->query('SELECT SUM( usuarioMoneyTotal ) AS totalGanado
								 FROM money_usuario
								 WHERE usuarioMoneyUsuarioId ='.$id.'
								 AND usuarioMoneystatus =3');
        $count = $this->db->count_all_results();
		if($count != 0)
		{						 
        return $query->row();
		}
		else
		{
		return false;
		}
		
    }
	
	/*
 	 *Metodo para obtener el total ganado del usuario 
	 *que el negocio ya haya depositado. si el usuario no existe en la tabla 
	 *retorna false 
	 *
	 *@params int, id del usuario 
	 *@return moneyTotalUsuarioId,moneyTotalGanadoUsuario, false
	 *@author jalomo
	*/
	public function get_totalGanadoUsuario($id)
    {
        $query=$this->db->query('SELECT moneyTotalUsuarioId,moneyTotalGanadoUsuario
								 FROM money_total
								 WHERE moneyTotalUsuarioId ='.$id.'');
		$count = $this->db->count_all_results();
		if($count != 0)
		{						 
        return $query->row();
		}
		else
		{
		return false;
		}
    }

    /**
     * Metodo que se usa para obtener todas las ofertas que se tienen
     * actualmente por parte de las empresas que estan activadas, estas
     * para que el usuario pueda seleccionar una de todas las que se
     * tienen actualmente en la empresa y puedan realizar su proceso de
     * bonificacion
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function company_data_offerts($id)
    {
        $datos = $this->db->query('select * from planesusuarios right join ofertas_negocios on idPlanUsuarioOfertaNegocio = planId where idNegocioOferta = ' . $id . ' and ofertaActivacion = 1');
        $query = $datos->result();
        return $query;
    }

    /**
     * Metodo necesario para poder realizar los metodos
     * de las ofertas con los cuales los usuario que solicitan
     * la bonificacion se les mande un inbox xon diversos casos.
     * Es para obtener los datos de social media de las redes 
     * sociales
     *
     * @params int id de la oferta
     * @return mixed datos de la oferta
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function datos_ofertas($id, $chk=null)
    {
        $this->db->where('ofertaId', $id);
        $datos = $this->db->get('ofertas_negocios');
        if(isset($chk)){
            return $datos->result();
        }else{
            return $datos->row();
        }
    }
	/*
 	 *Metodo para obtener el total ganado pendiente del usuario, 
	 *segun la suma del usuarioMoneyTotal 
	 *con status 1 (pendiente).
	 *
	 *@params int, id del usuario 
	 *@return totalGanado
	 *@author jalomo
	*/
	public function get_totalGanado_pendiente($id)
    {
        $query=$this->db->query('SELECT SUM( usuarioMoneyTotal ) AS totalPendiente
								 FROM money_usuario
								 WHERE usuarioMoneyUsuarioId ='.$id.'
								 AND usuarioMoneystatus =1');
        $count = $this->db->count_all_results();
		if($count != 0)
		{						 
        return $query->row();
		}
		else
		{
		return false;
		}
		
    }
	
	/*
 	 *Metodo para obtener el total ganado pendiente del usuario, 
	 *segun la suma del comisionRecibidaUsuarioBonificacion 
	 *con status diferente de 0 (depositado).
	 *@tabla comisionrecibida
	 *@params int, id del usuario 
	 *@return comisionRecibidaUsuarioBonificacion
	 *@author jalomo
	*/
	public function get_comision_total($id)
    {
        $query=$this->db->query('SELECT SUM( comisionRecibidaUsuarioBonificacion )
									FROM comisionRecibida
									WHERE fechaDepositoComisionUsuario <> "0"
									AND comisionRecibidaUsuarioId = '.$id.' ');
        $count = $this->db->count_all_results();
		if($count != 0)
		{						 
        return $query->row();
		}
		else
		{
		return false;
		}
		
    }
	
	/*
 	 *Metodo para obtener el total ganado pendiente del usuario, 
	 *segun la suma del comisionRecibidaUsuarioBonificacion 
	 *con status  de 0 (pendiente).
	 *@tabla comisionrecibida
	 *@params int, id del usuario 
	 *@return totalGanado
	 *@author jalomo
	*/
	public function get_comision_pendiente($id)
    {
        $query=$this->db->query('SELECT SUM( comisionRecibidaUsuarioBonificacion )AS totalPendiente
									FROM comisionRecibida
									WHERE fechaDepositoComisionUsuario = "0"
									AND comisionRecibidaUsuarioId = '.$id.' ');
        $count = $this->db->count_all_results();
		if($count != 0)
		{						 
        return $query->row();
		}
		else
		{
		return false;
		}
		
    }
}
