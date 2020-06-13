<!-- Bootstrap 3.3.6 -->
<script src="lte/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
<script type="text/javascript" language="javascript" src="assets/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="assets/buttons.bootstrap.min.js"></script>

<!-- bootstrap datepicker -->
<script src="lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- SlimScroll -->
<script src="lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="lte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="lte/dist/js/app.min.js"></script>
<script src="assets/sweetalert2.js"></script>

<?php if (isset($_GET['message'])): ?>
	<script>
		alert('<?php echo $_GET['message']?>');
		
		location.href = window.location.href.split('?')[0];
	</script>
<?php endif; ?>
