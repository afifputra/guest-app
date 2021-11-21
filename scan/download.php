<?php
// Require composer autoload
require_once $_SERVER['DOCUMENT_ROOT'].'/guest/libraries/vendor/autoload.php';
// Create an instance of the class:
$nama_dokumen = 'Bukti-Registrasi';
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8', 
	'format' => [58, 100],
	'orientation' => 'portrait',
	'margin_top' => 3,
	'margin_left' => 5,
	'margin_right' => 5,
	'margin_bottom' => 0,
	'default_font_size' => 9,
	'default_font' => 'dejavusans']);

ob_start();
?>
<?php
	include "../koneksi.php";
	$idevent = $_GET['idevent'];

	$event = mysqli_query($mysqli, "select * from event where idevent='$idevent'");
	$ambil = mysqli_fetch_array($event);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bukti Registrasi</title>
		<style type="text/css">
			h4{
				text-align: center;
				margin-bottom: 0;
				font-size: 12;

			}
			h5{
				text-align: center;
				font-style: italic;
				font-family: freesans;

			}
			p{
				margin: 2;
			}
		</style>
	</head>
	<body>
		<h4>
			<?php echo $ambil['jenisevent']; ?>
			<br>
			<?php echo $ambil['namaevent']; ?>
		</h4>
		<hr>
		<span>Welcome, Mr. / Mrs. / Ms.</span>
		<br>
		<br>
		<div align="center">
			<span>

			<?php
				$kodetamu = $_GET['kodetamu'];
				$tampil = mysqli_query($mysqli, "select * from tamu where idevent='$idevent' and kodetamu='$kodetamu'");
				$hasil = mysqli_fetch_array($tampil);
				echo $hasil['namatamu1'].'<br>';
				if ($hasil['namatamu2'] != '') {
				     echo nl2br($hasil['namatamu2']);
				 } 
				else{
				    echo "";
				}
			?>
			</span>
		</div>
		<br>
		<p>Person : <?php echo $hasil['jmlorang'].' '.'pax'; ?></p><br>
		<p>Table : <?php echo $hasil['namameja']; ?></p><br>
		<p>Noted : <?php echo $hasil['nomorkursi']; ?></p><br>

		<h5>Thank you for your registration</h5>
	</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
// Write some HTML code:
$mpdf->WriteHTML(utf8_encode($html));

// Output a PDF file directly to the browser
$mpdf->Output($nama_dokumen.".pdf", 'I');
exit;

?>