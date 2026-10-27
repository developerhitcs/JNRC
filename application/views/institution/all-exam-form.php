<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_SESSION['errmsg'])) 
				{
					?>
					<div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
						<strong><?php echo $_SESSION['errmsg']; ?></strong>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="alert" aria-label="Close" style="float:right;margin-top:-5px;"><span aria-hidden="true">&times;</span></button>  
					</div>
					<?php
					unset($_SESSION['msg']);
					unset($_SESSION['errmsg']);
				}
				?>
			</div>
		</div> 
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-info">
						<span>Search Submitted Exam Form Details</span>		
					</div>	
					<div class="card-body">						
						<form method="post">
							<div class="row">								
								<div class="col-sm-5">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Choose Batch Session Year <small class="text-danger">*</small></label>
										<select class="form-control session"  name="session" required="">
											<option value="">Select Year</option>											
											<?php 
											foreach($batch_session_year as $bs)
											{
												?>
												<option value="<?php echo $bs['batch_session']; ?>"><?php echo $bs['batch_session']; ?></option>
												<?php
											}
											?>																													
										</select>								
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Choose Course <small class="text-danger">*</small></label>
										<select class="form-control course" name="course" required="">
											<option value="">Select Course</option>
											<?php
											if($_SESSION['school_course']=='ANM')
											{
												?>
												<option value="1st Year ANM">1st Year ANM</option>
												<option value="2nd Year ANM">2nd Year ANM</option>																		
												<?php
											}
											else
											{
												?>
												<option value="1st Year GNM">1st Year GNM</option>
												<option value="2nd Year GNM">2nd Year GNM</option>
												<option value="3rd Year GNM">3rd Year GNM</option>																	
												<?php
											}
											?>											
										</select>								
									</div>
								</div>
								<div class="col-sm-2">
									<button type="button" onclick="myAjax()" class="btn btn-success btn-block">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 search_result">  
				
			</div>
		</div>
	</div>
</div>

<script>
function myAjax() 
{
	var session = $(".session").val();
	var course = $(".course").val();
	$.ajax(
	{
		type: "POST",
		url: "<?php echo base_url('search_exam_form_details');?>",
		data:{session:session,course:course},
		success:function(data) 
		{
			$('.search_result').html(data);  
		}
	});
}

</script>