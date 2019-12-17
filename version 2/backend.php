<?php
if(isset($_POST['object'])){
    $objects = json_decode($_POST['object'],true);
	echo $objects;
    // Create connection
    $conn = new mysqli("localhost", "root", "", "web2db");
    // Check connection
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
    //echo $objects;
    for($i=0;$i<count($objects);$i++){
        //echo $i;
        $object = $objects[$i];
		$type = $object['type'];
		$target = $object['target'];
		$time = $object['time'];
        $sql = "INSERT INTO objects (type_, target_, time_) VALUES ('$type', '$target', '$time')";
        $conn->query($sql);
    }
	if ($conn->affected_rows>0)
		echo "inserted successfully";
	 else
		echo "Failed!";
}

if(isset($_GET['object'])){
    
    // Create connection
    $conn = new mysqli("localhost", "root", "", "web2db");
    // Check connection
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
    //echo $objects;
    $sql = "select * from objects";
    if($result = $conn->query($sql)){
        $rows = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($rows,$row);
            }
            echo json_encode($rows,true);
        }
        else{
            echo "No Data!";
        }
    }
}