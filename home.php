<?php 
include 'admin/db_connect.php'; 
?>

    <header class="masthead">
        <section>
        <!-- Intro -->
        <div id="intro" class="bg-image vh-100">
            <div class="header-container">
            <h3>Welcome to <?php echo $_SESSION['setting_name']; ?></h3>
            <hr class="divider my-4" />
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="index.php?page=doctors">Find a Doctor</a>
            </div>
        </div>
        <!-- Intro -->
    </section>
    </header>

	<section class="page-section" id="menu">
        
    </section>

    <div id="portfolio" class="container">

            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12 text-center">
                    <h2 class="mb-4">Medical Specialties</h2>
                    <hr class="divider">
                    </div>
                </div>

                <div class="portfolio-container">
                    <?php
                    $cats = $conn->query("SELECT * FROM medical_specialty order by id asc");
                                while($row=$cats->fetch_assoc()):
                    ?>

                    <div class="portfolio-item">
                        <a class="portfolio-box" href="index.php?page=doctors&sid=<?php echo $row['id'] ?>">
                            <img class="img-fluid" src="assets/img/<?php echo $row['img_path'] ?>" alt="" />
                            <div class="portfolio-box-caption">
                                <div class="project-name"><?php echo $row['name'] ?></div>
                            </div>
                        </a>
                    </div>

                    <?php endwhile; ?>
                </div>
            </div>
    </div>

    <script>
        
        $('.view_prod').click(function(){
            uni_modal_right('Product','view_prod.php?id='+$(this).attr('data-id'))
        })
    </script>
	
