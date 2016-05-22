<h1>Welcome back, <?php echo $_SESSION['nama'];?></h1>
<hr>
<h1>News</h1>
<?php
$simpan = $koneksi->prepare("SELECT berita.*,user.nama FROM berita LEFT JOIN user ON  user.id=berita.id_penulis ORDER BY id DESC");
$simpan->execute();
$data = $simpan->fetchAll();
foreach ($data as $key) 
		{
			?>
			<div style="display: block;clear:both;border:1px solid orange;padding: 10px;">
				<div style="display: block;
				clear:both;"><?php echo $key['judul'];?>
				<div style="float:right;"><?php echo $key 
				['tanggal'];?></div>
				<hr>
				<div style="display: block;clear:both"><?php echo $key['isi'];?></div>

				<br>
				posted by <?php echo $key['nama'];?>
				</div>
				<hr>
				<?php }
					?>	 