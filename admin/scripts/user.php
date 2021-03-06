<?php 
	function createUser($fname,$username,$password,$email){
			include('connect.php');
			
		$create_user_query = 'INSERT INTO tbl_user(user_fname,user_name,user_pass,user_email, user_login)'; //connect and insert into db
		$create_user_query .= ' VALUES(:fname,:username,:password,:email, "new")';

		$create_user_set = $pdo->prepare($create_user_query);
		$create_user_set->execute(
			array(
				':fname'=>$fname,
				':username'=>$username,
				':password'=>$password,
				':email'=>$email,
			)
		);
		if($create_user_set->rowCount()){
			redirect_to('index.php');
			//redirect to edit user page
		}else{
			$message = 'Your hiring practices have failed you.. this individual sucks...';
			return $message;
		}

}

function editUser($id, $fname, $username, $password, $email) {
//To Do: use the createUser function as reference to build this function
//so that it can update the tbl_user with provided data

//when updated successfully, redirect to index.php
//otherwise, return an error message

include('connect.php');
	$update_user_query = 'UPDATE tbl_user SET user_fname=:fname, user_name=:username, user_pass=:password, user_email=:email, user_login = "old" WHERE user_id = :id';

		$update_user_set = $pdo->prepare($update_user_query);
		$update_user_set->execute(
			array(
				':id'=>$id,
				':fname'=>$fname,
				':username'=>$username,
				':password'=>$password,
				':email'=>$email
			)
		);

		//login after edit
		if($update_user_set->rowCount()){
			redirect_to('index.php');
			// redirect to admin page after log out and log back in
		}else{
			$message = 'Something went wrong, oops!';
			return $message;
		}

}