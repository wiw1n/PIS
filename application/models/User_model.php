<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	public function login($username,$password)
	{
		$this->db->where('id_number',$username);
		$this->db->where('password',sha1($password));
		$this->db->where('archive', 0);
		$this->db->where('role !=', 2);

		$query = $this->db->get('users_tbl');

		$data = $query->row();

		if (!empty($data)) {
			$this->setLoginSession($data);
		}
		return !empty($data);
	}

	public function setLoginSession($data)
	{
		$newdata = array(
		        'id'  => $data->id,
		        'name'  => $data->firstname . " " . $data->lastname,
		        'id_number'  => $data->id_number,
		        'role'  => $data->role,
		        'department'  => $data->department,
		        'logged_in' => TRUE
		);

		$this->session->set_userdata($newdata);
	}

	public function logout()
	{
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('id_number');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('department');
		$this->session->unset_userdata('logged_in');
	}

	public function forLoggedInOnly()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('user/loginUser'));
		}
	}

	public function forNotLoggedInOnly()
	{
		if ($this->session->userdata('logged_in')) {
			redirect(base_url("Main/dashboard"));
		}
	}

	public function archiveEmployee($id)
	{
		$data = [
			'archive' => 1
		];

		$this->db->where('id', $id)
						->update('users_tbl', $data);

		return TRUE;
	}

	public function addEmployee($id_number, $password, $lastname, $firstname, $middlename, $email, $department_id, $position, $role_id)
	{
		$data = [
			'id_number' => $id_number,
			'password' => $password,
			'firstname' => $firstname,
			'middlename' => $middlename,
			'lastname' => $lastname,
			'email' => $email,
			'department' => $department_id,
			'position' => $position,
			'role' => $role_id,
		];

		$this->db->insert('users_tbl', $data);

		return TRUE;
	}

	public function editEmployee($id, $id_number, $lastname, $firstname, $middlename, $email, $department_id, $position, $role_id)
	{
		$data = [
			'id_number' => $id_number,
			'firstname' => $firstname,
			'middlename' => $middlename,
			'lastname' => $lastname,
			'email' => $email,
			'department' => $department_id,
			'position' => $position,
			'role' => $role_id,
		];

		$this->db->where('id', $id)
				->update('users_tbl', $data);

		return TRUE;
	}

	public function changePassEmployee($id, $password)
	{
		$data = [
			'password' => $password
		];

		$this->db->where('id', $id)
						->update('users_tbl', $data);

		return TRUE;
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */