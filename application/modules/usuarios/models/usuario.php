<?php
/**
 * Model for usuarios. Self explained actually
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com
 * @version 0.1
 * @copyright ZavorDigital, 14 February, 2011
 * @package Usuarios
 **/

class Usuario extends CI_Model
{

    /**
     * Constructor. Load the Model
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('avatar'));
    }
    
    /**
     * Save the user's new data
     *
     * @param bool success flag
     *
     * @return bool value TRUE or FALSE
     * @author blackfozgdl <ruben.alonso21@gmail.com>
     **/
    public function save($post){
        if($this->db->insert('usuarios', $post)){
			return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Save the user's data with the login
     * by the facebook connect
     *
     * @params array mix data
     * @return int id
     * @return flag in case false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_fb($post)
    {
        if($this->db->insert('usuarios', $post))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Method where the system update the code of the user once
     * register by first time. This code will be used by the
     * users which one will receive the disaccount in the total
     * of the account
     *
     * @params int id
     * @params string code
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_codeRegister($id, $code)
    {
        $this->db->update('usuarios', array('usuariosCode'=>$code), array('id'=>$id));
    }
    
    /**
     * Method where use for save the tokens of facebook where
     * which one the user can post the data in his/her
     * social network
     *
     * @params mixed array
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_tokens_FB($data)
    {
        $this->db->insert('social_media', $data);
    }

    /**
     *
     * Method used for save the avatar of the user
     * and show once login to the platform. He/She
     * will watch the picture in the user profile
     *
     * @params strint table
     * @params mixed array
     *
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_avatar_fb($table, $array)
    {
        $this->db->insert($table, $array);
        return $this->db->insert_id();
    }

	/**
	 * Guardar datos personales
	 * del usuario en la tabla
	 * personal
	 *
	 * @params int, id de usuario
	 * @return flag, verdadero o false
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	 public function save_personal($id)
	 {
	 	if($this->db->insert('personal', array('usuarioId'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	 }
	
	/**
	 * Get the password for compare if is 
	 * correct with the typed for the user
	 *
	 * @params string with the email
	 * @return string with the password encode
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	 public function get_password($email)
     {
         $this->db->select('*')
                  ->from('usuarios')
                  ->join('negocios','negocioUsuarioId = id', 'left')
                  ->where('email',$email);
         $query = $this->db->get();
/*	     $this->db->where('email',$email);
         $query = $this->db->get('usuarios');*/
		 return $query->row();
	 }
	
	/**
	 * Check if there are some
	 * data with the information passed
	 *
	 * @params two strings, email and password
	 * @params tinyint 1 or 0 depending user o business
	 * @return true or false
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function check_account($email, $password, $flag)
	{
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$this->db->where('statusEU',$flag);
		$this->db->from('usuarios');
		$count = $this->db->count_all_results();
		if($count != 0)
		{
		    return TRUE;
		}
		else
		{
		    return FALSE;
		}
	}
	
	/**
	 * Metodo para verificar el status de
	 * tipo de usuario, si es negocio o
	 * solamente empresa, por medio de este
	 * redireccionar una vez que este en el footer
	 * navengado
	 *
	 * @params int id de usuario
	 * @return tinyint statusEU
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function check_data($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('usuarios');
		return $query->row();
	}
	
	/**
	 * Check if the email typed in
	 * the field is correct and return
	 * true or false
	 *
	 * @param email
	 * @return bool true or false
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function check_email($email)
	{
		$this->db->where('email',$email);
		$this->db->from('usuarios');
		$count = $this->db->count_all_results();
		if($count != 0)
		{
		    return TRUE;
		}
		else
		{
		    return FALSE;
		}
    }

    /**
     * Method where the system can get the results once the
     * string will be checked by the match. If the macth is correct
     * in both the platform return a number where indicate that the
     * data for access to an account is correct
     *
     * @params string email
     * @params string password
     * @params int flag
     * 
     * @return int total
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function checkEmailExists($mail, $pass, $status)
    {
        $this->db->where('email', $mail);
        $this->db->where('password', $pass);
        $this->db->where('statusEU', $status);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }

    /**
     * Gets the data of the user for
     * show the information like the
     * age and id location
     *
     * @params int, the id of the user
     * @return array with the data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_name($id)
    {
        $this->db->select('*')
            ->from('usuarios')
            ->where('usuarios.id = '.$id);

        //limpiar los resultados y asignar al row
        $query = $this->db->get();
        $model = $query->row();
        return $model;
    }

    /**
     * Recover the location of the
     * user with the id of the city assigned
     * to the user
     *
     * @params int, id of the city
     * @return string, name of the city
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_location($id)
    {
            $this->db->where('id',$id);
            $query = $this->db->get('estado');
            return $query->row();
    }

    /**
     * Se obtienen los datos para llenar las listas
     * desplegables en la parte de edicion de los
     * datos del perfil de usuario
     *
     * @params string nombre de la tabla
     * @return mixed datos de la tabla
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    

	/**
	 * Actualizar los datos personales del
	 * usuario en la tabla USUARIOS
	 *
	 * @params valores a actualizar, id del
	 *  usuario
	 * @return bandera con verdaro o falso
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function update_profile($post, $id)
	{
		if($this->db->update('usuarios', $post, array('id'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }
	
	/**
	 * Actualizar los datos personales del
	 * usuario en la tabla Personal
	 *
	 * @params array, datos del usuario
	 * @params int, variable de session
	 * @return flag, con verdadero o falso
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function update_personal($post, $id)
	{
		if($this->db->update('personal', $post, array('usuarioId'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

    /**
     * Obtener el total de registros que hay
     * de los usuarios que coincida con la
     * condicion de busqueda
     *
     * @params cadena con el valor de la condicion
     * @return datos de los usuarios con la coincidencia
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function search($id, $valor = null)
    {
        if($valor)
	{
        $this->db->like('nombre',$valor,'after');
        }
        $this->db->order_by('id','desc');
        $this->db->limit(8);
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    public function searchMas($id, $c){
        $this->db->like('nombre', $c, 'after');
        $this->db->order_by('id','desc');
        $query = $this->db->get('usuarios');
        return $query->result();
    }

	public function get_id($name = null)
	{
		if($name)
		{
			$this->db->where($name);
		}
		$query = $this->db->get('usuarios');
		return $query->result_array();
	}
	
	/**
	 * Metodo para recuperar datos del
	 * usuarios por medio del correo
	 * electronico
	 * 
	 * @params string e-mail
	 * @return object con datos del usuario
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function user_data($email)
	{
		$this->db->where('email',$email);
		$query = $this->db->get('usuarios');
		return $query->row();
    }

    /**
     * Method where the system check the facebook
     * uid in case that the user has make account.
     * With that function the system get all the data
     * of the user
     *
     * @params string FB uid
     * @return mixed array
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function user_data_by_fb($fb)
    {
        $this->db->where('usuariosFBuId', $fb);
        $data = $this->db->get('usuarios');
        return $data->row();
    }
	
	/**
	 * Metodo para obtener los datos
	 * que se mostraran en la vista de
	 * edicion del perfil de usuario
	 *
	 * @params int, ID de usuario
	 * @return array, datos a editar
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function data_profile($valor, $id, $tabla)
	{	
		$this->db->where($valor,$id);
		$query = $this->db->get($tabla);
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * Metodo para actualizar el
	 * nuevo password tecleado
	 * en la forma de recuperacion
	 *
	 * @params string nuevo password
	 * @params string clave de confirmacion
	 * @return flag verdadero o false
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function update_password($pass, $id)
	{
		if($this->db->update('usuarios', array('password'=>$pass,
											   'statusRecuperacion'=>'1'),
							 			 array('codigoRecuperacion'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * Get specific information of database
	 * specifing the name of the table
	 *
	 * @params a strinh with the table's name
	 * @return the table information
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	 public function all_data($table)
     {
         $this->db->select('id, nombre');
	     return $this->db->get($table);
     }

    /**
     * Metodo que se usa para obtener la informacion
     * de las ciudades dependiendo del pais que se ha seleccionado,
     * esto para llenar automaticamente la lista de las ciudades
     * sin necesidad de que se tenga que seleccionar de nueva cuenta
     * el pais y se haga doble el proceso
     *
     * @params int id del pais
     * @return mixed array data
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function all_data_by_country($id)
    {
        $this->db->where('id_pais', $id);
        return $this->db->get('estado');
    }
	
	/**
	 * Realiza el conteo de los registros
	 * que tengan coincidencia cuando los
	 * usuarios realizan una busqueda de
	 * algun amigo o empresa
	 *
	 * @params string nombre a buscar
	 * @return int total de registros
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function count_all($id, $valor = null)
    {
        $this->db->where_not_in('id', $id);
		if($valor)
		{
			$this->db->like('nombre',$valor, 'after');
		}
		$query = $this->db->get('usuarios');
		return $query->num_rows();
    }

    /**
     * Se obtienen todos los datos personales del usuario
     * dependiendo el id que se pase, esto para mostrarlos
     * en informacion personal
     *
     * @params int id del usuario
     * @return mixed datos del usuario y personal
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_personal_user($id)
    {
        $query = $this->db->query("select * from usuarios right join personal on usuarioId = id where id = " . $id);
        return $query->row();
    }
    
    /**
     * Metodo con el cual obtendremos las etiquetas de los
     * pulzos para que los usuarios puedas seleccionar
     * su experiencia de vida que mas les convenga
     *
     * return mixed datos de las etiquetas
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function etiquetas()
    {
        $this->db->group_by('nombre');
        $query = $this->db->get('etiquetas');
        return $query->result();
    }

    /**
     * Metodo para obtener los pulzos y retos para el lado
     * derecho, los cuales solo seran 2 de estos.
     *
     * @params int tipo de pulzos
     * @return mixed datos de los pulzos o retos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function pulzos_der($id)
    {
        $query = $this->db->query('select * from pulzos where pulzoTipo = ' . $id . ' order by pulzoId desc limit 2');
        return $query->result();
    }

    /**
     * Metodo que se encarga de obtener todos los inbox que tiene el
     * usuario sin leer contando los nuevos, todos estos inbox tienen
     * un status de 1, en caso de que sea 0, no se mostraran los inbox
     * como si fueran no leidos.
     *
     * @params int id del usuario
     * @params int status del inbox
     *
     * @return int total de registros con el valor
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function inbox_total($id, $status)
    {
        $this->db->where('inboxnUsuarioRecibeId', $id);
        $this->db->where('inboxnStatus', $status);
        $query = $this->db->count_all_results('inboxn');
        return $query;
    }
	
	/**
	 * Metodo que se encarga de obtener el tipo de amistad
     * que se tiene para saber si es una amistad aceptada
     * o es una amistad pendiente, o incluso si
     * es una amistad que no se tiene aun
     *
     * @params int id del usuario con sesion
     * @params int id del usuario del perfil
     *
     * @return mixed datos de la tabla
     * @return blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function data_friendship($id,$id_amigo)
	{
		$this->db->where('amigoUsuarioId',$id);
		$this->db->where('amigoAmigoId',$id_amigo);
		$query = $this->db->get('amigos');
		return $query->row();
    }

    /**
     * Metodo que se encarga de obtener el numero de registros que se tiene
     * en la base de datos con estos datos, en caso de no tener ninguno 
     * simplemente regresa un cero
     *
     * @params int id del usuario con sesion
     * @params int id del usuario del perfil
     *
     * @return int numero de regiostros que coincidan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function type_of_friendly($id1, $id2)
    {
        $this->db->where('amigoUsuarioId', $id1);
        $this->db->where('amigoAmigoId', $id2);
        $total = $this->db->count_all_results('amigos');
        return $total;
    }

    /**
     * Metodo que se usa para dar de alta un negocio
     * nuevo con el cual el usuario podra darse cuenta que
     * esta registrado en la plataforma y armar un plan sin necesidad
     * de crearlo el desde cero, se puede poner de acuerdo en el
     * perfil de creacion del negocio. ALTANEGOCIO
     *
     * @params mixed datos del negocio a crear
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_new_company($data)
    {
        $this->db->insert('altanegocio', $data);
        $uid = $this->db->insert_id();
        return $uid;
    }

    /**
     * Metodo que se usa para poder guardar los datos de la empresa
     * administrador una vez que estas registrado o cuando realizas
     * el registro, esto para que el usuario pueda ver los post que realiza
     * el mimso sobre promociones u ofertas que se llevan a cabo
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_friendly($data)
    {
        $this->db->insert('amigos', $data);
    }

    /**
     * Metodo que se usa para que cuando un usuarios se registre en la
     * plataforma pueda tener a su primer empresa como seguidor para
     * que pueda ver todos los post o promociones que estan poniendo y
     * que se esten informados de los eventos
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_follower_company($data)
    {
        $this->db->insert('seguidores', $data);
    }

    /**
     * Metodo que se usa para poder registrar al padrino del negocio
     * que el usuario comenzara a dar de alta para que los usuarios
     * puedan armar sus planes aqui. APADRINARNEGOCIO
     *
     * @params int id del usuario
     * @params int id del negocio dado de alta
     * @params int fecha de creacion
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_sponsor_company($id, $id_new, $time)
    {
        $this->db->set('apadrinaNegocioUserId', $id);
        $this->db->set('apadrinaNegocioNegocioId', $id_new);
        $this->db->set('apadrinaNegocioFechaCreacion', $time);
        $this->db->insert('apadrinanegocio');
    }

    /**
     * Metodo que se encarga de dar de alta el negocio en la tabla de
     * usuarios para que cuando se quiera accesar al perfil del negocio
     * se pueda ver algo muy sencillo que seria la informacion breve del
     * usuario. USUARIOS
     *
     * @params mixed datos a guardad
     * @return int id del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_company_sponsor($data)
    {
        $this->db->insert('usuarios', $data);
        $idn = $this->db->insert_id();
        return $idn;
    }

    /**
     * Metodo para guardar los datos del negocio con los cuales
     * se dara de alta un registro de empresas para poder tenerlo
     * una vez que el usuario o dueño de la empresa lo reclame y asi
     * no tener que crear un nuevo registro. NEGOCIOS
     *
     * @params mixed datos del negocio a guardar
     * @return int id del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_companys($data)
    {
        $this->db->insert('negocios', $data);
        $idn = $this->db->insert_id();
        return $idn;
    }

    /**
     * Metodo para obtener subcategorias dependiendo el id
     * que se este pasando en als categoria seleccionada con
     * la cual se registrara un negocio nuevo
     *
     * @params int id del giro
     * @return mixed datos del subgiro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_by_category($id)
    {
        $result = $this->db->query('select * from subcategorias where idGiro = ' . $id);
        return $result->result();
    }

    /**
     * Metodo que se encarga de actualizar el status del
     * avatar para que se ponga el que esta por default y el
     * usuario si desea no mostrar mas la imagen que tiene
     *
     * @params int id de la imagen
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_avatar_user($id)
    {
        $this->db->where('imagenId', $id);
        $this->db->update('imagenes', array('imagenAvatar'=>'0'));
    }
	
	/** 
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 **/
	public function count_friends($id,$id_amigo)
	{
		$this->db->where('amigoUsuarioId',$id);
		$this->db->where('amigoAmigoId',$id_amigo);
		$query = $this->db->get('amigos');
		return $query->num_rows();
    }

    /**
     * Se obtienen los datos de los negocios que sigue
     * el usuario, asi poder ver los pulzos mas recientes
     * en el perfil del usuario
     *
     * @params int id del usuario
     * @return mixed datos del negocio seguido
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function business_follow($id)
    {
        $query = $this->db->query('select * from negocios as n, usuarios as u right join seguidores as s on s.seguidorUsuarioId = u.id where u.id=' . $id);
        return $query->row();
    }

    /**
     * Se obtienen los pulzos del negocio con el cual se
     * podran visualizar los mas recientes en una barra lateral
     * en la cual el usuario pueda ver los pulzos mas
     * recientes de las empresas que estan siguiendo
     *
     * @params int id del negocio
     * @return mixed datos de la empresa y los pulzos de la misma
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzos_negocio_vivo($id)
    {
        $query = $this->db->query('select * from pulzosneg right join negocios on negocioUsuarioId = pulzosnegNegocioId where pulzosnegNegocioId =' . $id . ' order by pulzosnegId DESC limit 5');
        return $query->result();
    }

    /**
     * Se muestra el total de empresas que sigue el usuario,
     * asi para evitar la excepcion de la base de datos
     * en mandar error por falta de registros
     *
     * @parasm int id del usuario
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_count_business($id)
    {
        $this->db->where('seguidorUsuarioId', $id);
        $query = $this->db->count_all_results('seguidores');
        return $query;
    }

    /**
     * Se usa esta funcion para obtener el estado civil de usuario,
     * el cual se mostrara en los datos del perfil una vez que este
     * seleccionado, en caso de que este vacio, no mostrara nada
     *
     * @params int id del usuario
     * @return mixed datos personales del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function estado_civil($id)
    {
        $query = $this->db->query("select * from personal right join estadocivil on id = relaciones where usuarioId = " . $id);
        return $query->row();
    }

    /**
     * Se revisa si la acmistad que hay entre el usuario
     * loguados y al que esta visitando en su perfil se
     * encuentra aceptada o si esta pendiente, para
     * saber que es lo que se mostrara a los no
     * amigos
     *
     * @params int id del usuario logueado
     * @params int id del usuario al que visitan
     *
     * @return numero de registros con coincidencia
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function amistad_aceptada($id1, $id2, $val)
    {
        $this->db->where('amigoUsuarioId',$id1);
        $this->db->where('amigoAmigoId',$id2);
        $this->db->where('amigoAceptado',$val);
        $query = $this->db->count_all_results("amigos");
        return $query;
    }

    /**
     * Mostrar el numero de notificaciones con las que
     * cuentan los usuarios para que puedan visualizar si tienen
     * las notificaciones los usuarios
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_notifications($id)
    {
        $this->db->where('invitacionInvitadoPersonalId', $id);
        $this->db->where('invitacionUsuarioPersonalId != ', $id);
        $this->db->where('invitacionPersonalStatus', '1');
        $query = $this->db->count_all_results('invitacionpersonal');
        return $query;
    }

    /**
     * Metodo que se encarga de contar todos los registros que
     * se tienen como pendientes o status no leidos de las notificaciones
     * para que el usuario puedan observar quienes se han apuntado o comentado
     * en algun comentarios que hayas puesto
     *
     * @params int id del usuario
     * @return int numero de notificaciones pendientes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_notifications($id)
    {
      /*  $total = $this->db->query('select count(*) from notificaciones left join notificacion on notificaPlanId = notificacionPlanId where notificaUsuarioId = ' . $id . ' and notificacionUsuarioId = ' . $id . ' and notificacionReciente != 1 and notificacionLeido = 1');
       $this->db->where('notificacionUsuarioId', $id);
        $this->db->where('notificacionLeido', '1');
        $this->db->where_not_in('', '1');
        $total = $this->db->count_all_results('notificaciones');*/
        $this->db->select('*')
                 ->from('notificaciones')
                 ->join('notificacion', 'notificaPlanId = notificacionPlanId', 'left')
                 ->where('notificaUsuarioId', $id)
                 ->where('notificacionUsuarioId', $id)
                 ->where('notificacionLeido', '1');
                 //->where_not_in('notificacionReciente', '1');
        $total = $this->db->count_all_results();
        return $total;
    }


    /****
     *
     *
     *
     *
     * NECESITAMOS CHECAR ESTAS FUNCIONES HABER SI SIRVEN PARA VER SI
     * SE ELIMINAN ESTAS CHINGADERAS
     *
     *
     *
     *
     ******/
    /**
     *
     *
     **/
    public function get_data_negocios($info)
    {
        $this->db->where('nombre', $info);
        $query = $this->db->get('giro');
        return $query->row();
    }

    /**
     *
     *
     **/
    public function get_all_business($id)
    {
        $query = $this->db->query('select * from negocios right join giro on id=negocioGiro where negocioGiro = '.$id);
        return $query->result();
    }

    /**
     * se usa para mostrar todas las invitaciones
     * pendientes
     *
     **/
    public function get_pending_invitations($id)
    {
        $this->db->where('invitacionInvitadoId', $id);
        $this->db->where('invitacionAceptado = 0');
        $query = $this->db->count_all_results('invitaciones');
        return $query;
    }

    /**
     * se obtienen los datos de la invitacion
     **/
    public function datos_invitaciones_recibidas($id)
    {
        $query = $this->db->query('select * from usuarios right join invitaciones on invitacionInvitadoId = id where invitacionInvitadoId ='. $id .' and invitacionAceptado=0');
        return $query->result();
    }

    /**
     * se oibtienen datos de invitaciones hechas pendientes
     **/
    public function datos_invitaciones_hechas($id)
    {
        $query = $this->db->query('select * from usuarios right join invitaciones on invitacionUsuarioId = id where invitacionUsuarioId = ' . $id . ' and invitacionAceptado = 0');
        return $query->result();
    }

    /**
     * se obtienen todos los amigos que tiene el usuario para mostrar en 
     * el perfil del mismo
     **/
    public function get_friends_data($id)
    {
        $query = $this->db->query('select * from usuarios left join amigos on amigoAmigoId = id where amigoUsuarioId = ' . $id . ' limit 6');
        return $query->result();
    }

    /**
     * se obtiene el total de amigos que tiene el usuario
     * para mostrar los 6 amigos o solo un mensaje
     * de que dga que no tiene amigos actualemnte
     **/
    public function get_friends_count($id)
    {
        $this->db->where('amigoUsuarioId', $id);
        $query = $this->db->count_all_results('amigos');
        return $query;
    }
	/**
     * Metodo que se usa para obtener los datos del usuario
     * de la tabla de usuarios para que este pueda ser usado
     * en el header de usuarios, esto para que no cambie de
     * usuarios en el nombre
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_user($id)
    {
        $this->db->where('id',$id);
        $usuario = $this->db->get('usuarios');
        return $usuario->row();
    }
	/*
	*Crea el album por default perfil
	*/
	public function get_default_album($id)
    {
        $this->db->select('*')
            ->from('albums')
            ->where('albums.albumUsuarioId = '.$id)
            ->where('albums.albumDefault = 1');
        $Q = $this->db->get();
        if($Q->num_rows() == 0)
        {
            $this->db->insert('albums', 
                array(
                    'albumUsuarioId'=>$id,
                    'albumDefault'=>1,
                    'albumNombre'=>'Mis fotos de perfil',
                    'albumFechaCreacion'=>time(),
                    'albumLugar'=>'Mi Perfil',
                    'albumDescripcion'=>'Imágenes que he usado como fotos de perfil',
                ));
            $return_data = $this->db->insert_id(); 
        }else{
            $album = $Q->row();
            $return_data = $album->albumId;
        }
        return $return_data;
    }
	
	/*
	*insertar el album por default
	*/
	public function get_album($id)
    {
        $this->db->select('*')
            ->from('albums')
            ->where('albums.albumUsuarioId = '.$id)
            ->where('albums.albumDefault = 2');
        $Q = $this->db->get();
        if($Q->num_rows() == 0)
        {
            $this->db->insert('albums', 
                array(
                    'albumUsuarioId'=>$id,
                    'albumDefault'=>2,
                    'albumNombre'=>'anexos',
                    'albumFechaCreacion'=>time(),
                    'albumLugar'=>'Mi Perfil',
                    'albumDescripcion'=>'Imágenes que he usado en el muro',
                ));
            $return_data = $this->db->insert_id(); 
        }else{
            $album = $Q->row();
            $return_data = $album->albumId;
        }
        return $return_data;
    }
	/*
	*
	*
	*/
	public function estados_pais($id)
    {
        $result = $this->db->query('select * from estado where id_pais = ' . $id);
        return $result->result();
    }

    /**
     * Metodo que se usa para insertar la imagen thubmnail para que el mismo pueda
     * insertarse y guardarse y una vez que se use la aplicacion del usuario para
     * que se pueda mostrar una imagen necesaria sin necesidad de redimensionar desde
     * el movil
     *
     * @params mixed datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_thumb($data)
    {
        $this->db->insert('imagenes_thumb', $data);
    }

    /**
     * Metodo que se usa para poder obtener los valores de si el email existe o si
     * es un email que no est registrado, en caso de tener o saber si esta registrado
     * pasar o asignar en una variable el valor y checarlo para que se envie el 
     * correo o se muestre un mensaje de error
     *
     * @params string email del usuario
     * @return int 0 o 1
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_email_user_exists($str)
    {
        $this->db->where('email', $str);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }

    /**
     * Method for check if really exists the value of the user
     * register, if noth exists the user will be created in the
     * database
     *
     * @params string fb uid
     * @return int total
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_fbUId($fbUid)
    {
        $this->db->where('usuariosFBuId', $fbUid);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }

    /**
     * Metodo que se usa para guardar el codigo de recuperacion del password del usuario,
     * el cual se usara enviando un correo electronico y al mismo tiempo se tendra que
     * resetear el password actual del usuario con el cual este mismo podra despues
     * por medio de un link resetear su password por uno nuevo
     *
     * @params string codigo del usuario
     * @params int id del usuario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_code_user($code, $id)
    {
        $this->db->update('usuarios', array('codigoRecuperacion'=>$code, 'password'=>''), array('id'=>$id));
    }

    /**
     * Metodo que se usa para poder guardar el nuevo password que se
     * mandara por parte del usuario con el cual este se puede loguear
     * por fin a su cuenta y disfrutar de pulzos la plataforma de geo-
     * tagging del mundo
     *
     * @params string password
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_new_password($pass, $id)
    {
        $this->db->update('usuarios', array('password'=>$pass, 'codigoRecuperacion'=>'0'), array('id'=>$id));
    }

    /**
     * Metodo que se usa para revisar que el codigo para la
     * actualizacion de password se cheque correctamente y asi
     * que el usuario pueda ingresar a la parte del formulario,
     * en caso de que quieran regresar al metodo del formulario
     * ya sin codigo activo entonces se redireccionara
     *
     * @params int id del usuario
     * @params string codigo de recuperacion password
     *
     * @return int valor del conteo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_total_code($id, $code)
    {
        $this->db->where('id',$id);
        $this->db->where('codigoRecuperacion', $code);
        $datos = $this->db->count_all_results('usuarios');
        return $datos;
    }

    /**
     * Method where the system will update the profile
     * picture just for the user that register or login
     * by facebook
     *
     * @params string avatar
     * @params int id
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_avatar_profile($avatar, $idAlbum)
    {
        $this->db->update('imagenes', array('imagenRuta'=>$avatar), array('imagenAlbumId'=>$idAlbum));
    }

    /**
     * Method where the system will update the image thumb
     * once the user register or login by facebook, just work for
     * this form to login
     *
     * @params string avatar
     * @params int id
     *
     * @params return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_avatar_thumb($avatar, $idUser)
    {
        $this->db->update('imagenes_thumb', array('usuarioThumbName'=>$avatar), array('thumbUsuarioId'=>$idUser));
    }

    /**
     * Method for update the token of facebook every that the user
     * login to the platform with the form of facebook login button,
     * all this for avoid all the data of the user has problems
     * once want to post in facebook some thing or some recomendation
     *
     * @params string token
     * @params int id
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_tokenFB($token, $id)
    {
        $this->db->update('social_media', array('tokenFacebook'=>$token), array('socialUsuarioId'=>$id));
    }

    	
	public function get_data($id)
	{
		$this->db->where('negocioUsuarioId',$id);
		$query = $this->db->get('negocios');
		return $query->row();
	}
	
	public function get_default_albumN($id)
    {
        $this->db->select('*')
            ->from('albumsnegocios')
            ->where('albumsnegocios.albumNegocioId = '.$id)
            ->where('albumsnegocios.albumNegocioDefault = 1');
        $Q = $this->db->get();
        if($Q->num_rows() == 0)
        {
            $this->db->insert('albumsnegocios', 
                array(
                    'albumNegocioId'=>$id,
                    'albumNegocioDefault'=>1,
                    'albumNombre'=>'Mis fotos de perfil',
                    'albumFechaCreacion'=>time(),
                    'albumLugar'=>'Mi Perfil',
                    'albumDescripcion'=>'Mis Avatars',
                    'albumFechaModificacion'=>time(),
                ));
            $return_data = $this->db->insert_id(); 
        }else{
            $album = $Q->row();
            $return_data = $album->albumId;
        }
        return $return_data;
    }
	
	
	
	public function saveI($post, $condition=null)
	{
        if($condition)
        {
            $this->db->update('imagennegocios', $post, $condition);
            $return_data = 0;
        }
        else
        {
            $this->db->insert('imagennegocios', $post);
            $return_data = $this->db->insert_id();
        }
        return $return_data;
	}
	
	public function count_data_thumbnail($id)
    {
        $this->db->where('thumbUsuarioId', $id);
        $total = $this->db->count_all_results('imagenes_thumb');
        return $total;
    }
	
	public function update_thumb($str, $id)
    {
        $this->db->update('imagenes_thumb', array('usuarioThumbName'=>$str), array('thumbUsuarioId'=>$id));
    }
	public function update_img_geotag($id, $str)
    {
        $this->db->update('scribbles_comments', array('scribbleImagenUsuario'=>$str), array('scribbleUsuarioId'=>$id));
    }


}
