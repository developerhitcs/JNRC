<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
.container{
    /*margin-top: 30px;
    margin-bottom: 15px;*/
    /* 
    max-width: 1140px;
    max-width: 960px;
    max-width: 720px;
    max-width: 540px;
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
    width: 100%;
    */
}
.wizards{
    overflow: hidden; 
    position: relative; 
    margin-top: 20px;
}
.progressbar{
    position: absolute; 
    top: 24px; 
    left: 0; 
    width: 100%; 
    height: 1px; 
    background: #ddd;
}
.progress-line{
    position: absolute; 
    top: 0; 
    left: 0; 
    height: 1px; 
    background: green;
}
.form-wizard{
    position: relative; 
    float: left; 
    width: 20%; 
    padding: 0 5px; 
    text-align: center;
}
.wizard-icon{
    display: inline-block; 
    width: 40px; 
    height: 40px; 
    margin-top: 4px; 
    background: #ddd;
    font-size: 16px; 
    color: #fff; 
    line-height: 40px;
    -moz-border-radius: 50%; 
    -webkit-border-radius: 50%; 
    border-radius: 50%;
}
.form-wizard.activated .wizard-icon{
    background: #fff; 
    border: 1px solid green; 
    color: green; 
    line-height: 38px;
}
.form-wizard.active .wizard-icon{
    width: 48px; 
    height: 48px; 
    margin-top: 0; 
    background: green; 
    font-size: 22px; 
    line-height: 48px;
}
.form-wizard p { 
    color: #ccc; 
}
.form-wizard.activated p { 
    color: green; 
}
.form-wizard.active p { 
    color: green; 
}
fieldset { 
    display: none; 
    text-align: left; 
}
.wizard-buttons { 
    text-align: right; 
}
.input-error { 
    border-color: red; 
}
/*
.btn{
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .5rem .75rem;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
    transition: all .15s ease-in-out;
}
*/
.btn-previous{
    background-color: lightgrey;
}
.btn-next{
    background-color: green;
    color: white;
}
iframe{
    width: 100%;
    height: 400px;
    border: 1px solid #ccc;
}
h3 {
  color: #2f2f8f;
}
</style>
<body>
<div class="container">
  <div class="row" style="margin-top: 10px;">
    <div class="col-sm-7"></div>
    <div class="col-sm-5 ">
      <div class="pull-right">
     <span style=" color: red;"> Welcome <?php echo $this->session->inst_name;?> !!</span> 
      <a onclick="return confirm('Are you sure you want to logout?')" href="<?php echo base_url();?>logout_user" class="btn btn-danger" style="border-radius: 35px;">Logout</a>
    </div>
    </div>
  </div>
       <form action='<?php echo base_url();?>/save_affil' method='post'>
            <div class="wizards">
                <div class="progressbar">
                    <div class="progress-line" data-now-value="12.11" data-number-of-steps="5" style="width: 12.11%;"></div> <!-- 19.66% -->
                </div>
                <div class="form-wizard active">
                    <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                    <p style="text-align: center;">Instructions</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-user"></i></div>
                    <p style="text-align: center;">Institution,Society/Trust/Mission Details</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-key"></i></div>
                    <p style="text-align: center;">Seat Availability and Other Details</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-globe"></i></div>
                    <p style="text-align: center;">Teaching Faculty Details</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                    <p style="text-align: center;">Clinical Facility & Other Details</p>
                </div>
            </div>
             <fieldset>
                <iframe src="<?php echo base_url();?>assets/license.txt"></iframe>
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"  value="yes"> I agree with this license

                </label>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-next">Next</button>
                </div>
            </fieldset> 
            <fieldset>
              <center><h3>Society/ Trust/ Mission Details</h3></center>
              <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Chairperson/ Registrar Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="chairperson" id="chairperson" value="" autofocus="">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Society/ Trust Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="society" id="society" value="" >
                  </div>
                </div>
                  <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Address :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="address" id="address" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>List of Society Members :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="soc_members" id="soc_members" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>State Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="state" id="state" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>District :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="district" id="district" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Tehsil/ Block :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="tehsil" id="tehsil" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="pin" id="pin" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Landline No. :</label>
                    <input type="number" class="form-control" name="landline" id="landline" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="mobile" id="mobile" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Society/ Trust Email :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="" >
                  </div>
                </div>
                <center><h3>Institution Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Name of the institution :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="institution" id="institution" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Address of the Institution :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="address_ins" id="address_ins" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>State :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="state_ins" id="state_ins" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>District :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="district_ins" id="district_ins" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Tehsil :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="tehsil_ins" id="tehsil_ins" value="" >
                  </div>
                   <div class="form-group col-sm-5">
                    <label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="pin_ins" id="pin_ins" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                 
                  <div class="form-group col-sm-5">
                    <label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="landline_ins" id="landline_ins" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="fax_ins" id="fax_ins" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Institution is Under :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="ins_under" id="ins_under" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Institution Email:<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="ins_email" id="ins_email" value="" >
                  </div>
                </div>
                <center><h3>Fee Code/Principal Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                   <?php  
                        foreach ($appl_id as $appl_id) { }                              
                    ?> 
                  <div class="form-group col-sm-5">
                    <label>Application ID :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="applicant_id" id="applicant_id" value="<?php echo  $appl_id['id'] + 1;?>" readonly="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Fee Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="fee_code" id="fee_code" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Entry Date :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="date" class="form-control" name="ent_date" id="ent_date" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Name of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="principal" id="principal" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Email of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="email_prin" id="email_prin" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="landline_prin" id="landline_prin" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="fax_prin" id="fax_prin" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="mobile_prin" id="mobile_prin" value="" >
                  </div> 
                </div>
                 <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="wizard-buttons  col-sm-3">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <button type="button" class="btn btn-next">Next</button>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                 <center><h3>Seat Availability and Other Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Program, Seats and Total No. of Admitted Student Details :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="student_total" id="student_total" value="">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>M.Sc(N) Student Details :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="student_msc" id="student_msc" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>PBB.Sc(N) Student Details :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="student_pbb" id="student_pbb" value="" >
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Distance Education Details :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="distance_edu" id="distance_edu" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label>Other Short Term Course Details :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="other_short" id="other_short" value="" >
                  </div>
                  </div>
                <center><h3>Laboratory and Class Room Details</h3></center>
                 <!-- <button type="button" id="addd">Add</button>  -->
                <div class="row">
                  <div class="col-sm-1">
                    
                  </div>
                 <!-- <button type="button" id="addd">Add</button> -->
                 <div class="col-sm-10 table-responsive">
                 <table id="result_lab">
                    <tr>
                        <td style="width:70px;"><strong>Sl. No.</strong></td>
                        <td align="center"><strong>Laboratory </br>Name</strong></td>
                        <td align="center"><strong>Size of </br>Laboratory</strong></td>
                        <td align="center"><strong>No. of Equipments</strong></td>
                        <td align="center"><strong>No. of Dummies & Dolls</strong></td>
                        <td align="center"><strong>No. of the Class Rooms</strong></td>
                        <td align="center"><strong>Size of the Class Rooms</strong></td>
                        <td align="center"><strong>Entry Date</strong></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><input type="text" class="form-control" name="lab_name[]" id="lab_name" value="" ></td>
                        <td><input type="text" class="form-control" name="lab_size[]" id="lab_size" value="" ></td>
                        <td><input type="text" class="form-control" name="no_equp[]" id="no_equp" value="" ></td>
                        <td><input type="text" class="form-control" name="no_dum[]" id="no_dum" value="" ></td>
                        <td><input type="text" class="form-control" name="no_cls[]" id="no_cls" value="" ></td>
                        <td><input type="text" class="form-control" name="size_cls[]" id="size_cls" value="" ></td>
                        <td><input type="date" class="form-control" name="ent_date_lab[]" id="ent_date_lab" value="" ></td>
                        <td align="center"></td>
                    </tr>
                 </table>
                 
                 
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" id="add_lab">Add</button>
                  </div>
                <hr/>
                 <script>
                    var ppl = 1;
                    $("#add_lab").click(function(){
                        ppl = ppl + 1;
                        var app = '<tr id="row'+ppl+'"><td ><input type="text" name="sl_no[]" class="form-control"  id="sl_no_'+ppl+'" value="'+ppl+'" readonly></td><td><input type="text" name="lab_name[]" class="form-control" id="lab_name_'+ppl+'"></td><td><input type="text" name="lab_size[]" class="form-control" id="lab_size_'+ppl+'"></td><td><input type="text" name="no_equp[]" class="form-control" id="no_equp_'+ppl+'"></td><td><input type="text" name="no_dum[]" class="form-control" id="no_dum_'+ppl+'"></td><td><input type="text" name="no_cls[]" class="form-control" id="no_cls_'+ppl+'"></td><td><input type="text" name="size_cls[]" class="form-control" id="size_cls'+ppl+'"></td><td><input type="date" name="ent_date_lab[]" class="form-control" id="ent_date_lab_'+ppl+'"></td><td class="clsrmv_'+ppl+'" id="'+ppl+'" onclick="remov_lab(this)"><span class="glyphicon glyphicon-remove-circle" style="color:red; font-size:17px; cursor:pointer; line-height:30px;"></span></td></tr>';
                        $("#result_lab").append(app);
                        var rowCountLab = $('#result_lab tr').length;
                        //$("#result3").val(rowCount - 2);
                        //$("#autofill_prdct").val('');
                    });

                    function remov_lab(arg)
                    {
                        //alert(arg.id);
                        var str = arg.id;
                        //alert(str);
                         $(arg).parent('tr').remove();
                    }
                </script>
                 <center><h3>Building and Penalty Details</h3></center>
                 <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="table-responsive">
                  <table id="building" class="table table-striped" >
                    <tr>
                        <td style="width: 70px;">1.</td>
                        <td style="width: 500px;">
                    <label>Online Registration of all the said details on </br>the website for 2016-2017 academic year :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="onln_reg" id="onln_reg1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="onln_reg" id="onln_reg2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">2.</td>
                        <td style="width: 500px;">
                    <label>General Profile :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="general" id="general1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="general" id="general2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">3.</td>
                        <td style="width: 500px;">
                    <label>Physical :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="physical" id="physical1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="physical" id="physical2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">4.</td>
                        <td style="width: 500px;">
                    <label>Clinical :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="clinical" id="clinical1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="clinical" id="clinical2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">5.</td>
                        <td style="width: 500px;">
                    <label>Admission :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="admission" id="admission1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="admission" id="admission2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">7.</td>
                        <td style="width: 500px;">
                    <label>Teachers :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="teachers" id="teachers1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="teachers" id="teachers2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">8.</td>
                        <td style="width: 500px;">
                    <label>Previous year annual fees paid :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="pre_year" id="pre_year1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="pre_year" id="pre_year2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td style="width: 70px;">9.</td>
                        <td style="width: 500px;">
                    <label>Challan Attachment :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <!-- <input  type="file" name="gender" id="gender" value="1" > -->
                       <!-- Please attach challan with the documents
                        </td>
                    </tr> -->
                    <tr>
                        <td style="width: 70px;">9.</td>
                        <td style="width: 500px;">
                    <label>Building Status :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-control" type="text" name="building" id="building" style="width:300px;">
                        </td>
                    </tr>
                     <tr>
                        <td style="width: 70px;">10.</td>
                        <td style="width: 500px;">
                    <label>Location (Institution's full address) of the building :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                     <!--  <input class="form-control" type="text" name="loc_full_addr" id="loc_full_addr" style="width:500px;"> -->
                     <textarea class="form-control" name="loc_full_address" id="loc_full_address" style="width:300px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">11.</td>
                        <td style="width: 500px;">
                    <label>Total area of the building :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                      <input class="form-control" type="text" name="tot_area" id="tot_area" style="width:300px;">
                        </td>
                    </tr>
                     <tr>
                        <td style="width: 70px;">12.</td>
                        <td style="width: 500px;">
                    <label>Blueprint should be signed by the authority :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="blueprint" id="blueprint1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="blueprint" id="blueprint2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                     <tr>
                        <td style="width: 70px;">13.</td>
                        <td style="width: 500px;">
                    <label>In whose name the building/land is registered :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                   <input class="form-control" type="text" name="build_name" id="build_name" style="width:300px;">
                        </td>
                    </tr>
                     <tr>
                        <td style="width: 70px;">14.</td>
                        <td style="width: 500px;">
                    <label>Building completion certificate/ Building </br> status report attested by registered architect with valid registration number as per INC cercular dated 10.03.2016 along with the following details :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <!-- <input class="form-check-input" type="radio" name="gender" id="gender" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="2"><strong>No</strong> -->
                      Please attach xerox with the documents
                        </td>
                    </tr>
                    <tr>
                        <!-- <td></td> -->
                        <td colspan="3"><center><h3>Penalty Details</h3></center></td>
                        <!-- <td></td> -->
                    </tr>
                    <tr>
                        <td style="width: 70px;">1.</td>
                        <td style="width: 500px;">
                    <label>If, Penalty of the building asked during 2016-2017</br> then submit the D.D. of Penalty in form of "Secretary, Jharkhand </br>Nursing Council, Ranchi" :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-check-input" type="radio" name="penalty" id="penalty1" value="1" ><strong>Yes</strong>&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="penalty" id="penalty2" value="2"><strong>No</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">2.</td>
                        <td style="width: 500px;">
                    <label>Demand Draft(DD) Number :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                      <input class="form-control" type="text" name="dd_number" id="dd_number" style="width:300px;" >
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">3.</td>
                        <td style="width: 500px;">
                    <label>Demand Draft(DD) Attachment :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <!-- <input  type="file" name="gender" id="gender" > -->
                    Please attach Demand Draft(DD) with the documents
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">4.</td>
                        <td style="width: 500px;">
                    <label>Demand Draft(DD) Date :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                   <input class="form-control" type="date" name="dd_date" id="dd_date" style="width:300px;" >
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">5.</td>
                        <td style="width: 500px;">
                    <label>Built-up area of Teaching Block  :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-control" type="text" name="build_area" id="build_area" style="width:300px;" >
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">6.</td>
                        <td style="width: 500px;">
                    <label>Built-up area of Hostel Block :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-control" type="text" name="build_hostel" id="build_hostel" style="width:300px;" >
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">7.</td>
                        <td style="width: 500px;">
                    <label>Entry Date :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <input class="form-control" type="date" name="ent_date_pen" id="ent_date_pen" style="width:300px;" >
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70px;">8.</td>
                        <td style="width: 500px;">
                    <label>Two photographs of the complete building taken from</br> different angle duly certificate by the architect :<span style="color:red; font-weight: bold;"> *</span></label>
                        </td>
                        <td>
                    <!-- <input  type="file" name="gender" id="gender" ></br>
                    <input  type="file" name="gender" id="gender" > -->
                    Please affix two postcard size (5.8 x 4.1 inches) photographs on the document after printing.
                        </td>
                    </tr>
                  </table>
                    </div>
                  </div>
                </div> 
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="wizard-buttons  col-sm-3">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <button type="button" class="btn btn-next">Next</button>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <center><h3>Teaching Faculty Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                    
                  </div>
                  <!-- <button type="button" id="addd" class="btn btn-success">Add Faculty</button> --> 
                 <div class="col-sm-10 table-responsive">
                 <table id="result_faculty">
                    <tr>
                        <td style="width:70px;"><strong>Sl. No.</strong></td>
                        <td align="center"><strong>Faculty Name, Gender,</br> Designation and Qualification</strong></td>
                        <td align="center"><strong>Institute Name, Passing</br> Year, Date of Joining and</br> Qualification Certificatre</strong></td>
                        <td align="center"><strong>RN/RM Number, </br>RN/RM Certificate,</br>NUID No. and Entry</br> Date</strong></td>
                        <td align="center"><strong>Teaching Experience</br> and Faculty Image</strong></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td>Faculty Name<input type="text" class="form-control" name="fac_name[]" id="fac_name" value="" ></td>
                        <td>Institute Name<input type="text" class="form-control" name="fac_inst[]" id="fac_inst" value="" ></td>
                        <td>RN/RM Number:<input type="text" class="form-control" name="fac_r_num[]" id="fac_r_num" value="" ></td>
                        <td>UG Teaching Exp.:<input type="text" class="form-control" name="fac_ug[]" id="fac_ug" value="" ></td>
                       
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Gender<input type="text" class="form-control" name="fac_gen[]" id="fac_gen" value="" ></td>
                        <td>Passing Year<input type="text" class="form-control" name="fac_pass[]" id="fac_pass" value="" ></td>
                        <td>RN/RM Certificate:</br>Please attach certificate with the documents<!-- <input type="text" class="form-control" name="stud_name" id="stud_name" value="" > --></td>
                        <td>PG Teaching Exp.:<input type="text" class="form-control" name="fac_pg[]" id="fac_pg" value="" ></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Designation<input type="text" class="form-control" name="fac_des[]" id="fac_des" value="" ></td>
                        <td>Date of Joining<input type="date" class="form-control" name="fac_join[]" id="fac_join" value="" ></td>
                        <td>Aadhar Number<input type="text" class="form-control" name="fac_adhr[]" id="fac_adhr" value="" ></td>
                        <td>Diploma Teaching Exp.:<input type="text" class="form-control" name="fac_dip[]" id="fac_dip" value="" ></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Qualification<input type="text" class="form-control" name="fac_qual[]" id="fac_qual" value="" ></td>
                        <td>Qualification Certification Attachment:</br>Please attach qualification certificate with the documents<!-- <input type="text" class="form-control" name="stud_name" id="stud_name" value="" > --></td>
                        <td>Entry Date:<input type="date" class="form-control" name="fac_ent[]" id="fac_ent" value="" ></td>
                        <td>Faculty Image:</br><!-- Please affix passport size photo on the document -->
                          <input type="file"  name="fac_img[]" id="fac_img" value="Upload" ></td>
                        <td align="center"></td>
                    </tr>
                 </table>
                 
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" id="add_faculty">Add</button>
                  </div>
                <hr/>
                 <script>
                    var ppf = 1;
                    $("#add_faculty").click(function(){
                        ppf = ppf + 1;
                        var app = '<tr id="rowf'+ppf+'"><td ><input type="text" name="sl_no[]" class="form-control"  id="slno_'+ppf+'" value="'+ppf+'" readonly></td><td>Faculty Name<input type="text" name="fac_name[]" class="form-control" id="fac_name'+ppf+'"></td><td>Institute Name<input type="text" name="fac_inst[]" class="form-control" id="fac_inst'+ppf+'"></td><td>RN/RM Number:<input type="text" name="fac_r_num[]" class="form-control" id="fac_r_num'+ppf+'"></td><td>UG Teaching Exp.:<input type="text" name="fac_ug[]" class="form-control" id="fac_ug'+ppf+'"></td><td class="clsrmv_'+ppf+'" id="'+ppf+'" onclick="remov_faculty(this)"><span class="glyphicon glyphicon-remove-circle" style="color:red; font-size:17px; cursor:pointer; line-height:30px;"></span></td></tr><tr id="rowf1'+ppf+'"><td></td><td>Gender<input type="text" name="fac_gen[]" class="form-control" id="fac_gen'+ppf+'"></td><td>Passing Year<input type="text" name="fac_pass[]" class="form-control" id="fac_pass'+ppf+'"></td><td>RN/RM Certificate:</br>Please attach certificate with the documents</td><td>PG Teaching Exp.:<input type="text" name="fac_pg[]" class="form-control" id="fac_pg'+ppf+'"></td><td class="clsrmv_'+ppf+'" id="'+ppf+'" onclick="remov(this)"></td></tr><tr id="rowf2'+ppf+'"><td></td><td>Designation<input type="text" name="fac_des[]" class="form-control" id="fac_des'+ppf+'"></td><td>Date of Joining<input type="date" name="fac_join[]" class="form-control" id="fac_join'+ppf+'"></td><td>Aadhar Number:<input type="text" name="fac_adhr[]" class="form-control" id="fac_adhr'+ppf+'"></td><td>Diploma Teaching Exp.:<input type="text" name="fac_dip[]" class="form-control" id="fac_dip'+ppf+'"></td><td class="clsrmv_'+ppf+'" id="'+ppf+'" onclick="remov(this)"></td></tr><tr id="rowf3'+ppf+'"><td></td><td>Qualification<input type="text" name="fac_qual[]" class="form-control" id="fac_qual'+ppf+'"></td><td>Qualification Certificate Attachment:</br>Please attach qualification certificate with the documents</td><td>Entry Date:<input type="date" name="fac_ent[]" class="form-control" id="fac_ent'+ppf+'"></td><td>Faculty Image:</br>Please affix passport size photo on the document</td><td></td></tr>';
                        $("#result_faculty").append(app);
                        var rowCount = $('#result_faculty tr').length;
                        $("#result3").val(rowCount - 2);
                        $("#autofill_prdct").val('');
                    });

                    function remov_faculty(arg)
                    {
                        //alert(arg.id);
                        var str2 = arg.id;
                    //alert(str2);
                     // $(arg).parent('tr').remove();
                     $('#rowf'+str2).remove();
                     $('#rowf1'+str2).remove();
                     $('#rowf2'+str2).remove();
                     $('#rowf3'+str2).remove();
                     
                    }
                </script>
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="wizard-buttons  col-sm-3">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <button type="button" class="btn btn-next">Next</button>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <center><h3>Clinical Facility Details</h3></center>
                 <div class="row">
                  <div class="col-sm-1">
                    
                  </div>
                 <!-- <button type="button" id="addd">Add</button> -->
                 <div class="col-sm-10 table-responsive">
                 <table id="result_clin">
                    <tr>
                        <td style="width:70px;"><strong>Sl. No.</strong></td>
                        <td align="center" style="width:200px;"><strong>Parent Hospital </br>Name</strong></td>
                        <td align="center"><strong>Address</strong></td>
                        <td align="center"><strong>No. of Beds</strong></td>
                        <td align="center"><strong>Bed Occupancy</strong></td>
                      <tr>
                      <tr>
                        <td>1.</td>
                        <td><input type="text" class="form-control" name="parent_hos" id="parent_hos" value="" ></td>
                        <td><input type="text" class="form-control" name="clin_addr" id="clin_addr" value="" ></td>
                        <td><input type="text" class="form-control" name="clin_beds" id="clin_beds" value="" ></td>
                        <td><input type="text" class="form-control" name="clin_bed_occu" id="clin_bed_occu" value="" ></td>
                        <tr>
                        </tr>
                        <td></td>
                        <td align="center" style="width:200px;"><strong>Receipt of the Hospital</strong></td>
                        <td align="center"><strong>Permission letter of</br> Hospital for Clinical Exp.</strong></td>
                        <td align="center" style="width:120px;"><strong>Entry Date</strong></td>
                        <td align="center"></td>
                    </tr>

                        </tr>
                        <td></td>
                        <td><!-- <input type="text" class="form-control" name="stud_name" id="stud_name" value="" > -->Attach Receipt of the Hospital for Clinical Exp. of the Students</td>
                        <td>Clinical Experience of the Students:<input type="text" class="form-control" name="clin_exp" id="clin_exp" value="" ></td>
                        <td><input type="date" class="form-control" name="clin_ent" id="clin_ent" value="" ></td>
                        <td align="center"></td>
                    </tr>
                 </table> 

                 <center><h3>Affiliated Hospital Details</h3></center>
                 <table id="result_affl">
                    <tr>
                        <td style="width:70px;"><strong>Sl. No.</strong></td>
                        <td align="center" style="width:200px;"><strong> Hospital </br>Name</strong></td>
                        <td align="center" style="width:200px;"><strong>Address</strong></td>
                        <td align="center" ><strong>No. of Beds</strong></td>
                        <td align="center" ><strong>Bed Occupancy</strong></td>
                       
                        <td align="center" ><strong>Entry Date</strong></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><input type="text" class="form-control" name="affl_hos" id="affl_hos" value="" ></td>
                        <td><input type="text" class="form-control" name="affl_address" id="affl_address" value="" ></td>
                        <td><input type="text" class="form-control" name="affl_beds" id="affl_beds" value="" ></td>
                        <td><input type="text" class="form-control" name="affl_bed_occu" id="affl_bed_occu" value="" ></td>
                        <td><input type="date" class="form-control" name="affl_ent" id="affl_ent" value="" ></td>
                        <td align="center"></td>
                    </tr>
                 </table>
                 
                 <center><h3>Library Facilities and Declaration Details</h3></center>
                 <table id="result2">
                    <tr>
                        <td align="center" style="width:200px;"><strong> Nursing </br>Books</strong></td>
                        <td align="center" style="width:200px;"><strong>Anti Ragging and</br>HIV/AIDS/TB Details</strong></td>
                        <td align="center" ><strong>Declaration</strong></td>
                        <td align="center" ><strong>Date and Place</strong></td>
                    </tr>
                    <tr>
                        <td>Nursing Books<input type="text" class="form-control" name="nurs_books" id="nurs_books" value="" ></td>
                        <td>Total Number of students have been trained in HIV/AIDS/TB Module:<input type="text" class="form-control" name="nur_no_hiv" id="nur_no_hiv" value="" ></td>
                        <td>Declaration Candidate </br>Name:<input type="text" class="form-control" name="dec_name" id="dec_name" value="" ></td>
                        <td>Applicant Name:<input type="text" class="form-control" name="app_dec_name" id="app_dec_name" value="" ></td>
                    </tr>
                    <tr>
                        <td>Number of </br>Nursing</br> Journals Subscribed</br> (National):<input type="text" class="form-control" name="nur_jour_nat" id="nur_jour_nat" value="" ></td>
                        <td>Anti Ragging </br>Monitoring Committee</br>, If yes Members & their Mobile Numbers:<input type="text" class="form-control" name="anti_rag" id="anti_rag" value="" ></td>
                        <td>S/O, D/O or W/O:<input type="text" class="form-control" name="sodowo" id="sodowo" value="" ></td>
                        <td>Date:<input type="date" class="form-control" name="nur_ent" id="nur_ent" value="" ></td>
                    </tr>
                    <tr>
                        <td>Number of </br>Nursing</br> Journals Subscribed</br> (International):<input type="text" class="form-control" name="nur_jour_int" id="nur_jour_int" value="" ></td>
                        <td>Anti Ragging </br>Squad, If yes Members &</br> their Mobile Numbers:<input type="text" class="form-control" name="anti_rag_mob" id="anti_rag_mob" value="" ></td>
                        <td></td>
                        <td>Place:<input type="text" class="form-control" name="nur_place" id="nur_place" value="" ></td>
                    </tr>
                 </table>
                 <center><h3>Name of the Faculty trained under GFATM Programme Details</h3></center>
                 <table id="result_gfa">
                    <tr>
                        <td style="width:70px;"><strong>Sl. No.</strong></td>
                        <td align="center"><strong>Name of the</br>Faculty</strong></td>
                        <td align="center"><strong>HIV/AIDS</strong></td>
                        <td align="center"><strong>TB</strong></td>
                        <td align="center"><button type="button" class="btn btn-primary" id="add_gfatm">Add</button></td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><input type="text" class="form-control" name="gfa_name[]" id="gfa_name" value="" ></td>
                        <td><input type="text" class="form-control" name="gfa_hiv[]" id="gfa_hiv" value="" ></td>
                        <td><input type="text" class="form-control" name="gfa_tb[]" id="gfa_tb" value="" ></td>
                        <td align="center"></td>
                    </tr>
                 </table>
             </div>
             <div class="col-sm-1">
                    
                  </div>
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="wizard-buttons  col-sm-3">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button>
                    </div>
                </div>
                <script>
                    var ppg = 1;
                    $("#add_gfatm").click(function(){
                        ppg = ppg + 1;
                        var app = '<tr id="row'+ppg+'"><td ><input type="text" name="category[]" class="form-control"  id="str_'+ppg+'" value="'+ppg+'" readonly></td><td><input type="text" name="gfa_name[]" class="form-control" id="gfa_name'+ppg+'"></td><td><input type="text" name="gfa_hiv[]" class="form-control" id="gfa_hiv'+ppg+'"></td><td><input type="text" name="gfa_tb[]" class="form-control" id="gfa_tb'+ppg+'"></td><td class="clsrmv_'+ppg+'" id="'+ppg+'" onclick="remov_gfa(this)"><span class="glyphicon glyphicon-remove-circle" style="color:red; font-size:17px; cursor:pointer; line-height:30px;"></span></td></tr>';
                        $("#result_gfa").append(app);
                        var rowCount = $('#result_gfa tr').length;
                        //$("#result4").val(rowCount - 2);
                        //$("#autofill_prdct").val('');
                    });

                    function remov_gfa(arg)
                    {
                        //alert(arg.id);
                        var str = arg.id;
                      //alert(str);
                      $(arg).parent('tr').remove();
                    }
                </script>
                
            </fieldset>
           
            <fieldset>
                <div class="jumbotron text-center">
                <h2>Please click submit button to save your data</h2>
                </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Previous</button>
                    <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
     <script src="<?php echo base_url();?>assets/script.js"></script>
</body>
</html>