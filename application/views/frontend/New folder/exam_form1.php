

<br>
<center>
	<h1>JHARKHAND NURSES REGISTRATION COUNCIL, RANCHI</h1>
<img src="<?php echo base_url('assets/images/logo_pdf.png');?>" style="padding: -20px">
	<h4>EXAMINATION APPLICATION FORM </h4>
</center>
<div class="row">
			<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<form  enctype="multipart/form-data" method="POST" action="<?php echo base_url('save_exam_form');?>"> 
            
						<fieldset>
							<span style="color:red; font-weight: bold;"> (*)</span> Marked fields are mandatory.
						<div class="row">
          <div class="col-sm-10">

				  <div class="form-group col-sm-6">
					<label for="date_adm">Course:<span style="color:red; font-weight: bold;"> *</span></label>
					<select class="form-control" name="course" id="course" required="">

						<option value="">--Select--</option>
						<option value="gnm_year_1">1st Year GNM</option>
						<option value="gnm_year_2">2nd Year GNM</option>
						<option value="gnm_year_3">3rd Year GNM</option>
						<option value="anm_year_1">1st Year ANM</option>
						<option value="anm_year_2">2nd Year ANM</option>
					</select>
				  </div>
				  <div class="form-group col-sm-6">
					<label for="stud_name">Name :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control autocapitalize" name="name" id="name" value="" required="">
				  </div>
				  
				  <div class="form-group col-sm-6">
					<label for="father_name">Father's Name :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control autocapitalize" name="father_name" id="father_name" required="">
				  </div>
				  <div class="form-group col-sm-6">
					<label for="mother_name">Mother's Name :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control autocapitalize" name="mother_name" id="mother_name" required="">
				  </div>
				  <div class="form-group col-sm-6">
					<label for="dob">Date of Birth :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text"  class="form-control" name="dob" id="dob" required="">
				  </div>

				 	<div class="form-group col-sm-6">
					<label for="class">Age : (must be between 17-38)<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="number" class="form-control" name="age" id="age" required="" placeholder="Age must be between 17-38" readonly="">
				  </div>

				 	<div class="form-group col-sm-6">
					<label for="class">Aadhar No. :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="number" class="form-control" name="aadhar" id="aadhar" required="">
				  </div>
				   <div class="form-group col-sm-6" style="margin-bottom: 27px;">
					<label>Marital Status :<span style="color:red; font-weight: bold; "> *</span></label><br>
					  <input class="form-check-input" type="radio" name="marital" value="1" required="">
					    Married
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="marital" value="2">
					    Unmarried
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="marital" value="3">
					    Widow
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="marital" value="4">
					    Divorcee
				  </div>
				  <div class="form-group col-sm-6">
					<label for="percentage">Nationality :</label>
					<select name="nationality" class="form-control" id="nationality" required="">
  <option value="">-- select one --</option>
  <option value="afghan">Afghan</option>
  <option value="albanian">Albanian</option>
  <option value="algerian">Algerian</option>
  <option value="american">American</option>
  <option value="andorran">Andorran</option>
  <option value="angolan">Angolan</option>
  <option value="antiguans">Antiguans</option>
  <option value="argentinean">Argentinean</option>
  <option value="armenian">Armenian</option>
  <option value="australian">Australian</option>
  <option value="austrian">Austrian</option>
  <option value="azerbaijani">Azerbaijani</option>
  <option value="bahamian">Bahamian</option>
  <option value="bahraini">Bahraini</option>
  <option value="bangladeshi">Bangladeshi</option>
  <option value="barbadian">Barbadian</option>
  <option value="barbudans">Barbudans</option>
  <option value="batswana">Batswana</option>
  <option value="belarusian">Belarusian</option>
  <option value="belgian">Belgian</option>
  <option value="belizean">Belizean</option>
  <option value="beninese">Beninese</option>
  <option value="bhutanese">Bhutanese</option>
  <option value="bolivian">Bolivian</option>
  <option value="bosnian">Bosnian</option>
  <option value="brazilian">Brazilian</option>
  <option value="british">British</option>
  <option value="bruneian">Bruneian</option>
  <option value="bulgarian">Bulgarian</option>
  <option value="burkinabe">Burkinabe</option>
  <option value="burmese">Burmese</option>
  <option value="burundian">Burundian</option>
  <option value="cambodian">Cambodian</option>
  <option value="cameroonian">Cameroonian</option>
  <option value="canadian">Canadian</option>
  <option value="cape verdean">Cape Verdean</option>
  <option value="central african">Central African</option>
  <option value="chadian">Chadian</option>
  <option value="chilean">Chilean</option>
  <option value="chinese">Chinese</option>
  <option value="colombian">Colombian</option>
  <option value="comoran">Comoran</option>
  <option value="congolese">Congolese</option>
  <option value="costa rican">Costa Rican</option>
  <option value="croatian">Croatian</option>
  <option value="cuban">Cuban</option>
  <option value="cypriot">Cypriot</option>
  <option value="czech">Czech</option>
  <option value="danish">Danish</option>
  <option value="djibouti">Djibouti</option>
  <option value="dominican">Dominican</option>
  <option value="dutch">Dutch</option>
  <option value="east timorese">East Timorese</option>
  <option value="ecuadorean">Ecuadorean</option>
  <option value="egyptian">Egyptian</option>
  <option value="emirian">Emirian</option>
  <option value="equatorial guinean">Equatorial Guinean</option>
  <option value="eritrean">Eritrean</option>
  <option value="estonian">Estonian</option>
  <option value="ethiopian">Ethiopian</option>
  <option value="fijian">Fijian</option>
  <option value="filipino">Filipino</option>
  <option value="finnish">Finnish</option>
  <option value="french">French</option>
  <option value="gabonese">Gabonese</option>
  <option value="gambian">Gambian</option>
  <option value="georgian">Georgian</option>
  <option value="german">German</option>
  <option value="ghanaian">Ghanaian</option>
  <option value="greek">Greek</option>
  <option value="grenadian">Grenadian</option>
  <option value="guatemalan">Guatemalan</option>
  <option value="guinea-bissauan">Guinea-Bissauan</option>
  <option value="guinean">Guinean</option>
  <option value="guyanese">Guyanese</option>
  <option value="haitian">Haitian</option>
  <option value="herzegovinian">Herzegovinian</option>
  <option value="honduran">Honduran</option>
  <option value="hungarian">Hungarian</option>
  <option value="icelander">Icelander</option>
  <option value="indian" selected="">Indian</option>
  <option value="indonesian">Indonesian</option>
  <option value="iranian">Iranian</option>
  <option value="iraqi">Iraqi</option>
  <option value="irish">Irish</option>
  <option value="israeli">Israeli</option>
  <option value="italian">Italian</option>
  <option value="ivorian">Ivorian</option>
  <option value="jamaican">Jamaican</option>
  <option value="japanese">Japanese</option>
  <option value="jordanian">Jordanian</option>
  <option value="kazakhstani">Kazakhstani</option>
  <option value="kenyan">Kenyan</option>
  <option value="kittian and nevisian">Kittian and Nevisian</option>
  <option value="kuwaiti">Kuwaiti</option>
  <option value="kyrgyz">Kyrgyz</option>
  <option value="laotian">Laotian</option>
  <option value="latvian">Latvian</option>
  <option value="lebanese">Lebanese</option>
  <option value="liberian">Liberian</option>
  <option value="libyan">Libyan</option>
  <option value="liechtensteiner">Liechtensteiner</option>
  <option value="lithuanian">Lithuanian</option>
  <option value="luxembourger">Luxembourger</option>
  <option value="macedonian">Macedonian</option>
  <option value="malagasy">Malagasy</option>
  <option value="malawian">Malawian</option>
  <option value="malaysian">Malaysian</option>
  <option value="maldivan">Maldivan</option>
  <option value="malian">Malian</option>
  <option value="maltese">Maltese</option>
  <option value="marshallese">Marshallese</option>
  <option value="mauritanian">Mauritanian</option>
  <option value="mauritian">Mauritian</option>
  <option value="mexican">Mexican</option>
  <option value="micronesian">Micronesian</option>
  <option value="moldovan">Moldovan</option>
  <option value="monacan">Monacan</option>
  <option value="mongolian">Mongolian</option>
  <option value="moroccan">Moroccan</option>
  <option value="mosotho">Mosotho</option>
  <option value="motswana">Motswana</option>
  <option value="mozambican">Mozambican</option>
  <option value="namibian">Namibian</option>
  <option value="nauruan">Nauruan</option>
  <option value="nepalese">Nepalese</option>
  <option value="new zealander">New Zealander</option>
  <option value="ni-vanuatu">Ni-Vanuatu</option>
  <option value="nicaraguan">Nicaraguan</option>
  <option value="nigerien">Nigerien</option>
  <option value="north korean">North Korean</option>
  <option value="northern irish">Northern Irish</option>
  <option value="norwegian">Norwegian</option>
  <option value="omani">Omani</option>
  <option value="pakistani">Pakistani</option>
  <option value="palauan">Palauan</option>
  <option value="panamanian">Panamanian</option>
  <option value="papua new guinean">Papua New Guinean</option>
  <option value="paraguayan">Paraguayan</option>
  <option value="peruvian">Peruvian</option>
  <option value="polish">Polish</option>
  <option value="portuguese">Portuguese</option>
  <option value="qatari">Qatari</option>
  <option value="romanian">Romanian</option>
  <option value="russian">Russian</option>
  <option value="rwandan">Rwandan</option>
  <option value="saint lucian">Saint Lucian</option>
  <option value="salvadoran">Salvadoran</option>
  <option value="samoan">Samoan</option>
  <option value="san marinese">San Marinese</option>
  <option value="sao tomean">Sao Tomean</option>
  <option value="saudi">Saudi</option>
  <option value="scottish">Scottish</option>
  <option value="senegalese">Senegalese</option>
  <option value="serbian">Serbian</option>
  <option value="seychellois">Seychellois</option>
  <option value="sierra leonean">Sierra Leonean</option>
  <option value="singaporean">Singaporean</option>
  <option value="slovakian">Slovakian</option>
  <option value="slovenian">Slovenian</option>
  <option value="solomon islander">Solomon Islander</option>
  <option value="somali">Somali</option>
  <option value="south african">South African</option>
  <option value="south korean">South Korean</option>
  <option value="spanish">Spanish</option>
  <option value="sri lankan">Sri Lankan</option>
  <option value="sudanese">Sudanese</option>
  <option value="surinamer">Surinamer</option>
  <option value="swazi">Swazi</option>
  <option value="swedish">Swedish</option>
  <option value="swiss">Swiss</option>
  <option value="syrian">Syrian</option>
  <option value="taiwanese">Taiwanese</option>
  <option value="tajik">Tajik</option>
  <option value="tanzanian">Tanzanian</option>
  <option value="thai">Thai</option>
  <option value="togolese">Togolese</option>
  <option value="tongan">Tongan</option>
  <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
  <option value="tunisian">Tunisian</option>
  <option value="turkish">Turkish</option>
  <option value="tuvaluan">Tuvaluan</option>
  <option value="ugandan">Ugandan</option>
  <option value="ukrainian">Ukrainian</option>
  <option value="uruguayan">Uruguayan</option>
  <option value="uzbekistani">Uzbekistani</option>
  <option value="venezuelan">Venezuelan</option>
  <option value="vietnamese">Vietnamese</option>
  <option value="welsh">Welsh</option>
  <option value="yemenite">Yemenite</option>
  <option value="zambian">Zambian</option>
  <option value="zimbabwean">Zimbabwean</option>
