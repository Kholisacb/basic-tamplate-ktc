<h2>Detail Pembelian</h2>
<?php 
$ambil = $koneksi->mysqli_query("SELECT * FROM pembelian_produk JOIN produk
	ON pembelian_produk.id_produk=produk.id_produk
	WHERE pembelian_produk.id_pembelian_produk_produk='$_GET[id]'");
$detail = $ambil->fetch_assoc();
 ?>
 <pre><?php print_r($detail); ?></pre>