<?php 
$this->load->view('frontend/include/header');
if(isset($view))
{
	
	$this->load->view('frontend/'.$view);
} 
$this->load->view('frontend/include/footer');
?>