<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		if($_POST['user_email'] == '')
		{
			echo 'Email is Required';
			exit();
		}
		else
		{
			if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL))
			{
				echo 'Invalid Email Format';
				exit();
			}
		}
		
		$user_password = password_hash($_POST["user_password"], PASSWORD_DEFAULT);
		$query = "
		INSERT INTO user_details (user_email, user_password, user_name, user_type, user_status) 
		VALUES ('$_POST[user_email]', '$user_password', '$_POST[user_name]', 'user', 'active')
		";	
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'New User Added';
		}
	}
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM user_details WHERE user_id = '$_POST[user_id]'
		";
		$statement = mysqli_query($connect, $query);
		while($row = mysqli_fetch_assoc($statement))
		{
			$output['user_email'] = $row['user_email'];
			$output['user_name'] = $row['user_name'];
		}
		echo json_encode($output);
	}
	if($_POST['btn_action'] == 'Edit')
	{
		if($_POST['user_password'] != '')
		{
			$query = "
			UPDATE user_details SET 
				user_name = '".$_POST["user_name"]."', 
				user_email = '".$_POST["user_email"]."',
				user_password = '".password_hash($_POST["user_password"], PASSWORD_DEFAULT)."' 
				WHERE user_id = '".$_POST["user_id"]."'
			";
		}
		else
		{
			$query = "
			UPDATE user_details SET 
				user_name = '".$_POST["user_name"]."', 
				user_email = '".$_POST["user_email"]."'
				WHERE user_id = '".$_POST["user_id"]."'
			";
		}
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'User Details Edited';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Active';
		if($_POST['status'] == 'Active')
		{
			$status = 'Inactive';
		}
		$query = "
		UPDATE user_details 
		SET user_status = '$status' 
		WHERE user_id = '$_POST[user_id]'
		";
		$statement = mysqli_query($connect, $query);	
		if(isset($statement))
		{
			echo 'User Status change to ' . $status;
		}
	}
}

?>