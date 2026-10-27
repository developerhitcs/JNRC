<div class="content">
	<div class="container-fluid">
		<div class="row" >
			<div class="col-md-12">	
				<div class="card" >
					<div class="card-header-info">
						<span>Runtime Manage SQL</span>
					</div>						
					<div class="card-body">
						<form action="<?php echo base_url('om_run_query');?>" method="post">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating">Enter SQL Code</label>
								<textarea name="query_text" class="form-control" rows="3" ></textarea>
							</div>
							<input type="submit" value="Submit" class="btn btn-success">
						</form>
					</div>
				</div>
			</div>			
		</div>
		<div class="row" >
			<div class="col-md-12">	
				<div class="card" >
					<div class="card-header-success">
						<span>Query Results</span>
					</div>						
					<div class="card-body">						
						<div style="overflow-y: scroll;height: 500px">
							<?php if(!empty($result)){
								echo '<pre>';
								print_r($result);
								echo '</pre>';
							}
							?>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>

