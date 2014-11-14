<?php
/**
 * Modelo que se usara para poder obtener todos los
 * inbox de los usuarios con los cuales se mostraran los
 * enviados, los recibidos.
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @author jorgeLeon <jorge@zavordigital.com>
 * @Copyright Zavordigital, June 17, 2011
 * @package inboxUsuarios
 **/
class inboxUsuario extends CI_Model
{

    /**
     * Constructor el cual se declara alguna 
     * variable que se usara en toda la clase
     * y asi poder ya no declararla en cada funcion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table = "inboxn";
    }

    /**
     * Metodo que se encarga de de obtener todos los inbox que tiene
     * el usuario para poder mostrar  lo que se  ha enviado hacia este
     * usuario
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_inbox_user($id)
    {
        $this->db->where('inboxnUsuarioRecibeId ',$id);
        $this->db->order_by('inboxnId','desc');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Metodo del modelo que se usa para obtener los datos 
     * del usuario con el cual se podran manipular toda
     * la parte de los inbox del mismo
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }
    /**
     * Funcion que se encarga de obtener todos los mensajes
     * que se han enviado a diversos contatos, estos son
     * para usuario y negocios, va combinado
     **/
    public function get_inbox_sent($id)
    {
        /*$this->db->where('inboxnUsuarioId', $id);
        $this->db->order_by('inboxnId','desc');
        $query = $this->db->get($this->table);*/
        $query=$this->db->query('SELECT * FROM ( SELECT * FROM inboxn WHERE inboxnUsuarioId = '.$id.' order by inboxnId DESC) as inbx GROUP BY inboxnUsuarioRecibeId');
        return $query->result();
    }

