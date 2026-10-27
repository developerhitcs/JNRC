
<style type="text/css">
	.table>thead>tr>th {
    vertical-align: inherit;
    /* border-bottom: 2px solid #ddd; */
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
     padding: none; 
    line-height: 1.42857143;
    vertical-align: none;
    border-top: 1px solid #ddd;
}
th {
     text-align: none; 
}
td, th {
     padding: none; 
}
td{
	color:black;
}

</style>
 <div class="row" style="min-height: 400px;">
<div class="col-sm-12 table-responsive">

 <table id="view_table" class="table table-striped table-bordered" style="width: 100%">
                <thead class="text-primary">
                	<tr>
                        <th style="width: 30px;" rowspan="4">Sl.no.</th>
                        <th>Course</th>
                        <th>Reference No.</th>
                        <th>Name</th>
                        <th>Father's Name</th>
                        <th>Date of Birth</th>
                        
                        <th>Ver Report</th>
                        <th>Image</th>
                        <th>Sign</th>
                        <th style="width: 150px;">Remarks</th>
                        <th>Action</th>
                    
                    </tr>
                    </thead>
                    <tbody class="text-primary">
                       <?php $i=1; ?>
                       <?php foreach ($row as $key ) { ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php if($key['course']=='gnm_year_1')echo '1st Year GNM'; elseif($key['course']=='gnm_year_2')echo '2nd Year GNM'; elseif($key['course']=='gnm_year_3')echo '3rd Year GNM'; elseif($key['course']=='anm_year_1')echo '1st Year ANM';elseif($key['course']=='anm_year_2')echo '2nd Year ANM';?></td>
                            <td><?php echo $key['ref_no'];?></td>
                            <td><?php echo $key['name'];?></td>
                            <td><?php echo $key['father_name'];?></td>
                            <td><?php echo $key['dob'];?></td>
                            <td><a href="<?php echo base_url().$key['file1'];?>" target="_blank" class="btn btn-xs btn-success">Matric Report</a><br><br><a href="<?php echo base_url().$key['file2'];?>" target="_blank" class="btn btn-xs btn-success">Inter Report</a></td>
                                                    <td><img src="<?php echo base_url(); echo  $key['img1']; ?>" style=" width:70px; height: 92px;"></td>
                                                    <td><img src="<?php echo base_url(); echo  $key['img2']; ?>" style=" width:112px; height: 49px;"></td>
                            <td><?php echo $key['remarks'];?></td>
                            <td><a href="<?php echo base_url('preview_exam_form/').$key['ref_id'];?>" class="btn btn-xs btn-primary">View Detail</a></td>
                         <?php $i++; } 
                                              
                                                ?>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    </div>
           
