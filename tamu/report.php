<?php
// Require composer autoload
require_once $_SERVER['DOCUMENT_ROOT'].'/guest/libraries/vendor/autoload.php';
// Create an instance of the class:
$nama_dokumen = 'Laporan_Tamu';
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8', 
	'format' => 'A4-L',
	'default_font_size' => 11,
	'default_font' => 'dejavusans']);

ob_start();
?>
<?php
include "../koneksi.php";
$idevent = $_GET['idevent'];

$event = mysqli_query($mysqli, "select * from event where idevent='$idevent'");
$ambil = mysqli_fetch_array($event);
?>
<style>
 	table{margin: auto;}
 	td,th{padding: 5px;text-align: center; width: 150px}
 	h1{text-align: center}
 	h2{text-align: center;}
 	th{background-color: #95a5a6; padding: 10px;color: #fff}
 </style>
<h1>Laporan Tamu</h1>
<h2><?php echo $ambil['jenisevent'].' ';echo $ambil['namaevent'];?></h2>
<br>
<table border="1">
	<tr>
		<th width="10px">No</th>
        <th>Kode Tamu</th>
        <th>Tamu 1</th>
        <th>Tamu 2</th>
        <th>Jml Pax</th>
        <th>Meja</th>
        <th>Kursi</th>
        <th>Waktu Scan</th>
        <th>Status</th>
	</tr>
	<?php
        $tampil = mysqli_query($mysqli, "select * from tamu where idevent='$idevent'");
        $no = 1;
        while ($hasil = mysqli_fetch_array($tampil)) {
    ?>
	<tr>
		<td width="10px"><?php echo $no++; ?></td>
	    <td><?php echo $hasil['kodetamu']; ?></td>
	    <td><?php echo $hasil['namatamu1']; ?></td>
	    <td><?php echo nl2br($hasil['namatamu2']); ?></td>
	    <td><?php echo $hasil['jmlorang']; ?></td>
	    <td><?php echo $hasil['namameja']; ?></td>
	    <td><?php echo $hasil['nomorkursi']; ?></td>
	    <td>
	        <?php
	        if($hasil['tglscan'] == ''){
	            echo "<span>Belum scan</span>";
	        }else{ 
	            echo date('d-m-Y', strtotime($hasil['tglscan'])).' ';
	            echo date('H:i', strtotime($hasil['waktu']));
	        }
	        ?>
	    </td>
	    <td>
	        <?php
	            if($hasil['status'] == 'Sukses'){
	                echo '<span>Sukses</span>';
	            }
	            elseif($hasil['status'] == 'Gagal'){
	                echo '<span>Gagal</span>';
	            }
	            elseif($hasil['status'] == ''){
	                echo "<span>Belum scan</span>";
	            }
	        ?>
	    </td>
	</tr>
   <?php }?>
</table>
<hr>
<?php
	$kueri = mysqli_query($mysqli, "select SUM(jmlorang) AS total from tamu where idevent='$idevent'");
	$data = mysqli_fetch_array($kueri);

	$kueri2 = mysqli_query($mysqli, "select SUM(jmlorang) AS hadir from tamu where idevent='$idevent' AND status='Sukses'");
	$hadir = mysqli_fetch_array($kueri2);
?>
<strong>
<span>Total Pax : <?php echo $data['total']; ?> || </span>
<span>Hadir : <?php echo $hadir['hadir']; ?></span>
</strong>

<?php
$html = ob_get_contents();
ob_end_clean();
// Write some HTML code:
$mpdf->WriteHTML(utf8_encode($html));

// Output a PDF file directly to the browser
$mpdf->Output($nama_dokumen.".pdf", 'I');
exit;

?>