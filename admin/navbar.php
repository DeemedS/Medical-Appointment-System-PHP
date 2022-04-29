<div class="navc">
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <div class="nav_list"> 
					<a href="index.php?page=home" class="nav_link nav-home"><i class='bx bx-home-alt-2 nav_icon'></i></i> <span class="nav_name">Home</span> </a> 
					<a href="index.php?page=appointments" class="nav_link nav-appointments"> <i class='bx bx-detail nav_icon'></i> <span class="nav_name">Appointments</span> </a> 
					<a href="index.php?page=doctors" class="nav_link nav-doctors" > <i class='bx bxs-user-badge nav_icon'></i> <span class="nav_name">Doctors</span></a> 
					<a href="index.php?page=categories" class="nav_link nav-categories"> <i class='bx bx-category nav_icon'></i> <span class="nav_name">Categories</span> </a> 
					<a href="index.php?page=users" class="nav_link nav-users"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a> 
					<a href="index.php?page=site_settings" class="nav_link site_settings"> <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Site Settings</span> </a> 
				</div>
            </div> 
			<a href="ajax.php?action=logout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
<nav>
	
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

<script src="assets/js/navbar.js"></script>
<?php if($_SESSION['login_type'] == 2): ?>
	<style>
		.nav-sales ,.nav-users,.nav-doctors,.nav-categories{
			display: none!important;
		}
	</style>
<?php endif ?>



