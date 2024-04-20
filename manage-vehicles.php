<?php
	session_start();
	error_reporting(0);
	include('includes/dbconn.php');
	if (strlen($_SESSION['vpmsaid']==0)) {
	header('location:logout.php');
	} else {

	if(isset($_POST['submit-vehicle'])) {
		$parkingnumber=mt_rand(10000, 99999);
		$catename=$_POST['catename'];
		$vehcomp=$_POST['vehcomp'];
		$vehreno=$_POST['vehreno'];
		$ownername=$_POST['ownername'];
		$ownercontno=$_POST['ownercontno'];
		$enteringtime=$_POST['enteringtime'];
		$remark=$_POST['remark'];
		$amount=$_POST['amount'];

		$query=mysqli_query($con, "INSERT into vehicle_info(ParkingNumber,VehicleCategory,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber,Remark,ParkingCharge) value('$parkingnumber','$catename','$vehcomp','$vehreno','$ownername','$ownercontno','$remark','$amount')");
		if ($query) {
			echo "<script>alert('Adatok hozzá adva az adatbázishoz!');</script>";
			echo "<script>window.location.href ='dashboard.php'</script>";
		} else {
			echo "<script>alert('Something Went Wrong');</script>";       
		}
	}
  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VPS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="manage-vehicles";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Jármű beregisztrálása</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-default">
					<div class="panel-heading">Beérkezett jármű regisztrálása</div>
					<div class="panel-body">

						<div class="col-md-12">

							<form method="POST">

							<div class="form-group">
									<label>Ügyfél neve</label>
									<input type="text" class="form-control" placeholder="Név" id="ownername" name="ownername" required>
								</div>

								<div class="form-group">
									<label>Rendszám</label>
									<input type="text" class="form-control" placeholder="ABC-123" id="vehreno" name="vehreno" required>
								</div>
								
						
								<div class="form-group">
									<label>Utasok száma</label>
									<input type="number" class="form-control" placeholder="1-18" id="catename" name="catename" required>		
								</div>


								<div class="form-group">
									<label>Elérhetőség</label>
									<input type="text" class="form-control" placeholder="telefonszám/email" maxlength="20" id="ownercontno" name="ownercontno" required>
								</div>

								<div class="form-group">
									<label>Visszaérkezés ideje</label>
									<input type="datetime-local" class="form-control" placeholder="ÉÉÉÉ.HH.NN ÓÓ:PP (Az idő kereken 00:00 érték ne legyen!)" id="remark" name="remark" required>
								</div>


								<div class="form-group">
									<label>Légitársaság-Város-Egyéb</label>
									<input type="text" class="form-control" placeholder="Légitársaság Város Egyéb" id="vehcomp" name="vehcomp">
								</div>


								<div class="form-group">
									<label>Összeg</label>
									<input type="text" class="form-control" placeholder="Ha a utána fizet akkor üresen kell hagyni" id="amount" name="amount">
								</div>

									<button type="submit" class="btn btn-success" name="submit-vehicle">Regisztrál</button>
									<button type="reset" class="btn btn-default">Reset</button>
								</div> <!--  col-md-12 ends -->
							</form>
						</div> 
					</div>
		
		
		

        <?php include 'includes/footer.php'?>
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true,
		scaleLineColor: "rgba(0,0,0,.2)",
		scaleGridLineColor: "rgba(0,0,0,.05)",
		scaleFontColor: "#c5c7cc"
		});
};
	</script>
		
</body>
</html>

<?php }  ?>