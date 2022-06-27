<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();
	if(!empty($_POST)){
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $user = 1;
        $que = update($dbo, $id,  $password, $user);
        if($que == "OK"){
            $message = "Password has been changed Successfully.";
            $cl = "success";
            $fa = "fa-check";
        }else{
            $message = "Failed to update password, kindly try again.";
            $cl = "danger";
            $fa = "fa-exclamation-triangle";
        }
		$responseArray['response'] = array(
			"message" => $message,
			"cl" => $cl,
			"fa" => $fa
		);

		echo json_encode($responseArray); 	
	}

	function update($db, $id,  $password, $user){
		try{
            $query = "UPDATE `users` SET `password`='$password', `modifiedBy` = '$user', `dateModified` = CURRENT_TIMESTAMP() WHERE `id` = $id";
            $que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
?>
