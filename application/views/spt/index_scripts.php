<script>
	$(document).ready(function() {
		// $('#wysiwyg').wysihtml5({
		// 	toolbar: {
		// 		fa: true
		// 	}
		// });
		$('#wysiwyg2').wysihtml5({
			toolbar: {
				fa: true
			}
		});

		tinymce.init({
			selector: '#wysiwyg_dasar',
			plugins: 'table print preview image paste lists',
			visual: false,
			menubar: 'table',
			statusbar: false,
			paste_data_images: true,
		});

		tinymce.init({
			selector: '#wysiwyg_pelaksana',
			plugins: 'table print preview image paste lists',
			visual: false,
			menubar: 'table',
			statusbar: false,
			paste_data_images: true,
		});

		tinymce.init({
			selector: '#wysiwyg_untuk',
			plugins: 'table print preview image paste lists',
			visual: false,
			menubar: 'table',
			statusbar: false,
			paste_data_images: true,
		});

		tinymce.init({
			selector: '#wysiwyg_tembusan',
			plugins: 'table print preview image paste lists',
			visual: false,
			menubar: 'table',
			statusbar: false,
			paste_data_images: true,
		});
	})
</script>
