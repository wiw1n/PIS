<?php

class Department extends CI_Controller
{

    public function insertDepartment(Type $var = null)
    {
        $name = $this->input->post('txtDepartmentName');
        $code = $this->input->post('txtDepartmentCode');

        if ($this->Main_model->insertDepartment($name,$code)) {
            echo json_encode("Success!");
        }
    }

    public function updateDepartment()
    {
        $id = $this->input->post('updateDepartmentID');
        $name = $this->input->post('updateDepartmentName');
        $code = $this->input->post('updateDepartmentCode');

        if ($this->Main_model->updateDepartment($id,$name,$code)) {
            echo json_encode("Success!");
        }
    }

    public function deleteDepartment()
    {
        $id = $this->input->post('id');

        if ($this->Main_model->deleteDepartment($id)) {
            echo json_encode("Success!");
        }
    }
}
