	<footer class="main-footer"></footer>
    <!--aside class="control-sidebar control-sidebar-dark"></aside-->
<script src="<?php echo ASSET_URL; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSET_URL; ?>dist/js/pages/dashboard3.js"></script>
<script src="<?php echo ASSET_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSET_URL; ?>js/lib/persianDatepicker.min.js"></script>
<!--script src="<?php //echo ASSET_URL; ?>dist/js/demo.js"></script-->
<script src="<?php echo ASSET_URL; ?>dist/js/adminlte.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".datepicker").persianDatepicker();
        $('.select2').select2();
		$('.modal').on('shown.bs.modal', function() {
			$(this).find('[autofocus]').focus();
		});
    });
</script>
</body>
</html>