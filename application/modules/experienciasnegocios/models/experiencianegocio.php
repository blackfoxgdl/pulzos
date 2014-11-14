<?php
/**
 * Modelo el cual se usa para tener todas las
 * funciones que se necesitaran para maniular 
 * los datos a ingresar y mostrar de la 
 * base de datos por medio de experiencias
 * de vida que el negocio proponga a los usuarios
 *
 * @versio 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 9, 2011
 * @package experienciasNegocios
 **/
class experienciaNegocio extends CI_Model
{

    /**
     * Constructor, es el metodo donde se pueden
     * inicializar las variables para que puedan ser
     * manipuladas dentro de las funciones que se
     * declaren dentro de esta clase
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "pulzos";
    }

    /**
     * Metodo que se usara para guardar las nuevas
     * experiencias de vida que el negocio desee registrar
     * y ponerlas a disposicion de los usuarios
     *
     * @params mixed datos de al experiencia de vida a guardar
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($data)
    {
        if($this->db->insert($this->table_name, $data))
        {
            $id = $this->db->insert_id();
            return $id;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder guardar los datos de los
     * usuarios en la tabla de planes para poder mostrar
     * los comentarios o post del negocio en la tabla del
     * usuario
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_plains_data($data)
    {
        $this->db->insert('planesusuarios', $data);
    }

    /**
     * Metodo que se encarga de eliminar la experiencia de
     * negocio que ya paso de tiempo o que vencio, o 
     * incluso que el negocio se equivoco al promocionarla
     *
     * @params int id del negocio
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($id)
    {
        if($this->db->delete($this->table_name, array('pulzoUsuarioId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se encargara de mostrar todos los datos
     * que los usuarios tengan, por medio de un id que se veran asi
     * todos los tipo de experiencias se tienen
     *
     * @params int id del negocio
     * @params int id del tipo de pulzo
     *
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_experiencias($id, $tipo)
    {
        
        $this->db->where('pulzoUsuarioId',$id);
        $this->db->where('pulzoTipo',$tipo);
        $query = $this->db->get($this->table_name);
        return $query->result();
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
     * Metodo que se usa para poder obtener los registros de las siguientes 10
     * publicaciones para poder mostrarselos a los usuarios, pero estos solamente
     * seran del negocio
     *
     * @params int id del negocio
     * @params int numero de la ultima publicacion
     *
     * @return mixed datos de las experiencias
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_next_ten_experience($id, $num)
    {
        $experiencias = $this->db->query('select * from pulzos right join negocios on negocioId = pulzoUsuarioId where pulzoUsuarioId = ' . $id . ' and pulzoTipo = 2 and pulzoId < ' . $num . ' order by pulzoId DESC limit 10');
        return $experiencias->result();
    }

    /**
     * Metodo que estraera los datos del pulzo para mostrarlo
     * individualmente sin necesidad de ver todos los demas
     * pulzos, asi se mostrara con mas detalle
     *
     * @params int id del pulzo
     * @return mixed datos del pulzo
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_experiencia($id, $tipo)
    {
        $query = $this->db->query("select * from pulzos left join negocios on pulzoUsuarioId = negocioId where pulzoId=".$id." and pulzoTipo=".$tipo);
        return $query->row();
    }

    /**
     * Metodo que se encarga de guardar las etiquetas
     * de los negocios que pongan en cada experiencia
     * de vida para cuando los usuarios busquen alguna de
     * las mismas, sean seleccionadas por medio de una nube
     * de etiquetas
     *
     * @params string nombre del negocios
     * @return flag
     * @author blaclfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_tag($str, $str2)
    {
        if($this->db->insert('etiquetas', array('nombre'=>$str, 'idNegocio'=>$str2)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se encarga de mostrar las etiquetas que
     * se tienen registradas por todas las empresas en las cuales
     * los usuarios podran buscar las experiencias de su interes
     *
     * @params string nombre de la palabra a buscar
     * @return mixed datos de los pulzos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_etiquetas($str)
    {
        $query = $this->db->query("select * from pulzos right join etiquetas on idNegocio = pulzoId where nombre = '" . $str . "' order by pulzoId DESC");
        return $query->result();
    }

    /**
     * Metodo que se encarga de obtener todas las etiquetas que se tienen
     * en las bases de datos y no solo limitarlo al numero
     * pequeños que se mostraran en la barra lateral derecha
     *
     * @return mixed datos de las etiquetas
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_tags()
    {
        $this->db->group_by('nombre');
        $query = $this->db->get('etiquetas');
        return $query->result();
    }
    /**
     * Funcion con la cual se obtendran todos los datos
     * del negocio para manipularlos en la vista de los
     * retos
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_data($id)
    {
        $this->db->where('negocioId',$id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Metodo que se usa para guardar el comentario de la experiencia
     * de vida que el usuario este interesado y este comentando, esto
     * para que se pueda observer en un futuro
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruebn.alonso21@gmail.com>
     **/
    public function save_comment($post)
    {
        $this->db->insert('comentarios', $post);
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
}
