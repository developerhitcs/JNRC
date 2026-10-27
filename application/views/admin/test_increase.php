<div class="row">
	<div id="table">
		<div class="col-sm-1">
	<a onclick="hello(this)" class="btn btn-danger" id="tab_1">hiii</a></br>
	<input type="text" name="" id="tab_id" value="5">
	</div>
</div>
</div>




<script type="text/javascript">
	function hello(e) {
		//alert(e.id);
		//var app = '<a onclick="hello(this)" class="btn btn-danger" id="tab_1">hiii</a>';
		//$("$table").append('app');
		$("#TabModal").modal('show');
	}
	var txt_value = 5;
	var yourChar = 'A'
	 // 'B'
	function increase(){
		var newChar = String.fromCharCode(yourChar.charCodeAt(0) + 1)
		var app = '<div class="col-sm-1"><a onclick="hello(this)" class="btn btn-danger" id="tab_1">hiii</a></br><input type="text" name="" id="tab_id" value="'+txt_value+ newChar+'"></div>';
		$("#table").append(app);
		//txt_value++;
		yourChar = newChar;
	}
</script>



<!-- Edit modal -->
            <!-- modal --> 
            <div class="modal fade" id="TabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">features</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <a onclick="increase(this)" class="btn btn-info" id="tab_1">split</a>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update changes</button>
                </div>
              
              </div>
            </div>
          </div>


            <!-- modal ending -->