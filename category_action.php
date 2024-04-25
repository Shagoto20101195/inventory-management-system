<?php

//category_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO category (category_name) 
		VALUES ('$_POST[category_name]')
		";
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'Category Name Added';
		}
	}
	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM category WHERE category_id = '$_POST[category_id]'";
		$statement = mysqli_query($connect, $query);
		while($row = mysqli_fetch_assoc($statement))
		{
			$output['category_name'] = $row['category_name'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE category set category_name = '$_POST[category_name]'  
		WHERE category_id = '$_POST[category_id]'
		";
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'Category Name Edited';
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
		UPDATE category 
		SET category_status = '$status' 
		WHERE category_id = '$_POST[category_id]'
		";
		$statement = mysqli_query($connect, $query);
		if(isset($statement))
		{
			echo 'Category status change to ' . $status;
		}
	}
}

?>