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

<style>
    header.dashboard-header {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        background: linear-gradient(to bottom, rgb(0 0 0 / 40%) 0%, rgb(245 242 240 / 45%) 100%), url(../assets/img/theater-bg.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: cover;
        }

    .dbcontainer {
        height: 100vh;
    }
</style>

<header class="dashboard-header">
     <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
             <div class="col-lg-10 align-self-end mb-4 page-title">
                    <h3 class="text-white">My Appointments</h3>
             </div>
        </div>
    </div>
</header>

    
<div class="dbcontainer container-fluid">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<?php if ($type == 3): ?>
				<button class="btn-primary btn btn-sm" type="button" id="new_appointment"><i class="fa fa-plus"></i> New Appointment</button>
				<?php endif; ?>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
						<th>Schedule</th>
						<th>Doctor</th>
						<th>Pateint</th>
						<th>Status</th>
						<th>Button</th>
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
						<td><?php echo "DR. ".$doc_arr[$row['doctor_id']]['name'].'' ?></td>
						<td><?php echo $p_arr[$row['patient_id']]['name'] ?></td>
						<td>
							<?php if($row['status'] == 0): ?>
								<span class="badge badge-warning">Pending Request</span>
							<?php endif ?>
							<?php if($row['status'] == 1): ?>
								<span class="badge badge-primary">Confirmed</span>
							<?php endif ?>
							<?php if($row['status'] == 2): ?>
								<span class="badge badge-info">Rescheduled</span>
							<?php endif ?>
							<?php if($row['status'] == 3): ?>
								<span class="badge badge-info">Done</span>
							<?php endif ?>
						</td>

						<td>
							<?php if ($type == 3): ?>
							<a class="nav-link js-scroll-trigger" href="index.php?page=chat&id=<?php echo $row['doctor_id'] ?>">chat</a>
							<?php endif ?>
							<?php if ($type == 2): ?>
							<a class="nav-link js-scroll-trigger" href="index.php?page=chat&id=<?php echo $row['patient_id'] ?>">chat</a>
							<?php endif ?>
						</td>

						<td class="text-center">
							<button  class="btn btn-primary btn-sm update_app" type="button" data-id="<?php echo $row['id'] ?>">Update</button>
							<button  class="btn btn-danger btn-sm delete_app" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
						</td>
					</tr>
				<?php endwhile; ?>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="js/dashboard.js"> </script>