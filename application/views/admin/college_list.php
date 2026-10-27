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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
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
                        <span>Add New College </span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('save_school'); ?>">

                            <!-- CSRF TOKEN -->
                            <input type="hidden" name="<?= $csrf_name; ?>" value="<?= $csrf_hash; ?>">

                            <div class="row">

                                <div class="col-sm-4">
                                    <label>School Name</label>
                                    <input type="text" class="form-control" name="school_name" required
                                        autocomplete="off">
                                </div>

                                <div class="col-sm-4">
                                    <label>School Code</label>
                                    <input type="text" class="form-control" name="school_code" required>
                                </div>

                                <div class="col-sm-4">
                                    <label>Seat</label>
                                    <input type="number" class="form-control" name="seat" required>
                                </div>

                                <div class="col-sm-4">
                                    <label>Course Type</label>
                                    <select class="form-control" name="course_type" required>
                                        <option value="">Choose</option>
                                        <?php foreach (['ANM','GNM','BSC','PBSC','MSC'] as $type): ?>
                                        <option value="<?= html_escape($type); ?>">
                                            <?= html_escape($type); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>

                                <div class="col-sm-4">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" maxlength="10" required>
                                </div>

                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>

                                <div class="col-sm-4">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>

                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>

                                <div class="col-sm-2 mt-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Submit
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
                        <span>All College List</span>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!-- Add Aditional Section Contntent Here.... -->
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <th>#</th>
                                    <th style="width:40%;">Name</th>
                                    <th>Course</th>
                                    <th>Seat</th>
                                    <th>Code</th>
                                    <th>Password</th>
                                    <th>Date</th>
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
                                        <td><?php echo $key['seat'];?></td>
                                        <td><?php echo $key['school_code'];?></td>
                                        <td><?php echo $key['show_pass'];?></td>
                                        <td><?php echo $key['addon_date'];?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" title="More Details" data-toggle="modal"
                                                data-target="#ViewmyModal<?php echo $key['id'];?>"
                                                href="javascript:void();"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success btn-sm" title="Edit" data-toggle="modal"
                                                data-target="#EditmyModal<?php echo $key['id'];?>"
                                                href="javascript:void();"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this item?')"
                                                href="<?php echo base_url('delete_school/');?><?php echo $key['id'];?>"><i
                                                    class="fa fa-trash"></i></a>
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
                                                    <h4 class="card-title title-margin">Addon Date :
                                                        <?php echo $key['addon_date'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" id="EditmyModal<?php echo $key['id'];?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit College Details</h4>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo base_url('edit_school');?>">
														 <input type="hidden" name="<?= $csrf_name; ?>" value="<?= $csrf_hash; ?>">
                                                        <input type="hidden" name="edit_id"
                                                            value="<?php echo $key['id'];?>">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">School Name
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $key['school_name'];?>"
                                                                        name="edit_school_name" required=""
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">School Code
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $key['school_code'];?>"
                                                                        name="edit_school_code" required=""
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Seat </label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $key['seat'];?>"
                                                                        name="edit_seat" required="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <select class="form-control" name="edit_course_type"
                                                                        required="">
                                                                        <option
                                                                            value="<?php echo $key['course_type'];?>"
                                                                            selected><?php echo $key['course_type'];?>
                                                                        </option>
                                                                        <option value="">Choose School Type</option>
                                                                        <option value="ANM">ANM</option>
                                                                        <option value="GNM">GNM</option>
                                                                        <option value="BSC">BSC</option>
                                                                        <option value="PBSC">PBSC</option>
                                                                        <option value="MSC">MSC</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Email </label>
                                                                    <input type="email" class="form-control"
                                                                        value="<?php echo $key['email'];?>"
                                                                        name="edit_email" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Phone </label>
                                                                    <input type="tel" maxlength="10"
                                                                        class="form-control"
                                                                        value="<?php echo $key['phone'];?>"
                                                                        name="edit_phone" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Address </label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $key['address'];?>"
                                                                        name="edit_address" required=""
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group is-filled">
                                                                    <label class="bmd-label-floating">Date </label>
                                                                    <input type="text" name="date"
                                                                        class="form-control datepicker"
                                                                        value="<?php echo $key['addon_date'];?>"
                                                                        required="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Password </label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $key['show_pass'];?>"
                                                                        name="edit_password" required=""
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-block">Update</button>
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