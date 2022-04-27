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
        $output = "";

        $sql = "SELECT * FROM messages LEFT JOIN users ON users.id = $uid
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                
                if($row['outgoing_msg_id'] === $outgoing_id){

                    if ($row['img_msg'] != null){

                        if ($row['msg'] != null) {

                            $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <div class="imgmess">
                                        <p>'. $row['msg'] .'</p>
                                        <img src="assets/img/'. $row['img_msg'] .'" alt="" width="250" height="150">
                                    </div>
                                </div>
                                </div>';
                        }
                    
                        else {
                            $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <div class="imgmess">
                                        <img src="assets/img/'. $row['img_msg'] .'" alt="" width="250" height="150">
                                    </div>
                                </div>
                                </div>';
                        }
                        
                    }

                    else {

                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p class="mess">'. $row['msg'] .'</p>
                                </div>
                                </div>';

                    }


                    
                }else{
                    if ($row['img_msg'] != null){

                        if ($row['msg'] != null) {

                            $output .= '<div class="chat incoming">
                            <div class="details">
                                <div class="imgmess">
                                    <p>'. $row['msg'] .'</p>
                                    <img src="assets/img/'. $row['img_msg'] .'" alt="" width="250" height="150">
                                </div>
                            </div>
                            </div>';

                        }

                        else {

                            $output .= '<div class="chat incoming">
                            <div class="details">
                                <div class="imgmess">
                                    <img src="assets/img/'. $row['img_msg'] .'" alt="" width="250" height="150">
                                </div>
                            </div>
                            </div>';
                        }


                    }

                    else {

                        $output .= '<div class="chat incoming">
                        <div class="details">
                            <p class="mess">'. $row['msg'] .'</p>
                        </div>
                        </div>';
                    }
                   
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>