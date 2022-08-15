<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Equipment extends CI_Controller
{
    public function getMaxId()
    {
        $query = $this->db->select_max('id')
                        ->get('property_tbl');
        
        $result = $query->row();

        echo json_encode($result);
    }

    public function deleteProperty(Type $var = null)
    {
        $id = $this->input->post('id');

        $this->db->set('archive', 1)
                ->where('id', $id)
                ->update('property_tbl');
        
        echo json_encode("TRUE");
    }

    public function get_PPEAccount()
    {
        $ppe = $this->Main_model->getAllPpe('');

        echo json_encode($ppe);
    }

    public function get_PPESubAccount()
    {
        $id = $this->input->post('id');

        $ppe_sub_select = $this->Main_model->getAllPpeSub($id);

        echo json_encode($ppe_sub_select);
    }

    public function insertProperty()
    {
        $ppe = $this->input->post('txtPpe');
        $ppe_sub = $this->input->post('txtPpeSub');
        $item = $this->input->post('txtItem');
        $description = $this->input->post('txtDescription');
        $purchase_date = $this->input->post('txtPurchaseDate');
        $old_property_no = $this->input->post('txtOldProperty');
        $property_no = $this->input->post('txtNewProperty');
        $unit_measure = $this->input->post('txtUnitMeasure');
        $unit_value = $this->input->post('txtUnitValue');
        $qty = $this->input->post('txtQty');
        $total_cost = $this->input->post('txtTotalCost');
        $property_card = $this->input->post('txtPropertyCard');
        $physical_count = $this->input->post('txtPhysicalCount');
        $location = $this->input->post('txtLocation');
        $accountable = $this->input->post('txtAccountable');
        $user = $this->input->post('txtUser');
        $condition = $this->input->post('txtCondition');
        $remarks = $this->input->post('txtRemarks');

        $barcode = $this->generateBarcode($this->input->post('txtNewProperty'));

        if($this->Main_model->addProperty($barcode,$ppe_sub,$item,$description,$purchase_date,$old_property_no,$property_no,$unit_measure,$unit_value,$qty,$total_cost,$property_card,$physical_count,$location,$accountable,$user,$condition,$remarks)){
            echo json_encode(TRUE);
        }
    }

    public function updateProperty()
    {
        $id = $this->input->post('updateID');
        $ppe_sub = $this->input->post('updatePpeSub');
        $item = $this->input->post('updateItem');
        $description = $this->input->post('updateDescription');
        $purchase_date = $this->input->post('updatePurchaseDate');
        $old_property_no = $this->input->post('updateOldProperty');
        $property_no = $this->input->post('updateNewProperty');
        $unit_measure = $this->input->post('updateUnitMeasure');
        $unit_value = $this->input->post('updateUnitValue');
        $qty = $this->input->post('updateQty');
        $total_cost = $this->input->post('updateTotalCost');
        $property_card = $this->input->post('updatePropertyCard');
        $physical_count = $this->input->post('updatePhysicalCount');
        $location = $this->input->post('updateLocation');
        $accountable = $this->input->post('updateAccountable');
        $user = $this->input->post('updateUser');
        $condition = $this->input->post('updateCondition');
        $remarks = $this->input->post('updateRemarks');

        $barcode = $this->generateBarcode($this->input->post('updateNewProperty'));

        if($this->Main_model->editProperty($id,$barcode,$ppe_sub,$item,$description,$purchase_date,$old_property_no,$property_no,$unit_measure,$unit_value,$qty,$total_cost,$property_card,$physical_count,$location,$accountable,$user,$condition,$remarks)){
            echo json_encode(TRUE);
        }
    }
    
    private function generateBarcode($txt){
        

		//load library
		$this->load->library('Zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$txt,'font' => 5, 'factor'=>2), array())->draw();
		imagepng($imageResource, './assets/barcodes/'.$txt.'.png');

		$data = base64_encode('./assets/barcodes/'.$txt.'.png');;
		
        return $data;
		// $this->load->view('welcome',$data);
    }

    public function viewBarcode()
    {
        $id = $this->input->post('id');

        $query = $this->db->where('id', $id)
                        ->get('property_tbl');
        
        echo json_encode($query->result());
    }

    public function exportReport()
    {
        $property_id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $date_added = $this->input->post('date_added');
        $response = array();        

        if (!empty($property_id)) {
            $datas = $this->Main_model->getPropertyReprot('', '', '', $property_id);
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./assets/appendix66.xlsx");
            header('Content-Type: application/vnd.ms-excel');
            // header('Content-Disposition: attachment;filename="hello_world.xlsx"');
            $worksheet = $spreadsheet->getActiveSheet();
            // echo "<pre>";
            // print_r(count($datas));
            $numCell = 13;
            $num = 1;
            $filename = "";
            foreach ($datas as $data) {            
                $filename = 'appendix66_' . $data->ppe_sub_account_group ."_" . $data->accountable;
                if ($num == 13) {
                    $writer = new Xlsx($spreadsheet);
                    ob_start();
                    $writer->save("php://output");
                    $xlsData = ob_get_contents();
                    ob_end_clean();

                    $temp =  array(
                            'op' =>  $filename,
                            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
                        );
                    
                    array_push($response, $temp);

                    header('Content-Type: application/vnd.ms-excel');
                    // header('Content-Disposition: attachment;filename="hello_world.xlsx"');
                    $worksheet = $spreadsheet->getActiveSheet();

                    $numCell = 13;
                    $num = 1;
                }
                $worksheet->setCellValue('E4', $data->ppe_account_group . ', ' . $data->ppe_sub_account_group); //PPE and SUB
                $worksheet->setCellValue('A9', 'For which ' . $data->accountable); //Accountable fullname
                $worksheet->setCellValue('E9', ", " . $data->department_name); //department
                $worksheet->setCellValue('H9', "            LGU-Palo"); //LGU-Palo
                $worksheet->setCellValue('A'.$numCell, $data->item); //item
                $worksheet->setCellValue('B'.$numCell, $data->description); //description
                $worksheet->setCellValue('D'.$numCell, $data->property_no); //property number
                $worksheet->setCellValue('F'.$numCell, $data->unit_value); //unit value
                $worksheet->setCellValue('I'.$numCell, $data->location); //location
                $worksheet->setCellValue('K'.$numCell, $data->condition); //condition
                $worksheet->setCellValue('L'.$numCell, $data->remarks); //remarks
                
                $numCell++;
                $num++;
            }
            $writer = new Xlsx($spreadsheet);
            ob_start();
            $writer->save("php://output");
            $xlsData = ob_get_contents();
            ob_end_clean();

            $temp =  array(
                    'op' => $filename,
                    'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
                );
            
            array_push($response, $temp);

            die(json_encode($response));
        }else{
            $users = $this->Main_model->getAccountableReport($user_id,$date_added);        
            
            foreach ($users as $user) {
                $datas = $this->Main_model->getPropertyReprot($user->accountable_id, $user->ppe_sub_account_group, $user->accountable_location, $property_id);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./assets/appendix66.xlsx");
                header('Content-Type: application/vnd.ms-excel');
                // header('Content-Disposition: attachment;filename="hello_world.xlsx"');
                $worksheet = $spreadsheet->getActiveSheet();
                // echo "<pre>";
                // print_r(count($datas));
                $numCell = 13;
                $num = 1;
                $filename = "";
                if (!empty($datas)) {
                    foreach ($datas as $data) {            
                        $filename = 'appendix66_' . $data->ppe_sub_account_group ."_" . $data->accountable;
                        if ($num == 13) {
                            $writer = new Xlsx($spreadsheet);
                            ob_start();
                            $writer->save("php://output");
                            $xlsData = ob_get_contents();
                            ob_end_clean();
        
                            $temp =  array(
                                    'op' =>  $filename,
                                    'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
                                );
                            
                            array_push($response, $temp);
                            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./assets/appendix66.xlsx");
                            header('Content-Type: application/vnd.ms-excel');
                            // header('Content-Disposition: attachment;filename="hello_world.xlsx"');
                            $worksheet = $spreadsheet->getActiveSheet();
        
                            $numCell = 13;
                            $num = 1;
                        }
                        $worksheet->setCellValue('E4', $data->ppe_account_group . ', ' . $data->ppe_sub_account_group); //PPE and SUB
                        $worksheet->setCellValue('A9', 'For which ' . $data->accountable); //Accountable fullname
                        $worksheet->setCellValue('E9', ", " . $data->department_name); //department
                        $worksheet->setCellValue('H9', "            LGU-Palo"); //LGU-Palo
                        $worksheet->setCellValue('A'.$numCell, $data->item); //item
                        $worksheet->setCellValue('B'.$numCell, $data->description); //description
                        $worksheet->setCellValue('D'.$numCell, $data->property_no); //property number
                        $worksheet->setCellValue('F'.$numCell, $data->unit_value); //unit value
                        $worksheet->setCellValue('I'.$numCell, $data->location); //location
                        $worksheet->setCellValue('K'.$numCell, $data->condition); //condition
                        $worksheet->setCellValue('L'.$numCell, $data->remarks); //remarks
                        
                        $numCell++;
                        $num++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    ob_start();
                    $writer->save("php://output");
                    $xlsData = ob_get_contents();
                    ob_end_clean();
        
                    $temp =  array(
                            'op' => $filename,
                            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
                        );
                    
                    array_push($response, $temp);
                }
                
            }

        die(json_encode($response));
        
        }       

    }
}
