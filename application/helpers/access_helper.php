<?php

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level,$id_menu){
    $ci = get_instance();
    $ci->db->where('role_id',$id_user_level);
    $ci->db->where('group_id',$id_menu);
    $data = $ci->db->get('menu_access');
    if($data->num_rows()>0){
        return "checked='checked'";
    }
}