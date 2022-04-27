<?php 
    $uid = $_SESSION['login_id'];

    $users= $conn->query("SELECT * FROM users where id= $uid ");
	while($row = $users->fetch_assoc()) {

        $username = $row['username'];
        $name = $row['name'];
        $contact = $row['contact'];
        $password = $row['password'];
        $did = $row['doctor_id'];
        $type = $row['type'];
        $address = $row['address'];
        $imag =  $row['img'];
        }


?>