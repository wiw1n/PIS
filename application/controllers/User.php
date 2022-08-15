<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function register()
	{
		$this->User_model->forNotLoggedInOnly();
		$message = '';

		if (!empty($this->input->post())) {

			$name = $this->input->post('name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->User_model->register($name,$username,$password)) {
				$message = [
					'status' => 'success',
					'message' => 'Congrats registered ka na bes!'
				];
			}else{
				$message = [
					'status' => 'danger',
					'message' => 'Error bes!'
				];
			}
		}

		$this->load->view('users_register',['message'=>$message]);
	}

	public function loginUser()
	{
		$this->User_model->forNotLoggedInOnly();
		$this->load->view('users_login');
	}

	public function login()
	{
		$message = '';

		if (!empty($this->input->post())) {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->User_model->login($username,$password)) {
				// redirect(base_url());
				$message = [
					'status' => 'success',
					'message' => 'Success!'
				];
			}else{
				$message = [
					'status' => 'danger',
					'message' => 'Error!'
				];
			}
		}
		echo json_encode($message);
	}

	public function logout()
	{
		$this->User_model->logout();

		redirect(base_url('user/loginUser'));
	}

	public function deleteEmployee()
	{
		$id = $this->input->post('id');

		if ($this->User_model->archiveEmployee($id)) {
			echo json_encode("Success!");
		}
	}

	public function insertEmployee()
	{
		$id_number = $this->input->post('txtIdNo');
		$password = sha1($this->input->post('txtPassword1'));
		$lastname = $this->input->post('txtLastname');
		$firstname = $this->input->post('txtFirstname');
		$middlename = $this->input->post('txtMiddlename');
		$email = $this->input->post('txtEmail');
		$department_id = $this->input->post('txtDepartment');
		$position = $this->input->post('txtPosition');
		$role_id = $this->input->post('txtRole');

		if ($this->User_model->addEmployee($id_number, $password, $lastname, $firstname, $middlename, $email, $department_id, $position, $role_id)) {
			echo json_encode("SUCCESS");
		}
	}

	public function updateEmployee()
	{
		$id = $this->input->post('updateID');
		$id_number = $this->input->post('updateIdNo');
		$lastname = $this->input->post('updateLastname');
		$firstname = $this->input->post('updateFirstname');
		$middlename = $this->input->post('updateMiddlename');
		$email = $this->input->post('updateEmail');
		$department_id = $this->input->post('updateDepartment');
		$position = $this->input->post('updatePosition');
		$role_id = $this->input->post('updateRole');

		if ($this->User_model->editEmployee($id, $id_number, $lastname, $firstname, $middlename, $email, $department_id, $position, $role_id)) {
			echo json_encode("SUCCESS");
		}
	}

	public function changePassword()
	{
		$id = $this->input->post('id');
		$password = sha1($this->input->post('password'));

		if ($this->User_model->changePassEmployee($id, $password)) {
			echo json_encode("SUCCESS");
		}
	}

	
}