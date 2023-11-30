<!DOCTYPE html>
<html>

<head>
	<title>SPPD - Surat Perintah Perjalanan Dinas</title>
</head>

<style type="text/css">
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
		font-family: "Arial";
	}

	.header {
		font-size: 14px;
		font-family: "Arial";
		font-weight: bold;
	}

	.sekda {
		font-size: 18px;
		font-family: "Arial";
		font-weight: bold;
	}

	.header_sppd {	
		font-size: 16px;
		font-family: 'Arial', sans-serif;
		font-weight: bold;
	}

	table.sppd_table {
		border-collapse: collapse;
	}

	table.sppd_table tr {
		border: 1px solid;
	}

	table.sppd_table td {
		border: 1px solid;
		padding: 5px;
	}

	.sppd_content {
		font-size: 14px;
		font-family: 'Arial', sans-serif;
		padding-left: 100px;
		padding-right: 100px;
	}

	.sppd_content table tbody.nomor tr td:first-child {
		width:70%;
	}

	.sppd_content table tbody.nomor tr td:nth-child(2) {
		width:10%;
	}

	.sppd_content table tbody.nomor tr td:nth-child(3) {
		width:3%;
	}

	.sppd_content table tbody.nomor tr td:last-child {
		width:17%;
	}

	.sppd_content table tbody.item tr td:first-child {
		width:5%;
		text-align: center;
		font-weight: 600;
	}

	.sppd_content table tbody.item tr td:nth-child(2) {
		width:40%;
		font-weight: 600;
	}

	.sppd_content table tbody.item tr td:last-child {
		width:55%;
	}

	.sppd_content table tbody.place tr td:first-child,
	.sppd_content table tbody.sign tr td:first-child {
		width:60%;
	}

	.sppd_content table tbody.place tr td:nth-child(2) {
		width:20%;
	}

	.sppd_content table tbody.place tr td:nth-child(3) {
		width:3%;
	}

	.sppd_content table tbody.place tr td:last-child {
		width:22%;
	}

</style>

<body class="sppd_content">
	<table border="0" style="width:100%">
		<tbody>
			<tr>
				<td style="width:15%">
					<p style="text-align:center"><img src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/images/logo_prov.png' ?>" width="64px" height="64px"></p>
				</td>
				<td style="width:70%">
					<p style="text-align:center;" class="header">PEMERINTAH PROVINSI MALUKU</p>
					<p style="text-align:center;" class="sekda">SEKRETARIAT DAERAH</p>
					<p style="text-align: center;">Jalan Raya Pattimura Nomor 1 Ambon, 97124</p>
					<p style="text-align: center;">Website : www.malukuprov.go.id, Email : setdamaluku09@gmail.com</p>

				</td>
				<td style="width:15%">&nbsp;</td>
			</tr>
		</tbody>
	</table>
	<br>
	<hr>
	<br>

	<table style="width: 100%;border-collapse: collapse;">
		<tbody class="nomor">
			<tr>
				<td></td>
				<td>Nomor</td>
				<td>:</td>
				<td>{{nomor_spt}}</td>
			</tr>
			<tr>
				<td></td>
				<td>Lembar ke</td>
				<td>:</td>
				<td>I</td>
			</tr>
		</tbody>
	</table>
	<br>

	<table style="width:100%;">
		<tbody>
			<tr>
				<td style="text-align:center; text-decoration: underline;" class="header_sppd">
					SURAT PERINTAH PERJALANAN DINAS
				</td>
			</tr>

		</tbody>
	</table>
	<br>
	<table style="width: 100%;" class="sppd_table">
		<tbody class="item">
			<tr>
				<td>1.</td>
				<td>Pejabat yang Memberi Perintah</td>
				<td>Gubernur Maluku</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>Nama Pegawai yang diperintah</td>
				<td>{{nama_kadis}}</td>
			</tr>
			<tr>
				<td>3.</td>
				<td>
					a. Pangkat dan Golongan <br>
					b. Jabatan<br>
					c. Gaji Pokok<br>
					d. Tingkat Menurut Peraturan Perjalanan
				</td>
				<td>
					a. {{pangkat_golongan}}<br>
					b. {{nama_jabatan}}<br>
					<br>
					<br>
				</td>
			</tr>
			<tr>
				<td>4.</td>
				<td>Maksud Perjalanan Dinas</td>
				<td>{{maksud}}</td>
			</tr>
			<tr>
				<td>5.</td>
				<td>Alat Angkut yang Dipergunakan</td>
				<td>{{transportasi}}</td>
			</tr>
			<tr>
				<td>6.</td>
				<td>
					a. Tempat berangkat <br>
					b. Tempat Tujuan
				</td>
				<td>{{maksud}}</td>
			</tr>
			<tr>
				<td>7.</td>
				<td>
					a. Lamanya Perjalanan Dinas<br>
					b. Tanggal Berangkat<br>
					c. Tanggal Harus Kembali
				</td>
				<td>
					a. {{jumlah_hari}} hari<br>
					b. {{tanggal_berangkat}}<br>
					c. {{tanggal_pulang}}</td>
			</tr>
			<tr>
				<td>8.</td>
				<td>Pengikut</td>
				<td>{{pengikut}}</td>
			</tr>
			<tr>
				<td>9.</td>
				<td>
					Pembebanan Anggaran <br>
					a. Instansi <br>
					b. Mata Anggaran
				</td>
				<td>
					Atas Beban : {{nama_opd}} <br>
					Pasal Anggaran :
				</td>
			</tr>
			<tr>
				<td>10.</td>
				<td>Keterangan lain-lain</td>
				<td>{{keterangan}}</td>
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
				<td style="border-bottom: 1px solid; padding-bottom: 10px;">{{tanggal_cetak}}</td>
			</tr>

		</tbody>
	</table>
	<br>

	<table style="width: 100%;border-collapse: collapse;">
		<tbody class="sign">
			<tr>
				<td></td>
				<td>
					<p style="text-align: center;" class="header_sppd">SEKRETARIS DAERAH</p><br>
					<p style="text-align: center;"><u><img alt="" src="{{qr_ttdsekda}}" /></u></p>
					<br>
					<br>
					<p style="text-align: center;font-weight: bold;">
						<u>{{nama_sekda}}</u><br>
						{{pangkatgol_sekda}}<br>
						{{nip_sekda}}<br>
					</p>
				</td>
			</tr>
		</tbody>
	</table>

</body>

</html>