    /**
     * Metodo que se usa para obtener los inbox que se
     * deben de tener en el mismo, esto para poder
     * seleccionar a quien ira dirigido el mensaje
     *
     * @params int id del usuario
     * @return mixed datos de la tabla amigos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_amigos_auto($id, $nombre)
    {
        $query = $this->db->query("select *,CONCAT(nombre,' ',apellidos) as nCompleto from amigos right join usuarios on amigoAmigoId = id where amigoUsuarioId = ".$id." AND nombre like '".$nombre."%'");
        return $query->result();
    }
    
    public function get_amigos($id)
    {
        $query = $this->db->query('select * from amigos right join usuarios on amigoAmigoId = id where amigoUsuarioId = '.$id);
        return $query;
    }

    /**
     * Metodo que se encarga de guardar los inbox de los usuarios
     * que van a usuario o a empresa en la base de datos, con
     * este metodo solo se usa para envios. Por el momento solo
     * esta para que se envie a un usuario
     *
     * @params mixed datos a insertar en la tabla
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($post)
    {
        $this->db->insert($this->table, $post);
        if($post['inboxnAsunto']!=''){
            $id = $this->db->insert_id();
            $this->db->where('inboxnId',$id);
            $aleatorio=$id.$post['inboxnUsuarioId'].$post['inboxnUsuarioRecibeId'];
            $this->db->update($this->table, array('inboxnConversacionId'=>$aleatorio));
        }else{
            
            return false;
        }
        
    }

    /**
     * Metodo que se usa para obtener los datos de los
     * mensajes privados y mostrarlos a los usuarios
     * 
     * @params int id del inbox del usuario al que envias el msj
     * @param int session es el id del usuario que entro (session->userdata(id))
     * @return mixed datos del inbox
     * @author jorgeLegon <jorgeLeon>
     **/
    public function get_data_message($id, $sesion)
    {
        $query = $this->db->query("SELECT * FROM inboxn 
                                   RIGHT JOIN usuarios ON inboxnUsuarioId = id 
                                   WHERE inboxnUsuarioId= " .$id." AND inboxnUsuarioRecibeId= ".$sesion." AND inboxnAsunto != ''
                                   
                                   UNION ALL 
                                   
                                   SELECT * FROM inboxn 
                                   RIGHT JOIN usuarios ON inboxnUsuarioId = id 
                                   WHERE inboxnUsuarioId =".$sesion." AND `inboxnUsuarioRecibeId` =".$id." AND inboxnAsunto != ''
                                   ORDER BY inboxnId DESC, inboxnConversacionId ASC");
        return $query->result();
    }
    
    public function ver_respuesta($id, $sesion){
        $query = $this->db->query("SELECT * FROM inboxn 
                                    RIGHT JOIN usuarios ON inboxnUsuarioId = id 
                                    WHERE inboxnUsuarioId= ".$id." AND inboxnUsuarioRecibeId = ".$sesion."  AND inboxnAsunto = ''
                                        
                                    UNION

                                    SELECT * FROM inboxn 
                                    RIGHT JOIN usuarios ON inboxnUsuarioId = id 
                                    WHERE inboxnUsuarioId =".$sesion." AND `inboxnUsuarioRecibeId` = ".$id." AND inboxnAsunto = ''
                                    ORDER BY inboxnConversacionId ASC");
        return $query->result();
    }

    /**
     * Metodo que se encarga de eliminar los mensajes
     * de los usuarios, una vez hech esta accion no
     * se pueden recuperar de ningun lado
     *
     * @params int id del inbox
     * @return void
     * @author jorge <jorgeLeon>
     **/
     public function get_data_coment($id){
        $query = $this->db->query("select * from inboxn right join usuarios on inboxnUsuarioId = id where inboxnConversacionId = " .$id);
        return $query->row();
     }
    public function delete($id)
    {
        if($this->db->delete($this->table, array('inboxnId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function deleteC($idC){
         
        if($this->db->delete($this->table, array('inboxnConversacionId'=>$idC)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se obtienen los datos del usuario una ves que se le
     * vaya a responder la solicitud o el inbox enviado al usuario que
     * envio
     *
     * @params int id del inbox
     * @return mixed datos de usuarios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function request($id)
    {
        $query = $this->db->query("select * from inboxn left join usuarios on inboxnUsuarioRecibeId = id where inboxnId = " . $id);
        return $query->result();
    }

    /**
     * Metodo que se encarga de actualizar los datos del usuario
     * en cuanto al mensaje del inbox para que este se pueda 
     * marcar como leido y que no se quede siempre como no leido en
     * el marcador del header del usuario
     *
     * @params int id del inbox
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function change_status($inboxId)
    {
        $this->db->where('inboxnUsuarioRecibeId',$this->session->userdata('id'));
		$this->db->where('inboxnUsuarioId ',$inboxId);
        $this->db->update($this->table, array('inboxnStatus'=>'0'));
    }

    /**
     * Metodo que se encarga de obtener el total de amigos que tiene
     * el usuario actualmente, en caso de no tener amigos mandar un
     * mensaje o mostrar un mensaje, el cual no puede mostrar la forma de
     * envio de mensajes
     *
     * @params int id del usuario
     * @return int numero de registros
     * @author jorgeLeon 
     **/
    public function get_total_friends($id)
    {
        $this->db->where('amigoUsuarioId',$id);
        $total = $this->db->count_all_results('amigos');
        return $total;
    }
    /**
     * Metodo que se encarga de obtener el total de amigos que tiene
     * el usuario actualmente, en caso de no tener amigos mandar un
     * mensaje o mostrar un mensaje, el cual no puede mostrar la forma de
     * envio de mensajes
     *
     * @params int id del usuario
     * @return int numero de registros
     * @author jorgeLeon 
     **/
    public function get_inbox_recibe($id)
    {
         $query=$this->db->query('SELECT * FROM( SELECT * FROM inboxn 
                                    LEFT JOIN usuarios ON inboxn.inboxnUsuarioId = usuarios.id
                                    WHERE inboxnUsuarioRecibeId = '.$id.'
                                    ORDER BY inboxnStatus DESC, inboxnUsuarioId DESC, inboxn.inboxnFecha DESC) as inbx
                                    GROUP BY inboxnUsuarioId ORDER BY inboxnId DESC');
         return $query->result();
    }
    public function get_sin_leer($id){
         $query=$this->db->query("SELECT * FROM inboxn LEFT JOIN usuarios ON inboxn.inboxnUsuarioId = usuarios.id Where inboxnUsuarioId = ".$id." AND inboxnStatus = 1 OR inboxnUsuarioRecibeId = ".$id." AND inboxnStatus = 1 ");
         return $query->result();
    }
    
    /**
     * Metodo que se encarga de obtener el total de amigos que tiene
     * el usuario actualmente, en caso de no tener amigos mandar un
     * mensaje o mostrar un mensaje, el cual no puede mostrar la forma de
     * envio de mensajes
     *
     * @params int id del usuario
     * @return int numero de registros
     * @author jorgeLeon 
     **/
    public function actualizarMoney($idInbox, $idMoneyU, $status){
        
        if($status=='aceptar'){
            $this->db->where('inboxnId', $idInbox);
            $this->db->update($this->table, array('inboxnMoneyStatus'=>'1'));
            
            $this->db->where('usuarioMoneyId', $idMoneyU);
            $this->db->update('money_usuario', array('usuarioMoneyStatus'=>'1'));
        }else{
            $this->db->where('inboxnId', $idInbox);
            $this->db->update($this->table, array('inboxnMoneyStatus'=>'3'));
    }
        
    }

   /**
     * Metodo que se encarga de obtener el total de amigos que tiene
     * el usuario actualmente, en caso de no tener amigos mandar un
     * mensaje o mostrar un mensaje, el cual no puede mostrar la forma de
     * envio de mensajes
     *
     * @params int id del usuario
     * @return int numero de registros
     * @author jorgeLeon 
     **/
    public function check_data_folio_user($id, $ff, $idN)
    {
        $this->db->where('bonificacionIeUsuario', $id);
        $this->db->where('bonificacionIeFolioFactura', $ff);
        $this->db->where('bonificacionIePlan', $idN);
        $datos = $this->db->count_all_results('bonificaciones_ie');
        return $datos;
    }
}
