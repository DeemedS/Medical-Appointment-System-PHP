<?php
session_start();
include ('../../../admin/db_connect.php');

$uid = $_SESSION['login_id'];

$doctor= $conn->query("SELECT * FROM doctors_list ");
	while($row = $doctor->fetch_assoc()){
		$doc_arr[$row['id']] = $row;
	}
	$patient= $conn->query("SELECT * FROM users where id = $uid ");
	while($row = $patient->fetch_assoc()){
		$p_arr[$row['id']] = $row;
	}
	if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM appointment_list where id =".$_GET['id']);
	foreach ($qry->fetch_array() as $key => $value) {
		$$key = $value;
	}

	}

?>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div id="msg"></div>
		<form action="" id="manage-appointment">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
			<?php if($_SESSION['login_type'] == 2): ?>
			<input type="hidden" name="doctor_id" value="<?php echo isset($_SESSION['login_doctor_id']) ? $_SESSION['login_doctor_id'] : ''; ?>">
				<?php else: ?>
			<div class="form-group">
				<label for="" class="control-label">Doctor</label>
				<select class="form-select" aria-label="Default select example" name="doctor_id">
					<option value=""></option>
					<?php foreach($doc_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($doctor_id) && $doctor_id == $row['id'] ? 'selected' : '' ?>><?php echo "DR. ".$row['name'].''?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>

            <?php foreach($p_arr as $row): ?>
                <input type="text" name="patient_id" value="<?php echo $row['id'] ?>" hidden />
            <?php endforeach; ?>


			<div class="form-group">
				<label for="" class="control-label">Date</label>
				<input type="date" id="date" name="date" class="form-control" value="<?php echo isset($schedule) ? date("Y-m-d",strtotime($schedule)) : '' ?>" required>
			</div>

			<div class="form-group">
				<label for="" class="control-label">Time</label>
				<input type="time"  name="time" class="form-control" value="<?php echo isset($schedule) ? date("H:i",strtotime($schedule)) : '' ?>" required>
			</div>

			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4">Update</button>
				<button class="btn btn-secondary btn-sm col-md-4  " type="button" data-bs-dismiss="modal" id="">Close</button>
			</div>
		</form>
	</div>
</div>

<script>
	
	$("#manage-appointment").submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=set_appointment',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				resp = JSON.parse(resp)
				if(resp.status == 1){
					alert_toast("Request submitted successfully");
					// end_load();
					$('.modal').modal("hide");
					setTimeout(function(){
						location.reload();
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
					end_load();
				}
			}
		})
	})

var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear() + "-" + (month) + "-" + (day);

$('#date').attr('min', today)
</script>

