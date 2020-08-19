<?php

class Role_model extends CI_Model{
	function get_all(){
		return $this->db->get('role')->result_array();
	}

	public function delete($id)
    {
        $this->db->delete('role', ['role_id' => $id]);
    }

}


?>