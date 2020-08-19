<?php

function is_logged_in() {
	$ci = get_instance();

	if(!$ci->session->userdata('username')) {
		redirect('auth');
	} else {
		$role_id = $ci->session->userdata('role_id');
		$menu = $ci->uri->segment(1);

		$query_menu = $ci->db->get_where('menu', ['menu_link' => $menu])->row_array();
		$group_id = $query_menu['group_id'];

		$user_access = $ci->db->get_where('menu_access', [
			'role_id' => $role_id,
			'group_id' => $group_id
		]);

		if($user_access->num_rows() < 1) {
			redirect('auth/blocked');
		}
	}
}