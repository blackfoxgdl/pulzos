<?php
/**
 * Model for the Apps module
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 22 February, 2011
 * @package Apps
 **/

class App extends CI_Model{

    /**
     * TODO: Verify this ORM'ing works at all
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store new app data.
     * 
     * @param mixed post data to store
     * @param string condition to check record to update in case needed
     *
     * @return bool success flag
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function save($post, $condition=Null)
    {
        if($condition == Null){
            $this->db->insert('apps', $post);
        }else{
            $this->db->update('apps', $post, $condition);
        }       
        return true;
    }

    /**
     * get all app records
     * 
     * @param integer id of the app to get. if not set return every app on 
     * record
     *
     * @return mixed App records in the DB from a given user
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/

    public function get($id = null){
        //Prepare the query
        $this->db
            ->select('apps.*, usuarios.*')
            ->from('apps')
            ->join('usuarios', 'apps.appUsuarioId=usuarios.id', 'left');

        //Verify if $id param isset
        if($id == Null){
            //Get every record from DB
            $Q = $this->db->get();
        }else{
            //Add a where clause
            $this->db->where('apps.appId', $id);
            $Q = $this->db->get();
        }

        //Check if there is something to return
        if($Q->num_rows() == 1){
            return $Q->row();
        }else if($Q->num_rows() > 1){
            return $Q->result();
        }else{
            return false;
        }
    }

    /**
        * This breaks the paradigm. But it's faster than 
        * finding out how to call somewhere else.
        *
        * @param integer ID of the logged in user.
     *
     * @return mixed logged in user data
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_usuario($id)
    {
        $Q = $this->db->get_where('usuarios', array('id'=>$id));
        return $Q->row();
    }

    /**
     * Deletes a record
     * TODO: Add some form of validation
     *
     * @return bool success flag
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function delete($id)
    {
        $this->db->delete('apps', array('appId'=>$id));
        return true;
    }
}
