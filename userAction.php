<?php

	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	
	$conn = mysqli_connect("localhost","root","");
	mysqli_select_db($conn,"project");
	
	
	$result = "Insert into adduser(name,email,phone,address) VALUES ('$name','$email','$phone','$address')"
				or die("Failed to inser into  database");
	if (mysqli_query($conn, $result)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $result . "<br>" . mysqli_error($conn);
	}
	
	
	

	?>