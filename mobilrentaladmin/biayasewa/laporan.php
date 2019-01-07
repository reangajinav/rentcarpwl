<?php

include "../koneksi.php";
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../assets/gambar/mobil.jpg',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'PT. Lontar Tali Media',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : (021) 22473531',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Jl. Bekasi Timur Raya No.1, RT.7/RW.9, Cipinang, Jakarta Timur, DKI Jakarta 13240',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Instagram : @wanita.me || Website : Wanita.me',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan Data Transaksi',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
//$no=1;
$id_transaksi=$_GET['id_transaksi'];
$query=mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN .tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_transaksi='$id_transaksi' order by id_transaksi asc");
while($lihat=mysql_fetch_array($query)){
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'ID Transaksi', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['id_transaksi'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Type Mobil', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['type_mobil'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Harga', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['harga'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'No KTP', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['no_ktp'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Nama Lengkap', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['nama_lengkap'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Tgl Sewa', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['tgl_sewa'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Tgl Selesai Sewa', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['tgl_selesaisewa'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Jumlah Harga', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['jumlah_harga'],1, 1, 'C');
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'Denda', 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['denda'],1, 1, 'C');
$pdf->ln(1);
$pdf->Cell(7.5, 0.8, '', 0, 0);
$pdf->Cell(5, 0.8, 'TOTAL HARGA', 1, 0, 'C');
$pdf->Cell(5, 0.8, $lihat['jumlah_harga'] + $lihat['denda'],1, 1, 'C');

}
/* $q=mysql_query("select sum(gaji_pokok) as total from jabatan where id_jabatan");
// select sum(total_harga) as total from barang_laku where tanggal='$tanggal'
while($total=mysql_fetch_array($q)){
	$pdf->Cell(6, 0.8, "Total Pengeluaran", 1, 0,'C');		
	$pdf->Cell(5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');
	$pdf->Cell(5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');	
}
$qu=mysql_query("select sum(gaji_pokok) as total_laba from jabatan where nama_jabatan");
*/

$pdf->Output("laporan_buku.pdf","I");

?>

