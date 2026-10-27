

           </br>
           <form action="<?php  //echo base_url();?>save_form1" method="POST">
            <fieldset>
              <center><h3>Society/ Trust/ Mission Details</h3></center>
              <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Chairperson/ Registrar Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="chairperson" id="chairperson" value="" autofocus="">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Society/ Trust Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="society" id="society" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Address :<span style="color:red; font-weight: bold;"> *</span></label>
                    <!-- <input type="text" class="form-control" name="address" id="address" value="" > -->
                    <textarea class="form-control" name="address" id="address"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>List of Society Members :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="soc_members" id="soc_members" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>State Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="state" id="state" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>District :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="district" id="district" value="" >
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Tehsil/ Block :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="tehsil" id="tehsil" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="pin" id="pin" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Landline No. :</label>
                    <input type="number" class="form-control" name="landline" id="landline" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="mobile" id="mobile" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Society/ Trust Email :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="" >
                  </div>
                </div>
                
                <center><h3>Institution Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Name of the institution :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="institution" id="institution" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Address of the Institution :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="address_ins" id="address_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>State :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="state_ins" id="state_ins" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>District :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="district_ins" id="district_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Tehsil :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="tehsil_ins" id="tehsil_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="pin_ins" id="pin_ins" value="" >
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                 
                  <div class="form-group col-sm-3">
                    <label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="landline_ins" id="landline_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="fax_ins" id="fax_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Institution is Under :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="ins_under" id="ins_under" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Institution Email:<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="ins_email" id="ins_email" value="" >
                  </div>
                </div>
                <center><h3>Fee Code/Principal Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                   
                    
                  <div class="form-group col-sm-3">
                    <label>Application ID :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="applicant_id" id="applicant_id" value="<?php   //echo  $last_id['id'] + 1;?>" readonly="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Fee Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="fee_code" id="fee_code" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Entry Date :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="date" class="form-control" name="ent_date" id="ent_date" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>Name of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="principal" id="principal" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Email of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="email_prin" id="email_prin" value="" >
                  </div>
                   <div class="form-group col-sm-3">
                    <label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="landline_prin" id="landline_prin" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                 
                  <div class="form-group col-sm-3">
                    <label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="fax_prin" id="fax_prin" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="mobile_prin" id="mobile_prin" value="" >
                  </div> 

                </div>
              
                 <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="wizard-buttons  col-sm-3">
                        <a href="<?php  //echo base_url();?>affiliation" class="btn btn-danger">Back</a>
                        <button type="submit" name="save" class="btn btn-success btn-submit">Save & Next</button>
                    </div>
                </div>
            </fieldset>
                
          </form>

                     </br>
           <form action="<?php  //echo base_url();?>update_form1" method="POST">
            <fieldset>
              <center><h3>Society/ Trust/ Mission Details</h3></center>
              <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Chairperson/ Registrar Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="chairperson" id="chairperson" value="" autofocus="">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Society/ Trust Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="society" id="society" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Address :<span style="color:red; font-weight: bold;"> *</span></label>
                    <!-- <input type="text" class="form-control" name="address" id="address" value="" > -->
                    <textarea class="form-control" name="address" id="address"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>List of Society Members :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="soc_members" id="soc_members" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>State Name :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="state" id="state" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>District :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="district" id="district" value="" >
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Tehsil/ Block :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="tehsil" id="tehsil" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="pin" id="pin" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Landline No. :</label>
                    <input type="number" class="form-control" name="landline" id="landline" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="mobile" id="mobile" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Society/ Trust Email :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="" >
                  </div>
                </div>
                
                <center><h3>Institution Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Name of the institution :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="institution" id="institution" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Address of the Institution :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="address_ins" id="address_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>State :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="state_ins" id="state_ins" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>District :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="district_ins" id="district_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Tehsil :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="tehsil_ins" id="tehsil_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="pin_ins" id="pin_ins" value="" >
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                 
                  <div class="form-group col-sm-3">
                    <label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="landline_ins" id="landline_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="fax_ins" id="fax_ins" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Institution is Under :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="ins_under" id="ins_under" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Institution Email:<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="ins_email" id="ins_email" value="" >
                  </div>
                </div>
                <center><h3>Fee Code/Principal Details</h3></center>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                   
                    
                  <div class="form-group col-sm-3">
                    <label>Application ID :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="applicant_id" id="applicant_id" value="<?php   //echo  $last_id['id'] + 1;?>" readonly="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Fee Code :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="fee_code" id="fee_code" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Entry Date :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="date" class="form-control" name="ent_date" id="ent_date" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                  <div class="form-group col-sm-3">
                    <label>Name of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="text" class="form-control" name="principal" id="principal" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Email of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="email" class="form-control" name="email_prin" id="email_prin" value="" >
                  </div>
                   <div class="form-group col-sm-3">
                    <label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="landline_prin" id="landline_prin" value="" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  
                 
                  <div class="form-group col-sm-3">
                    <label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="fax_prin" id="fax_prin" value="" >
                  </div>
                  <div class="form-group col-sm-3">
                    <label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
                    <input type="number" class="form-control" name="mobile_prin" id="mobile_prin" value="" >
                  </div> 

                </div>
              
                 <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="wizard-buttons  col-sm-3">
                        <a href="<?php  //echo base_url();?>affiliation" class="btn btn-danger">Back</a>
                        <button type="submit" name="save" class="btn btn-success btn-submit">Save & Next</button>
                    </div>
                </div>
            </fieldset>
                
          </form>

         