<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Export_model','export');
	}
	public function index()
	{
		$data['exam_form_list'] = $this->export->examList();

		$this->load->view('admin/exam_form_list',$data);
	}
	public function createXLS()
	{
		$this->load->library("excel");
		$object = new PHPExcel();  
	     
	    $object->setActiveSheetIndex(0);  
	  

	    $feedbackInfo = $this->export->examList();

	    $output = '';

    $output .= "<table class='table' border='1'>
                    <thead>
                        <th style='background-color:#c7c7c7;'>School Code</th>  
                        <th style='background-color:#c7c7c7;'>Course</th>  
                        <th style='background-color:#c7c7c7;'>Name</th>  
                        <th style='background-color:#c7c7c7;'>Reference No.</th>      
                        <th style='background-color:#c7c7c7;'>Date of Birth</th>
                        <th style='background-color:#c7c7c7;'>Father's Name</th>
                        <th style='background-color:#c7c7c7;'>Mother's Name</th>
                       
                       
                        <th style='width:220px !important;background-color:#c7c7c7;'>Image</th>
                        <th style='width:220px !important;background-color:#c7c7c7;'>Signature</th>
                    </thead>
                    <tbody>
                ";
    foreach($feedbackInfo as $item){ 
    $output .= "
            <tr>
                <td style='text-align:center;'>".$item->issue_by."</td>
                <td style='text-align:center;'>".$item->course."</td>
                <td style='text-align:center;'>".$item->name."</td>
                <td style='text-align:center;'>".$item->ref_no."</td>
                <td style='text-align:center;'>".$item->dob."</td>
                <td style='text-align:center;'>".$item->father_name."</td>
                <td style='text-align:center;'>".$item->mother_name."</td>
               
                
                
                <td style='text-align:center;width:80px !important;height:100px !important;'><img src='".base_url().$item->img1."' width='70' height='92'> </td>
                <td style='text-align:center;width:80px !important;height:100px !important;'><img src='".base_url().$item->img2."' width='112' height='49'> </td>
            </tr>
                ";
    }
    $output .= "</tbody>
            </table>
        ";
	     

	   
	       $rand = rand(1234, 9898);  
	  
	    $fileName = "" . $rand . "_" .time() . ".xls";  
	  
	    header('Content-Type: application/vnd.ms-excel');  
	    header('Content-Disposition: attachment;filename="'.$fileName.'"');  
	    header('Cache-Control: max-age=0'); 
	    //$objWriter->save('php://output'); 
	    echo $output;
	}


	
}