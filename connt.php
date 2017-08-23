<?php
	$username = $_POST['user'];
	$password = $POST['pass'];

	$conn = mysqli_query($conn, "select * from user_login where user = '$username' and pass = '$password'") or die ("Failed to Login".mysqli_error());
	$row = mysqli_fetch_array($result);

	if (!empty($row['user']) == $username && $row['pass'] == $password) {

		echo "LOGIN SUCCESS".'<br>'.$row['user'];
	}
	else {
		echo "FAILED to LOGIN";
		}

?>
