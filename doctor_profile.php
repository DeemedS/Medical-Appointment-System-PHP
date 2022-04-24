<?php 
include 'admin/db_connect.php';
include('src/components/database/userquery.php');
include('src/components/database/doctorslistquery.php');
?>

        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Profile</h3>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>

	<section class="page-section" id="account" >

    <div class="container-fluid">


			<form action="" id="manage-profile">

				<div class="card">
					<div class="card-header">My Profile</div>

					<div class="card-body">
							<div id="msg"></div>
							<input type="hidden" name="id" value="<?php	echo  $did; ?>">

							<input type="hidden" id="type" value="<?php echo  $type ?>">
							
							<div class="form-group">
								<label for="" class="control-label">Prefix</label>
								<input type="text" class="form-control" name="name_pref" placeholder="(M.D.)" required="" value="<?php echo  $name_pref ?>">
							</div>

							<div class="form-group">
								<label class="control-label">Name</label>
								<textarea name="name" cols="30" rows="2" class="form-control" required=""><?php echo  $name ?></textarea>
							</div>

							<div class="form-group">
								<label class="control-label">Medical Specialties</label>
								<input type="text" id="data-specialty_ids" value="<?php echo  $ids ?>" hidden>
								<select name="specialty_ids[]"  multiple=""  class="custom-select browser-default select2">
									<option value=""></option>
									<?php 
									$qry = $conn->query("SELECT * FROM medical_specialty order by name asc");
										while($row=$qry->fetch_assoc()):
									 ?>
									<option value="<?php echo $row['id'] ?>"><?php echo  $row['name'] ?></option>
									<?php endwhile; ?>
								</select>
							</div>


							<div class="form-group">
								<label class="control-label">Clinic Address</label>
								<textarea name="clinic_address"  cols="30" rows="2" class="form-control" required=""><?php echo  $address ?></textarea>
							</div>

							<div class="form-group">
								<label for="" class="control-label">Contact</label>
								<textarea name="contact" cols="30" rows="2" class="form-control" required=""><?php echo  $contact ?></textarea>
							</div>

							<div class="form-group">
								<label for="" class="control-label">Email</label>
								<input type="email" class="form-control" name="email" required="" value="<?php echo  $username ?>">
							</div>

							<div class="form-group">
								<label for="" class="control-label">Password</label>
								<input type="password" class="form-control" name="password" >
							</div>

							<div class="form-group">
								<label for="" class="control-label">Image</label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>
							<div class="form-group">
								<img src="" alt="" id="cimg">
							</div>	

							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3" >Save Profile</button>	
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>

    </div>
</section>


<script>

$('.select2').select2({
		placeholder:"Please Select Here",
		width:'100%'
	})

		
function _reset(){
		window.location.href = "index.php?page=dashboard";
	}


let data_ids = document.getElementById('data-specialty_ids').value;
	if( data_ids != ''){
		
			var ids = data_ids;
			ids = ids.replace('[','')
			ids = ids.replace(']','')
			ids=ids.split(',')
			var nids = [];
			ids.map(function(e){
				nids.push(e)
			})
					$('[name="specialty_ids[]"]').val(nids)
		}else{
			$('[name="specialty_ids[]"]').val('')

		}
		
$('[name="specialty_ids[]"]').trigger('change')





$('#manage-profile').submit(function(e){

		e.preventDefault()
		start_load()
		$('#msg').html('')
		
			$.ajax({
			
			url:'admin/ajax.php?action=save_doctor',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					$('#msg').html('<div class="alert alert-danger">Email already exist.</div>')
					end_load()
				}
			}
		})
})

</script>

	