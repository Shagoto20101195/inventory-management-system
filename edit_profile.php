<?php

//edit_profile.php

include('database_connection.php');

if(isset($_POST['user_name']))
{
	if($_POST["user_new_password"] != '')
	{
		$query = "select user_password from user_details where user_id = '".$_SESSION["user_id"]."'";
		$statement = mysqli_query($connect, $query);
		$result = mysqli_fetch_assoc($statement);
		if(password_verify($_POST["user_old_password"], $result["user_password"]))
		{
			$query = "
			UPDATE user_details SET 
				user_name = '".$_POST["user_name"]."', 
				user_email = '".$_POST["user_email"]."', 
				user_password = '".password_hash($_POST["user_new_password"], PASSWORD_DEFAULT)."' 
				WHERE user_id = '".$_SESSION["user_id"]."'
			";
		}
		else
		{
			echo '<div class="alert alert-danger">Old Password Did Not Match</div>';
			exit();
		}
		
	}
	else
	{
		$query = "
		UPDATE user_details SET 
			user_name = '".$_POST["user_name"]."', 
			user_email = '".$_POST["user_email"]."'
			WHERE user_id = '".$_SESSION["user_id"]."'
		";
	}
	$statement = mysqli_query($connect, $query);
	if(isset($statement))
	{
		echo '<div class="alert alert-success">Profile Edited</div>';
	}
}

?>