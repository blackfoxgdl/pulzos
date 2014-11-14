<?php
/**
 * Modelo para la manipulacion de datos de los pulzos
 * de las empresas los cuales se podran realizar las
 * invitaciones a amigos del usuario interesado en realizar
 * una reunion
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 05 April, 2011
 * @package Invitaciones
 **/
class Invitacion extends CI_Model
{
    /**
     * Constructor del modelo de las invitaciones
     * que el usuario de pulzos hara para ir a negocios
     * con sus amigos.
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'invitaciones';
    }
    
    /**
     * Metodo de manipulacion de base de datos, con el
     * cual se actualiza o se inserta un nuevo dato, dependiendo
     * si se trae una condicion como parametro o solo se
     * mandan los datos de una nueva invitacion
     *
     * @params mixed arreglo de datos a insertar o actualizar
     * @params string condicion a cumplir en caso de actualizacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($post, $condition=null)
    {
        if($condition)
        {
            $this->db->update($this->table_name, $post, $condition);
        }
        else
        {
            $this->db->insert($this->table_name, $post);
        }
    }

    /**
     * Metodo para obtener todos los amigos relacionados
     * con el usuario que desee hacer la invitacion
     *
     * @params int id del usuario
     * @return mixed datos de los amigos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_friends($id)
    {
        $query = $this->db->query('SELECT * FROM usuarios left join amigos on amigoAmigoId = id where amigoAceptado = 1 and amigoUsuarioId = ' . $id);
        return $query->result();
    }

    /**
     * Metodo el cual se usa para borrar los datos
     * de las invitaciones
     *
     * @params int id de la invitacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->where('invitacionId',$id);
        $this->db->delete('invitaciones');
    }

    /**
     * Metodo para obtener el pulzo con el cual se
     * desea realizar la invitacion a los amigos del
     * usuario interesado.
     *
     * @params int id del pulzos
     * @return mixed datos del comentario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzosNeg($id)
    {
        $this->db->where('pulzosnegId',$id);
        $query = $this->db->get('pulzosneg');
        return $query->row();
    }

    /**
     * Se obtienen todas las invitaciones con status de
     * aceptadas dependiendo el id del usuario, se devuelven 
     * como un arreglo de objetos.
     *
     * @params int id del usuario
     * @return mixed datos de las invitaciones dependiendo el id de usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_invitations($id)
    {
        $query = $this->db->query('SELECT * FROM negocios LEFT JOIN invitaciones ON negocioUsuarioId = invitacionEmpresaId WHERE invitacionInvitadoId = ' . $id);
        return $query->result();
    }

    /**
     * Se obtienen todas las invitaciones que ha realizado
     * el usuario a sus amigos, y se visualizan quienes
     * han aceptado y quienes la han rechazado
     *
     * @params itn id del usuario que realizo la invitacion
     * @return mixed datos de las invitaciones
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_made_invitations($id)
    {
        $query =  $this->db->query('SELECT * FROM negocios RIGHT JOIN invitaciones ON invitacionEmpresaId = negocioUsuarioId WHERE invitacionUsuarioId = ' . $id);
        return $query->result();
    }

    /**
     * Se obtienen todas las solicitudes con status pendientes que se
     * tienen, estas se mostraran al usuario para que pueda decidir
     * si confirma o rechaza la invitacion.
     *
     * @params int id del usuario
     * @return mixed datos de los negocios e invitaciones
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_request($id)
    {
        $query = $this->db->query('SELECT * FROM negocios LEFT JOIN invitaciones ON negocioUsuarioId = invitacionEmpresaId WHERE invitacionInvitadoId = ' . $id);
        return $query->result();
    }

    /**
     * Elimina las invitaciones rechazaras del usuario
     * borrandolas de la base de datos, asi ya no le apareceran
     * mas en sus registros
     *
     * @params int id de al invitacion
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function refuse($id, $idU)
    {
        $this->db->where('invitacionId',$id);
        $this->db->where('invitacionInvitadoId',$idU);
        $this->db->delete($this->table_name);
    }

    /**
     * Cuenta todas las invitaciones que tiene el usuario
     * como pendientes para saber si se muestra el hipervinculo
     * de las solicitudes pendientes o no.
     *
     * @params int id del usuario
     * @return int numero de registros que coinciden con el id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_invitations_request($id,$condicion,$segCond=null,$valor=null)
    {
        $this->db->where($condicion,$id);
        if($segCond)
        {
            $this->db->where($segCond,$valor);
        }
        $query = $this->db->count_all_results($this->table_name);
        return $query;
    }

    /**
     * Se obtienen los datos para mostrar en el detalle,
     * datos de las empresas para mostrar y a los
     * usuarios que ya hayan aceptado al invitacion
     *
     * @params int id de la invitacion
     * @params int id del usuario creador de la empresa
     * @params int id del pulzo del negocio
     *
     * @return mixed datos generales de la invitacion, negocios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function details($id, $idU, $idP)
    {
        $query = $this->db->query('SELECT * FROM negocios RIGHT JOIN invitaciones ON negocioUsuarioId WHERE invitacionId='.$id.' and invitacionUsuarioId='.$idU.' and invitacionPulzoId='.$idP);
        return $query->row();
    }

    /**
     * Se obtiene el giro al que pertenece la empresa
     * que realizo el pulzo. Se obtendran tambien con esta
     * misma funcion el pais y la ciudad del negocio o de
     * la empresa.
     *
     * @params int id del giro del negocio
     * @return string nombre del giro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id,$tabla)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($tabla);
        return $query->row();
    }

    /**
     * Se obtienen los datos de los usuarios que han 
     * aceptado las invitacion para asistir. Los valores
     * deben de aparecer en 1.
     *
     * @params int id del usuario creador de la invitacion
     * @params int id del pulzos del negocio a usar
     * @params int id de la invitacion
     *
     * @return mixed datos del usuario y la invitacion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_users($id, $idU, $idP)
    {
        $query = $this->db->query('SELECT * FROM usuarios LEFT JOIN invitaciones ON invitacionInvitadoId = id WHERE invitacionId='.$id.' and invitacionUsuarioId='.$idU.' and invitacionPulzoId='.$idP.' and invitacionAceptado=1');
        return $query->result();
    }

    /**
     * Se obtienen los datos del usuario que
     * esta logueado yq eu esta mirando las invitaciones
     * que tiene, ha hecho o tiene pendientes
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user_data($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

    /**
     * Se obtienen los datos de ubicacion del
     * usuario en cuanto a la ciudad y el pais en 
     * el quue reside actualmente
     *
     * @params int id del pais o ciudad
     * @params string nombre de la tabla del pais o ciudad
     *
     * @return mixed datos del pais o ciudad
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location_user($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Se obtienen los datos de la empresa para
     * poder mostrarlos en el mapa del sitio
     * y asi saber donde se encuentra navegando el usuario
     * en la plataforma
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alosno21@gmail.com>
     **/
    public function get_bussines_data($id)
    {
        $this->db->where('negocioUsuarioId', $id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Se ingresa un nuevo pulzo personal
     * para realizar una nueva invitacion de 
     * algun evento en alguna casa o en algun restaurant que despues
     * se hara como alguna propuesta
     *
     * @params mixed datos a insertar del pulzo
     * @return int id del pulzo del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_id_save($post)
    {
        $this->db->insert('pulzos', $post);
        return $this->db->insert_id();
    }

    /**
     * Se guardan los datos para la invitacion personal
     * en la cual se mostraran como las demas invitaciones
     * que hacen los usuarios, solo que esta se obtiene de otra
     * tabla
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_personal_invitacion($post)
    {
        $this->db->insert('invitacionpersonal', $post);
    }

    /**
     * Se mostraran las invitaciones que ha organizado el
     * usuario por medio de su perfil, sin acudir o usar
     * un pulzo de alguna empresa. En la segunda fase se podra
     * asignar que llevara cada usuario y de donde lo pueden comprar
     * para descuentos con sus pulzos
     *
     * @params int id del usuario
     * @return mixed datos de las invitaciones organizadas personales
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function invitaciones_organizadas($id)
    {
        $this->db->where('invitacionUsuarioPersonalId', $id);
        $query = $this->db->get('invitacionpersonal');
        return $query->result();
    }

    /**
     * Se usara para borrar las invitaciones personales en caso
     * de que el usuario no quiera verla mas en sus invitaciones
     * de organizaciones personales que le haya hecho algun amigo
     * para un evento en especifico
     *
     * @params int id de la invitacion
     * @params condition
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function borrar_personal($id)
    {
        $this->db->where('invitacionPersonalId', $id);
        $this->db->delete('invitacionpersonal');
        return TRUE;
    }

    /**
     * Se mostrara la parte de rechazo de invitacion
     * donde se cambiara el status a 2, lo cual o rechazo
     * la invitacion o no podra asistir por x o y razon
     *
     * TODO: se usara 2 para el rechazo de la invitacion
     *
     * @params int id del usuario
     * @params int id de la invitacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function refuse_personal_invitacion($id, $idU)
    {
        $this->db->where('invitacionPersonalId', $id);
        $this->db->where('invitacionInvitadoPersonalId', $idU);
        $this->db->update('invitacionpersonal', array('invitacionPersonalAceptadoId'=>'2'));
        return TRUE;
    }

    /**
     * Muestra el cambio de statis a uno para los usuarios
     * que aceptan las invitaciones que les han hecho para
     * los eventos personales
     *
     * TODO: se usara 1 para el cambio de status que si acepto
     *
     * @params int id del usuario
     * @params int id de la invitacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function acept_personal_invitation($id, $idU)
    {
        $this->db->where('invitacionPersonalId', $id);
        $this->db->where('invitacionUsuarioPersonalId', $idU);
        $this->db->update('invitacionpersonal', array('invitacionPersonalAceptadoId'=>'1'));
    }
}
