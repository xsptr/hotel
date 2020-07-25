<?php 
/**
 * Aplikasi Insentif
 * 
 * 
 * 
 * @author B.E.
 */
if (!isset($_GET['pg'])) {
	include 'dashboard.php';
} else {
	switch ($_GET['pg']) {
		case 'dashboard':
			include 'dashboard.php';
			break;

		case 'contact':
			include 'contact.php';
			break;

		case 'about':
			include 'about.php';
			break;

		case 'adm':
			include 'dt_admin.php';
			break;

		case 'pytr':
			include 'dt_pelanggan.php';
			break;

		case 'trk':
			include 'dt_kamar.php';
			break;
			
		case 'trs':
			include 'dt_transaksi.php';
			break;


		default:	        
	    	echo "<label>404 Halaman tidak ditemukan</label>";
	    break;
		
	}
}

?>