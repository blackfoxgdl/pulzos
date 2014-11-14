<?php
/**
 * Modelo de Negocios, en el cual
 * se tendra toda las operaciones 
 * a la base de datos con relacion
 * a los negocios en pulzos
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/

class Negocio extends CI_Model
{

    /**
     * Constructor del modelo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Guarda los datos de la creacion
     * de la nueva pulzoempresa
     *
     * @params array con datos de 
     *  la empresa a insertar
     * @return flag con verdadero o false
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($post)
    {
        if($this->db->insert('negocios', $post))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo para guardar los datos
     * del usuario que solo creara 
     * una cuenta para su empresa
     * o negocio
     * @params string codigo de activacion
     * @params string email
     * @params string password
     * @params timestamp creacion cuenta
     * @params string codigo de activacion
     * @params tinyint status identificador
     * @return int id de usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_user($activacion, $email, $password, $creacion, $nombre)
    {
        $this->db->set('nombre',$nombre);
        $this->db->set('email',$email);
        $this->db->set('password',$password);
        $this->db->set('creacion',$creacion);
        $this->db->set('codigoActivacion',$activacion);
        $this->db->set('statusEU',1);
        if($this->db->insert('usuarios'))
        {
            $uid = $this->db->insert_id();
            return $uid;
        }
        else
        {
            return FALSE;
        }
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
        $this->db->select('*')
                          ->from('notificaciones')
                          ->join('notificacion', 'notificaPlanId = notificacionPlanId', 'left')
                          ->where('notificaUsuarioId', $id)
                          ->where('notificacionUsuarioId', $id)
                          ->where('notificacionLeido', '1')
                          ->where_not_in('notificacionReciente', '1');
        $total = $this->db->count_all_results();
        return $total;
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
     * Metodo que se encarga de guardar los pulzos que el
     * usuario haya posteado hacia la empresa o que la empresa
     * haya posteado sobre algun comentario que se le ocurrio
     * hacer o compartir con sus seguidores
     *
     * @params mixed datos a guardar
     * @params string nombre de la tabla
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_comments($data, $tabla) 
    {
        $this->db->insert($tabla, $data);
        return $this->db->insert_id();
    }

    /**
     * se quito esta de negocios
     **/
    public function save_post($post)
    {
        if($this->db->insert('pulzos', $post))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo para obtener los paises y ciudades y giro
     * para el registro de los nuevos perfiles
     * de pulzoempresas o pulzonegocios
     *
     * @params string, con el nombre de la tabla
     * @return objeto, con datos de las tablas especificadas
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_register($table)
    {
        return $this->db->get($table);
    }

    /**
     * Metodo para obtener los datos
     * de todas las empresas o de
     * alguna empresa especifica
     * dependiendo el parametro
     *
     * @params string, con el nombre de la tabla
     * @return objeto, con datos de las tablas especificadas
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function view()
    {
        $this->db->select('*');
        $this->db->from('negocios');
        $this->db->join('ciudad', 'ciudad.id=negocios.negocioCiudad');
        $this->db->join('pais', 'pais.id=negocios.negocioPais');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Metodo para obtener el id de
     * la nueva empresa o negocio
     * asi poder iniciar la sesion 
     * una vez que se haya creado
     *
     * @params string email negocio
     * @return object datos negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function check_email($email)
    {
        $this->db->where('email', $email);
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
     * Metodo para obtener los datos
     * introducidos en el negocio al
     * momento de registrarse para
     * mostrarlos en el perfil del
     * mismo
     *
     * @return object datos negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_negocio($id)
    {
        $this->db->where('negocioId', $id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Metodo que se usa para obtener los datos del negocio pero como 
     * usuario para si se requiere algun dato especifico de ahi poder
     * usarlo sin necesidad de crear un helper, en caso de que no se
     * use no afectara en nada la consulta que se realiza
     *
     * @params int id del negocio como usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function data_usuario_negocio($id)
    {
        $this->db->where('id', $id);
        $datos = $this->db->get('usuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para obtener los datos de los servicios
     * que se tienen en la actualidad en el negocio, y asi poderlos
     * mostrar a los usuarios que visiten el perfil del negocio
     *
     * @params int id del negocio
     * @return mixed datos de los servicios
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_services($id)
    {
        $this->db->where('serviciosNegocioId', $id);
        $servicios = $this->db->get('servicios');
        return $servicios->row();
    }

    /**
     * Metodo para obtener la ciudad
     * y el pais de los negocios, el
     * giro del negocio
     *
     * @params string nombre tabla
     * @params int id de ciudad, pais, giro
     * @return object datos de ciudad
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $tabla)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($tabla);
        return $query->row();
    }

    /**
     * Metodo que se encarga de obtener los pulzos
     * por medio de el tipo de pulzos que sea
     *
     * @params int id del negocio
     * @params int tipo de pulzo
     *
     * @return mixed datos de los pulzos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzos($condition=null, $tipo)
    {
        $this->db->where('pulzoUsuarioId',$condition);
        $this->db->where('pulzoTipo', $tipo);
        $this->db->order_by('pulzoId','desc');
        $query = $this->db->get('pulzos');
        return $query->result();
    }

    /**
     * Metodo que se encarga de obtener todos los datos de los planes
     * que se tienen por parte de los negocios para que este se sepa si
     * se va a eliminar alguna publicacion real de la tabla especificada
     *
     * @params int id del plan
     * @return mixed datos del plan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_plains($id)
    {
        $this->db->where('planId', $id);
        $datos = $this->db->get('planesusuarios');
        return $datos->row();
    }

    /**
     * Se obtienen los datos de los seguidores
     * que se tienen hasta el momento en la empresa
     * para que ya no les aparesca el link de seguir
     * empresa cuando ya lo presionaron mas de una vez
     *
     * @params int id de la empresa
     * @return mixed datos en un arreglo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_follower($id, $idU)
    {
        $this->db->where("seguidorNegocioId", $id);
        $this->db->where("seguidorUsuarioId", $idU);
        $query = $this->db->count_all_results("seguidores");
        return $query;
    }

    /**
     * Metodo para actualizar los datos de
     * la empresa, todos los cambios se realizan
     * en la tabla de Negocios
     *
     * @params array datos a actualizar
     * @params int id del negocio
     * @params session id del usuario
     *
     * @return flag verdadero o falso
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data($post, $uid, $id)
    {
        $this->db->where('negocioId',$id);
        $this->db->where('negocioUsuarioId',$uid);
        if($this->db->update('negocios',$post))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Actualiza los registros de nombre de la empresa
     * y el email del mismo, el cual se guarda para
     * mostrar los datos al momento que se haga la busqueda
     * de las empresas junto con la de los usuarios
     *
     * @params int id del negocio como usuario
     * @params string nombre del negocio
     * @params string email del negocio
     *
     * @return flag Verdadero o Falso
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_user_data($nombre, $email, $id)
    {
        $data = array('nombre'=>$nombre,
                      'email'=>$email);
        $this->db->update('usuarios', $data, array('id'=>$id));
    }

    /**
     * Se guarda la informacion dada del banner
     * para la empresa, se tiene que actualizar o 
     * cambiar dependiendo que se necesite realizar
     *
     * @params mixed arreglo de datos a guardar
     * @params int id del negocio NULL
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_banner($data, $condition=null)
    {
        if($condition)
        {
            $this->db->where('extraNegocioId',$condition);
            $this->db->update('datosExtraNegocios',$data);
        }
        else
        {
            $this->db->insert("datosExtraNegocios", $data);
            return true;
        }
    }

    /**
     * Se revisa si hay algun registro en la tabla
     * de datosExtraNegocios para poder saber si se actualiza el registro
     * o se inserta uno nuevo
     *
     * @params int id del negocio
     * @return int total de registros en la bd
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function total_registro($id)
    {
        $this->db->where('extraNegocioId',$id);
        $total = $this->db->count_all_results('datosExtraNegocios');
        return $total;
    }

    /**
     * Metodo que se encarga de mostrar las notificaciones de los mensajes que 
     * se tienen con un status de no leidos para que el usuario pueda 
     * visualizar los datos que se tienen
     *
     * @params int id del negocio
     * @params int status del negocio
     * 
     * @return int numero de mensajes sin leer
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function inbox_company_total($id, $status)
    {
        $this->db->where('inboxnUsuarioRecibeId',$id);
        $this->db->where('inboxnStatus',$status);
        $query = $this->db->count_all_results('inboxn');
        return $query;
    }

    /**
     * Metodo que se usa para eliminar los registros de los pulzos en la
     * parte de pulzos pues son todos los registros que se tienen una vez
     * que se crea y se comienza a eliminar estos
     *
     * @params int id del pulzos
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_pulzos($id)
    {
        $this->db->delete('pulzos', array('pulzoId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar los registros de los planes de usuarios
     * en cuanto a los datos de los pulzos para que este mismo se elimine de los registros
     * y ya no aparesca en la plataforma
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_planes($id)
    {
        $this->db->delete('planesusuarios', array('planEmpresaPulzoId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar los registros de los comentarios que se tengan
     * con referencia a este pulzo, esto para evitar basura en la base de datos,
     * pues los comentarios que se tengan de pulzos eliminados ya no serviran
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_comments($id)
    {
        $this->db->delete('comentarios', array('comentarioPulzoId'=>$id));
    }

    /**
     * Metodo que se usa para borrar los comentarios especificos de
     * los posts del negocio, esto para solo borrar un comentario y no todos
     * cuando se borra el post
     *
     * @params int id del pulzo
     * @params int id del comentario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_comments_specific($idP, $idC)
    {
        $this->db->delete('comentarios', array('comentarioPulzoId'=>$idP, 'comentarioId'=>$idC));
    }

    /**
     * Metodo que se usa para eliminar los registros de los comentarios que tengan
     * con referencia a este pulzo, como son comentarios se tienen en otro lado aparte
     * y con esta funcion evitamos que se tenga basura como registro
     *
     * @params int id del planusuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments($id)
    {
        $this->db->delete('comentarios_planes', array('comentarioSimplePlanId'=>$id));
    }

    /**
     * Metodo que se usa para eliminar un comentario en especifico y no
     * todos los comentarios que se hagan en el post, esto para que el
     * negocio solo elimine uno especifico que no desee tener en su
     * publicacion
     *
     * @params int id del plan
     * @params int id del comentario
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_subcomments_specific($idP, $idC)
    {
        $this->db->delete('comentarios_planes', array('comentarioSimplePlanId'=>$idP, 'comentarioSimpleId'=>$idC));
    }

    /**
     * Metodo que se usa para poder eliminar las etiquetas que esten asiganadas 
     * al mismo pulzo de experiencia, pues una vez que se elimina ese pulzo no 
     * es necesario una vez que se elimina 
     *
     * @params int id del pulzo
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_tags($id)
    {
        $this->db->delete('etiquetas', array('idNegocio'=>$id));
    }

    /**
     * 
     *
     *
     *
     *
     *
     **/
    public function get_data_followers($id)
    {
        $this->db->where('seguidorUsuarioId',$id);
        $query = $this->db->get('seguidores');
        if($query->num_rows == 1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    /**
     * Metodo que se usa para actualizar los password
     * de los usuarios que se tienene en cuenta en
     * el sitio para poder loguearse una vez que el mismo
     * lo haya cambiado y se haya salido de la plataforma
     *
     * @params mixed datos a actualizar
     * @params int id del negocio
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_new_password($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('usuarios', array('password'=>$data));
    }

    /**
     * Metodo que se usa para actualizar el password
     * de la cuenta del negocio en la parte de edicion
     * de datos
     *
     * @params string password del negocio
     * @params int id del negocio en la tabla de usuarios
     *
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_password($pass, $id)
    {
        $data = array('password'=>$pass);
        if($this->db->update('usuarios',$data,array('id'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Busca todas las coincidencias que se
     * tengan con los registros dependiendo la
     * palabra o el nombre que se haya pasado
     * en la busqueda
     *
     * @params string valor con lso datos a 
     *	a buscar dependiendo las coincidencias
     * @return mixed datos con el resultado de
     *	las coincidencias
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function search($id, $valor = null)
    {
        if($valor)
        {
         $this->db->like('nombre', $valor, 'both');
        }
        $this->db->order_by('id','desc');
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    /**
     * Cuenta el total de registros que hay en la base de
     * datos para mostrar el numero de registros que se
     * encontraron una vez que se haya persionado el boton de busqueda
     * de los archivos
     *
     * @params string coincidencia a buscar en caso de que tenga valor
     * @return mixed datos a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all($id, $valor = null)
    {
        $this->db->where_not_in('id', $id);
        if($valor)
        {
            $this->db->like('nombre',$valor);
        }
        $query = $this->db->get('usuarios');
        return $query->num_rows();
    }

    /**
     * Metodo que se usa para obtener los datos del usuario
     * de la tabla de usuarios para que este pueda ser usado
     * en el header de negocios, esto para que no cambie de
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

    /**
     * Metodo de la base de datos que se usa para
     * extraer todos los datos de las ofertas que
     * se han colocado al servicio del empleado, estas
     * para mostrar en el muro del mismo
     *
     * @params int id del negocio - negocio
     * @return mixed objeto con los datos de los pulzos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzos_negocios($id)
    {
        $this->db->where('pulzoUsuarioId', $id);
        $this->db->order_by('pulzoId', 'DESC');
        $this->db->limit(10);
        $datos = $this->db->get('pulzos');
        return $datos->result();
    }

    /**
     * Metodo que se usa para obtener los siguientes 10 registros que
     * se tienen en la parte de inicio del usuario donde al momento de presionar
     * "Ver mas" se podran observar los siguientes pulzos que le siguen
     *
     * @params int id del negocio
     * @params int numero del pulzo en el que esta
     *
     * @return mixed datos de los pulzos siguientes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_next_ten_pulzos($id, $num)
    {
        $this->db->where('pulzoUsuarioId', $id);
        $this->db->where('pulzoId <', $num);
        $this->db->order_by('pulzoId', 'DESC');
        $this->db->limit(10);
        $datos = $this->db->get('pulzos');
        return $datos->result();
    }

    /**
     * Metodo que se usa para guardar los comentarios del post
     * principal cuando es un comentario de un post de una empresa
     * o que un usuario haya posteado en la empresa
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_subcomments_pulzo($data)
    {
        $this->db->insert('comentarios_planes', $data);
    }

    /**
     * Metodo que se usa para guardar los datos de los comentarios de los 
     * pulzos que el negocio haya hecho, esto para poder despues mostrarlos, ya 
     * sea al usuario en su perfil o al negocio y el mismo pueda tener replica
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function subcomments_save_data($data)
    {
        $this->db->insert('comentarios', $data);
    }

    /**
     * Metodo que se encarga de actualizar las coordenadas del
     * negocio para mostrar al usuario la ubicacion desde el google maps
     *
     * @params int id del negocio
     * @params array coordenadas del negocio a guardar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_coordenadas($id, $data)
    {
        $this->db->where('negocioId',$id);
        $this->db->update('negocios', $data);
    }

    /**
     * Metodo que se usa para conocer el numero de registros
     * en servicios, esto para saber si ya registro servicios
     * y si se muestran los valores o si se ponen los valores
     * por defecto con el cual se mostraran los radio button
     *
     * @params int id del negocio
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_register_service($id)
    {
        $this->db->where('serviciosNegocioId', $id);
        $int = $this->db->count_all_results('servicios');
        return $int;
    }

    /**
     * Metodo para obtener todos los registros que se tengan
     * por parte del negocio en cuanto a servicios se refiere,
     * esto para saber si se muestran los datos por default o si
     * se muestran los datos guardados
     *
     * @params int id del negocios
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_service($id)
    {
        $this->db->where('serviciosNegocioId', $id);
        $datos = $this->db->get('servicios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder guardar un registro nuevo en
     * los servicios que ofrece el negocio para que estos ya se
     * puedan ir mostrando en el perfil del negocios y tenerlos
     * registrados
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_services($data)
    {
        $this->db->insert('servicios', $data);
    }

    /**
     * Metodo para poder actualizar los registros del horario
     * del negocio, asi se veran reflejados los datos
     * en el perfil del mismo para que el usuario pueda ver o 
     * darse cuenta de algun cambio
     *
     * @params int id del negocio
     * @params string datos a actualizar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_hour($time, $id)
    {
        $this->db->where('negocioId', $id);
        $this->db->update('negocios', array('negocioHorario'=>$time));
    }

    /**
     * Metodo que se usa para poder actualizar los
     * registros en caso de que ya se tengan, asi
     * poder registrar los cambios que se tengan
     * ya en la plataforma
     *
     * @params int id del negocio
     * @params string dato a actualizar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_services($data, $id)
    {
        $this->db->where('serviciosNegocioId', $id);
        $this->db->update('servicios', $data);
    }

    /**
     * Metodo que se usa para guardar los datos de 
     * ubicacion que se vayan actualizando por parte
     * del negocio, esto para que el usuario conozca
     * la localidad donde se encuentran las mismas
     *
     * @params int id del negocio
     * @params mixed datos a actualizar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_ubication($data, $id)
    {
        $this->db->where('negocioId', $id);
        $this->db->update('negocios', $data);
    }


    public function get_followers($id)
    {
        $query = $this->db->query('select * from usuarios right join seguidores on seguidorUsuarioId = id where seguidorNegocioId = ' . $id . ' limit 6');
        return $query->result();
    }

    /**
     *
     *
     **/
    public function get_data_pulzos()
    {
        $query = $this->db->query('select * from usuarios right join pulzos on pulzoUsuarioId = id limit 5');
        return $query->result();
    }

    /**
     *
     **/
    public function count_albums($id)
    {
        $this->db->where('imagenNegocioAlbumId',$id);
        $query = $this->db->count_all_results('imagennegocios');
        return $query;
    }

    /**
     *
     **/
    public function get_data_albums($id)
    {
        $this->db->where('albumNegocioId', $id);
        $query = $this->db->get('albumsnegocios');
        return $query->row();
    }

    /**
     *
     *
     **/
    public function get_total_albums($id)
    {
        $this->db->where('albumNegocioId', $id);
        $query = $this->db->count_all_results('albumsnegocios');
        return $query;
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
     * Metodo que se usa para poder obtener lo datos de los
     * seguidores de los negocios que se utiliza para saber
     * si el usuario ya esta siguiendo el negocio o si el
     * usuario aun no sigue el negocio
     *
     * @params int id del negocio
     * @params int id del usuario
     *
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_count_follower($id, $idU)
    {
        $this->db->where('seguidorNegocioId', $id);
        $this->db->where('seguidorUsuarioId', $idU);
        $query = $this->db->count_all_results('seguidores');
        return $query;
    }

    /**
     *
     *
     **/
    public function get_invitations_pending($id, $val)
    {
        $this->db->where('invitacionEmpresaId', $id);
        $this->db->where('invitacionAceptado', $val);
        $query = $this->db->count_all_results('invitaciones');
        return $query;
    }

    /**
     * obtener todas las invitaciones del negocio como aceptadas
     *
     **/
    public function get_invitaciones_negocio($id)
    {
        $query = $this->db->query('select * from usuarios inner join invitaciones on invitacionUsuarioId = id or invitacionInvitadoId = id where invitacionEmpresaId = ' . $id . ' and invitacionAceptado = 1');
        return $query->result();
    }

    /**
     * contar todos los pulzos que vayan
     * poniendo los usuarios en general
     * si no hay poner que no hay pulzos
     **/
    public function get_count_pulzos_general()
    {
        $query = $this->db->count_all_results('pulzos');
        return $query;
    }

    /**
     * Metodo que se usa para poder obtener todos los datos referentes
     * al usuario para que se puedan despues obtener los comentarios de
     * los usuarios po de la empresa en el mismo post
     *
     * @params int id del plan
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_simple_pulzo($id)
    {
        $this->db->where('pulzoId', $id);
        $query = $this->db->get('pulzos');
        return $query->row();
    }

    /**
     * Obtener todas las empresas que cierto usuario followea. 
     * Lo más probable es que ya haya un método que lo haga... pero me da miedo 
     * buscar
     *
     * @param integer $id ID del usuario que buscar
     * 
     * @return mixed información de usuarios obtenida
     * @author axoloteDeAccion
     **/
    public function obtener_seguidores($id)
    {
        $this->db->select('*')
            ->from('negocios')
            ->join('seguidores', 'seguidores.seguidorNegocioId = negocios.negocioId', 'left')
            ->where('seguidores.seguidorUsuarioId = '.$id);

        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     **/
    public function get_pulzo_dias($dia){
        $this->db->select('invitacionInvitadoPersonalId, invitacionPersonalPlanId, planFechaInicio')
            ->from('planesusuarios')
            ->join('invitacionpersonal', 'invitacionpersonal.invitacionPersonalPlanId = planesusuarios.planId', 'inner')
            ->where('planFechaInicio = ' .$dia)
            ->group_by('invitacionInvitadoPersonalId');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     **/
    public function get_pulzo_semana($plan,$id)
    {
        $this->db->select('invitacionInvitadoPersonalId, invitacionPersonalPlanId, planFechaInicio')
                 ->from('planesusuarios')
                 ->join('invitacionpersonal', 'invitacionpersonal.invitacionPersonalPlanId = planesusuarios.planId', 'inner')
                 ->where('planFechaInicio = ' .$plan)
                 ->where('planEmpresaPulzoId',$id)
                 ->group_by('invitacionInvitadoPersonalId');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     **/
    public function get_pulzos_semanaAll($id){
        $fechaHoy=strftime("%Y-%m-%d");
            $hoy=unix_to_human(strtotime("$fechaHoy+1 day"));$cort=explode(' ',$hoy);$cor1=explode('-',$cort[0]);$anio=$cor1[0];$mes=$cor1[1];$dia=$cor1[2];$hoyStamp=mktime(0, 0, 0, $mes, $dia, $anio);
            $fechaWeek=explode(' ',unix_to_human(strtotime("+1 week +1 day")));$corte=explode('-',$fechaWeek[0]);$semanaStamp = mktime(0, 0, 0, $corte[1], $corte[2], $corte[0]);
            $this->db->select('*')
                ->from('planesusuarios')
                ->join('invitacionpersonal', 'invitacionpersonal.invitacionPersonalPlanId = planesusuarios.planId', 'inner')
                ->where('planFechaInicio BETWEEN "'.$hoyStamp.'" AND "'.$semanaStamp.'"')
                ->where('planEmpresaPulzoId',$id)
                ->group_by('planFechaInicio');
            $query = $this->db->get();
            return $query->result();
    }

    /**
     **/
    public function get_subgiro($id){
        $this->db->select('*')
        ->from('subcategorias')
        ->where('idGiro',$id);
         $query = $this->db->get();
         return $query->result();
    }

    /**
     **/
    public function insert_admin($post)
    {
        if($this->db->insert('pulzos', $post))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     **/
    public function insert_adminPlan($post)
    {
         if($this->db->insert('planesusuarios', $post))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
        
    }

    /**
     **/
    public function all_data($table)
	{
        return $this->db->get($table);
    }

   /**
    **/
   public function save_image($data)
   {
         $this->db->insert('imageneventos', $data);
         $return_data = $this->db->insert_id();
         return $return_data;
   }

   /**
    **/
   public function get_last_plan($id){
        $this->db->where('planImagenId',$id);
        $query = $this->db->get('planesusuarios');
        return $query->row();
   }

   /**
    **/
   public function update_imagenId($planIm,$planId,$idUsuario){
        $this->db->where('ImagenId',$planIm);
        $this->db->update('imageneventos', array('planesusuariosId'=>$planId));
        $this->db->delete('imageneventos', array('planesusuariosId'=>'0', 'idUsuario'=>$idUsuario));
   }

   /**
    **/
    public function getAwebo($aw=null)
    {
        $query = $this->db->query('SELECT usuarios.id FROM usuarios LEFT JOIN amigos ON usuarios.id = amigos.amigoUsuarioId WHERE statusEU=0 and amigoUsuarioId!="822" and amigoAmigoId!="822" GROUP BY id UNION ALL
         SELECT usuarios.id FROM usuarios LEFT JOIN amigos ON usuarios.id = amigos.amigoUsuarioId
            where statusEU=0 and amigoUsuarioId is null and amigoAmigoId is null GROUP BY id');
        return $query->result(); 
    }
    
    /**
     **/
    public function insertA($datos)
    {
            $this->db->insert('amigos',$datos);
            $return_data = $this->db->insert_id();
            var_dump($return_data);
            return $return_data;    
    }

	/**
	 *
	 *
	 **/
	public function estados_pais($id)
    {
        $result = $this->db->query('select * from estado where id_pais = ' . $id);
        return $result->result();
    }
    
    /**
     * Metodo que se usa para poder guardar los datos de un mensaje posicionado 
     * en la parte que una empresa lo desee con solo colocarlo en una posicion
     * especifica en el mapa de google maps, esto para que se puedan obtener 
     * las coordenadas donde se colocara el mensaje de publicidad
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_scribble_advertising($data)
    {
        $this->db->insert('scribbles_comments', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para poder obtener el total de publicaciones del negocio
     * en el area de los scribbles comments para que el negocio no publique mas de
     * una promocion o un mensaje, para conocer si tienen un comentario, entonces
     * se sustituya por el comentario nuevo
     *
     * @params int id del negocio como usuario
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_publications($id)
    {
        $this->db->where('scribbleUsuarioId', $id);
        $totales = $this->db->count_all_results('scribbles_comments');
        return $totales;
    }

    /**
     * Metodo que se usa para contar el total de registros que se usan en la 
     * parte de los scribbles de los negocios, para saber si se va a eliminar
     * o no se eliminaran los datos dependiendo si hay o no y asi evitar los 
     * errores
     *
     * @params int id del negocio como usuario
     * @return int total de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_scribble_specific($id)
    {
        $this->db->where('scribbleId', $id);
        $datos = $this->db->count_all_results('scribbles_comments');
        return $datos;
    }

    /**
     * Metodo que se usa para borrar los scribbles que se tienen actualmente en
     * la plataforma ligada al negocio, estas creadas desde la web para que se
     * puedan mostrar al usuario
     *
     * @params int id del scribble
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_scribble($idS)
    {
        $this->db->delete('scribbles_comments', array('scribbleId'=>$idS));
    }

    /**
     * Metodo que se usa para poder actualizar los datos de la publicacion real del
     * usuario en el murio virtual el cual es una forma de que los usuarios vean algun
     * mensaje de la empresa que les quiera comunicar a los visitantes o clientes
     *
     * @params mixed datos a actualiza
     * @params int id del negocio como usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_scribble_advertising($data, $id)
    {
        $this->db->update('scribbles_comments', $data, array('scribbleUsuarioId'=>$id));
    }

    /**
     * Metodo que se usa para poder eliminar los datos de las publicaciones reales en el
     * muro virtual pero por parte de la empresa, la cual se eliminara una vez que el usuario
     * ya no desee esa publicacion en el muro de la plataforma
     *
     * @params int id del negocio como usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_scribble_advertising($id)
    {
        $this->db->delete('scribbles_comments', array('scribbleUsuarioId'=>$id));
    }

    /**
     * Metodo que se usa para conocer los datos que se tienen en cuanto
     * a las notificaciones que se tienen por parte de la empresa para
     * que estas se muestres para el usuario
     *
     * @params int id del usuario
     * @return int total de datos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_notifications_company($id)
    {
    }

    /**
     * Metodo que se usa para poder dar las notificaciones de los mensajes
     * que ha recibido la empresa para que se de cuenta que tiene mensajes sin
     * leer de los cuales puede contestar
     *
     * @params int id del negocio
     * @return int numero de mensajes o notificaciones
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_messages_company($id)
    {
    }

    /**
     **/
    public function save_thumb($data)
    {
        $this->db->insert('imagenes_thumb', $data);
    }

    /**
     * Metodo que se usa para poder realizar la insercion de los valores de las 
     * promociones que se tienen actualmente creadas por la empresa desde la 
     * cual los usuarios podran ganar premios en caso de pasar la voz
     *
     * @params mixed datos a insertar
     * @return id de la insercion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_promotion($data)
    {
        $this->db->insert('tagging_promotions', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para guardar los datos nuevos de los
     * usuarios que se esten registrando a las diferentes redes sociales
     * y asi tener sus datos una vez que ya se hayan dado de alta
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_tokens_company($data)
    {
        $this->db->insert('social_media_empresa', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para guardar los datos de las ofertas de las empresas
     * en las cuales se podran observar los usuarios una vez que hayan hecho
     * la compra para la bonificacion de los puntos o del dinero del usuario
     *
     * @params mixed datos a insertar
     * @return int id de la oferta
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_ofert($data)
    {
        $this->db->insert('ofertas_negocios', $data);
        $value = $this->db->insert_id();
        return $value;
    }

    /**
     * Metodo que se usa para guardar en esta tabla el scribble del usuario y la
     * oferta a la cual se esta refiriendo el mismo, para saber cual es el descuento que
     * se hara una vez que el usuario haga su bonificacion del mismo
     *
     * @params mixed arreglo con datos a insertar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_tag_ofert($data)
    {
        $this->db->insert('geotag_oferta', $data);
    }

    /**
     * Metodo que se encarga de realizar la insercion de las tags que se tienen actualmente
     * pero con foto, esto para que el negocio pueda colocar una foto en su muro virtual
     * y al momento de ser escaneado con el celular se pueda visualizar desde ahi
     * e inclusive se pueda dejar un comentario de la foto
     *
     * @params mixed array data
     * @params string table name to insert
     * 
     * @return int id del register
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_datas_register($data, $name)
    {
        $this->db->insert($name, $data);
        return $this->db->insert_id();
    }

    /**
     * Method where the system update the status that the platform will check
     * once the user inside for first time, all this for accept the contract where
     * the user can create offerts and after can download the app
     * once accept the before step
     *
     * @params int status
     * @params int id
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status_activate($status, $id)
    {
        $this->db->update('negocios', array('negocioImagenId'=>$status), array('negocioId'=>$id));
    }

    /**
     * Method used for check the email of the company, in case the email exists
     * the platform send a message for notificate to the company that the email
     * was taken. If the email was taken the company will need to type or register
     * his profile with another diferent email
     *
     * @params string email
     * @return int total
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function countEmailSent($email)
    {
        $this->db->where('email', $email);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }
}
