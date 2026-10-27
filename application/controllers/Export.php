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
        
		$session = $this->export->Get_Affected_Details('batch_session_tb');
		$batch_session=$session[0]['current_session'];
		$anm1 = $this->export->Get_exam_data('exam_form_tb',$batch_session,'1st Year ANM');
		$anm2 = $this->export->Get_exam_data('exam_form_tb',$batch_session,'2nd Year ANM');
		$gnm1 = $this->export->Get_exam_data('exam_form_tb',$batch_session,'1st Year GNM');
		$gnm2 = $this->export->Get_exam_data('exam_form_tb',$batch_session,'2nd Year GNM');
		$gnm3 = $this->export->Get_exam_data('exam_form_tb',$batch_session,'3rd Year GNM');
	     $jnrc_url='https://jnrcranchi.com/uploads/exam_form/';

        $output = '';
        $output .= "
		<table class='table' border='1'>
			<thead>
				<th style='background-color:#c7c7c7;'> # </th>  
				<th style='background-color:#c7c7c7;'>School Code</th>  
				<th style='background-color:#c7c7c7;'>Course</th>  
				<th style='background-color:#c7c7c7;'>Name</th>  
				<th style='background-color:#c7c7c7;'>Reference No.</th>      
				<th style='background-color:#c7c7c7;'>Date of Birth</th>
				<th style='background-color:#c7c7c7;'>Father's Name</th>
				<th style='background-color:#c7c7c7;'>Mother's Name</th>
				<th style='background-color:#c7c7c7;'>Aadhar</th>
				<th style='background-color:#c7c7c7;'>Training School</th>
				<th style='background-color:#c7c7c7;'>Medium Exam</th>
				<th style='background-color:#c7c7c7;'>Image</th>
				<th style='background-color:#c7c7c7;'>CML Rank</th>

			
				
				
				

				
			</thead>
			<tbody>
				";
				$i=1;
				foreach($anm1 as $item)
				{ 
					$output .= "
					<tr>
						<td style='text-align:center;'>".$i."</td>
						<td style='text-align:center;'>".$item->issue_by."</td>
						<td style='text-align:center;'>".$item->course."</td>
						<td style='text-align:center;'>".$item->name."</td>
						<td style='text-align:center;'>".$item->ref_no."</td>
						<td style='text-align:center;'>".$item->dob."</td>
						<td style='text-align:center;'>".$item->father_name."</td>
						<td style='text-align:center;'>".$item->mother_name."</td>
						<td style='text-align:center;'>".$item->aadhar."</td>
						<td style='text-align:center;'>".$item->train_school."</td>
						<td style='text-align:center;'>".$item->medium_exam."</td>
						<td style='text-align:center;'>" . $jnrc_url . $item->ref_no . '/' . $item->img1 . "</td>
							<td style='text-align:center;'>".$item->cmlrank."</td>
				    
				
						
					

					</tr>";
					$i++;
				}
				$i=1;
				foreach($anm2 as $item)
				{ 
					$output .= "
					<tr>
						<td style='text-align:center;'>".$i."</td>
						<td style='text-align:center;'>".$item->issue_by."</td>
						<td style='text-align:center;'>".$item->course."</td>
						<td style='text-align:center;'>".$item->name."</td>
						<td style='text-align:center;'>".$item->ref_no."</td>
						<td style='text-align:center;'>".$item->dob."</td>
						<td style='text-align:center;'>".$item->father_name."</td>
						<td style='text-align:center;'>".$item->mother_name."</td>
						<td style='text-align:center;'>".$item->aadhar."</td>
						<td style='text-align:center;'>".$item->train_school."</td>
						<td style='text-align:center;'>".$item->medium_exam."</td>
						<td style='text-align:center;'>" . $jnrc_url . $item->ref_no . '/' . $item->img1 . "</td>
						<td style='text-align:center;'>".$item->cmlrank."</td>

						

					</tr>";
					$i++;
				}
				$i=1;
				foreach($gnm1 as $item)
				{ 
					$output .= "
					<tr>
						<td style='text-align:center;'>".$i."</td>
						<td style='text-align:center;'>".$item->issue_by."</td>
						<td style='text-align:center;'>".$item->course."</td>
						<td style='text-align:center;'>".$item->name."</td>
						<td style='text-align:center;'>".$item->ref_no."</td>
						<td style='text-align:center;'>".$item->dob."</td>
						<td style='text-align:center;'>".$item->father_name."</td>
						<td style='text-align:center;'>".$item->mother_name."</td>
						<td style='text-align:center;'>".$item->aadhar."</td>
						<td style='text-align:center;'>".$item->train_school."</td>
						<td style='text-align:center;'>".$item->medium_exam."</td>
						<td style='text-align:center;'>" . $jnrc_url . $item->ref_no . '/' . $item->img1 . "</td>
						<td style='text-align:center;'>".$item->cmlrank."</td>

					

					</tr>";
					$i++;
				}
				$i=1;
				foreach($gnm2 as $item)
				{ 
					$output .= "
					<tr>
						<td style='text-align:center;'>".$i."</td>
						<td style='text-align:center;'>".$item->issue_by."</td>
						<td style='text-align:center;'>".$item->course."</td>
						<td style='text-align:center;'>".$item->name."</td>
						<td style='text-align:center;'>".$item->ref_no."</td>
						<td style='text-align:center;'>".$item->dob."</td>
						<td style='text-align:center;'>".$item->father_name."</td>
						<td style='text-align:center;'>".$item->mother_name."</td>
						<td style='text-align:center;'>".$item->aadhar."</td>
						<td style='text-align:center;'>".$item->train_school."</td>
						<td style='text-align:center;'>".$item->medium_exam."</td>
						<td style='text-align:center;'>" . $jnrc_url . $item->ref_no . '/' . $item->img1 . "</td>
						<td style='text-align:center;'>".$item->cmlrank."</td>

						

					</tr>";
					$i++;
				}
				$i=1;
				foreach($gnm3 as $item)
				{ 
					$output .= "
					<tr>
						<td style='text-align:center;'>".$i."</td>
						<td style='text-align:center;'>".$item->issue_by."</td>
						<td style='text-align:center;'>".$item->course."</td>
						<td style='text-align:center;'>".$item->name."</td>
						<td style='text-align:center;'>".$item->ref_no."</td>
						<td style='text-align:center;'>".$item->dob."</td>
						<td style='text-align:center;'>".$item->father_name."</td>
						<td style='text-align:center;'>".$item->mother_name."</td>
						<td style='text-align:center;'>".$item->aadhar."</td>
						<td style='text-align:center;'>".$item->train_school."</td>
						<td style='text-align:center;'>".$item->medium_exam."</td>
					<td style='text-align:center;'>" . $jnrc_url . $item->ref_no . '/' . $item->img1 . "</td>
						<td style='text-align:center;'>".$item->cmlrank."</td>

						

					</tr>";
					$i++;
				}
				$output .= "
			</tbody>
		</table>";  
		//print_r($output);
		$rand = rand(1234, 9898);   
		$fileName = "" . $rand . "_" .time() . ".xls"; 
		header('Content-Type: application/vnd.ms-excel');  
		header('Content-Disposition: attachment;filename="'.$fileName.'"');  
		header('Cache-Control: max-age=0'); 
		//$objWriter->save('php://output'); 
		echo $output;
    }
	
	
	
	
	
	
	
	public function createRenewalXLS()
	{
		$this->load->library("excel");
		$object = new PHPExcel();  
	   
	    $object->setActiveSheetIndex(0);  
	
	    $feedbackInfo = $this->export->renewalList();
	    $output = '';
        $output .= "<table class='table' border='1'>
                <thead>
                        <th style='background-color:#c7c7c7;'>Reg No.</th>  
                        <th style='background-color:#c7c7c7;'>Ref No.</th>      
                        <th style='background-color:#c7c7c7;'>Name</th>  
                        <th style='background-color:#c7c7c7;'>Father's Name</th>
                        <th style='background-color:#c7c7c7;'>Date of Birth</th>
                        <th style='background-color:#c7c7c7;'>Category</th>
                        <th style='background-color:#c7c7c7;'>Aadhar</th>
                        <th style='background-color:#c7c7c7;'>Mobile No.</th>
                        <th style='background-color:#c7c7c7;'>Training School</th>
                        <th style='background-color:#c7c7c7;'>Address</th>
                        <th style='background-color:#c7c7c7;'>Current Post</th>
                        <th style='background-color:#c7c7c7;'>Date Time</th>

                    </thead>
                    <tbody>
                ";

    foreach($feedbackInfo as $item){ 
    	
    $output .= "
            <tr>
                <td style='text-align:center;'>".$item->reg_no."</td>
                <td style='text-align:center;'>".$item->ref_no."</td>
                <td style='text-align:center;'>".$item->name."</td>
                <td style='text-align:center;'>".$item->father_name."</td>
                <td style='text-align:center;'>".$item->dob."</td>
                <td style='text-align:center;'>".$item->category."</td>
                <td style='text-align:center;'>".$item->aadhar_no."</td>
                <td style='text-align:center;'>".$item->mobile_no."</td>
                <td style='text-align:center;'>".$item->school_train."</td>
                <td style='text-align:center;'>".$item->perm_address."</td>
                <td style='text-align:center;'>".$item->place_post."</td>
                <td style='text-align:center;'>".$item->created."</td>

            </tr>";
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