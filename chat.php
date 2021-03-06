<?php 
  include_once "admin/db_connect.php";
  include('src/components/database/userquery.php');
  if(!isset($_SESSION['login_id'])){
    header("location: index.php?page=home");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">

      <header class="chat-header">
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['id']);
          
          if ($type == 3){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE doctor_id = {$user_id}");
          }
          if ($type == 2){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = {$user_id}");
          }
          

          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>

        <a href="index.php?page=dashboard" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="assets/img/<?php echo $row['img'] ?>" alt="">
        <div class="details">
          <span><?php echo $row['name']?></span>
        </div>
      </header>

      <div class="chat-box">
        <div class="messages">

        </div>

      <div class="img-up">
        <div id="close">
          <button onclick="closeimage();"><i class="material-icons">close</i></button>
          <img  id='blah' src="" alt=""/>
        </div>
      </div>

      </div>
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">

            <label for="file-input"><i class="large material-icons">image</i></label>
            <input id="file-input" type="file" name="img_msg" accept="image/x-png,image/gif,image/jpeg,image/jpg" onchange="readURL(this);">

          <button class="active"><i class="fab fa-telegram-plane"></i></button>
        </form>

    </section>
  </div>

  <script src="js/chat.js"></script>
  <script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function closeimage(){
      $('.img-up  ').hide()
      const $blah = $('#blah');
      $($blah).attr('src', '');
      inputFile.value = "";
    }


    setInterval(function(){ 

        const img = document.getElementById('blah');
        const src = img.getAttribute('src');

        if (src != ""){
          $('.img-up  ').show()
        }


    }, 1000);



    

</script>

</body>
</html>
