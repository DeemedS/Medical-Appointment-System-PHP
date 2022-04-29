<?php 
    session_start();
    if(isset($_SESSION['login_id'])){
        include_once "../admin/db_connect.php";
        include('../src/components/database/userquery.php');

        if ($type == 3){
            $outgoing_id = $_SESSION['login_id'];
          }
        if ($type == 2){
            $outgoing_id = $did;
        }
        
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(isset($_FILES['img_msg'])){

            $img_name = $_FILES['img_msg']['name'];
            $img_type = $_FILES['img_msg']['type'];
            $tmp_name = $_FILES['img_msg']['tmp_name'];
                    
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];

            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                    if(in_array($img_type, $types) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;

                        if(move_uploaded_file($tmp_name,"../assets/img/message-img/".$new_img_name)){
                            $ran_id = rand(time(), 100000000);

                                $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, img_msg)
                                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$new_img_name}')") or die();
                        }
                    }
            }
        }

        if ($img_name == ""){

            if(!empty($message)) {
                $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
            }
        }



    }else{
        header("location: ../login.php");
    }


    
?>