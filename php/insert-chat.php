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
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>