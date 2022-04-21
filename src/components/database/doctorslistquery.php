<?php 

    $users= $conn->query("SELECT * FROM doctors_list where id= $did ");
	while($row = $users->fetch_assoc()) {

        $name_pref = $row['name_pref'];
        $ids = $row['specialty_ids'];
       
        }

?>