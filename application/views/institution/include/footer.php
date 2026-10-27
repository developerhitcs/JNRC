	<footer class="footer">
		<div class="container-fluid">          
			<div class="copyright float-right">
				&copy; 2018 - <?php echo date('Y'); ?> made with <i class="material-icons">favorite</i> By
				<a href="https://www.hitcs.in/" target="_blank">Hitcs Pvt. Ltd.</a> For A Better Web Solution.
			</div>
		</div>
	</footer>
</div> 
</body>
<script src="<?php echo base_url('assets_admin/js/core/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/core/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/core/bootstrap-material-design.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/perfect-scrollbar.jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/jquery.validate.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/jquery.bootstrap-wizard.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/material-dashboard.minf066.js?v=2.1.0')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/bootstrap-datetimepicker.min.js')?>"></script>
<script>
$(document).ready(function() 
{
	// initialise Datetimepicker and Sliders
	md.initFormExtendedDatetimepickers();
	if ($('.slider').length != 0) 
	{
		md.initSliders();
	}
});
</script>
<script type="text/javascript">
window.setTimeout(function() 
{
	$(".alert").fadeTo(500, 0).slideUp(500, function()
	{
		$(this).remove(); 
	});
}, 5000);
</script>
<script>
$(document).ready(function() 
{
	$('#datatables').DataTable(
	{
		"pagingType": "full_numbers",
		"lengthMenu": [
		[15, 30, 50,100, -1],
		[15, 30, 50,100, "All"]
		],
		responsive: true,
		language: 
		{
			search: "_INPUT_",
			searchPlaceholder: "Search records",
		}
	});

	var table = $('#datatable').DataTable();

	//Like record
	table.on('click', '.like', function() 
	{
		alert('You clicked on Like button');
	});
});
</script>
<script type="text/javascript">	
	$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();	
	$('.main-panel').perfectScrollbar('destroy');	
	$('.main-panel').perfectScrollbar('update');
</script>
</body>
</html>