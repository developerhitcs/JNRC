<style>
.title-margin
{
	
    padding-bottom: 5px;
    border-bottom: 1px dashed  #c3c3c3;
    text-align: left;
	font-family: cursive;
}
</style>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_SESSION['errmsg'])) 
				{
					?>
					<div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
						<strong><?php echo $_SESSION['errmsg']; ?></strong>
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
						<span>Set Subject Date and Time </span>		
					</div>	
					<div class="card-body">
					<div class="content">
                      <div class="container-fluid">
                        <?php if ($this->session->flashdata('msg')): ?>
                          <div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
                        <?php endif; ?>
                    
                       <form method="post" action="<?php echo base_url('admin/update_subject_datetime'); ?>">

<input type="hidden" 
name="<?php echo $this->security->get_csrf_token_name(); ?>" 
value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="row">

<!-- Row 1 -->
<div class="col-md-4">
<div class="form-group">
<label>Course</label>
<select name="course" id="course" class="form-control" required>
<option value="">Select Course</option>
<?php foreach ($courses as $c): ?>
<option value="<?php echo $c['course']; ?>"><?php echo $c['course']; ?></option>
<?php endforeach; ?>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Year</label>
<select name="year" id="year" class="form-control" required>
<option value="">Select Year</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Subject</label>
<select name="subject_name" id="subject_name" class="form-control" required>
<option value="">Select Subject</option>
</select>
</div>
</div>

</div>

<div class="row">

<!-- Exam Date -->
<div class="col-md-3">
<div class="form-group">
<label>Exam Date</label>
<input type="date" name="exam_date" class="form-control"
value="<?php echo (!empty($subject['exam_date']) && $subject['exam_date'] != '0000-00-00') ? $subject['exam_date'] : ''; ?>">
</div>
</div>

<!-- Exam Time -->
<div class="col-md-3">
<div class="form-group">
<label>Exam Time</label>
<input type="time" name="exam_time" class="form-control"
value="<?php echo (!empty($subject['time']) && $subject['time'] != '00:00:00') ? $subject['time'] : ''; ?>">
</div>
</div>

</div>

<button type="submit" class="btn btn-primary">Update</button>

</form>
                      </div>
                    </div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-success">
						<span> Subject Date and Time</span>		
					</div>	
					<div class="card-body">	
						<div class="toolbar">							
							<!-- Add Aditional Section Contntent Here.... -->					
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-bordered" style="width: 100%">
								<thead>
									<th>Course</th>
									<th>Year</th>
										<th>Subject</th>
											<th>Date</th>
												<th>Time</th>
									
								
								</thead>
								  <tbody>
                            <?php foreach($subject_details as $subject): ?>
                            <tr>
                                <td><?php echo $subject['course']; ?></td>
                                <td><?php echo $subject['year']; ?></td>
                                <td><?php echo $subject['subject_name']; ?></td>
                                <td><?php echo $subject['exam_date']; ?></td>
                                <td><?php echo $subject['time']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
					

							
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
  var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

  $('#course, #year').change(function() {

    var course = $('#course').val();
    var year = $('#year').val();

    if(course && year) {

      var data = {};
      data['course'] = course;
      data['year'] = year;
      data[csrfName] = csrfHash;

      $.ajax({
        url: "<?php echo base_url('admin/get_subjects_by_course_year'); ?>",
        type: "POST",
        data: data,
        success: function(response) {
          $('#subject_name').html(response);
        }
      });

    }
  });

});
</script>
