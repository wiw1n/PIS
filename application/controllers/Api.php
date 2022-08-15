<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function getPropertyData()
	{
		if (isset($_REQUEST['property_no'])) {
			// echo json_encode($_REQUEST['property_no']);
			$property_no = $_REQUEST['property_no'];
			$data = $this->Main_model->getAPI($property_no);
			echo json_encode($data);
		}else{
			$data['prop'] = array("item"=>"ERROR");
			echo json_encode($data);
		}
	}

	
}