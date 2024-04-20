<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');

    if (strlen($_SESSION['vpmsaid']==0)) {
    header('location:logout.php');
    } else {

    if(isset($_POST['submit-in'])){
        $cid=$_GET['updateid'];
        $remark=$_POST['remark'];
        $status=$_POST['status'];
        $parkingcharge=$_POST['parkingcharge'];
    
        $query=mysqli_query($con, "UPDATE vehicle_info set Remark='$remark',Status='$status',ParkingCharge='$parkingcharge' where ID='$cid'");
        if ($query) {
            $msg="Minden változtatás felülírva.";
        } else {
            $msg="Valami hiba történt";
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
    <link href="css/datatable.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="in-vehicle";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Parkolóban lévő járművek vezérlése</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Parkolóban lévő járművek vezérlése</div>
						<div class="panel-body">

                        <?php if($msg)
						echo "<div class='alert bg-info ' role='alert'>
						<em class='fa fa-lg fa-warning'>&nbsp;</em> 
						$msg
						<a href='#' class='pull-right'>
						<em class='fa fa-lg fa-close'>
						</em></a></div>" ?> 
                        
                        <div class="col-md-12">


							<form method="POST">


                            <?php
                            $cid=$_GET['updateid'];
                            $ret=mysqli_query($con,"SELECT * from vehicle_info where ID='$cid'");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {

                            ?> 
								<div class="form-group">
									<label>Ügyfél neve</label>
									<input type="text" class="form-control" value="<?php  echo $row['OwnerName'];?>" id="sdesc" name="sdesc" readonly>
								</div>


								<div class="form-group">
									<label>Rendszám</label>
									<input type="text" class="form-control" value="<?php  echo $row['RegistrationNumber'];?>" id="catename" name="catename" readonly>
								</div>


								<div class="form-group">
									<label>Autó típusa</label>
									<input type="text" class="form-control" value="<?php  echo $row['VehicleCompanyname'];?>" id="sdesc" name="sdesc" readonly>
								</div>


                                <div class="form-group">
									<label>Utasok száma</label>
									<input type="text" class="form-control" value="<?php  echo $row['VehicleCategory'];?>" id="sdesc" name="sdesc" readonly>
								</div>


                                <div class="form-group">
									<label>Parking Number</label>
									<input type="text" class="form-control" value="<?php  echo $row['ParkingNumber'];?>" id="sdesc" name="sdesc" readonly>
								</div>


                                <div class="form-group">
									<label>Autó beérkezése</label>
									<input type="text" class="form-control" value="<?php  echo $row['InTime'];?>" id="sdesc" name="sdesc" readonly>
								</div>

								<div class="form-group">
									<label>Autó várható távozása</label>
									<input type="text" class="form-control" value="<?php  echo $row['Remark'];?>" id="sdesc" name="sdesc" readonly>
								</div>


                                <div class="form-group">
									<label>Elérhetőség</label>
									<input type="text" class="form-control" value="<?php  echo $row['OwnerContactNumber'];?>" id="sdesc" name="sdesc" readonly>
								</div>


                                <div class="form-group">
									<label>Jelenlegi státusz</label>
									<input type="text" class="form-control" value="<?php if($row['Status']==""){ echo "Jármű a parkolóban van"; } if($row['Status']=="Out"){echo "Jármű távozott a parkolóbol";} ;?>" id="sdesc" name="sdesc" readonly>
								</div>


								<div class="form-group">
									<label>Érkezéskor ha fizetett</label>
									<input type="text" class="form-control" value="<?php if(empty($row['ParkingCharge'])){ echo "Nem fizetett"; } else {echo "Érkezéskor fizetett: " . $row['ParkingCharge'];} ;?>" id="sdesc" name="sdesc" readonly>
								</div>


                                <div class="form-group">
    								<label>Teljes fizetendő összeg</label>
    								<input type="number" class="form-control" value="<?php echo $row['ParkingCharge']; ?>" placeholder="" id="parkingcharge" name="parkingcharge" <?php if(!empty($row['ParkingCharge'])) {echo "readonly";} ?>>
								</div>

								
								<script>
    							var sdescValue = document.getElementById("sdesc").value;
    							if (sdescValue === "Nem fizetett") {
        						document.getElementById("parkingcharge").readOnly = true;
    							}
								</script>


                                <div class="form-group">
									<label>Müvelet</label>
									<select name="status" class="form-control" required="true" >
                                        <option value="Out">Parkolás vége</option>
                                    </select>
								</div>


                                <div class="form-group">
									<label>Megjegyzés</label>
									<input type="text" class="form-control" placeholder="" id="remark" name="remark">
								</div>
								
                        <?php } ?>

									<button type="submit" class="btn btn-success" name="submit-in">Parkolás vége</button>
									<button type="reset" class="btn btn-default">Reset</button>
                                    
								</div> <!--  col-md-12 ends -->


						</div>
					</div>
				</div>
				
				
				
</div><!--/.row-->
		
		
		

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

    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
		
</body>
</html>

<?php }  ?>