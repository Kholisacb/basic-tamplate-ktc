<?php 
session_start();
$koneksi = new mysqli("localhost","root","","tokoabushofi");
 ?>
<!DOCTYPE html
<html>
<head>
	<title>Checkout</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<!--navbar-->
<nav class="navbar navbar-default">
	<div class="container">

		<ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="keranjang.php">Keranjang</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="checkout.php">Checkout</a></li>		
		</ul>	
	</div>
</nav>

<section class="konten">
  <div class="container">
    <h1>Keranjang Belanja</h1>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subharga</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor=1; ?>
        <?php $totalbelanja = 0; ?>
        <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
        <!-- menampikan produk yg sedang diperulangkan berdasarkan id_produk -->
        <?php
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $pecah = $ambil->fetch_assoc();
        $subharga = $pecah["harga_produk"]*$jumlah;

         ?>
        <tr>
          <td>1</td>
          <td><?php echo $pecah["nama_produk"]; ?></td>
          <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
          <td><?php echo $jumlah; ?></hgroup></td>
          <td>Rp. <?php echo number_format($subharga); ?></td>
          
      </tr>
      <?php $nomor++; ?>
      <?php $totalbelanja+=$subharga; ?>
        <?php endforeach ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Total Belanja</th>
          <th>Rp. <?php echo number_format($totalbelanja) ?></th>
        </tr>
      </tfoot>
    </table>

    <form method="post">
     
      <div class="row">
        <div class="col-md-4"> <div class="form-group">
           <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>" class="form-control">
              </div>
            </div>
        <div class="col-md-4">
           <div class="form-group">
        <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telephone_pelanggan'] ?>" class="form-control">
      </div>
        </div>
        <div class="col-md-4">
          <select class="form-control" name="id_ongkir">
            <option value="">Pilih Ongkos Kirim</option>
            <?php 
            $ambil = $koneksi->query("SELECT * FROM ongkir");
            while($perongkir = $ambil->fetch_assoc()){
             ?>
            }
            <option value="<?php echo $perongkir["id_ongkir"] ?>">
              <?php echo $perongkir['nama_kota'] ?> -
              Rp. <?php echo number_format($perongkir['tarif']) ?>
            </option>
            <?php } ?>
          </select>
        </div>
      </div>
      <button class="btn btn-primary" name="checkout">Checkout</button>
    </form>

  </div>
</section>

<pre><?php print_r($_SESSION['pelanggan']) ?></pre>
	
</body>
</html>