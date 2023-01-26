<?php

$koneksi = mysqli_connect("localhost","root","","_test");

	if(isset($_POST['Simpan'])){
		$asd = $_POST['asd'];
		$b = explode(" ", $asd, 6);

		$age = preg_replace("/[^0-9]/","",$asd);
		$nama = preg_replace("/[^a-zA-Z\s]+/", "", $asd);
		$name = explode(" ", $nama,6);
		if(($name[3]=="TAHUN" || $name[3]=="THN" || $name[3]=="TH")){
			$fullname = $name[0].' '.$name[1].' '.$name[2];
		}else{
			$fullname = $name[0].' '.$name[1];
		}
		$kota = explode(" ", $nama,6);
		if(is_string($kota[4])){
			$city = $kota[3].' '.$kota[4];
		}else{
		$city = $kota[3];	
		}
	}

	if(!empty($age) && !empty($fullname) && !empty($city)){
		$query = "INSERT INTO data(ID,NAME,AGE,CITY) VALUES(NULL,'$fullname','$age','$city')";
		if(mysqli_query($koneksi,$query)){
			header("location:index.php?berhasil");
		}else{
			echo "gagal".mysqli_error($koneksi);
		}
	}

	// print_r($kota);
	// echo $nama;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Test Skill Web Developer - PT Arkatama Multi</title>
  </head>
  <body>
  	<div class="container-fluid">
  		<div class="card">
  			<?php 
  			if(isset($_GET['berhasil'])){ ?>
  			<div class="alert alert-primary" role="alert">
  Data Berhasil Disimpan

</div>
  			<?php } ?>
  			<div class="card-body">
		    <form method="POST" action="">
		  <div class="form-group">
		  	<label>Input</label>
		    <input type="text" class="form-control" name="asd">
		  </div>
		 	<div class="form-group">
		 		<button type="submit" class="btn btn-primary float-right" name="Simpan">Simpan</button>
		 	</div> 
		</form>		
  			</div>
  		</div>

  		<div class="card">
  			<div class="table-responsive">
  				<table class="table">
  					<caption>Data List</caption>
  					<thead>
  						<tr>
  							<th scope="col">ID</th>
  							 <th scope="col">NAME</th>
						      <th scope="col">AGE</th>
						      <th scope="col">CITY</th>
  						</tr>
  					</thead>
  					<tbody>
  						<?php
  							
  							$data = mysqli_query($koneksi,"SELECT * FROM data");
  							while($d = mysqli_fetch_array($data)){
  						?>
  						<tr>
  							<td><?= $d['ID']; ?></td>
  							<td><?= $d['NAME']; ?></td>
  							<td><?= $d['AGE']; ?></td>
  							<td><?= $d['CITY']; ?></td>
  						</tr>
  					<?php } ?>
  					</tbody>
  				</table>
  			</div>
  		</div>

  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>