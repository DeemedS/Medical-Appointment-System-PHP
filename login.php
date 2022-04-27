<?php session_start() ?>

<div class="container-fluid">
	<form action="" id="login-frm">

		<div class="type-button" role="group" aria-label="Basic radio toggle button group">
			<input type="radio" class="btn-check" name="type" id="patient" value="3" autocomplete="off" checked>
			<label class="btn btn-outline-primary" for="patient">Patient</label>

			<input type="radio" class="btn-check" name="type" id="doctor" value="2"autocomplete="off">
			<label class="btn btn-outline-primary" for="doctor">Doctor</label>

		</div>


		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control">
		</div>

		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
		</div>

		<div class="lbutton">
		<small><a href="javascript:void(0)" id="new_account">Create New Account</a></small>
		<button class="button btn btn-info btn-sm">Login</button>
		</div>

	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

<script>
	$('#new_account').click(function(){
		uni_modal("Create an Account",'signup.php?redirect=index.php?page=checkout')
	})
	$('#login-frm').submit(function(e){
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login2',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=dashboard' ?>';
				}else{
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>