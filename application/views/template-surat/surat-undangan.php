<!DOCTYPE html>
<!-- Created by pdf2htmlEX (https://github.com/pdf2htmlEX/pdf2htmlEX) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<meta name="generator" content="pdf2htmlEX" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title></title>
</head>

<body>
	<style type="text/css">
		* {
			margin: 0px;
			padding: 0px;
		}

		body {
			background-color: #FFFFFF;
			min-height: 29.7cm;
			padding: 0.5cm;
			margin: 0.5cm auto;
			font-size: 15px;
			font-family: "Arial";
		}

		.header {
			font-size: 14px;
			font-family: "Times New Roman";
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
	</style>


	<table border="0" style="width:100%">
		<tbody>
			<tr>
				<td style="width:15%">
					<p style="text-align:center"><img src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/images/logo_prov.png' ?>" width="64px" height="64px"></p>
				</td>
				<td style="width:70%">
					<p style="text-align:center" class="header"><strong>PEMERINTAH PROVINSI MALUKU <br>
							SEKRETARIAT DAERAH <br>
							Jln. Raya Pattimura No. 1 Ambon 97124 Telp./Fax. No. ( 0911 ) 314246 <br>
							Website : www.malukuprov.go.id </strong> </span></p>
				</td>
				<td style="width:15%">&nbsp;</td>
			</tr>
		</tbody>
	</table>
	<br>
	<hr>
	<br>

	<p style="text-align:right">Ambon, {{tanggal_surat}}</p>

	<p style="text-align:right">Kepada Yth :</p>

	<table border="0" style="width:100%">
		<tbody>
			<tr>
				<td style="width:86px">Nomor</td>
				<td style="width:10px">:</td>
				<td style="width:686px">{{nomor_surat}}</td>
				<td style="width:686px">&nbsp;</td>
				<td style="width:686px">&nbsp;</td>
				<td style="width:583px">{{nama_opd}}</td>
			</tr>
			<tr>
				<td style="width:86px">Lampiran</td>
				<td style="width:10px">:</td>
				<td style="width:686px">{{lampiran}}</td>
				<td style="width:686px">&nbsp;</td>
				<td style="width:686px">&nbsp;</td>
				<td style="width:583px">di</td>
			</tr>
			<tr>
				<td style="width:86px">Hal</td>
				<td style="width:10px">:</td>
				<td style="width:686px">{{perihal}}</td>
				<td style="width:686px">&nbsp;</td>
				<td style="width:686px">&nbsp;</td>
				<td style="width:583px">Ambon</td>
			</tr>
		</tbody>
	</table>

	<p>&nbsp;</p>

	<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
		<tbody>
			<tr>
				<td style="width:154px">&nbsp;</td>
				<td style="text-align:justify; width:866px">{{isi_pendahuluan}}</td>
				<td style="width:141px">&nbsp;</td>
			</tr>
		</tbody>
	</table>

	<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
		<tbody>
			<tr>
				<td style="text-align:center; width:270px">&nbsp;</td>
				<td style="width:69px">Hari/Tanggal</td>
				<td style="text-align:center; width:15px">:</td>
				<td style="width:268px">{{hari_tanggal}}</td>
				<td style="text-align:center; width:524px">&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align:center; width:270px">&nbsp;</td>
				<td style="width:69px">Waktu</td>
				<td style="text-align:center; width:15px">:</td>
				<td style="width:268px">{{waktu_kegiatan}}</td>
				<td style="text-align:center; width:524px">&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align:center; width:270px">&nbsp;</td>
				<td style="width:69px">Tempat</td>
				<td style="text-align:center; width:15px">:</td>
				<td style="width:268px">{{lokasi_kegiatan}}</td>
				<td style="text-align:center; width:524px">&nbsp;</td>
			</tr>
		</tbody>
	</table>

	<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
		<tbody>
			<tr>
				<td style="width:154px">&nbsp;</td>
				<td style="text-align:justify; width:866px">{{isi_penutup}}</td>
				<td style="width:141px">&nbsp;</td>
			</tr>
		</tbody>
	</table>

	<br />
	<br />

	<table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
		<tbody>
			<tr>
				<td style="width:75%;">Paraf Koordinasi : </td>
				<td style="text-align:right; width:75%;">a.n</td>
				<td style="white-space: nowrap;">Gubernur Maluku</td>
			</tr>
			<tr>
				<td style="width:75%;">{{jabatan_asisten}} :<br /><img alt="" src="{{nip_qrcode_asisten}}" /></td>
				<td>&nbsp;</td>
				<td style="white-space: nowrap;">SEKRETARIS DAERAH</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;</td>
				<td style="white-space: nowrap;">
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>{{nama_sekda}}<br />
						{{pangkat_gol}}<br />
						<img alt="" src="{{nip_qrcode}}" /><br />
						{{nip_sekda}}
					</p>
				</td>
			</tr>
		</tbody>
	</table>

	<br />
	<br />

	<table border="0">
		<tbody>
			<tr>
				<td>Tembusan :</td>
			</tr>
			<tr>
				<td>{{list_tembusan}}</td>
			</tr>
		</tbody>
	</table>

	<p>&nbsp;</p>
</body>

</html>