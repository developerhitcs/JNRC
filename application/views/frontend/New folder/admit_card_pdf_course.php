<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css"> -->
            </br>
            <?php foreach ($row as $key ) {?>
            <fieldset >
                 <center><h2 id="yourStyle" style="padding-top: -20px">
                 JHARKHAND NURSES REGISTRATION COUNCIL </h2>
                 <img src="<?php echo $_SERVER['DOCUMENT_ROOT']; echo '/assets/images/logo_pdf.png' ?>" >
                 <h4 style="margin-top: -15px"><u>ADMIT CARD</u></h4>
             	</center> 
             	<div class="row">
                    <table style="width: 100%;" border="1" cellspacing="0">
                        <thead class="text-primary">
                          <tr>
                              <td colspan="3" valign="top">
                                  <table style="width: 100%">
                                  <tr>
                                      <td><b>Roll No.</b> <?php echo $key['roll_no'];?></td>
                                      <td align="right"><b>Ref No.</b> <?php echo $key['ref_no'];?></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">Miss/Mrs./Mr. <b><?php echo $key['name'];?></b> S/o, D/o Shri <b><?php echo $key['father_name'];?></b> born on <?php echo $key['dob'];?> is allowed to appear at the <b><?php if($key['course']=='ANM1')echo '1st Year ANM';elseif($key['course']=='ANM2')echo '2nd Year ANM';elseif($key['course']=='GNM1')echo '1st Year GNM';elseif($key['course']=='GNM2')echo '2nd Year GNM';elseif($key['course']=='GNM3')echo '3rd Year GNM';?></b> Examination to be held on 	April 2020 at Centre <br><br><br>from School of Nursing <b><?php echo $key['train_school'];?></b> </td>
                                  </tr>
                                    </table>
                              </td> 
                               <td align="right" width="160"><img src="<?php echo $_SERVER['DOCUMENT_ROOT']; echo '/'. $key['img1']; ?>" style=" width:150px; height: 165px;"><br> Photo of Candidate</td>
                          </tr>
                          <tr>
                               <td colspan="3" valign="top">
                                  <table style="width: 100%">
                                  <tr>
                                      <td colspan="2" align="center"><b>SUBJECT & DATE OF EXAMINATION</b></td>
                                  </tr>
                                  <tr>
                                      <td><?php echo $key['subject_list'];?></td>
                                  </tr>
                                  <!-- <tr>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                  </tr> -->
                                  <tr>
                                      <td colspan="2"></td>
                                  </tr>
                                    </table>
                              </td> 
                               <td align="right"><img src="<?php echo $_SERVER['DOCUMENT_ROOT']; echo '/'. $key['img2']; ?>" style=" width:150px; height: 50px;"><br>Signature of Candidate</td>
                          </tr>
                      </thead>
                    </table>
                </div>
            </fieldset>
            <table style="width: 100%; margin-top: 125px;">
                <tr>
                    <td>Signature of Candidate</td>
                    <td align="right">Signature of Principal</td>
                    <td align="right">Signature of Director/ Superitendent</td>
                </tr>
                <tr>
                    <td colspan="3" align="right" style="padding-top: 70px">Registrar</td>
                </tr>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td valign="top"><i>Note:<i></td>
                    <td colspan="2"><i>The result of the examination of the candidates will be communicated to the Institution concerned from the office of the Jharkhand Nurses Registration Council as soon as the result is approved and published.</i></td>
                </tr>
            </table>
<div style="page-break-before:always">&nbsp;</div>
             <?php }?>