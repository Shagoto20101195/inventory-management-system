<?php

//brand_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO brand (category_id, brand_name) 
		VALUES ('$_POST[category_id]', '$_POST[brand_name]')
		";
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'Brand Name Added';
		}
	}

	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM brand WHERE brand_id = '$_POST[brand_id]'
		";
		$statement = mysqli_query($connect, $query);
		while($row = mysqli_fetch_assoc($statement))
		{
			$output['category_id'] = $row['category_id'];
			$output['brand_name'] = $row['brand_name'];
		}
		echo json_encode($output);
	}
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE brand set 
		category_id = '$_POST[category_id]', 
		brand_name = '$_POST[brand_name]'  
		WHERE brand_id = '$_POST[brand_id]' 
		";
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'Brand Name Edited';
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['status'] == 'active')
		{
			$status = 'inactive';
		}
		$query = "
		UPDATE brand 
		SET brand_status = '$status' 
		WHERE brand_id = '$_POST[brand_id]'
		";
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'Brand status change to ' . $status;
		}
	}
}

?>