<?php
class Mapa extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(){
        $total = $this->db->get('mapas');
        if($total->num_rows() > 8)
        {
            $this->db->empty_table('mapas');
        }else{
            $this->db->insert('mapas', array('mapasCounter'=>1));
        }
    }

    public function get()
    {
        $data = $this->db->get('mapas');
        return $data->num_rows();
    }
}
