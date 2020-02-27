<?php
	require_once('./connect.php');

	header('content-type:application/json');

	$action_name = $_POST["actionName"];

	if($action_name == "getUsers"){
		$data = [];
		$search = isset($_POST["search"]) ? $_POST["search"] : '';

		if(empty($search))
			$query = "SELECT * FROM user";
		else
			$query = "SELECT * FROM user where name like '%$search%'";

		$result = mysqli_query($con,  $query);

		$rowCount = mysqli_num_rows($result);

		if($rowCount > 0){
			while($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
			}
			$message = "success";
		} else {
			$message = "no data found.";
		}

		$result_data = array('status' => 1, 'message' => $message, 'data' => $data);

		echo json_encode($result_data);
	}

	if($action_name == "insertUser"){
		$name = isset($_POST["name"]) ? $_POST["name"] : '';
		$age = isset($_POST["age"]) ? $_POST["age"] : '';
		$username = isset($_POST["username"]) ? $_POST["username"] : '';
		$password = isset($_POST["password"]) ? $_POST["password"] : '';

		$query = "INSERT INTO user(name, age, username, password) VALUES('$name', '$age', '$username', '$password')";
		$result = mysqli_query($con, $query);

		if($result){
			$status = 1;
			$message = "User added successfuly";
		} else {
			$status = 0;
			$message = "Unable to add user";
		}

		$result_data = array('status' => $status, 'message' => $message);

		echo json_encode($result_data);


	}

	if($action_name == "updateUser"){
		$id	 	= $_POST['id'];
		$name = isset($_POST["name"]) ? $_POST["name"] : '';
		$age = isset($_POST["age"]) ? $_POST["age"] : '';
		$username = isset($_POST["username"]) ? $_POST["username"] : '';
		$password = isset($_POST["password"]) ? $_POST["password"] : '';

		$query = "UPDATE user SET name='$name', age='$age', username='$username', password='$password' WHERE id=$id";
		$result = mysqli_query($con, $query);

		if($result){
			$status = 1;
			$message = "User updated successfuly";
		} else {
			$status = 0;
			$message = "Unable to update user";
		}

		$result_data = array('status' => $status, 'message' => $message);

		echo json_encode($result_data);

	}

	if($action_name == "deleteUser"){
		$id = $_POST['id'];

		$query = "DELETE FROM user WHERE id=$id";
		$result = mysqli_query($con, $query);

		echo $result;

		if($result){
			$status = 1;
			$message = "User deleted successfuly";
		} else {
			$status = 0;
			$message = "Unable to delete user";
		}

		$result_data = array('status' => $status, 'message' => $message);

		echo json_encode($result_data);

	}





?>