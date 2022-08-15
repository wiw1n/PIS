<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function dashboard()
	{
		$this->User_model->forLoggedInOnly();

		$department = $this->Main_model->getAllDeparment('');
		$user = $this->Main_model->getUser('');
		$property = $this->Main_model->getPropertyReprot('','','','');

		$this->load->view('template/header');
		$this->load->view('dashboard', ['department'=>$department,'user'=>$user,'property'=>$property]);
		$this->load->view('template/footer');
	}

	public function listOfEquipment()
	{	
		$this->User_model->forLoggedInOnly();

		$department = $this->Main_model->getAllDeparment('');
		$ppe = $this->Main_model->getAllPpe('');
		$ppe_sub = $this->Main_model->getAllPpeSub('');
		$user = $this->Main_model->getUser('');


		$this->load->view('template/header');
		$this->load->view('list_of_equipment', ['department'=>$department, 'ppe'=>$ppe, 'ppe_sub'=>$ppe_sub, 'user'=>$user]);
		$this->load->view('template/footer');
	}	

	public function IPAdressesAllocation()
	{
		$this->User_model->forLoggedInOnly();

		$this->load->view('template/header');
		$this->load->view('IPAddresses');
		$this->load->view('template/footer');
	}

	public function registeredUsers()
	{
		$this->User_model->forLoggedInOnly();

		$department = $this->Main_model->getAllDeparment('');

		$this->load->view('template/header');
		$this->load->view('list_of_user', ['department'=>$department]);
		$this->load->view('template/footer');
	}

	public function listOfOffices()
	{
		$this->User_model->forLoggedInOnly();

		$this->load->view('template/header');
		$this->load->view('department');
		$this->load->view('template/footer');
	}

	public function ppeAccountGroup()
	{
		$this->User_model->forLoggedInOnly();

		$this->load->view('template/header');
		$this->load->view('ppe');
		$this->load->view('template/footer');
	}

	public function get_employee()
	{
		$columns = array( 
			0 =>'user_id', 
			1 =>'id_number',
			2=> 'lastname',
			3=> 'firstname',
			4=> 'middlename',
			5=> 'email',
			6=> 'department',
			7=> 'position',
			8=> 'role',
			9=> 'action',
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->Datatable_model->allposts_count_users();

		$totalFiltered = $totalData; 

		if(empty($this->input->post('search')['value']))
		{            
		$posts = $this->Datatable_model->allposts_users($limit,$start,$order,$dir);
		}
		else {
		$search = $this->input->post('search')['value']; 

		$posts =  $this->Datatable_model->posts_search_users($limit,$start,$search,$order,$dir);

		$totalFiltered = $this->Datatable_model->posts_search_count_users($search);
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$role = "";
				if ($post->role == "0") {
					$role = "Admin";
				}elseif($post->role == "1"){
					$role = "Viewing";
				}else{
					$role = "None";
				}

				$nestedData['id'] = $post->user_id;
				$nestedData['id_number'] = $post->id_number;
				$nestedData['lastname'] = $post->lastname;
				$nestedData['firstname'] = $post->firstname;
				$nestedData['middlename'] = $post->middlename;
				$nestedData['email'] = $post->email;
				$nestedData['department'] = $post->department_name;
				$nestedData['department_id'] = $post->department_id;
				$nestedData['position'] = $post->position;
				$nestedData['role'] = $role;
				$nestedData['role_id'] = $post->role;
				$nestedData['action'] = "<a href='#' id='changePass' class='btn btn-info'><i class='fa fa-eye'></i></a>&nbsp;<a href='?updated=$post->id' id='empUpdate' class='btn btn-success'><i class='fa fa-edit'></i></a>&nbsp;<a href='?deleted=$post->id' id='empDelete' class='btn btn-danger'><i class='fa fa-trash'></i></a>";

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
	}

	public function get_property()
	{
		$columns = array( 
			0 =>'id', 
			1 =>'ppe_account_group',
			2=> 'ppe_sub_account_group',
			3=> 'item',
			4=> 'description',
			5=> 'purchase_date',
			6=> 'old_property_no_assigned',
			7=> 'property_number',
			8=> 'unit_measure',
			9=> 'unit_value',
			10=> 'qty',
			11=> 'total_cost',
			12=> 'quantity_per_property_card',
			13=> 'quantity_per_physical_count',
			14=> 'accountable',
			15=> 'location',
			16=> 'user',
			17=> 'condition',
			18=> 'remarks',
			19=> 'id',
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$accountable = "";
		$date_added = $this->input->post('filterByDate');
		
		if ($this->session->userdata('role') == 1) {
			$accountable = $this->session->userdata('id');
		}else{
			$accountable = $this->input->post('fiterByAccountable');
		}

		$totalData = $this->Datatable_model->allposts_count_property($accountable,$date_added);

		$totalFiltered = $totalData;

		

		if(empty($this->input->post('search')['value']))
		{            
			$posts = $this->Datatable_model->allposts_property($limit,$start,$order,$dir,$accountable,$date_added);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$posts =  $this->Datatable_model->posts_search_property($limit,$start,$search,$order,$dir,$accountable,$date_added);

			$totalFiltered = $this->Datatable_model->posts_search_count_property($search,$accountable,$date_added);
		}

		$data = array();
		if(!empty($posts))
		{
			$action = "";
			if ($this->session->userdata('role') == 0) {
				$action = "<a href='#' id='viewBarcode' class='btn btn-info'><i class='fa fa-barcode'></i></a>&nbsp;<a href='#' id='downloadExcel' class='btn btn-warning'><i class='fa fa-file-excel-o'></i></a>&nbsp;<a href='#' id='propertyUpdate' class='btn btn-success'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' id='propertyDelete' class='btn btn-danger'><i class='fa fa-trash'></i></a>";
			}else{
				$action = " ";
			}
			
			foreach ($posts as $post)
			{

				$nestedData['id'] = $post->id;
				$nestedData['ppe_account_group'] = $post->ppe_account_group;
				$nestedData['ppe_id'] = $post->ppe_id;
				$nestedData['ppe_sub_account_group'] = $post->ppe_sub_account_group;
				$nestedData['ppe_sub_id'] = $post->ppe_sub_id;
				$nestedData['item'] = $post->item;
				$nestedData['description'] = $post->description;
				$nestedData['purchase_date'] = $post->purchase_date;
				$nestedData['old_property'] = $post->old_property;
				$nestedData['property_no'] = $post->property_no;
				$nestedData['unit_measure'] = $post->unit_measure;
				$nestedData['unit_value'] = $post->unit_value;
				$nestedData['qty'] = $post->qty;
				$nestedData['total_cost'] = $post->total_cost;
				$nestedData['qty_per_property_card'] = $post->qty_per_property_card;
				$nestedData['qty_per_physical_count'] = $post->qty_per_physical_count;
				$nestedData['accountable'] = $post->accountable;
				$nestedData['accountable_id'] = $post->accountable_id;
				$nestedData['location'] = $post->location;
				$nestedData['location_id'] = $post->location_id;
				$nestedData['user'] = $post->user;
				$nestedData['user_id'] = $post->user_id;
				$nestedData['condition'] = $post->condition;
				$nestedData['remarks'] = $post->remarks;
				$nestedData['action'] = $action;

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
	}

	public function get_department()
	{
		$columns = array( 
			0 =>'id', 
			1 =>'department_name',
			2=> 'department_code',
			3=> 'id'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->Datatable_model->allposts_count_department();

		$totalFiltered = $totalData; 

		if(empty($this->input->post('search')['value']))
		{            
		$posts = $this->Datatable_model->allposts_department($limit,$start,$order,$dir);
		}
		else {
		$search = $this->input->post('search')['value']; 

		$posts =  $this->Datatable_model->posts_search_department($limit,$start,$search,$order,$dir);

		$totalFiltered = $this->Datatable_model->posts_search_count_department($search);
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$nestedData['id'] = $post->id;
				$nestedData['department_name'] = $post->department_name;
				$nestedData['department_code'] = $post->department_code;
				$nestedData['action'] = "<a href='?updated=$post->id' id='departmentUpdate' class='btn btn-success'><i class='fa fa-edit'></i></a>&nbsp;<a href='?deleted=$post->id' id='departmentDelete' class='btn btn-danger'><i class='fa fa-trash'></i></a>";

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
	}

	public function get_ppe()
	{
		$columns = array( 
			0 =>'id', 
			1 =>'ppe_name',
			2=> 'ppe_code',
			3=> 'id'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->Datatable_model->allposts_count_ppe();

		$totalFiltered = $totalData; 

		if(empty($this->input->post('search')['value']))
		{            
		$posts = $this->Datatable_model->allposts_ppe($limit,$start,$order,$dir);
		}
		else {
		$search = $this->input->post('search')['value']; 

		$posts =  $this->Datatable_model->posts_search_ppe($limit,$start,$search,$order,$dir);

		$totalFiltered = $this->Datatable_model->posts_search_count_ppe($search);
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$nestedData['id'] = $post->id;
				$nestedData['ppe_name'] = $post->ppe_name;
				$nestedData['ppe_code'] = $post->ppe_code;
				$nestedData['action'] = "<a href='#' id='viewPpeSub' class='btn btn-info'><i class='fa fa-eye'></i></a>&nbsp;<a href='?updated=$post->id' id='ppeUpdate' class='btn btn-success'><i class='fa fa-edit'></i></a>&nbsp;<a href='?deleted=$post->id' id='ppeDelete' class='btn btn-danger'><i class='fa fa-trash'></i></a>";

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
	}

	public function get_ppe_sub()
	{
		$columns = array( 
			0 =>'id', 
			1 =>'ppe_sub_name',
			2=> 'ppe_sub_code',
			3=> 'id'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$ppe_id = $this->input->post('ppe_id');
		$totalData = $this->Datatable_model->allposts_count_ppe_sub($ppe_id);

		$totalFiltered = $totalData; 

		if(empty($this->input->post('search')['value']))
		{            
		$posts = $this->Datatable_model->allposts_ppe_sub($limit,$start,$order,$dir,$ppe_id);
		}
		else {
		$search = $this->input->post('search')['value']; 

		$posts =  $this->Datatable_model->posts_search_ppe_sub($limit,$start,$search,$order,$dir,$ppe_id);

		$totalFiltered = $this->Datatable_model->posts_search_count_ppe_sub($search,$ppe_id);
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$nestedData['id'] = $post->id;
				$nestedData['ppe_sub_name'] = $post->ppe_sub_name;
				$nestedData['ppe_sub_code'] = $post->ppe_sub_code;
				$nestedData['action'] = "<a href='?updated=$post->id' id='ppeSubUpdate' class='btn btn-success'><i class='fa fa-edit'></i></a>&nbsp;<a href='?deleted=$post->id' id='ppeSubDelete' class='btn btn-danger'><i class='fa fa-trash'></i></a>";

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
	}

	public function get_address()
	{
		$columns = array( 
			0 =>'id', 
			1 =>'ip_address',
			2=> 'subnet',
			2=> 'status',
			3=> 'id'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$totalData = $this->Datatable_model->allposts_count_address();

		$totalFiltered = $totalData; 

		if(empty($this->input->post('search')['value']))
		{            
			$posts = $this->Datatable_model->allposts_address($limit,$start,$order,$dir);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$posts =  $this->Datatable_model->posts_search_address($limit,$start,$search,$order,$dir);

			$totalFiltered = $this->Datatable_model->posts_search_count_address($search);
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$active = "<span style='color:green;font-weight:500;'>Active</span>";
				if( ($post->status == 1) ? :$active="<span style='color:red;font-weight:500;'>Disabled</span>");
				$nestedData['id'] = $post->id;
				$nestedData['ip_address'] = $post->ip_address;
				$nestedData['subnet'] = $post->subnet;
				$nestedData['active'] = $active;
				$nestedData['status'] = $post->status;
				$nestedData['action'] = "<a href='#' id='update' class='btn btn-success'><i class='fa fa-edit'></i></a>&nbsp;<a href='?deleted=$post->id' id='delete' class='btn btn-danger'><i class='fa fa-trash'></i></a>&nbsp;<a href='#' id='ping' class='btn btn-primary'><i class='fa fa-signal'></i></a>";

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
	}

}
