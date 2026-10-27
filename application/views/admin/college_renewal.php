<style>
.title-margin {

    padding-bottom: 5px;
    border-bottom: 1px dashed #c3c3c3;
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
                    <div class="card-header-success">
                        <span>All College Renewal Details</span>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!-- Add Aditional Section Contntent Here.... -->
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <th>#</th>
                                    <th style="width:30%;">Name</th>
                                    <th>Course</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Renewal Date</th>
                                    <th>Expiry Date</th>
                                    <th>Certificate</th>
                                    <th class="disabled-sorting">Action</th>
                                </thead>
                                <tbody>
                                    <?php 
									$i=1; 
									foreach ($row as $key) 
									{ 
										?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $key['school_name'];?></td>
                                        <td><?php echo $key['course_type'];?></td>
                                        <td><?php echo $key['school_code'];?></td>
                                        <?php
											if($key['renewal_status']=='Active')
											{
												?>
                                        <td><span
                                                class="badge badge-success"><?php echo $key['renewal_status'];?></span>
                                        </td>
                                        <?php
											}
											else
											{
												?>
                                        <td><span class="badge badge-danger"><?php echo $key['renewal_status'];?></span>
                                        </td>
                                        <?php
											}
											?>
                                        <td><?php echo $key['renewal_date'];?></td>
                                        <td><?php echo $key['renewal_expiry_date'];?></td>
                                        <td><a href="<?php echo base_url('uploads_affliation/certificate/'); echo $key['renewal_ceritificate'];?>"
                                                target="_blank"><span class="badge badge-info">View</span></a></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" title="More Details" data-toggle="modal"
                                                data-target="#ViewmyModal<?php echo $key['id'];?>"
                                                href="javascript:void();"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success btn-sm" title="Edit" data-toggle="modal"
                                                data-target="#EditmyModal<?php echo $key['id'];?>"
                                                href="javascript:void();"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal" id="ViewmyModal<?php echo $key['id'];?>">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo $key['school_name']; ?> Details
                                                        :-</h4>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="card-title title-margin">School Name :
                                                        <?php echo $key['school_name']; ?></h4>
                                                    <h4 class="card-title title-margin">School Code :
                                                        <?php echo $key['school_code']; ?></h4>
                                                    <h4 class="card-title title-margin">School Seat :
                                                        <?php echo $key['seat']; ?></h4>
                                                    <h4 class="card-title title-margin">Contntent Type :
                                                        <?php echo $key['course_type']; ?></h4>
                                                    <h4 class="card-title title-margin">Mobile Number :
                                                        <?php echo $key['phone']; ?></h4>
                                                    <h4 class="card-title title-margin">Email-Id :
                                                        <?php echo $key['email']; ?></h4>
                                                    <h4 class="card-title title-margin">Address :
                                                        <?php echo $key['address']; ?></h4>
                                                    <br>
                                                    <h4 class="card-title title-margin">Status :
                                                        <?php
															if($key['renewal_status']=='Active')
															{
																?>
                                                        <span
                                                            class="badge badge-success"><?php echo $key['renewal_status'];?></span>
                                                        <?php
															}
															else
															{
																?>
                                                        <span
                                                            class="badge badge-danger"><?php echo $key['renewal_status'];?></span>
                                                        <?php
															}
															?>
                                                    </h4>
                                                    <h4 class="card-title title-margin">Renewal Date :
                                                        <?php echo $key['renewal_date']; ?></h4>
                                                    <h4 class="card-title title-margin">Expiry Date :
                                                        <?php echo $key['renewal_expiry_date']; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" id="EditmyModal<?php echo $key['id'];?>">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Renewal Status</h4>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?= base_url('update_renewal'); ?>"
                                                        enctype="multipart/form-data">

                                                        <!-- CSRF -->
                                                        <input type="hidden" name="<?= $csrf_name; ?>"
                                                            value="<?= $csrf_hash; ?>">

                                                        <input type="hidden" name="update_id"
                                                            value="<?= (int)$key['id']; ?>">

                                                        <div class="row">

                                                            <div class="col-sm-12">
                                                                <label>Renewal Status</label>
                                                                <select class="form-control" name="renewal_status"
                                                                    required>
                                                                    <option
                                                                        value="<?= html_escape($key['renewal_status']); ?>"
                                                                        selected>
                                                                        <?= html_escape($key['renewal_status']); ?>
                                                                    </option>
                                                                    <option value="">Choose</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="Expired">Expired</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group bmd-form-group is-filled"> <label
                                                                        class="bmd-label-floating">Renewal Date </label>
                                                                    <input type="text" name="renewal_date"
                                                                        class="form-control datepicker"
                                                                        value="<?php echo $key['renewal_date'];?>"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>




                                                            <div class="col-sm-6">
                                                                <div class="form-group bmd-form-group is-filled"> <label
                                                                        class="bmd-label-floating">Renewal Expiry Date
                                                                    </label> <input type="text"
                                                                        name="renewal_expiry_date"
                                                                        class="form-control datepicker"
                                                                        value="<?php echo $key['renewal_expiry_date'];?>"
                                                                        autocomplete="off"> </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <label>Upload Renewal Certificate</label>
                                                                <input type="file" class="form-control"
                                                                    name="renewal_ceritificate">
                                                                <input type="hidden" name="old_renewal_ceritificate"
                                                                    value="<?= html_escape($key['renewal_ceritificate']); ?>">
                                                            </div>

                                                            <div class="col-sm-3 mt-3">
                                                                <button type="submit" class="btn btn-success btn-block">
                                                                    Update
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
</div>