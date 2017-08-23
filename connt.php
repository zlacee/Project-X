<?php
	$username = $_POST['user'];
	$password = $_POST['pass'];


        $conn = mysqli_connect("localhost","root","");
	mysqli_select_db($conn,"project");

	$resu = mysqli_query($conn, "select * from user_login where user = '$username' and pass = '$password'") or die ("Failed to Login".mysqli_error());
	$row = mysqli_fetch_array($resu);

	if (!empty($row['user']) == $username && $row['pass'] == $password) {

		echo "LOGIN SUCCESS".'<br>'.$row['user'];
	}
	else {
		echo "FAILED to LOGIN";
		}

?>
