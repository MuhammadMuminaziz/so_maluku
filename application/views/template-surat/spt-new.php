<!DOCTYPE html>
<html>

<head>
	<title>SPT</title>
</head>

<style type="text/css">
	* {
		margin: 0px;
		padding: 0px;
	}

	@import url('http://fonts.cdnfonts.com/css/arial');

	body {
		background-color: #FFFFFF;
		min-height: 33cm;
		padding: 0.5cm;
		margin: 0.5cm auto;
		font-size: 12px;
		font-family: 'Arial', sans-serif;
	}
	
	.header {
		font-size: 18px;
		font-family: 'Arial', sans-serif;
		font-weight: bold;
	}

	.sekda {
		font-size: 18px;
		font-family: 'Arial', sans-serif;
		font-weight: bold;
	}

	.header_spt {	
		font-size: 16px;
		font-family: 'Arial', sans-serif;
		font-weight: bold;
	}

	.bold {
		font-weight: bold;
	}

	.general_content {
		padding-left: 100px;
		padding-right: 100px;
	}

	.general_content table tbody tr td {
		font-size: 14px;
		font-family: 'Arial', sans-serif;
		vertical-align: baseline;
		padding-top: 5px;
	}

	.general_content table tbody.title tr td {
		font-size: 16px;
		font-weight: bold;
	}

	.general_content table tbody.item tr td:first-child,
	.general_content table tbody.item tr td:nth-child(2) {
		font-weight: bold;
		text-align: left;
	}

	.general_content table tbody.item tr td:first-child {
		width:20%;
	}

	.general_content table tbody.item tr td:nth-child(2),
	.general_content table tbody.item tr td:nth-child(3) {
		width:20px;
	}

	.general_content table tbody.item tr td:last-child {
		width:77%;
	}

	.general_content table tbody.item tr td:last-child ol,
	.general_content table tbody.item tr td:last-child ul {
		padding-left: 20px;
	}

	.general_content table tbody.place tr td:first-child,
	.general_content table tbody.sign tr td:first-child {
		width:60%;
	}

	.general_content table tbody.place tr td:nth-child(2) {
		width:22%;
	}

	.general_content table tbody.place tr td:nth-child(3) {
		width:3%;
	}

	.general_content table tbody.place tr td:last-child {
		width:20%;
	}

	/*
	table, th, td, tr {
		border: 1px solid black;
		border-collapse: collapse;
	}
	*/
</style>

<body class="general_content">
	<table border="0" style="width:100%">
		<tbody class="title">
			<tr>
				<td style="text-align: center;">
					<img src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/images/logo_pancasila.png' ?>" height="64" width="64">
					<p style="text-align:center;" class="header">GUBERNUR MALUKU <br><br></p>
				</td>
			</tr>
			<tr>
				<td>
					<p style="text-align: center; text-decoration: underline;">SURAT PERINTAH TUGAS</p>
				</td>
			</tr>
			<tr>
				<td>
					<p style="text-align: center; text-decoration: underline;">NO : {{nomor_spt}} TAHUN 2022</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<table style="width: 100%;">
		<tbody class="item">
			<tr>
				<td>DASAR</td>
				<td>:</td>
				<td>1.</td>
				<td>
					<p>Keputusan Menteri Dalam Negeri Nomor 12 Tahun 1990 Tanggal 12 Pebruari 1990 tentang Pelaksanaan Perjalanan Dinas</p>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>2.</td>
				<td>
					<p>Peraturan Gubernur Maluku Nomor 28 Tahun 2019 Tanggal 21 November 2019 Tentang Perjalanan Dinas Dalam Negeri Atas Beban Anggaran Dan Belanja Daerah Tahun Anggaran 2020</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>

	<table style="width: 100%;">
		<tbody class="title">
			<tr>
				<td style="text-align:center; width:20%;">M E M E R I N T A H K A N</td>
			</tr>
		</tbody>
	</table>
	<br><br>

	<table style="width: 100%;">
		<tbody class="item">
			<tr>
				<td>KEPADA</td>
				<td>:</td>
				<td class="bold">{{nama_kadis}}</td>
			</tr>
			<tr>
				<td>JABATAN</td>
				<td>:</td>
				<td class="bold">{{nama_jabatan}}</td>
			</tr>
			<tr>
				<td>UNTUK</td>
				<td>:</td>
				<td>{{untuk}}</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>

	<table style="width: 100%;border-collapse: collapse;">
		<tbody class="place">
			<tr>
				<td></td>
				<td>Dikeluarkan di</td>
				<td>:</td>
				<td>Ambon</td>
			</tr>
			<tr>
				<td></td>
				<td style="border-bottom: 1px solid; padding-bottom: 10px;">Pada Tanggal</td>
				<td style="border-bottom: 1px solid; padding-bottom: 10px;">:</td>
				<td style="border-bottom: 1px solid; padding-bottom: 10px;">{{tanggal}}</td>
			</tr>

		</tbody>
	</table>
	<br>

	<table style="width: 100%;border-collapse: collapse;">
		<tbody class="sign">
			<tr>
				<td></td>
				<td>
					<p style="text-align: center;" class="header_spt">GUBERNUR MALUKU</p><br>
					<p style="text-align: center;"><u><img alt="" src="{{qr_ttdgub}}" /></u></p><br>
					<p style="text-align: center;" class="header_spt"><u>{{nama_gub}}</u></p><br>
				</td>
			</tr>
		</tbody>
	</table>

</body>

</html>
