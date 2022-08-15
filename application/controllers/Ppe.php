<?php

class Ppe extends CI_Controller
{
    public function insertPpe()
    {
        $name = $this->input->post('txtPpeName');
        $code = $this->input->post('txtPpeCode');

        if ($this->Ppe_model->insertPpe($name,$code)) {
            echo json_encode("Success!");
        }
    }

    public function updatePpe()
    {
        $id = $this->input->post('updatePpeID');
        $name = $this->input->post('updatePpeName');
        $code = $this->input->post('updatePpeCode');

        if ($this->Ppe_model->updatePpe($id,$name,$code)) {
            echo json_encode("Success!");
        }
    }

    public function deletePpe()
    {
        $id = $this->input->post('id');

        if ($this->Ppe_model->deletePpe($id)) {
            echo json_encode("Success!");
        }
    }

    public function insertPpeSub()
    {
        $ppeID = $this->input->post('txtPpeIdforSub');
        $name = $this->input->post('txtPpeSubName');
        $code = $this->input->post('txtPpeSubCode');

        if ($this->Ppe_model->insertPpeSub($ppeID,$name,$code)) {
            echo json_encode("Success!");
        }
    }

    public function updatePpeSub()
    {
        $id = $this->input->post('updatePpeSubID');
        $name = $this->input->post('updatePpeSubName');
        $code = $this->input->post('updatePpeSubCode');

        if ($this->Ppe_model->updatePpeSub($id,$name,$code)) {
            echo json_encode("Success!");
        }
    }

    public function deletePpeSub()
    {
        $id = $this->input->post('id');

        if ($this->Ppe_model->deletePpeSub($id)) {
            echo json_encode("Success!");
        }
    }
}
