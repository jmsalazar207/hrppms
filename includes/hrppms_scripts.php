<!-- jQuery 3 -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="plugins/jquery.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<script src="bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.checkboxes.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.checkboxes.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Active Script -->

<script src="plugins/print.js"></script>
<script src="includes/function.js"></script>

<style type="text/css">
	.row-top { 
		margin-top:10px; 
}

/*	select.btn-mini {
    height: 30px;
    line-height: 14px;
}*/
	.modal.modal-wide .modal-dialog {
  width: 85%;
}
.modal-wide .modal-body {
  overflow-y: auto;
}
	.modal.modal-confirm .modal-dialog {
  width: 25%;
}
.modal-confirm .modal-body {
  overflow-y: auto;
}
#tallModal .modal-body p { margin-bottom: 900px }
</style>


<script>


$(function(){
	 $('.select2').select2()
	/** add active class and stay opened when selected */
	var url = window.location;

	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
	$(".modal-wide").on("show.bs.modal", function() {
  var height = $(window).height() - 200;
  $(this).find(".modal-body").css("max-height", height);
});
  $(function () {
    $('#example1').DataTable({
      responsive: true,
	  dom: 'lBfrtip',
	  'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
	  'pageLength': 25
    })
	
    $('#example2').DataTable({
      responsive: true,
	  dom: 'lBfrtip',
	  'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
	  'pageLength': 25
    })
 });
  
</script>

<script>
	//window.print();
		$(document).ready(function() {
			// Setup - add a text input to each footer cell
			$('#example1 tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			} );
		 
			// DataTable
			var table = $('#example1').DataTable();
		 
			// Apply the search
			table.columns().every( function () {
				var that = this;
		 
				$( 'input', this.footer() ).on( 'keyup change', function () {
					if ( that.search() !== this.value ) {
						that
							.search( this.value )
							.draw();
					}
				} );
			} );
		} );
</script>

<!-- Date and Timepicker -->
<script>
  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  }) 
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


