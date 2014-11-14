<?php
/**
 * Modelo relacionado para las operaciones de
 * la base de datos en la cual se guardaran la
 * informacion de los pulzos que la empresa este haciendo
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 30 April, 2011
 * @package Pulzos de Negocios
 **/
class Pulzoneg extends CI_Model
{
    /**
     * @ignore 
     * Estructura de la tabla de pulzosneg:
     * pulzosnegId: int not null primary key auto-increment
     * pulzosnegNegocioId: int not null
     * pulzosnegAccion: varchar (400) not null
     * pulzosnegFechaCreacion: timestamp int not null
     **/

    /**
     * Constructor donde se declaran las
     * cosas que se usaran en el modelo
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/

    public function __construct()
    {
        parent::__construct();
        $this->table_name = "pulzosneg";
    }

    /**
     * Metodo que se usa para guardar o actualizar la
     * informacion de los pulzos dependiendo los parametros
     * que se vayan a pasar cada vez que se mande a llamar
     * este metodo.
     *
     * @params mixed arreglo de datos a guardar o actualizar
     * @params string condicion a usar en caso de actualizar
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function save($data, $condition=null)
    {
        if($condition)
        {
            $this->db->update($this->table_name, $data, $condition);
        }
        else
        {
            $this->db->insert($this->table_name, $data);
        }
    }

    /**
     * Metodo para obtener todos los pulzos que
     * ha realizado el negocio para ofrecer los
     * servicios que  tienen. Este metodo los muestra en
     * el muro o perfil de empresas
     *
     * @params condicion en caso de que se requiera buscar solo
     *         un registro
     *
     * @return mixed datos de los pulzos de negocios a mostrar
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get($condition=null)
    {
        $this->db->select('usuarios.*, pulzosneg.*')
                 ->from('pulzosneg')
                 ->join('usuarios','pulzosneg.pulzosnegNegocioId = usuarios.id','left');
        if($condition)
        {
            $this->db->where($condition);
        }
        else
        {
            $this->db->where('1 = 1');
        }
        $this->db->order_by('pulzosneg.pulzosnegId','desc');
        $N = $this->db->get();
        return $N->result();
    }

    /**
     * Metodo que se encarga de borrar las
     * ofertas o pulzos de los negocios
     * dependiendo el id que se pase
     *
     * @params int id de la oferta a eliminar
     *
     * @return flag verdadero en caso de exito
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->where('pulzosnegId', $id);
        $this->db->delete($this->table_name);
        return TRUE;
    }

    /**
     * Se recuperar todos los datos de la empresa para
     * poder mostrar varios de estos en le mapa de sitio,
     * asi el usuario que visita la empresa o el dueño
     * del negocio conocera donde esta navegando actualmente
     * en la plataforma
     *
     * @params int id del negocio
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_bussines_data($id)
    {
        $this->db->where('negocioUsuarioId',$id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Se obtienen los datos de la empresa como son el giro,
     * pais y ciudad para mostrarlos en el mapa de sitio
     * una vez que se este visitando una seccion dentro de la
     * empresa.
     *
     * @params int id del pais, ciudad o giro
     * @params string nombre de la tabla
     *
     * @return mixed datos del negocio
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_location($id, $table)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * Se obtienen los datos de las empresasa con los cuales
     * se puedes mostrar y guardar en la tabla de los pulzos para
     * saber cual es el id de la empresa que esta pulzando y no
     * tener problemas con eso.
     *
     * @params int id de la empresa (sesion)
     * @return mixed datos de la empresa
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_bussines($id)
    {
        $this->db->where('negocioUsuarioId', $id);
        $query = $this->db->get('negocios');
        return $query->row();
    }

    /**
     * Metodo que se usa para obtener el pulzos que se 
     * quiere visualizar asi como los datos de la empresa
     * que lo esta ofertando
     *
     * @params int id del pulzo
     * @return mixed datos del pulzo y empresa
     * @author blackfoxgdl <ruben.alonso21@gmail>
     **/
    public function get_pulzo_negocio($id)
    {
        $query = $this->db->query('select * from pulzosneg right join negocios on negocioUsuarioId = pulzosnegNegocioId where pulzosnegId = ' . $id);
        return $query->row();
    }
}
