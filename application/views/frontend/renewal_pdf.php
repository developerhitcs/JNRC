

            <?php foreach ($row as $key ) {}?>

            <fieldset >

                 <center><h2 id="yourStyle" style="padding-top: -20px">

                 JHARKHAND NURSES REGISTRATION COUNCIL </h2>

                 <img src="<?php echo $_SERVER['DOCUMENT_ROOT']; echo '/assets/images/logo_pdf.png' ?>" >

                 <h4 style="margin-top: -15px"><u>RENEWAL LETTER</u></h4>

              </center> 
              <?php foreach ($row as $key) {
              }?>
              <div class="row">

                    <table style="width: 100%;"  cellspacing="0">

                        <thead class="text-primary">

                          <tr>
                            <td>
                              To,<br>
                              The Registrar,<br>
                              Jharkhand Nurses Registration Council
                              
                            </td>
                            <td align="right">
                              <table align="right">
                                <tr>
                                  <td><b>Ref No.</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $key['ref_no'];?></td>
                                </tr>
                                <tr>
                                  <td><b>Date</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $key['created'];?></td>
                                </tr>
                              </table>
                            </td>

                          </tr>
                          <tr>
                            <td><br>Sir/Madam,<br></td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Renew my Registration Certificate. I am attaching photo copy of Registration Certificate (Front and Back) and SBI Payment Slip with this letter. <br><br>
                                </td>
                          </tr>
                             
                               <tr><td colspan="2">
                               <table width="100%">
                                 <tr>
                                   <td><b>1.</b></td>
                                   <td><b>Name</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['name'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>2.</b></td>
                                   <td><b>Father's Name</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['father_name'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>3.</b></td>
                                   <td><b>Date of Birth</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['dob'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>4.</b></td>
                                   <td><b>Registration No.</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['reg_no'];?></td>
                                 </tr>
                                 <tr>
                                   <td></td>
                                   <td>
                                    Nurse: 
                                   </td>
                                   <td></td>
                                   <td>
                                    Date:.................
                                   </td>
                                 </tr>
                                 <tr>
                                   <td></td>
                                   <td>
                                    Midwife G.N.M:
                                   </td>
                                   <td></td>
                                   <td>
                                    Date:.................
                                   </td>
                                 </tr>
                                 <tr>
                                   <td></td>
                                   <td>
                                    A.N.M:
                                   </td>
                                   <td></td>
                                   <td>
                                    Date:.................
                                   </td>
                                 </tr>
                                 <tr>
                                   <td></td>
                                   <td>
                                    Health Supervisor (Female): 
                                   </td>
                                   <td></td>
                                   <td>
                                    Date:.................
                                   </td>
                                 </tr>
                                 
                                 <tr>
                                   <td><b>5.</b></td>
                                   <td><b>Name of Training School</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['school_train'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>6.</b></td>
                                   <td><b>Full Address</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['perm_address'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>7.</b></td>
                                   <td><b>State Bank Reference No.</b></td>
                                   <td><b>:</b></td>
                                   <td>.................</td>
                                 </tr>
                                 <tr>
                                   <td><b>8.</b></td>
                                   <td><b>Place of Posting</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['place_post'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>9.</b></td>
                                   <td><b>Mobile No.</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['mobile_no'];?></td>
                                 </tr>
                                 <tr>
                                   <td><b>10.</b></td>
                                   <td><b>Aadhar No.</b></td>
                                   <td><b>:</b></td>
                                   <td><?php echo $key['aadhar_no'];?></td>
                                 </tr>
                               </table>
                            </td>
                             
                          </tr>
                          <tr>
                            <td>
                             
                            </td>
                            <td align="right">Signature  ....................................</td>

                          </tr>
                      </thead>

                    </table>

                </div>

            </fieldset>

          

             <table style="width: 100%;">

                <tr>

                    <td valign="top"><i>Note:</i></td>
                    </tr>
                    <tr>
                    <td><i>1. Renewal Fee<i class="fa fa-inr"></i> 1000.00 only valid for 5 years. Payment must be done from Payment link from jnrcranchi.com .</td>
                  </tr><tr>
                    <td><i>2. Renewal is done only in original certificate of registration.</td>
                  </tr><tr>
                    <td><i>3. For Renewal, the candidate must be present. </td>
                  </tr><tr>
                    <td><i>4. Renewal is done on Monday, Wednesday and Friday in the week. </td>
                  </tr><tr>
                    <td><i>5. The candidates who have done transfer registration in the past, must have to submit the original certificate of registration in the Jharkhand Nurses Registration Council. </td>
                    </tr><tr>
                    <td><i>6. Photo copy of Diploma Certificate must be submitted. </td>

                </tr> <tr>
                    <td><i>7. After Online Payment, SBI payment reference no. have to be written in the blank column. </td>

                </tr>

            </table> 
<!-- 
 <div style="page-break-before:always">&nbsp;</div>
             <table style="width: 100%;" border="1" cellspacing="0">
                <tbody>
                  <tr>
                    <td align="center">Instructions</td>
                  </tr>
                  <tr>
                    <td>
 <p>1. Candidate is required to show her Admit Card to the Centre Superintendent or Invigilator appointed by the JNRC, Ranchi before entering the examination hall. </p>
<p>2. Candidates will take their seats five minutes before the time fixed for the examination. A candidate coming later than thirty minutes of the starting of examination shall not be allowed to appear.</p>
 <p>3. Candidate shall not write anything on the question paper. </p>
<p>4. Candidates are not allowed to bring note books, text books, any electronic device and paper of any kind into the examination hall. </p>
<p>5. No candidate will be allowed to leave the room within an hour after the distribution of question papers. </p>
<p>6. Only after examination, candidate shall take question paper outside the hall. No other types of paper shall be removed from the hall. </p>
<p>7. Any student disobeying these rules shall be liable for disqualification. </p>
<p>8. Complaints, if any, should be submitted within thirty days of the publication of result through the training Institution.</p>
<p>9.  Any particulars concerning training submitted by the candidate or Institution on the examination applications or any other correspondence concerning examination, found incorrect, the candidate shall be liable to be disqualified from appearing at the examination or cancellation of examination. </p>
<p>10. Any candidate found using unfair or illegal means during examination shall be liable to be debarred and rusticated from appearing at three consecutive examination.</p>
</td>
                  </tr>
                </tbody>
             </table>  -->
