<?php

class Ppe_model extends CI_Model
{
    public function insertPpe($name, $code)
    {
        $data = [
            'ppe_name' => $name,
            'ppe_code' => $code
        ];

        $this->db->insert('ppe_tbl', $data);

        return TRUE;
    }

    public function updatePpe($id, $name, $code)
    {
        $data = [
            'ppe_name' => $name,
            'ppe_code' => $code
        ];

        $this->db->where('id', $id)
                ->update('ppe_tbl', $data);

        return TRUE;
    }

    public function deletePpe($id)
    {
        $data = [
            'archive' => 1
        ];

        $this->db->where('id', $id)
                ->update('ppe_tbl', $data);

        return TRUE;
    }

    public function insertPpeSub($ppeID, $name, $code)
    {
        $data = [
            'ppe_id' => $ppeID,
            'ppe_sub_name' => $name,
            'ppe_sub_code' => $code
        ];

        $this->db->insert('ppe_sub_tbl', $data);

        return TRUE;
    }

    public function updatePpeSub($id, $name, $code)
    {
        $data = [
            'ppe_sub_name' => $name,
            'ppe_sub_code' => $code
        ];

        $this->db->where('id', $id)
                ->update('ppe_sub_tbl', $data);

        return TRUE;
    }

    public function deletePpeSub($id)
    {
        $data = [
            'archive' => 1
        ];

        $this->db->where('id', $id)
                ->update('ppe_sub_tbl', $data);

        return TRUE;
    }
}
