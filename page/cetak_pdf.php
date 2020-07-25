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
<h3 style="text-align:center;"> Jurnal Buku Besar Penerimaan Biaya Sewa Reservasi Kamar Hotel</h3>

<?php

// Koneksi ke database //

error_reporting(0);
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tglpenjualanaw];
$tglpenjualanak = $_POST[tglpenjualanak];
?>


<table cellspacing="5" cellpadding="5" border="1">
                        
                          <tr>
                            <th>No</th>
                            <th width="20%">Tanggal</th>
                            <th width="20%">Nama Pelanggan</th>
                            <th width="20%">Uraian</th>
                            <th width="20%">Debit</th>
                            <th>Kredit</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT * FROM tbltransaksi s join tblkamar t
                    on (s.idkamar=t.idkamar) join tblpelanggan p
                    on (s.idpelanggan=p.idpelanggan) WHERE tgltransaksi BETWEEN  '$_POST[tglpenjualanaw]' AND  
                    '$_POST[tglpenjualanak]'  order by idtransaksi asc");

                        /* $tampill = mysql_fetch_array(mysql_query("select * from tblpeminjaman p 
                            join tblnasabah n on (p.idnasabah = n.idnasabah)
                            where nmnasabah LIKE  '%$_POST[nmkaryawan]%'")); 

                            */

                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td rowspan="2" align="center"><?php echo "$no"?></td>
                            <td rowspan="2"><?php echo tgl_indo($r[tgltransaksi])?></td>
                            <td rowspan="2" align="center"><?php echo $r[nmpelanggan]?></td>
                            <td><?php echo "Beban Sewa "?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[totalbiayasewa]",'0','.','.')?></td>
                            <td><?php echo "------"?></td>
                            </tr>
                            <tr>
                            <td><?php echo "Sewa dibayar dimuka "?></td>
                            <td><?php echo "------"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[totalbiayasewa]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        $ciHitung++;
                        }
                        
                        $liatHarga=mysql_fetch_array(mysql_query("SELECT sum(totalbiayasewa) as total
                        FROM tbltransaksi WHERE tgltransaksi BETWEEN  '$_POST[tglpenjualanaw]' AND  
                        '$_POST[tglpenjualanak]'
                        order by idtransaksi asc"));

                        ?>
                        

                        <tr>
                        <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                        

                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total]",'0','.','.')?></td>
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