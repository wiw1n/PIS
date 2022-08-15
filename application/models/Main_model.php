<?php
class Main_model extends CI_Model {

	public function getAllDeparment($id)
	{
		if (!empty($id)) {
			$this->db->where('id', $id);
		}

		$query = $this->db->get('department_tbl');
		
		return $query->result();
	}

	public function getAllPpe($id)
	{
		if (!empty($id)) {
			$this->db->where('id', $id);
		}

		$query = $this->db->get('ppe_tbl');
		
		return $query->result();
	}

	public function getAllPpeSub($id)
	{
		if (!empty($id)) {
			$this->db->where('ppe_id', $id);
		}

		$query = $this->db
					->get('ppe_sub_tbl');
		
		return $query->result();
	}

	public function getUser($id)
	{
		if (!empty($id)) {
			$this->db->where('id', $id);
		}

		$query = $this->db
					->where('archive', 0)
					->get('users_tbl');
		
		return $query->result();
	}

	public function addProperty($barcode,$ppe_sub,$item,$description,$purchase_date,$old_property_no,$property_no,$unit_measure,$unit_value,$qty,$total_cost,$property_card,$physical_count,$location,$accountable,$user,$condition,$remarks)
	{
		$data = [
			'ppe_sub_id' => $ppe_sub,
			'item' => $item,
			'description' => $description,
			'purchase_date' => $purchase_date,
			'old_property' => $old_property_no,
			'property_no' => $property_no,
			'unit_measure' => $unit_measure,
			'unit_value' => $unit_value,
			'qty' => $qty,
			'total_cost' => $total_cost,
			'qty_per_property_card' => $property_card,
			'qty_per_physical_count' => $physical_count,
			'department_id' => $location,
			'accountable_id' => $accountable,
			'user_id' => $user,
			'condition' => $condition,
			'remarks' => $remarks,
			'barcode' => $barcode
		];

		$this->db->insert('property_tbl', $data);

		return TRUE;
	}

	public function editProperty($id, $barcode,$ppe_sub,$item,$description,$purchase_date,$old_property_no,$property_no,$unit_measure,$unit_value,$qty,$total_cost,$property_card,$physical_count,$location,$accountable,$user,$condition,$remarks)
	{
		$data = [
			'ppe_sub_id' => $ppe_sub,
			'item' => $item,
			'description' => $description,
			'purchase_date' => $purchase_date,
			'old_property' => $old_property_no,
			'property_no' => $property_no,
			'unit_measure' => $unit_measure,
			'unit_value' => $unit_value,
			'qty' => $qty,
			'total_cost' => $total_cost,
			'qty_per_property_card' => $property_card,
			'qty_per_physical_count' => $physical_count,
			'department_id' => $location,
			'accountable_id' => $accountable,
			'user_id' => $user,
			'condition' => $condition,
			'remarks' => $remarks,
			'barcode' => $barcode
		];

		$this->db->where('id', $id)
				->update('property_tbl', $data);

		return TRUE;
	}

	public function getAccountableReport($user_id,$date_added)
	{
		$this->db->select('p.ppe_sub_id as ppe_sub_account_group, p.accountable_id, u.department as accountable_location')
				->join('users_tbl u', 'u.id = p.accountable_id', 'left');

		if (!empty($user_id)) {
			$this->db->where('p.accountable_id', $user_id);
		}

		if (!empty($date_added)) {
			$date_added = str_replace("-", "",$date_added);
            $this->db->where('EXTRACT( YEAR_MONTH FROM p.date_added) =', $date_added);
		}

		$query = $this->db->where('p.archive', 0)
							->group_by('accountable_id, ppe_sub_id, department_id')
							->order_by('accountable_id')
							->get('property_tbl p');

		$result = $query->result();

		return $result;
	}


