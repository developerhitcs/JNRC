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
						<span>Add New Center </span>		
					</div>	
					<div class="card-body">
						<form method="post" action="<?php echo base_url('save_center');?>"  >
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Name of Center </label>
										<input type="text" class="form-control" name="name_center" required="" autocomplete="off">
									</div>
								</div>
								<div class="col-sm-2">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-success">
						<span>All Center List</span>		
					</div>	
					<div class="card-body">	
						<div class="toolbar">							
							<!-- Add Aditional Section Contntent Here.... -->					
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-bordered" style="width: 100%">
								<thead>
									<th>Sl No.</th>
									<th style="width:70%;">Name</th>
									<th  style="width:20%;" class="disabled-sorting">Action</th>
								</thead>
						<tbody>
    <?php if (!empty($centers)): ?>
        <?php foreach ($centers as $index => $center): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($center->name_center); ?></td>
                <td>
                    <!-- Edit Button: Opens modal -->
                    <a class="btn btn-success btn-sm" title="Edit" data-toggle="modal" data-target="#EditmyModal<?= $center->id; ?>" href="javascript:void(0);">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <!-- Delete Button -->
                    <a class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')" href="<?= base_url('delete_center/' . $center->id); ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="EditmyModal<?= $center->id; ?>" tabindex="-1" role="dialog" aria-labelledby="EditLabel<?= $center->id; ?>" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" action="<?= base_url('update_center/' . $center->id); ?>">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="EditLabel<?= $center->id; ?>">Edit Center</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="name_center">Center Name</label>
                              <input type="text" name="name_center" class="form-control" value="<?= htmlspecialchars($center->name_center); ?>" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">No centers added yet.</td>
        </tr>
    <?php endif; ?>
</tbody>

							
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

