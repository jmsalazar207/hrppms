<?php
	session_start();

	include 'includes/conn.php';
/*	include 'includes/conn_to_ctris.php';*/
	
	if(isset($_POST['submit']))
	{
				if(empty($_POST['g-recaptcha-response']))
				{
					$_SESSION['error'] = 'Please verify you are not an alien';
				}

		else
		{
			if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
			{
				$secret = "6Lc-IEwhAAAAAETVl3ZliKvYueOG7p6Z1rWtbucy";
				$response=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			
				$data=json_decode($response);
				if ($data -> success)
				{
					$username = $_POST['username'];
					$password = md5($_POST['password']);

					$sql = "SELECT * FROM userprofile WHERE empno = '$username' && password= '$password'";
					$query = $conn->query($sql);
					
					if($query->num_rows == 1){
						$row = $query->fetch_assoc();
						$empno = $row['empno'];
						$hrppms = "HRPPMS";
						
						$sql1 = "SELECT * FROM user_lib WHERE empno = '$empno' && module= '$hrppms'";
						$query1 = $conn->query($sql1);
			
					if ($query1->num_rows == 1)
						{
							$row1 = $query1->fetch_assoc();
							$_SESSION['user_id'] = $row1['empno'];
						}
						else
						{
							$_SESSION['error'] = 'You are not allowed to access this module';
							$row1 = $query1->fetch_assoc();
						}
						}
						else{
							
							$_SESSION['error'] = 'Invalid Username/Password';
							$row = $query->fetch_assoc();
						
						}
	}
				}
				else
				{
					$_SESSION['error'] = 'Invalid Captcha';
				}

			}
		}
	header('location: index.php');
?>