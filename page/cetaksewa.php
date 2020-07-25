<?php
// sesuai kan root file mPDF anda
$nama_dokumen='Rekap Laporan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

//Tuliskan file HTML di bawah sini , sesuai File anda .
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->

<h2 style="text-align:center;"> &nbsp;&nbsp;HOTEL VINOTEL CIREBON </h2>
<hr style="height:8px;" />

<br>
<h3 style="text-align:center;"> Laporan Penerimaan Biaya Sewa Kamar </h3>

<?php

// Koneksi ke database //

error_reporting(0);
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tglpenjualanaw];
$tglpenjualanak = $_POST[tglpenjualanak];
?>

<table align="center" cellspacing="5" cellpadding="5" border="1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th width="25%">Tanggal CheckIn</th>
                        <th>Pelanggan</th>
                        <th>Nama Kamar</th>
                        <th width="25%">Tanggal CheckOut</th>
                        <th>Total Biaya Sewa</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM tbltransaksi s join tblkamar t
                    on (s.idkamar=t.idkamar) join tblpelanggan p
                    on (s.idpelanggan=p.idpelanggan) 
                    WHERE tgltransaksi BETWEEN  '$_POST[tglpenjualanaw]' AND  
                    '$_POST[tglpenjualanak]'  
                    order by idtransaksi asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        
                        <?php 
                        $tgltransaksi=tgl_indo($r['tgltransaksi']);
                        $tglcheckout=tgl_indo($r['tglcheckout']);
                        ?>

                        <td><?php echo "$tgltransaksi"?></td>
                        <td><?php echo "$r[nmpelanggan]"?></td>
                        <td><?php echo "$r[nmkamar]"?></td>
                        <td><?php echo "$tglcheckout"?></td>
                        <td><?php echo "Rp.". number_format("$r[totalbiayasewa]",'0','.','.')?></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    
                    <tr>
                    <td align = "center" colspan="5"> <span style="font-weight:bold">Grand Total </td>
                    
                    <?php
                    $liatHarga=mysql_fetch_array(mysql_query("SELECT sum(totalbiayasewa) as total
                    FROM tbltransaksi WHERE tgltransaksi BETWEEN  '$_POST[tglpenjualanaw]' AND  
                    '$_POST[tglpenjualanak]'
                    order by idtransaksi asc"));
                    ?>
                    <td align="center"><?php echo "Rp.". number_format("$liatHarga[total]",'0','.','.')?></td>
                    </tr>
                    
                    </tbody>
                  </table>
                  <br> <br>
                   <?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 450px;"> Cirebon, <?php echo "$tanggal"?>
                      <br><br><br></p>
                      <p style="margin: 50px 8px 5px 510px;">  MANAGER </p>

<?php
//Batas file sampe sini
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//$stylesheet = file_get_contents('css/zebra.css');
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>