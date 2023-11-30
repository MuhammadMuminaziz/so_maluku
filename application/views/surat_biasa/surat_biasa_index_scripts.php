<script>
	$(document).ready(function() {
		$('#select1').select2({
			minimumResultsForSearch: Infinity
		});
		$('#select1').change(function() {
			const status = $(this).val()
			if (status === 'ALL') {
				window.location = 'surat_biasa';
			} else {
				window.location = 'surat_biasa?status=' + status;
			}
		});
		$('#dataTable1').DataTable({
			"order": []
		});
	})
</script>
