<?php 
    include 'admin/db_connect.php'; 
    include('header.php');
	include('src/components/database/userquery.php');
    
    $uid = $_SESSION['login_id'];

	$doctor= $conn->query("SELECT * FROM doctors_list ");
	while($row = $doctor->fetch_assoc()){
		$doc_arr[$row['id']] = $row;
	}
	$patient= $conn->query("SELECT * FROM users where type = 3 ");
	while($row = $patient->fetch_assoc()){
		$p_arr[$row['id']] = $row;
	}

?>

<section class="page-section dashboard">


	<div class="title">
		<h3>MY APPOINTMENTS</h3>
	</div>

	<div class="container">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">

					<?php if ($type == 3): ?>
					<a  href="index.php?page=doctors" class="btn-primary btn btn-sm"><i class="fa fa-plus"></i> New Appointment</a>
					<?php endif; ?>
					<br>

					<table class="table table-bordered ">
						<thead>
							<tr>
								<th>Schedule</th>
								<?php if ($type == 3): ?>
								<th>Doctor</th>
								<?php endif ?>
								<?php if ($type == 2): ?>
								<th>Pateint</th>
								<?php endif ?>
								<th>Status</th>
								<th>Action</th>
							</tr>
							</thead>
							<?php 
							$where = '';

							if ($type == 3){
								$where = " where patient_id = ".$_SESSION['login_id'];
							}

							if ($type == 2){
								$where = " where doctor_id = " .$did;
							}

							
							if($_SESSION['login_id'] == $uid)
							$qry = $conn->query("SELECT * FROM appointment_list ".$where." order by id desc ");
							while($row = $qry->fetch_assoc()):
							?>
							<tr>

								<td><?php echo date("l M d, Y h:i A",strtotime($row['schedule'])) ?></td>
								<?php if ($type == 3): ?>
								<td><?php echo "DR. ".$doc_arr[$row['doctor_id']]['name'].'' ?></td>
								<?php endif ?>
								<?php if ($type == 2): ?>
								<td><?php echo $p_arr[$row['patient_id']]['name'] ?></td>
								<?php endif ?>
								<td>
									<?php if($row['status'] == 0): ?>
										<span class="badge bg-warning">Pending Request</span>
									<?php endif ?>
									<?php if($row['status'] == 1): ?>
										<span class="badge bg-primary">Confirmed</span>
									<?php endif ?>
									<?php if($row['status'] == 2): ?>
										<span class="badge bg-info">Rescheduled</span>
									<?php endif ?>
									<?php if($row['status'] == 3): ?>
										<span class="badge bg-success">Done</span>
									<?php endif ?>
								</td>


								<td class="text-center ">
									<button  class="btn btn-primary btn-sm update_app" type="button" data-id="<?php echo $row['id'] ?>">Update</button>

									<?php if($row['status'] == 1): ?>
										<?php if ($type == 3): ?>
										<a class="btn btn-info btn-sm" href="index.php?page=chat&id=<?php echo $row['doctor_id'] ?>">Meet the doctor</a>
										<?php endif ?>

										<?php if ($type == 2): ?>
										<a class="btn btn-info btn-sm" href="index.php?page=chat&id=<?php echo $row['patient_id'] ?>">Talk to the patient</a>
										<?php endif ?>
									<?php endif ?>

									<button  class="btn btn-danger btn-sm delete_app" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
								</td>
							</tr>
						<?php endwhile; ?>
						</table>
					</div>
				</div>
			</div>
		</div>

</section>

<script src="js/dashboard.js"> </script>