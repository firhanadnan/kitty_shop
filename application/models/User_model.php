<?php

class User_model extends CI_model{
    function __construct()
    {
        parent::__construct();
    }

    function get_role(){
      return $this->db->get('role')->result();
    }

    function user_json(){
        $this->datatables->select('user_id,username,nama_lengkap,is_active,photo,role.role_id,role_name');
        $this->datatables->from('user');
        $this->datatables->join('role', 'user.role_id=role.role_id');  
        $this->datatables->add_column('view', 
          '<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>  
          <button onclick="hapus_type($1)" type="button" class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></button>',
          'user_id,username,nama_lengkap,is_active,role_id,role_name,photo');
        return $this->datatables->generate();
    }

    public function save($data){
      return $this->db->insert('user',$data);
    }

    public function get_by_id($id)
    {
      $this->db->from('user');
      $this->db->where('user_id',$id);
      $query = $this->db->get();
      return $query->row();
    }
}

?>