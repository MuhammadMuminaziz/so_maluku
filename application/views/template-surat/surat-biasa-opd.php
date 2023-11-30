<!DOCTYPE html>
<html>

<head>
	<title>Surat Biasa Antar OPD</title>
</head>

<style type="text/css">
	@import url('http://fonts.cdnfonts.com/css/arial');

	* {
		margin: 0px;
		padding: 0px;
	}

	body {
		background-color: #FFFFFF;
		min-height: 33cm;
		padding: 0.5cm;
		margin: 0.5cm auto;
		font-size: 12px;
		font-family: 'Arial', sans-serif;
	}

	.header {
		font-size: 14px;
		font-weight: bold;
	}

	.nama_opd {
		font-size: 18px;
	}

	.header_address {
		font-size: 11px;
	}

	tr td {
		padding: 1px;
	}

	.x {
		font-size: 12px;
		margin: 2px 2px 2px 2px;
	}

	.main {
		padding: 5px 5px 5px 5px;
		width: 100%;
		background-color: #FFF;
	}

	.left {
		width: 60%;
		float: left;
	}

	.right {
		width: 40%;
		float: left;
	}

	.tabel {
		float: left;
		padding: 5px 5px 5px 5px;
		width: 100%;
	}

	.biro {
		font-style: italic;
		font-size: 11px;
	}

	tr.r {
		padding: 10px 10px 10px 10px;
	}

	tr.colom {
		font-style: bold;
	}

	.header_suratbiasa {
		font-size: 16px;
		font-family: 'Arial', sans-serif;
		font-weight: bold;
	}

	.suratbiasa_content {
		font-size: 14px;
		font-family: 'Arial', sans-serif;
		padding-left: 100px;
		padding-right: 100px;
	}

	.suratbiasa_content table tbody.sign tr td:first-child {
		width: 70%;
	}

	.suratbiasa_content table tbody.item tr td:last-child ol,
	.suratbiasa_content table tbody.item tr td:last-child ul {
		padding-left: 20px;
	}

	.tembusan {
		font-size: 11px;
	}

	.header_address {
		font-size: 12px;
	}

	.jabatan {
		font-weight: bold;
		font-size: 14px;
	}

	.page_break {
		page-break-before: always;
	}
</style>

<body class="suratbiasa_content">
	<table border="0" style="width:100%">
		<tbody>
			<tr>
				<td style="width:15%">
					<p style="text-align:center"><img src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/images/logo_prov.png' ?>" width="64px" height="64px"></p>
				</td>
				<td style="width:70%">
					<p style="text-align:center;" class="header">PEMERINTAH PROVINSI MALUKU</p>
					<p style="text-align:center;" class="nama_opd">{{nama_opd_approver}}</p>
					<p style="text-align:center;" class="header_address">{{alamat_opd_approver}}</p>
					<p style="text-align:center;" class="header_address">{{alamat_elektronik_opd_approver}}</p>
				</td>
				<td style="width:15%">&nbsp;</td>
			</tr>
		</tbody>
	</table>
	<br>
	<hr>
	<br>

	<p style="text-align:right">Ambon, {{tanggal_surat}}</p>
	<table style="width:100%">
		<tr>
			<td>
				<table>
					<tbody>
						<tr>
							<td>Nomor</td>
							<td>:</td>
							<td>{{nomor_surat}}</td>
						</tr>
						<tr>
							<td>Lampiran</td>
							<td>:</td>
							<td>{{lampiran}}</td>
						</tr>
						<tr>
							<td>Hal</td>
							<td>:</td>
							<td>{{perihal}}</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td style="text-align: left;">
				<table style="width:100%">
					<tbody>
						<tr>
							<td style="text-align: left;">Kepada Yth:</td>
						</tr>
						<tr>
							<td style="text-align: left;">{{nama_opd}}</td>
						</tr>
						<tr>
							<td style="text-align: left;">di</td>
						</tr>
						<tr>
							<td style="text-align: left;">Ambon</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
	<br>

	<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
		<tbody class="item">
			<tr>
				<td style="text-align:justify;" rowspan="2">{{isi_surat}}</td>
			</tr>
		</tbody>
	</table>

	<br>
	<br>
	<table style="width: 100%;border-collapse: collapse;">
		<tbody class="sign">
			<tr>
			
				<td>
					<p style="text-align: right;" class="jabatan">{{nama_jabatan}}</p><br>
					<p style="text-align: right;"><u><img alt="" src="{{kadis_qrcode}}" /></u></p>
					<br>
					<p style="text-align: right;font-weight: bold;">
						<u>{{nama_sekda}}</u><br>
						{{pangkat_sekda}}<br>
						{{nip_sekda}}
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<table style="width: 100%;border-collapse: collapse;">
		<tbody class="tembusan">
			<tr>
				<td>Tembusan:</td>
			</tr>
			<tr>
				<td>{{list_tembusan}}</td>
			</tr>
		</tbody>
	</table>

	<?php if ($is_send_to_all) : ?>
		<div class="page_break">
			<p style="text-align:center;" class="header">- LAMPIRAN -</p>
			<br />
			<br />
			<p class="header">Pimpinan OPD di Lingkup Provinsi Maluku:</p>
			<br />
			{{list_all_opd}}
		</div>
	<?php endif ?>
</body>

</html>