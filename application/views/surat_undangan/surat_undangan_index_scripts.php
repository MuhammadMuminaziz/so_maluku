<script>
	$(document).ready(function() {
		$('#select1').select2({
			minimumResultsForSearch: Infinity
		});
		$('#select1').change(function() {
			const status = $(this).val()
			if (status === 'ALL') {
				window.location = 'permohonan';
			} else {
				window.location = 'permohonan?status=' + status;
			}
		});
	})
</script>
