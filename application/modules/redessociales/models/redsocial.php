<?php //if(! defined('BASEPATH')); exit('No script Direct Access Allowed');
/**
 * Modelo de las redes sociales los cuales se usan para
 * poder dar los accesos y las ligas para que se puedan guardar
 * todos los datos relacionados a las redes sociales y a las
 * bases de datos para lo mismo de social media y no se ya
 * que chingados estoy diciendo
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright Zavordigital, Sep 21, 2011
 * @package Social Media
 **/
class redSocial extends CI_Model{

    /**
     * Metodo constructor en el cual se pueden declarar
     * variables que se vayan a usar de manera global en la
     * plataforma
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
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
     * Metodo que se usa para poder actualizar los datos de la empresa
     * los cuales son necesarios y se usa para saber si ya esta registrado
     * esto para no ciclar registros y solo sea uno por usuario u empresa
     *
     * @params int id del negocio
     * @params mixed datos a actualizar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data_company($data, $id)
    {
        $this->db->update('social_media_empresa', $data, array('socialEmpresaId'=>$id));
    }

    /**
     * Metodo que se usa para obtener los datos de los usuarios
     * que esten actuamente en la base de datos para que estos se
     * puedan actualizar y el usuario ver reflejado esos
     * cambios en su previsualizacion final
     *
     * @params int id del negocio
     * @return mixed datos del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_current($id)
    {
        $this->db->where('idNegocioOferta', $id);
        $this->db->order_by('ofertaId', 'DESC');
        $this->db->limit(1);
        $datos = $this->db->get('ofertas_negocios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder obtener actualizar los datos
     * de las ofertas que las empresas esten colocando cada que 
     * se quiera colocar una nueva promocion en la misma, esto para que
     * se pueda tener en cuenta y hacer en automatico las bonificaciones
     * dependiendo la oferta que publico el negocio
     *
     * @params int id del mensaje a actualizar
     * @params mixed datos del mensaje
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data_oferts($data, $id)
    {
        $this->db->update('ofertas_negocios', $data, array('ofertaId'=>$id));
    }

    /**
     * Metodo que se usa para borrar los datos de los negocios en cuanto a la
     * parte donde se guardan los productos o las categorias con las cuales los
     * usuarios podran despues hacer sus bonificaciones, este metodo solo se
     * llamara en la parte del update de los datos de la oferta
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_products_category($id)
    {
        $this->db->delete('productos_categorias', array('idOfertas'=>$id));
    }

    /**
     * Metodo que se usa para guardar los datos de los negocios en cuanto a la
     * parte donde se guardan los productos o las categorias con las cuales los
     * usuarios podran hacer sus bonificaciones, este metodo solo se podra
     * llamar en la parte de actualizacion de los datos de la oferta
     *
     * @þarams mixed datos del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_products_category($data)
    {
        $this->db->insert('productos_categorias', $data);
    }

    /**
     * Metodo que se usa para poder conocer los registros de la empresa
     * que hay en la base de datos, esto para saber si realmente ya hay 
     * algun registro o tiene que se un registro nuevo
     *
     * @params int id del negocio
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_number_register($id)
    {
        $this->db->where('socialEmpresaUsuarioId', $id);
        $datos = $this->db->count_all_results('social_media_empresa');
        return $datos;
    }

    /**
     * Metodo que se usa para obtener los datos de las
     * empresas que ya estan registradas, pues si ya han agregado algun
     * mensaje, se necesita mostrar para que ellos ya decidan si lo cambian
     * o lo dejan como esta, es personal de la empresa esta parte
     *
     * @params int id del usuario
     * @return mixed datos a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_social_company($id)
    {
        $this->db->where('socialEmpresaUsuarioId', $id);
        $datos = $this->db->get("social_media_empresa");
        return $datos->row();
    }

    /**
     * Metodo en el modelo que se usa para obtener todos los datos de los
     * usuarios en redes sociales y el mensaje que se promovera para que
     * el mismo pueda ver que si se le bonifica pero primero tiene que hacer
     * la promocion del producto en la red social
     *
     * @params int id del usuario
     * @return mixed datos del usuario en red social
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_post($id)
    {
        $this->db->where('socialUsuarioId', $id);
        $datos = $this->db->get('social_media');
        return $datos->row();
    }

    /**
     * Method where the system update the status or the
     * flag of the post some value or message where block
     * the post since the user need to activate or activate again
     * the status press the button
     *
     * @params int id
     * @params int value
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status_post_user($id, $value)
    {
        $this->db->update('usuarios', array('usuariosStatusActivado'=>$value), array('id'=>$id));
    }

    /**
     * Metodo que se usa para obtener los datos de los mensajes que se
     * van a promocionar por parte del usuario hacia el negocio, esto para que
     * se pueda activar la bonificacion una vez que se postie pero antes se tienen que
     * sacar los mensajes y noc que chingados digo
     *
     * @params int id del negocio como negocio
     * @return mixed datos a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_promotion($id)
    {
        $this->db->where('socialEmpresaId', $id);
        $datos = $this->db->get('social_media_empresa');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder obtener los datos correspondientes a la oferta que se
     * tienen actualmente con la bonificacion que el usuario ha solicitado a la
     * empresa para que este pueda obtener el identificador de los mensajes a 
     * promover en las redes sociales
     *
     * @params int id de la oferta
     * @return mixed datos de la oferta
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_offerts($id_oferta)
    {
        $this->db->where('ofertaId', $id_oferta);
        $datos = $this->db->get('ofertas_negocios');
        return $datos->row();
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
     * Metodo que se usa para poder guardar los productos y
     * las categorias que se tienen dependiendo como seleccione el negocio
     * las ofertas que este publicando en su perfil y para que sean
     * validas las bonificaciones
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_products($data)
    {
        $this->db->insert('productos_categorias', $data);
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
                 ->where('notificacionLeido', '1');
        $total = $this->db->count_all_results();
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
            $query = $this->db->get('ciudad');
            return $query->row();
    }

    /**
     * Metodo que se usa para poder guardar los tokens que se tienen
     * de parte del usuario para poder aceptar las aplicaciones y asi
     * poder postear los mensajes de los negocios para las bonificaciones
     * se puedan hacer validas
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_tokens_user($data)
    {
        $this->db->insert('social_media', $data);
    }

    /**
     * Metodo que se usa para actualizar los datos en caso de que los mismos
     * ya existan y se quiera agregar una red social que no este
     * aun dada de alta, este metodo actualizara todos los campos
     * que se tengan al instante
     *
     * @params mixed datos a actualizar
     * @params int id del usuario
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data_user($data, $id)
    {
        $this->db->update('social_media', $data, array('socialUsuarioId'=>$id));
    }

    /**
     **/
	public function get_data_user($id)
    {
        $this->db->where('id',$id);
        $usuario = $this->db->get('usuarios');
        return $usuario->row();
    }

