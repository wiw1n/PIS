<?php

class IP_Address extends CI_Controller
{
    public function insertIPAddress(Type $var = null)
    {
        $ip_address = $this->input->post('txtIpAddress');
        $subnet = $this->input->post('txtSubnetMask');
        $status = $this->input->post('txtStatus');

        if ($this->Main_model->insertIPAddress($ip_address, $subnet, $status)) {
            echo json_encode("Success!");
        }
    }

    public function updateIPAddress()
    {
        $id = $this->input->post('addressID');
        $ip_address = $this->input->post('txtIpAddress_update');
        $subnet = $this->input->post('txtSubnetMask_update');
        $status = $this->input->post('txtStatus_update');

        if ($this->Main_model->updateIPAddress($id, $ip_address, $subnet, $status)) {
            echo json_encode("Success!");
        }
    }

    public function deleteIPAddress()
    {
        $id = $this->input->post('id');

        if ($this->Main_model->deleteIPAddress($id)) {
            echo json_encode("Success!");
        }
    }

    public function ping_idAddress()
    {
        $host = $this->input->post('ip_address');
        $id = $this->input->post('id');

        exec("ping -n 3 $host", $output, $status);

        $ip = $this->input->ip_address();

        echo json_encode($output);
    }
}
