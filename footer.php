	<input type="hidden" id="home-url" value="http://localhost/hls5/">
	<footer class="main-footer"></footer>
    <!--aside class="control-sidebar control-sidebar-dark"></aside-->
<script src="<?php echo ASSET_URL; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSET_URL; ?>dist/js/pages/dashboard3.js"></script>
<script src="<?php echo ASSET_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSET_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo ASSET_URL; ?>plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo ASSET_URL; ?>js/lib/persianDatepicker.min.js"></script>
<script src="<?php echo ASSET_URL; ?>dist/js/demo.js"></script>
<script src="<?php echo ASSET_URL; ?>dist/js/adminlte.js"></script>

<script src="<?php echo INC_URL; ?>script/factor.js"></script>
<script src="<?php echo INC_URL; ?>script/game.js"></script>
<script src="<?php echo INC_URL; ?>script/offer.js"></script>
<script src="<?php echo INC_URL; ?>script/payment.js"></script>
<script src="<?php echo INC_URL; ?>script/person.js"></script>
<script src="<?php echo INC_URL; ?>script/product.js"></script>
<script src="<?php echo INC_URL; ?>script/sms.js"></script>
<script src="<?php echo INC_URL; ?>script/user.js"></script>
<script src="<?php echo INC_URL; ?>script/course.js"></script>
<script src="<?php echo INC_URL; ?>script/FormatNumber.js"></script>
<script src="<?php echo INC_URL; ?>script/buy.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".datepicker").persianDatepicker();
        $('.select2').select2();
		$('.modal').on('shown.bs.modal', function() {
			$(this).find('[autofocus]').focus();
		});
		
		ClassicEditor
		.create(document.querySelector('.rich'))
		.then(function (editor) {
			// The editor instance
		})
		.catch(function (error) {
			console.error(error)
		})
	  

    });
</script>
</body>
</html>