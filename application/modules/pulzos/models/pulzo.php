<?php
/**
 * Acceso a la tabla de pulzos en la DB
 * TODO: todos los metodos retornan true. No hay validación
 *
 * @author axoloteDeAccion y blackfoxgdl
 * @version 0.1
 * @copyright Zavordigital, 10 March, 2011
 * @package Pulzos
 **/
class Pulzo extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'pulzos';
    }

    /**
     * Nuevo pulzos a Base de datos
     *
     * @param mixed $data Datos a guardar
     * @param string $condition condición a obedecer en caso de update
     *
     * @return bool Bandera éxito
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save($data, $condition=null)
    {
        if($condition)
        {
            $this->db->update($this->table_name, $data, $condition);
        }else{
            $this->db->insert($this->table_name, $data);
        }
        return $this->db->insert_id();
    }

    /**
     * Obtener los pulzos con su información relevante
     *
     * Joinear con usuarios, albums e imagenes (para el avatar) y creo que ya.
     *
     * @param string $condition condición a obedecer en caso de ser necesario
     *
     * @return mixed Array de objetos con los resultados
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get($condition=null, $tipoValor)
    {
        $this->db->select('negocios.*, pulzos.*')
            ->from('pulzos')
            ->join('negocios', 'pulzos.pulzoUsuarioId = negocios.negocioId', 'left');
        if($condition)
        {
            $this->db->where('pulzoUsuarioId',$condition);
        }else{
            $this->db->where('1 = 1');
        }
        $this->db->where('pulzoTipo', $tipoValor);
        $this->db->order_by('pulzos.pulzoId', 'desc');
        $this->db->limit(10);
        $Q = $this->db->get();
        return $Q->result();
    }

    /**
     * Metodo que se usa para poder obtener los siguientes 10 registros
     * que se tienen que mostrar una vez que se presiona el boton de ver mas
     * para que el usuario pues visualizarlos con esta consulta pero ademas
     * se pueda actualizar el ultimo registro mostrado
     *
     * @params int id del usuario
     * @params int numero del ultimo registro mostrado
     *
     * @return mixed datos del registro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_next_ten_to_show($id, $num)
    {
        $registros = $this->db->query('select * from pulzos right join negocios on negocioId = pulzoUsuarioId where pulzoUsuarioId = ' . $id . ' and pulzoTipo = 0 and pulzoId < ' . $num . ' order by pulzoId DESC limit 10');
        return $registros->result();
    }

    /**
     * Metodo que se usara para borrar un pulzo de la empresa,
     * esta opcion solamente sera visible para el dueño del
     * perfil del negocio o empresa
     *
     * @param integer $id Id del pulzo a borrar
     * @return bool success flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->where('pulzoId = '.$id);
        $this->db->delete($this->table_name);
        return true;
    }

    /**
     * Se obtiene los datos de un pulzo especifico que se
     * desea ver o llamo la atencion de un usuario para
     * poder tomar en cuenta esa promocion
     *
     * @params int id del pulzo
     * @return mixed datos del pulzo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_pulzo($id)
    {
        $query = $this->db->query("select * from pulzos left join negocios on pulzoUsuarioId = negocioId where pulzoId=".$id." and pulzoTipo=0");
        return $query->row();
    }

    /**
     * Se obtienen los datos del usuario que esta viendo
     * sus pulzos, pues este solo puede ver todos como una
     * lista
     *
     * @params int id del usuario
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_company($id)
    {
        $this->db->where('negocioId',$id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Se obtienen los datos de la localizacion
     * del usuario, como lo es la ciudad y el
     * pais donde residen actualmente
     *
     * @params int id del pais o ciudad
     * @params string nombre de la tabla 'pais o ciudad'
     *
     * @return mixed datos del pais o ciudad
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Se guardan los datos en la tabla de comentarios
     * de la informacion que ponga el usuario de cada comentario en
     * los pulzos que se tienen
     *
     * @params mixed datos del comentario a guardar
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_comment($data)
    {
        if($this->db->insert('comentarios', $data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se encarga de guardar los post de los
     * pulzos que creen las empresas para poder
     * mostralos a los usuarios en la barra lateral derecha y con opciones
     * a ver todos los pulzos o solo uno individual
     *
     * @params string datos a guardar del pulzo
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_post($post)
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
     * Metodo que se usa para poder guardar los pulzos
     * de los usuarios en la plata de planes para que se puedan
     * mostrar al usuario y al negocio, tomando que es la tabla
     * pivote de todos
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_plain_comment($data)
    {
        $this->db->insert('planesusuarios', $data);
    }

    /**
     * Metodo que se encarga de obtener todos los pulzos que tienen las empresas,
     * solo los pulzos, esto significa que tengan los status en cero y asi
     * poder mostrarlos a todos los usuarios de la plataforma
     *
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_pulzos()
    {
        $this->db->where('pulzoTipo','0');
        $this->db->order_by('pulzoId','desc');
        $query = $this->db->get('pulzos');
        return $query->result();
    }

    /**
     * Metodo que se usa para obtener los inbox de los negocios
     * para poderlos mostrar en el header como las alertas que hay
     * de neuvos mensajes en el inbox del negocio
     *
     * @params int id del negocio
     * @params int status del negocio en inbox
     *
     * @return int numero de mensajes sin leer
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function inbox_company_total($id, $status)
    {
        $this->db->where('inboxnUsuarioRecibeId', $id);
        $this->db->where('inboxnStatus', $status);
        $query = $this->db->count_all_results('inboxn');
        return $query;
    }

    /**
     * Metodo que se encarga de obtener las subcategorias
     * con las cuales se podran categorizar lso pulzos
     *
     * @return mixed datos de las categorias
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_subcategories()
    {
        $query = $this->db->get('subcategorias');
        return $query->result();
    }

    /**
     * Metodo que se encarga de obtener los pulzos para poder
     * mostrar los datos de los pulzos que esten subcategorizados
     * asi mantenerlos divididos sin problemas
     *
     * @params int id de la subcategoria
     * @return mixed datos del usuario
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_pulzo_by_subcategory($id)
    {
        $query = $this->db->query('select * from negocios left join subcategorias on negocioGiro = idGiro where id = ' . $id . " and negocioSubgiro = " . $id);
        return $query->result();

    }

    /**
     * Metodo que se usa para obtener los datos de los
     * pulzos especificos para poner lo que se refiere
     * al header de los pulzos y demas cosas, se saca el 
     * valor de las categorias que se dan
     *
     * @params int id de la categoria
     * @return mixed datos de la categoria
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_subcategory($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('subcategorias');
        return $query->row();
    }

    /**
     * Metodo que se usa para obtener el nombre del 
     * giro que se tiene en el momento que se vea
     * la pura subcategoria
     *
     * @params int id del giro
     * @return mixed datos del giro
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_giro($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('giro');
        return $query->row();
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
     * Metodo que se usa para poder realizar las consultas de los pulzos
     * que hay por dia en cuanto a las actividades de los usuarios se 
     * tienen para que los puedan ver categorizados
     *
     * @params int id de la subcategoria
     * @params date fecha de inicio
     * @params date fecha de fin
     *
     * @return mixed datos a visualizar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_by_day($id, $fecha_ini, $fecha_fin)
    {
        $between = "pulzoFechaInicio between '$fecha_ini%' and '$fecha_fin%'";
        $this->db->where('pulzoSubcategoria', $id);
        $this->db->where($between, NULL, FALSE);
        $this->db->order_by('pulzoId', 'DESC');
        $datos = $this->db->get('pulzos');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder realizar las consultas de los pulzos
     * que hay por semana en cuanto a las actividades de los usuarios se 
     * tienen para que los puedan ver categorizado
     *
     * @params int id de la subcategoria
     * @params date fecha en timestamp o mktime
     * @params date fecha fin en timestamp o mktime
     *
     * @return mixed datos a mostrar de los pulzos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_by_week($id, $fecha_ini, $fecha_fin)
    {
        $between = "pulzoFechaInicio between '$fecha_ini%' and '$fecha_fin%'";
        $this->db->where('pulzoSubcategoria', $id);
        $this->db->where($between, NULL, FALSE);
        $this->db->order_by('pulzoId', 'DESC');
        $datos = $this->db->get('pulzos');
        return $datos->result();
    }

    /**
     * Metodo que se usa para poder realizar las consultas de los pulzos que
     * se tendran por mes en cuanto a las actividades que el usuario podra realizar
     * o que la empresa o negocio ofrece mensual
     *
     * @params int id de la subcategoria
     * @params date fecha timestamp o mktime
     * @params date fecha fin timestamp o mktime
     *
     * @return mixed datos de pulzos mensual
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data_by_month($id, $fecha_ini, $fecha_fin)
    {
        $between = "pulzoFechaInicio between '$fecha_ini%' and '$fecha_fin%'";
        $this->db->where('pulzoSubcategoria', $id);
        $this->db->where($between, NULL, FALSE);
        $this->db->order_by('pulzoId', 'DESC');
        $datos = $this->db->get('pulzos');
        return $datos->result();
    }
}
