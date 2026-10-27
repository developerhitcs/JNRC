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
                        <span>Upload Gallery</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('save_upload_gallery'); ?>"
                            enctype="multipart/form-data">

                            <!-- CSRF -->
                            <input type="hidden" name="<?= $csrf_name; ?>" value="<?= $csrf_hash; ?>">

                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Image Title</label>
                                        <input type="text" name="title" class="form-control" required minlength="3"
                                            maxlength="150" pattern="[A-Za-z0-9\s\-\_\.]+" autocomplete="off">

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <label class="bmd-label-floating">Insert Photo</label>
                                    <input type="file" class="form-control" name="img1"
                                        accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" required>
                                </div>

                                <div class="col-sm-2 mt-2">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Upload Image
                                    </button>
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
                        <span>Gallery Upload List</span>
                    </div>
                    <div class="card-body">
                        <table id="datatables" class="table table-striped table-bordered">
                            <thead>
                                <th>S.no.</th>
                                <th>Image Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
								$i=1; 
								foreach ($row as $key ) 
								{ 
									?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $key['title'];?></td>
                                    <td><img src="<?php echo base_url(); echo  $key['img1']; ?>" style=" height:60px;">
                                    </td>
                                    <td>
                                        <a title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this item?')"
                                            class="btn btn-danger btn-sm"
                                            href="<?php echo base_url('delete_gallery/'); echo $key['id'];?>"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php 
									$i++; 
								} 
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>