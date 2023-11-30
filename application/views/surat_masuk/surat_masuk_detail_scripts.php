<script>
	$(document).ready(function() {
		// $('#tanggal_surat').datepicker({
		// 	dateFormat: 'yy-mm-dd'
		// });

		$('#id_tujuan, #id_kabag, #id_asisten').select2();

		// tinymce.init({
		// 	selector: '#ringkasan, #list_tembusan',
		// 	plugins: 'table print preview image paste lists',
		// 	visual: false,
		// 	menubar: 'table',
		// 	statusbar: false,
		// 	paste_data_images: true,
		// });

		// $('[name="is_langsung"]').change(e => {
		// 	if (e.target.value == "1") {
		// 		$('#id_asisten_wrapper').hide();
		// 		$('#id_asisten').removeAttr("required");
		// 	} else {
		// 		$('#id_asisten_wrapper').show();
		// 		$('#id_asisten').prop('required', true);
		// 	}
		// });

		// if ($('[name="is_langsung"]:checked').val() == "1") {
		// 	$('#id_asisten_wrapper').hide();
		// 	$('#id_asisten').removeAttr("required");
		// }
	})
</script>
