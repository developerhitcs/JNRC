 <?php 
/*print_r($_SESSION);
die;*/

if($_SESSION['role']=='admin'){
  echo "Admin";
}
elseif ($_SESSION['role']=='state') {
  echo "State";
}
?>


 <script type="text/javascript">
                  //alert("You are state");
                  //alert("<?php echo $district_name;?>")
                  //var abc_n = $('#district').find('option[text="ranchi" ]').val();
                  //alert(abc_n);
                  //var a = $('#district').find(":selected").text('Chatra');
                  //alert(a);
                  //$('#district').find('option[val="2" ]').prop('selected', true)
                  /*if(a=='Ranchi'){
                    alert("Yes");
                  }
                  else{
                    alert("No");
                  }*/
                  //$('#district').val('2'); --worked
                 var hhh = $('#district option').filter(function () { return $(this).html() == "Chatra"; }).val();
                 //alert(hhh);
                  //var hhh = $('#district').find('option[text="Chatra"]').val();
                  $('#district').val(hhh);
                </script>
				
				
				how to use onchange function in jquery when selecting a value dynamically
				
				
				 //$('#district').bind('change', function() {
                       
                    //});
                    $('#district').val(select_val).onchange(prashant());
                   // $('#district').val(select_val);
                    //prashant(); 
                    function prashant(){
                      alert('hii prashant');
                    }
                    //$('#district').change(); 
                    //$("#district").trigger('change');
                    //$('#district').on('change', function () { }).trigger("change");
                      //alert( "Handler for .change() called." );
                    
                    /*if($(".target").trigger("change")){
                      alert( "Handler for .change() called." );
                    }*/
                    /*$('#district').trigger("onchange");*/
                    $(document).on('change', '#district', function () {
                       //alert('hii prashant'); 
                      /* if($('#district').val()==''){
                      alert("empty");
                    }
                    else{
                      alert("not empty");
                    }*/
                    });  
					
					
					
					 function prashant(){
                      //alert("hii prashant");
                     // setTimeout(function(){
                        //$(".search_species")[0].click();
                    //},1);
                   /* if($("#search_species").click()){
                      alert("yes");
                    }
                    else{
                      alert('NO');
                    }*/
                   // $("#search_species").click();
                  // $("#search_species").trigger('click');
                 // $("form").submit();
                 /*$("form").submit(function(){
                      alert("Submitted");
                  });*/
                    }
					
					
					Array ( [0] => Array ( [id] => 7 [com_tbl_id] => 50 ) [1] => Array ( [id] => 8 [com_tbl_id] => 51 ) [2] => Array ( [id] => 14 [com_tbl_id] => 4 ) [3] => Array ( [id] => 17 [com_tbl_id] => 1 ) )