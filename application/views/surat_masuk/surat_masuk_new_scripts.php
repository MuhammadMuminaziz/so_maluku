<script>
	$(document).ready(function() {
		$('#tanggal_surat').datepicker({
			dateFormat: 'yy-mm-dd'
		});

		$('#id_penerima, #id_kabag, #id_asisten').select2();

		tinymce.init({
			selector: '#ringkasan',
			plugins: 'table print preview image paste lists',
			visual: false,
			menubar: 'table',
			statusbar: false,
			paste_data_images: true,
		});
	})
</script>
