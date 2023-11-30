<script>
	$(document).ready(function() {
		$('#basicForm').validate({
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error');
			}
		});

		$('#datepicker').datepicker({
			dateFormat: 'yy-mm-dd'
		});


		var tanggal_berangkat = $('#tanggal_berangkat').datepicker({
			dateFormat: 'yy-mm-dd'
		});

		var tanggal_pulang = $('#tanggal_pulang').datepicker({
			dateFormat: 'yy-mm-dd'
		});

		tanggal_berangkat.on("change", function() {
			tanggal_pulang.datepicker("option", "minDate", getDate(this));
		});

		tanggal_pulang.on("change", function() {
			tanggal_berangkat.datepicker("option", "maxDate", getDate(this));
		});

		function getDate(element) {
			var date;
			try {
				date = $.datepicker.parseDate(dateFormat, element.value);
			} catch (error) {
				date = null;
			}

			return date;
		}
	})
</script>