	public function getPropertyReprot($accountable, $ppe_sub, $location, $property_id)
	{
		$this
			->db
			->select('p.id, pp.ppe_name as ppe_account_group, pp.id as ppe_id, ps.ppe_sub_name as ppe_sub_account_group, ps.id as ppe_sub_id, p.item, p.description,
					p.purchase_date, p.old_property, p.property_no, p.unit_measure, p.unit_value, p.qty,  p.total_cost, p.qty_per_property_card,
					p.qty_per_physical_count, concat(u1.firstname, " ", u1.middlename, " ", u1.lastname) as accountable, u1.id as accountable_id, d.department_name as location,
					d.id as location_id, concat(u2.firstname, " ", u2.lastname) as user, u2.id as user_id, p.condition, p.remarks, d2.department_name')
			->join('users_tbl u1', 'u1.id = p.accountable_id', 'left')
			->join('users_tbl u2', 'u2.id = p.user_id', 'left')
			->join('department_tbl d', 'd.id = p.department_id', 'left')
			->join('department_tbl d2', 'd2.id = u1.department', 'left')
			->join('ppe_sub_tbl ps', 'ps.id = p.ppe_sub_id', 'left')
			->join('ppe_tbl pp', 'pp.id = ps.ppe_id', 'left');
		
		if (!empty($accountable)) {
			$this->db->where('p.accountable_id', $accountable);
		}
		if (!empty($location)) {
			$this->db->where('u1.department', $location);
		}
		if (!empty($ppe_sub)) {
			$this->db->where('p.ppe_sub_id', $ppe_sub);
		}

		if (!empty($property_id)) {
			$this->db->where('p.id', $property_id);
		}

		$query = $this->db
					->where('p.archive', 0)
					->order_by('p.accountable_id, p.ppe_sub_id')
					->get('property_tbl p');

		$result = $query->result();

		return $result;
	}

	public function getAPI($property_no)
	{
		$this
			->db
			->select('p.id, pp.ppe_name as ppe_account_group, pp.id as ppe_id, ps.ppe_sub_name as ppe_sub_account_group, ps.id as ppe_sub_id, p.item, p.description,
					p.purchase_date, p.old_property, p.property_no, p.unit_measure, p.unit_value, p.qty,  p.total_cost, p.qty_per_property_card,
					p.qty_per_physical_count, concat(u1.firstname, " ", u1.middlename, " ", u1.lastname) as accountable, u1.id as accountable_id, d.department_name as location,
					d.id as location_id, concat(u2.firstname, " ", u2.lastname) as user, u2.id as user_id, p.condition, p.remarks, d2.department_name')
			->join('users_tbl u1', 'u1.id = p.accountable_id', 'left')
			->join('users_tbl u2', 'u2.id = p.user_id', 'left')
			->join('department_tbl d', 'd.id = p.department_id', 'left')
			->join('department_tbl d2', 'd2.id = u1.department', 'left')
			->join('ppe_sub_tbl ps', 'ps.id = p.ppe_sub_id', 'left')
			->join('ppe_tbl pp', 'pp.id = ps.ppe_id', 'left');
		
		$query = $this->db
					->where('p.property_no', $property_no)
					->where('p.archive', 0)
					->order_by('p.accountable_id, p.ppe_sub_id')
					->get('property_tbl p');

		$result = $query->result();

		return $result;
	}

	public function insertDepartment($name, $code)
	{
		$data = [
			'department_name' => $name,
			'department_code' => $code
		];

		$this->db->insert('department_tbl', $data);

		return TRUE;
	}

	public function updateDepartment($id, $name, $code)
	{
		$data = [
			'department_name' => $name,
			'department_code' => $code
		];

		$this->db->where('id', $id)
				->update('department_tbl', $data);

		return TRUE;
	}

	public function deleteDepartment($id)
	{
		$data = [
			'archive' => 1
		];

		$this->db->where('id', $id)
				->update('department_tbl', $data);

		return TRUE;
	}

	public function insertIPAddress($ip_address, $subnet, $status)
	{
		$data = [
			'ip_address' => $ip_address,
			'subnet' => $subnet,
			'status' => $status
		];

		$this->db->insert('address_tbl', $data);

		return TRUE;
	}

	public function updateIPAddress($id, $ip_address, $subnet, $status)
	{
		$data = [
			'ip_address' => $ip_address,
			'subnet' => $subnet,
			'status' => $status
		];

		$this->db->where('id', $id)
				->update('address_tbl', $data);

		return TRUE;
	}

	public function deleteIPAddress($id)
	{
		$data = [
			'archive' => 1
		];

		$this->db->where('id', $id)
				->update('address_tbl', $data);

		return TRUE;
	}
}