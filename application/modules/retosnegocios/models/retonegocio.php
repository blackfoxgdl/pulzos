<?php
/**
 * Modelo en el cual se crearan las consultas
 * de insercion, actualizacion, eliminacion
 * y reservacion de la parte de retos, con la cual
 * se manipularan los datos de la parte de retos
 * del negocio.
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
class retoNegocio extends CI_Model{

    /**
     * Constructor del modelo, donde se pueden
     * inicializar valores a usar en esta clase
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
        $this->table = "pulzos";
    }

    /**
     * Funcion que se usa para guardar los datos del
     * reto en la tabla de pulzos, estos se diferenciaran
     * por un status que se manejara en esta tabla
     *
     * @params mixed datos a guardar
     * @return flag
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($data)
    {
        if($this->db->insert($this->table, $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que se usa para poder guardar los datos en la tabla de
     * planes de usuario para que aparescan los post en los perfiles
     * de los usuarios para que estos los puedan ver
     * y estar observando los pulzos del negocio
     *
     * @params mixed datos a guardar
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save_comments_in_plains($data)
    {
        $this->db->insert('planesusuarios', $data);
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
     * Funcion que se encarga de mostrar todos los retos que
     * han puesto los negocios, para que los usuarios puedan tomar
     * estas ofertas de reaccion inmediata
     *
     * @params int id del negocio
     * @params int tipo de pulzo
     *
     * @return mixed datos del pulzo o pulzos hechos por la empresa
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_tipo_pulzos($id, $tipo)
    {
        $this->db->where('pulzoUsuarioId',$id);
        $this->db->where('pulzoTipo',$tipo);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Metodo o funcion que se encarga de eliminar los retos
     * que han sido registrados por la empresa y ya no desea
     * tenerlos porque o ya paso mucho tiempo o ya estan fuera 
     * de moda
     *
     * @parmas int id del negocio
     * @return void
     * @author blackfoxgdl
     **/
    public function delete($id)
    {
        if($this->db->delete($this->table, array('pulzoId'=>$id)))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Metodo que estraera los datos del pulzo para mostrarlo
     * individualmente sin necesidad de ver todos los demas
     * pulzos, asi se mostrara con mas detalle
     *
     * @params int id del pulzo
     * @return mixed datos del pulzo
     * @author blackfoxgdl <rubne.alonso21@gmail.com>
     **/
    public function get_data_pulzo($id)
    {
        $query = $this->db->query("select * from pulzos left join negocios on pulzoUsuarioId = negocioId where pulzoId=".$id." and pulzoTipo = 1");
        return $query->row();
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
     * una vez que se presiona el link de ver mas, esto para poder
     * obtener los datos y mostrarlos a los usuarios limitado a 
     * solamenten un numero de registros
     *
     * @params int id del negocios
     * @params int numero del ultimo registro mostrado
     * 
     * @return mixed datos de los retos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_next_ten_challenges($id, $num)
    {
        $querys = $this->db->query('select * from pulzos right join negocios on negocioId = pulzoUsuarioId where pulzoUsuarioId = ' . $id . ' and pulzoTipo = 1 and pulzoId < ' . $num . ' order by pulzoId DESC limit 10');
        return $querys->result();
    }

    /**
     * Metodo que se encarga de obtener todos los retos que se
     * tienen registrados en la bd por medio de las empresas esto
     * para poder mostrarlos en el muro de los usuarios. Por el
     * momento son de todas las empresas habidas y por haber
     *
     * @return mixed datos de los retos que se tengan
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_all_retos()
    {
        $this->db->where('pulzoTipo', '1');
        $this->db->order_by('pulzoId', 'desc');
        $query = $this->db->get('pulzos');
        return $query->result();
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