    /**
     * Metodo que se usa para poder obtener los datos
     * que se acaba de ingresar para que el usuario pueda corregir
     * los datos que ha puesto para su promocion
     *
     * @params int id del registro
     * @return mixed datos del registro mensajes
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_socialMedia($id)
    {
        $this->db->where('socialEmpresaId', $id);
        $datos = $this->db->get('social_media_empresa');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder obtener los datos que se
     * usan o que se han guardado en las ofertas que las empresas
     * han comenzado a crear para que los usuarios puedan
     * realizar sus bonificaciones
     *
     * @params int id de la oferta
     * @return mixed datos de la oferta
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_socialOferta($id)
    {
        $this->db->where('ofertaId', $id);
        $datos = $this->db->get('ofertas_negocios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para activar el o la oferta que el negocio comience
     * a dar de alta para que el mismo pueda saber que si esta abierta la promocion
     * o si no esta dada de alta pues se de cuenta que no esta aun activa esta
     * promocion y despues poder activarla
     *
     * @params int id de la promocion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status_promo($id, $status)
    {
        $this->db->update('ofertas_negocios', array('ofertaActivacion'=>$status), array('ofertaId'=>$id));
    }

    /**
     * Metodo que se usa para poder obtener toda la informacion de las
     * promociones que se han dado de alta o que se han activado por
     * parte del negocio, este metodo obtiene todos los datos del mismo
     * negocio que se tengan
     *
     * @params int id del negocio como negocio
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_information_promotions($id)
    {
        $this->db->where('idNegocioOferta', $id);
        $this->db->where('ofertaActivacion', '1');
        $datos = $this->db->get('ofertas_negocios');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder cambiar el estatus de los usuarios
     * con los cuales estos pueden ser a 2 para que no se elimine en 
     * si el registro y puedan despues en un futuro checar sus estadisticas
     * las cuales se podrna realizar las cosas desde cero
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_offert($id)
    {
        $this->db->update('ofertas_negocios', array('ofertaActivacion'=>'0'), array('ofertaId'=>$id));
    }

    /**
     * Metodo que se usa para poder actualizar los valores de los usuarios
     * que tienen sus notificaciones pendientes, esto en caso de que el
     * negocio haya aceptado los datos que el usuario mando para la bonificacion
     * de su cuenta
     *
     * @params int id de la bonificacion
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_bonifications_status($id)
    {
        $this->db->update('money_usuario', array('usuarioMoneyStatus'=>'1'), array('usuarioMoneyId'=>$id));
    }

    /**
     * Metodo que se encarga de obtener los datos de las bonificaciones y de 
     * las ofertas que se realizaron por parte de la empresa y que estan 
     * relacionadas con los usuarios, puesto que estos solo se usan para 
     * obtener reportes por parte de la empresa en un futuro
     *
     * @params int id de la bonificacion
     * @return mixed datos del arreglo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_data_bonifications_company($id)
    {
        $datos = $this->db->query('select * from money_usuario left join money_back on usuariosMoneyBackId = moneyBackId where usuarioMoneyId = ' . $id);
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar la consulta de los datos que sean necesarios
     * para poder insertar en la tabla de las comisiones en las cuales se llevaran a cabo
     * una vez que la empresa acepte las comisiones que se tienen por parte de la empresa
     * y asi conocer cuales son las transacciones que se han hecho correctamente o que
     * han finalizado con exito
     *
     * @params int id de la bonificacion
     * @return mixed datos a obtener
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_bonifications_all($id)
    {
        $this->db->where('moneyUsuarioId', $id);
        $datos_bonificacion = $this->db->get('comisionRecibida');
        return $datos_bonificacion->row();
    }

    /**
     * Metodo que se usa para la insercion de los valores de la comision que el corresponde
     * a la empresa encargada de sostener pulzos en linea, esto para saber cuales son las
     * bonificaciones que se estan haciendo y tambien para conocer cuales son las comisiones
     * que se van a cobrar
     *
     * @params mixed datos a insertar en comisiones
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_revenues($data)
    {
        $this->db->insert('comisionRecibida', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para poder postear en su muro, esto para que la compañia sepa que si
     * esta haciendo la publicacion de promocion por la bonificacion que ha solicitado se le
     * reintegre para que pueda usarse a su favor
     *
     * @params mixed datos a insertar en planesusuarios
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function insert_post_in_wall($data)
    {
        $this->db->insert('planesusuarios', $data);
    }

    /**
     * Metodo que se usa para poder contar los valores que hay en la
     * tabla del historial de la empresa para que se sepa si es necesario
     * insertar registro o no
     *
     * @params int id de la empresa
     * @params int timestamp fecha inicio
     * @params int timestamp fecha fin
     *
     * @return int numero de registros
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function count_all_register_history($id, $inicio, $fin)
    {

        $this->db->where('historialEmpresaId', $id);
        $this->db->where('historialFechaInicio', $inicio);
        $this->db->where('historialFechaFin', $fin);
        $datos = $this->db->count_all_results('historialDeposito');
        return $datos;
    }

    /**
     * Metodo que se usa para guardar los datos nuevos en la tabla de historial
     * para que la empresa pueda hacer los calculos y visualizaciones de todos
     * los depositos que tienen que realizar o los impactos que ha tenido la
     * empresa con los usuarios
     *
     * @params mixed datos a insertar
     * @return int id de la insercion
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function saveNew_history($data)
    {
        $this->db->insert('historialDeposito', $data);
        return $this->db->insert_id();
    }

    /**
     * Metodo que se usa para actualizar los datos de los historiales de en cuanto a las
     * cantidades que deben ir dependiendo todos los registros de los historiales y las
     * ventas de los mismos para que sea solo un registro y no 10
     *
     * @params int id de la empresa
     * @params int dato a actualizar
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_data_history($data, $id)
    {
        $this->db->update('historialDeposito', array('historialTotalQuincenal'=>$data),array('idHistorial'=>$id));
    }

    /**
     * Metodo que se usa para poder realizar los datos del historial que se esta consultando
     * en la parte de la insercion de los nuevos datos de los usuarios, con los cuales se
     * podran actualizar los datos de los usuarios los cuales son los que se van a utilizar
     * en la insercion de otras cosas o para actualizarlso mejor dicho
     *
     * @params int id de la empresa
     * @params int fecha inicio
     * @params int fecha fin
     *
     * @return mixed datos del historial
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_history_row($id, $inicio, $fin)
    {
        $this->db->where('historialEmpresaId', $id);
        $this->db->where('historialFechaInicio', $inicio);
        $this->db->where('historialFechaFin', $fin);
        $datos = $this->db->get('historialDeposito');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder realizar la actualizacion de los registros que se han
     * hecho de parte de las ofertas de las empresas, esto para que quede la ultima oferta
     * que se ha creado como activa, asi ya no habra confusion al momento de dar la bonificacion
     * y se sabra cual es la oferta que se dara
     *
     * @params int id del negocio
     * @params int status a cambiar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_all_status_promo($id_negocio, $status)
    {
        $this->db->update('ofertas_negocios', array('ofertaActivacion'=>$status), array('idNegocioOferta'=>$id_negocio));
    }

    /**
     * Metodo que se usa para obtener los datos de las ofertas que estan por el momento activas por
     * parte de la empresa en la cual el usuario puede aprovechar las mismas que son promociones
     * en las cuales se podra percibir algo de dinero si asi lo marca la promocion
     *
     * @params int id del negocio
     * @return mixed datos con coincidencias
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_data_promotions($id)
    {
        $this->db->where('idNegocioOferta', $id);
        $this->db->where('ofertaActivacion != 0');
        $this->db->order_by('ofertaId', 'DESC');
        $datos = $this->db->get('ofertas_negocios');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder actualizar los registros de forma
     * que quede desactivada la oferta por un momento sin necesidad
     * de eliminarla para que el negocio no la vuelva a crear, esto si
     * se vuelve a activar de forma que quede funcional de nueva cuenta
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_ofert_desactivate($id)
    {
        $this->db->update('ofertas_negocios', array('ofertaActivacion'=>'2'), array('ofertaId'=>$id));
    }

    /**
     * Metodo que se usa para poder actualizar los registros de forma que
     * quede activada la oferta de nueva cuenta y asi el usuario pueda visualizar
     * las promociones una vez que quieran aprovechar las ofertas que esta ofreciendo el
     * negocio y los usuarios puedan aprovecharlas
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_ofert_activate($id)
    {
        $this->db->update('ofertas_negocios', array('ofertaActivacion'=>'1'), array('ofertaId'=>$id));
    }

    /**
     * Metodo que se usa para poder obtener todos los pulzos y las geo etiquetas que
     * esten relacionadas con la oferta que se estan dadas de alta con la actual promocion
     * que se esta a punto de quitar de este desmadre
     *
     * @params int id de la oferta
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_geooffert($id)
    {
        $this->db->where('ofertaOId', $id);
        $datos = $this->db->get('geotag_oferta');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder activar o desactivar los scribbles de los negocios con 
     * sus ofertas, estos asi se podran visualizar o se podran realizar los cambios necesarios
     * que sean requeridos por los usuarios en los cuales se podran activar o desactivar y ya
     * no se que vergas digo
     *
     * @params int id del scribble
     * @params int status
     * 
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function update_status_scribble($idS, $status)
    {
        $this->db->update('scribbles_comments', array('scribbleStatus'=>$status), array('scribbleId'=>$idS));
    }

    /**
     * Metodo que se usa para poder obtener los valores restantes de los mensajes que
     * se necesitan eliminar por parte de la empresa, estos debido a que no es necesario de que
     * se signa mostrando estos mensajes ni en el scribble ni en la plataforma que se tiene
     * por el momento, ya que seran eliminados
     *
     * @params int id del scribble
     * @return mixed datos del registro que coincida
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_planusergeo($idS)
    {
        $this->db->where('planScribbleId', $idS);
        $datos = $this->db->get('planesusuarios');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder eliminar los registros de la base de datos que
     * ya nos e llevaran a cabo para que el usuario ya no pueda visualizarlos y el negocio no
     * pueda ya activar las ofertas puesto que eliminadas tiene que crear otras
     *
     * @params string nombre de la tabla
     * @params string nombre del campo
     * @params string id a eliminar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_data_showing($tabla, $campo, $idE)
    {
        $this->db->delete($tabla, array($campo=>$idE));
    }

    /**
     * Metodo que se usa para poder obtener todos los datos de los scribbles que seran
     * los post de los usuarios en las redes sociales, asi sabremos si trae algun mensaje o
     * un link con el cual se posteara como anexo en la parte de la red social por parte de
     * los usuarios
     *
     * @params int id del scribble
     * @return mixed datos del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_links_socialmedia($id)
    {
        $this->db->where('scribbleId', $id);
        $datos = $this->db->get('scribbles_comments');
        return $datos->row();
    }

    /**
     * Metodo que se usa para poder obtener los datos de la primer bitacora
     * la cual se usa para conocer cuales son los usuarios que guardaron los
     * datos de los posteos, esto es una vez que ya hayan aceptado la publicacion
     * del mensaje del usuario en sus redes sociales en las cuales esta suscrito
     *
     * @params int id de la bonificacion
     * @return mixed datos del arreglo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_bitacora_data($id)
    {
        //$this->db->where('bitacoraMoneyUsuario', $id);
        $this->db->where('bitacoraId', $id);
        $datos = $this->db->get('bitacora_uno');
        return $datos->row();
    }

    /**
     * Metodo que se usa para insertar todos los datos de la
     * bitacora numero dos en la cual los datos son para tener
     * un respaldo de que mensaje se publico y cual fue el que se
     * guardo esto correctamente
     *
     * @params mixed arreglo a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_bitacora_dos($data)
    {
        $this->db->insert('bitacora_dos', $data);
    }

    /**
     * Metodo que se usa para eliminar de la base de datos los valores
     * de los tokens, los cuales se usan para poder realizar publicaciones
     * desde las plataformas como lo es pulzos
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_facebook_tokens($id)
    {
        $this->db->update('social_media', array('tokenFacebook'=>''), array('socialUsuarioId'=>$id));
    }

    /**
     * Metodo que se usa para poder eliminar o actualizar los datos de los
     * usuarios con los cuales estos podran borrar los tokens del twitter
     * para que no se puedan realizar publicaciones desde aqui
     *
     * @params int id del usuario
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete_twitter_tokens($id)
    {
        $this->db->update('social_media', array('twitter_oauth'=>'', 'twitter_oauth_secret'=>''), array('socialUsuarioId'=>$id));
    }

    /**
     * Metodo que se usa para poder guardar las bonificaciones
     * aceptadas por parte del negocio y que el usuario ya no
     * pueda volver a pulzar la bonificacion las veces que se le
     * pegue la regalada gana y haga dinero con eso.
     *
     * @params array data to insert
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_bonification_ie($data)
    {
        $this->db->insert('bonificaciones_ie', $data);
    }

    /**
     * Method used for get all the data of the company once
     * pass the id of the company like company. Once pass this 
     * data, the system can receive all the data of the company
     *
     * @params int id
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_company_by_id($id)
    {
        $this->db->where('negocioId', $id);
        $data = $this->db->get('negocios');
        return $data->row();
    }

    /**
     * Method where the system save the inbox where the user can
     * receive an inbox just like notification where the user
     * can check that by post a message in facebook or twitter, the
     * user received a discount in his/her final total
     *
     * @params mixed array
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_inbox_default($data)
    {
        $this->db->insert('inboxn', $data);
        return $this->db->insert_id();
    }

    /**
     * Method where the system save the bitacora uno for get a register 
     * of the moviment in the platform, where can get all the data
     * and backups about the transactions
     *
     * @params mixed array
     * @return int id
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function saveBitacoraUno($data)
    {
        $this->db->insert('bitacora_uno', $data);
        return $this->db->insert_id();
    }
 }
