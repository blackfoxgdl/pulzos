<?php
/**
 * Modelo para la manipulacion de los
 * datos en la parte de los inbox que
 * obtendra el negocio, se señalaran si
 * ya estan leidos o no. NOTA SE USA EL idN
 * SE USA EL ID PARA PODER DIFERENCIA AL
 * USUARIO DE EMPRESA
 *
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 4, 2011
 * @package inboxNegocio
 **/
class inboxnegocio extends CI_Model
{
    /**
     * Datos de la tabla inboxn:
     *
     * @inboxnId int(11) not null primary key
     * @inboxnUsuarioId int(11) not null
     * @inboxnUsuarioRecibeId int(11) not null
     * @inboxnMensaje text not null
     * @inboxnAsunto varchar(200) not null
     * @inboxnStatus tinyint(4) not null
     * @inboxnFecha int(11) not null
     *
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "inboxn";
    }

    /**
     * Se guarda el mensaje de los inbox que envia la empresa
     * a sus usuarios
     * TODO: mensajes que se quieran enviar en privado
     * 
     * @params array object con datos del inbox
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($post)
    {
        if($this->db->insert($this->table_name, $post))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Obtener los datos de los seguidores para mostrar
     * los nombres en una lista desplegable en la cual
     * el negocio definira a quien se le enviara el inbox.
     *
     * @params int id del negocio
     * @return mixed datos del seguidor
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_follower($id)
    {
        $query = $this->db->query("select * from seguidores right join usuarios on seguidorUsuarioId = id where seguidorNegocioId = " . $id);
        return $query;
    }

    /**
     * Consulta para obtener los mensajes que se han recibido
     * de los usuario hacia los negocios
     *
     * @params int id del negocio
     * @return mixed arreglo de objetos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get($id)
    {
        $this->db->where('inboxnUsuarioRecibeId',$id);
        $this->db->order_by('inboxnId','desc');
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    /**
     * Se obtienen los datos del negocio para poder manipular
     * las diferentes operaciones que se pueden realizar en el
     * mismo inbox del negocio
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_bussines($id)
    {
        $this->db->where('negocioUsuarioId',$id);
        $query = $this->db->get("negocios");
        return $query->row();
    }

    /**
     * Metodo que marca como leido el mensaje que desea
     * checar el usuario por medio del checkbox y asi se le
     * cambiara de status del color de fondo al mensaje
     *
     * @params int id del negocio
     *
     * @return void
     * @author blackfogdl <ruben.alonso21@gmail.com>
     **/
    public function read_message($id)
    {
        if($this->db->update($this->table_name, array('inboxnStatus'=>'0'), array('inboxnId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se encarga de marcar los mensajes como
     * no leidos y asi se le guardaran al usuario para
     * que despues los pueda leer, si quiere el wey
     *
     * @params int id del mensaje de la empresa
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function no_read_message($id)
    {
        if($this->db->update($this->table_name, array('inboxnStatus'=>'1'), array('inboxnId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Se obtienen todos los datos del mensaje que
     * se desea abrir en la parte de inbox de los
     * negocios
     *
     * @params int id del mensaje
     * @return mixed datos del mensaje
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_message($id)
    {
        $query = $this->db->query("select * from inboxn right join usuarios on inboxnUsuarioId = id where inboxnId = " . $id);
        return $query->row();
    }

    /**
     * Se eliminan los inbox del negocio, dependiendo el id
     * del inbox que se desee eliminar
     *
     * @params int id del inbox
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($id)
    {
        if($this->db->delete($this->table_name, array('inboxnId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo con el cual se obtienen los datos del usuario una vez
     * que se le vaya a responder la solicitud o pregunta que se
     * haya enviado al inbox
     *
     * @params int id del inbox
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function request($id)
    {
        $query = $this->db->query("select * from inboxn left join negocios on inboxnUsuarioRecibeId = negocioUsuarioId where inboxnId = ".$id);
        return $query->row();
    }

    /**
     * Se obtienen los datos del usuario especificado
     * dependiendo el id que se este pasando como parametro,
     * con esto se obtienen los datos especificos del mismo.
     *
     * @params int id del usuario
     * @return miced datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_user($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get("usuarios");
        return $query->row();
    }

    /**
     * Metodo que se encarga de mostrar los mensajes enviados por
     * la empresa a los negocios, estos se mostraran del mas
     * reciente al mas viejo
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl
     **/
    public function ver_enviados($id)
    {
        $this->db->where('inboxnUsuarioId',$id);
        $this->db->order_by('inboxnId','desc');
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    /**
     * Metodo que se encarga de consultar el numero de seguidores
     * que tiene el negocio para poder crear los inbox, en caso de que no
     * tenga ningun numero de registro, entonces tendra que esperar hasta que
     * alguien lo siga.
     *
     * @params int id del negocio
     * @return int total de registros a seguir
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_total_follows($id)
    {
        $this->db->where('seguidorNegocioId',$id);
        $total = $this->db->count_all_results('seguidores');
        return $total;
    }

    /**
     * Metodo para actualizar los datos de los mensajes inbox del negocio
     * y asi poder actualizar los mismos cambiando el status en la tabla 
     * de los inbox. No mostrara asi al negocio que tiene mas inbox
     * pendientes.
     *
     * @params int id del inbox del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function change_status($id)
    {
        $this->db->where('inboxnId', $id);
        $this->db->update($this->table_name, array('inboxnStatus'=>'0'));
    }
}
