<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['signup'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$conf_password = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;

	if (!empty($email)){
		if (!empty($password)){
			
			// Create connection
			$conn = mysqli_connect('localhost', 'root', '', 'ecomm');
			if (mysqli_connect_error()){
				die('Connect Error ('. mysqli_connect_errno() .') '
				. mysqli_connect_error());
			}
			else{
				  if($password!=$conf_password){
					echo "<script>
						alert('Passwords donot match');
						window.location.href='register.php';
					</script>";
				}
				else{
					$password = password_hash($password, PASSWORD_DEFAULT);
					  $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES ('$email', '$password', '$firstname', '$lastname')";
					  if (mysqli_query($conn,$sql)){
  
					  // header("Location: login.html");
					  echo "<script>
						  alert('Account created successfully');
						  window.location.href='login.php';
					  </script>";
					}
					else{
						echo "Error: ". $sql ."
						". $conn->error;
					}
			}
			$conn->close();
			}
		}
		else{
			echo "Password should not be empty";
			die();
		}
	}
	else{
		echo "Email should not be empty";
		die();
	}
	if ($age<=0 || $age>=100){
		echo"invalid age ";
	}
}

?>