</select>
				  </div>
				  <div class="form-group col-sm-6">
					<label for="perm_address">Permanent Address: &nbsp; &nbsp;
    				</label> 
					<textarea class="form-control" name="perm_address" id="perm_address"></textarea> 
				  </div>
				 <div class="form-group col-sm-6">
					<label for="class_apply">Name of Training School :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control" name="train_school" id="train_school" required="">
					</div>

				   <div class="form-group col-sm-6">
					<label>Medium of Exam :<span style="color:red; font-weight: bold;"> *</span></label><br>
					  <input class="form-check-input" type="radio" name="medium_exam" value="1" required="">
					    Hindi
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="medium_exam" value="2">
					    English
				  </div>
          </div>
				  </div>

				  <div class="col-sm-12 table-responsive">
				  	<table class="table table-striped table-bordered" style="width: 100%">
				  		<caption><h5><center>EDUCATIONAL QUALIFICATIONS</center></h5></caption>
				  		<thead>
				  			<tr>
				  				<th style="width: 5%">Sl. No.</th>
				  				<th>Name of Board/ University</th>
				  				<th style="width: 13%">Year of Passing</th>
				  				<th style="width: 10%">Roll No.</th>
				  				<th style="width: 10%">Total Marks Obtained</th>
                  <th>Name of the School/College</th>
                  <th style="width: 10%">Upload Verification Report(*) <br><small style="    font-size: 69%;">(Less than 1 MB can be uploaded in JPG or PDF format)</small></th>
				  				
				  			</tr>
				  		</thead>
				  		<tbody>
				  			<tr>
				  				<td>1.</td>
				  				<td><input type="text" name="board_1" class="form-control autocapitalize" placeholder="Enter Matric Details"></td>
				  				<td><input type="text" name="year_1" class="form-control "></td>
				  				<td><input type="text" name="roll_1" class="form-control"></td>
				  				<td><input type="text" name="marks_1" class="form-control"></td>
                  <td><input type="text" name="school_1" class="form-control autocapitalize"></td>
				  				<td><input type="file" name="file1" required=""></td>
				  			</tr>
				  			<tr>
				  				<td>2.</td>
				  				<td><input type="text" name="board_2" class="form-control autocapitalize" placeholder="Enter Intermediate Details"></td>
				  				<td><input type="text" name="year_2" class="form-control"></td>
				  				<td><input type="text" name="roll_2" class="form-control"></td>
				  				<td><input type="text" name="marks_2" class="form-control"></td>
				  				<td><input type="text" name="school_2" class="form-control autocapitalize"></td>
                  <td><input type="file" name="file2" required=""></td>
				  			</tr>
				  			<tr>
				  				<td>3.</td>
				  				<td><input type="text" name="board_3" class="form-control autocapitalize"></td>
				  				<td><input type="text" name="year_3" class="form-control"></td>
				  				<td><input type="text" name="roll_3" class="form-control"></td>
				  				<td><input type="text" name="marks_3" class="form-control"></td>
				  				<td><input type="text" name="school_3" class="form-control autocapitalize"></td>
                 
				  			</tr>
				  			<tr>
				  				<td>4.</td>
				  				<td><input type="text" name="board_4" class="form-control autocapitalize"></td>
				  				<td><input type="text" name="year_4" class="form-control"></td>
				  				<td><input type="text" name="roll_4" class="form-control"></td>
				  				<td><input type="text" name="marks_4" class="form-control"></td>
				  				<td><input type="text" name="school_4" class="form-control autocapitalize"></td>
                  
				  			</tr>
				  		</tbody>
				  	</table>
				  </div>
          <div class="col-sm-10">
          <div class="col-sm-12 table-responsive">
				  	<table class="table table-striped table-bordered" style="width: 100%">
				  		<caption><h5><center>I WISH TO BE EXAMINED IN THE FOLLOWING SUBJECTS</center></h5></caption>
				  		<tbody>
				  			<tr>
				  				<td>A.</td>
				  				<td><input type="text" name="sub_1" class="form-control"></td>
				  				<td>B.</td>
				  				<td><input type="text" name="sub_2" class="form-control"></td>
				  			</tr>
				  			<tr>
				  				<td>C.</td>
				  				<td><input type="text" name="sub_3" class="form-control"></td>
				  				<td>D.</td>
				  				<td><input type="text" name="sub_4" class="form-control"></td>
				  			</tr>
                <tr>
                  <td>E.</td>
                  <td><input type="text" name="sub_5" class="form-control"></td>
                  <td>F.</td>
                  <td><input type="text" name="sub_6" class="form-control"></td>
                </tr>
				  			<tr>
				  				<td>G.</td>
				  				<td><input type="text" name="sub_7" class="form-control"></td>
				  				<td>H.</td>
				  				<td><input type="text" name="sub_8" class="form-control"></td>
				  			</tr>
				  		</tbody>
				  	</table>
          </div>
				  </div>
				  <div class="row">
				  <div class="form-group col-sm-6">
					<label for="img">Candidate Photo :<span style="color:red; font-weight: bold;"> *</span> (Max size 50 KB in .jpg or .png format) </label>
				  </div>
				  <div class="form-group col-sm-6">
          			<input type="file"  name="img1" id="img1" onchange="readURL(this);">
          			<img id="blah"/>
					</div>
				 </div>
				  <div class="row">
				  <div class="form-group col-sm-6">
					<label for="img">Candidate Signature :<span style="color:red; font-weight: bold;"> *</span> (Max size 30 KB in .jpg or .png format) </label>
				  </div>
				  <div class="form-group col-sm-6">
					<input type="file" name="img2" id="img2"  onchange="readURL1(this);">
          			<img id="blah1" />
					</div>
          <div class="form-group col-sm-6">
           <h4>Are you a resitter candidate? <input type="checkbox" value="Yes" id="resitter" onclick="show_full()" >  Yes</h4>
           </div>
				 </div>
         <script type="text/javascript">
          function show_full(){
                var ab = $('#resitter').is(':checked'); 
                if(ab==true){ 
                  $('.resitter_div').show(200);
               
                }
                else{
                  $('.resitter_div').hide(200);
                }
            }
         </script>
        
        <div class="row resitter_div" style="display: none;">

        <div class="col-sm-10">
          <div class="col-sm-12 table-responsive">
            <h3><center>FOR RE-SITTER CANDIDATES</center></h3>
            
              <div class="row">
              <div class="col-sm-2 ">I sat </div>
              <div class="col-sm-2"><input type="number" name="no_times" class="form-control" placeholder="No. Times"></div>
              <div class="col-sm-7" > times, the last examination. I sat for was in the month of</div>
               <div class="col-sm-1" >
                <input type="text" name="rmonth1" class="form-control" style="width: 100px; margin-left: -62px;" placeholder="Month">
              </div>

              
               <div class="col-sm-2"> year </div>
               <div class="col-sm-2"><input type="number" name="ryear1" class="form-control" placeholder="Year"> </div>
               <div class="col-sm-1" >from</div>
               <div class="col-sm-7" >
                <input type="text" name="rtrainschool" class="form-control" placeholder="Name of Training School"> 
              </div>

              <div class="col-sm-4">Training School, under Roll</div> 
              <div class="col-sm-4"><input type="number" name="rroll1" class="form-control" placeholder="Roll"></div>

              <div class="col-sm-2 ">No. </div>
              <div class="col-sm-2">
                <input type="number" name="rno1" class="form-control"  placeholder="No."></div>
               
              </div> 


              <div class="row">
                <div class="col-sm-2 ">I have passed </div>
                 <div class="col-sm-2">
                    <select name="ryear2" class="form-control" style="width:150px; ">
                      <option value="">Select Year</option>
                      <option value="First Year">First Year</option>
                      <option value="Second Year">Second Year</option>
                    </select>
                </div>
                <div class="col-sm-2">
              <select name="rcourse" class="form-control" style="width:150px; ">
                  <option>Select Course</option>
                  <option value="ANM">ANM</option>
                  <option value="GNM">GNM</option>
                </select>
              </div>
              <div class="col-sm-6">Examination conducted by Jharkhand Nurses  </div>

 
              </div>

              <div class="row" style="margin-top: 10px">
              <div class="col-sm-3 ">Registration Council from </div>
              <div class="col-sm-9 "><input type="text" name="rcouncil" class="form-control" ></div>
              </div>

              <div class="row" >
              <div class="col-sm-4 ">School of Nursing in the month of </div>
              <div class="col-sm-3 "><input type="text" name="rmonth2" class="form-control" placeholder="Enter Month"></div>
              
              <div class="col-sm-2 " >with Roll </div>
              <div class="col-sm-2 "><input type="number" name="rroll2" class="form-control" placeholder="Roll"></div>
              <div class="col-sm-2 ">No. </div>
              <div class="col-sm-2 "><input type="number" name="rno2" class="form-control" placeholder="No."></div>
              </div>

              <div class="row" >
               <div class="col-sm-3 ">I wish to be examined in  </div>
              <div class="col-sm-3" >
              <input class="form-check-input" type="radio" name="rlang" value="English"  >
              English
            &nbsp;&nbsp;
            <input class="form-check-input" type="radio" name="rlang" value="Hindi" >
              Hindi
              </div>
              <div class="col-sm-3 ">language</div>
              </div>
              </div>
              </div>
              </div>

        
        
        <div class="row">
        <div class="col-sm-10">
          <div class="col-sm-12 table-responsive">
            <h3><center>ENDORSEMENT BY SCHOOL OF NURSING</center></h3>
            
              <div class="row">
              <div class="col-sm-3 ">I consider Miss/Mrs./Sr. </div>
              <div class="col-sm-6"><input type="text" name="ename" class="form-control" ></div>
              <div class="col-sm-3" > Year Student is suitable</div>
              </div>

        
              <div class="row">
               <div class="col-sm-7"> for appearing in ensuing examination to be held in the month of  </div>
               <div class="col-sm-2"><input type="text" name="emonth1" class="form-control" > </div>
               <div class="col-sm-1" >Year</div>
               <div class="col-sm-2"><input type="text" name="eyear1" class="form-control" > </div>

              
              <div class="col-sm-6">conducted by Jharkhand Nurses Registration Council.</div> 
              
               
              </div> 


              <div class="row">
                <div class="col-sm-5 ">Her work/Clinical 
                Work is satisfactory. </div>
                <div class="col-sm-3 ">Her conduct is </div>
                 <div class="col-sm-4">
                    <input type="text" name="econduct" class="form-control" >
                </div>
              </div>

              <div class="row">
                
              <table class="table table-striped table-bordered" style="width: 100%">
             
              <tbody>
                <tr>
                  <td></td>
                  <td>PTS/1st Year</td>
                  <td>2nd Year</td>
                  <td>3rd Year</td>
                </tr>
                <tr>
                  <td>Date of Joining</td>
                  <td><input type="text" name="edoj1" class="form-control doj"></td>
                  <td><input type="text" name="edoj2" class="form-control doj"></td>
                  <td><input type="text" name="edoj3" class="form-control doj"></td>
                </tr>
                <tr>
                  <td>Total Leaved availed in</td>
                  <td><input type="text" name="eleave1" class="form-control"></td>
                  <td><input type="text" name="eleave2" class="form-control"></td>
                  <td><input type="text" name="eleave3" class="form-control"></td>
                </tr>
                
              </tbody>
            </table>
              </div>

              <div class="row" style="margin-top: 10px">
              <div class="col-sm-4 ">We certify that she has put in </div>
              <div class="col-sm-2 "><input type="text" name="eyear2" class="form-control" placeholder="Year"></div>
              <div class="col-sm-1" >Year</div>
               <div class="col-sm-2"><input type="text" name="emonth2" class="form-control" placeholder="Month"> </div>
               <div class="col-sm-3" >Month and</div>

               <div class="col-sm-3" sty><input type="text" name="eday" class="form-control" placeholder="No. of Days" ></div>
               <div class="col-sm-9" >days training exclusive of leave and has attended 75% Lectures/Clinical in each subject</div> 
               <div class="col-sm-12" >field/ Clinical experience and that she is "Eligible" to appear at the examination as per terms and condition lad\id down by INDIAN NURSING COUNCIL Syllabus.</div>
              </div>
              <div class="row">
                 <table class="table table-striped table-bordered" style="width: 100%; text-align: center;">
              <caption><h5><center><I>HE/SHE HAS ATTENDED THE UNDERMENTIONED NUMBER OF LECTURES</I></center></h5></caption>
              <tbody>
                <tr>
                  <td rowspan="2"></td>
                  <td rowspan="2"><strong>SUBJECT</strong></td>
                  
                
                  
                  <td colspan="3"><strong>NUMBER OF LECTURES</strong></td>
                  
                </tr>
                <tr>
                  <td><strong>DELIVERED</strong></td>
                  <td><strong>ATTENDED</strong></td>
                  <td><strong>PERCENTAGE</strong></td>
                </tr>
                <tr>
                  <td>A.</td>
                  <td><input type="text" name="lsub_1" class="form-control"></td>
                  <td><input type="text" name="ldel_1" class="form-control"></td>
                  <td><input type="text" name="latt_1" class="form-control"></td>
                  <td><input type="text" name="lper_1" class="form-control"></td>
                </tr>
                <tr>
                  <td>B.</td>
                  <td><input type="text" name="lsub_2" class="form-control"></td>
                  <td><input type="text" name="ldel_2" class="form-control"></td>
                  <td><input type="text" name="latt_2" class="form-control"></td>
                  <td><input type="text" name="lper_2" class="form-control"></td>
                </tr>
                <tr>
                  <td>C.</td>
                  <td><input type="text" name="lsub_3" class="form-control"></td>
                  <td><input type="text" name="ldel_3" class="form-control"></td>
                  <td><input type="text" name="latt_3" class="form-control"></td>
                  <td><input type="text" name="lper_3" class="form-control"></td>
                </tr>
                <tr>
                  <td>D.</td>
                  <td><input type="text" name="lsub_4" class="form-control"></td>
                  <td><input type="text" name="ldel_4" class="form-control"></td>
                  <td><input type="text" name="latt_4" class="form-control"></td>
                  <td><input type="text" name="lper_4" class="form-control"></td>
                </tr>
                <tr>
                  <td>E.</td>
                  <td><input type="text" name="lsub_5" class="form-control"></td>
                  <td><input type="text" name="ldel_5" class="form-control"></td>
                  <td><input type="text" name="latt_5" class="form-control"></td>
                  <td><input type="text" name="lper_5" class="form-control"></td>
                </tr>
                <tr>
                  <td>F.</td>
                  <td><input type="text" name="lsub_6" class="form-control"></td>
                  <td><input type="text" name="ldel_6" class="form-control"></td>
                  <td><input type="text" name="latt_6" class="form-control"></td>
                  <td><input type="text" name="lper_6" class="form-control"></td>
                </tr>
                <tr>
                  <td>G.</td>
                  <td><input type="text" name="lsub_7" class="form-control"></td>
                  <td><input type="text" name="ldel_7" class="form-control"></td>
                  <td><input type="text" name="latt_7" class="form-control"></td>
                  <td><input type="text" name="lper_7" class="form-control"></td>
                </tr>
                
              </tbody>
            </table>
              </div>
             

              




            <div class="row">
				  <div class="form-check col-sm-12" style="margin-top: 10px; margin-bottom: 10px;">
				  	<input type="checkbox" class="form-check-input" id="confirm" required="">
    				I have verified all the fields carefully and the information given by me  are true to my belief and knowledge. 
				  </div>
        </div>
        <div>
			  <div>
			  <center>
          <input type="submit" name="admission_stud" class="btn btn-primary" value="Submit & Continue"></center>
			  </div>
			  </fieldset>
				</form> 
 
        <!-- <fieldset>
          <div class="row">
            <div class="col-sm-10">
          <h2>New Exam Form submission is over. Check all submitted forms. Please wait for admit card. Take printout of the admit card and physically sign with the council authority. Make sure to bring payment receipt with you. <br><br> Thankyou !!</h2>
          </div></div>
        </fieldset> --->
			</div>
		</div>

		<script type="text/javascript">
			function readURL(input) {
		        if (input.files && input.files[0]) {
		            var reader = new FileReader();

		            reader.onload = function (e) {
		                $('#blah')
		                    .attr('src', e.target.result)
		                    .width(225)
		                    .height(200);
		            };
		            reader.readAsDataURL(input.files[0]);
		        }
		    }
		    function readURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah1')
                            .attr('src', e.target.result)
                            .width(250)
                            .height(100);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
		
    /* $(function () {


        $('form').on('submit', function (e) {
         // alert('form is submitting');
          e.preventDefault();


          $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>save_exam_form',
            data: $('form').serialize(),
            success: function (result) {
              //console.log(result);
              //alert('form was submitted');
              document.location.href = 'success_exam_form/'+result;
            }
          });

        });

      });*/
     </script>
     <script type="text/javascript" charset="utf-8">
    //Capitalize first letter while typing in side of input field
    jQuery(document).ready(function($) {
        $('.autocapitalize').keyup(function(event) {
            var textBox = event.target;
            var start = textBox.selectionStart;
            var end = textBox.selectionEnd;
            textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1);
            textBox.setSelectionRange(start, end);
        });
    });
  </script>