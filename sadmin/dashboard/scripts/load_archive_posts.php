<?php
	require_once '../config/dbconn.php';

	$db = new db_conn();

	try {
		$postArray = array();
		$query = "SELECT * FROM `post_archive` ORDER BY `id` DESC";
		$que = $db->fetchQuery($query);
		foreach($que as $rec){
			extract($rec);
			$archiveRawDate = strtotime($archiveDate);
			$archiveDateFormatted = date("d/m/Y",$archiveRawDate);
			$shortTitle = substr($title, 0,26) . "...";
			// Fetch Category
			$q = "SELECT `id`,`categoryName` FROM `postCategory` WHERE `id` =".$categoryId.";";
			$qob = $db->fetchObject($q);
			
			// Fetch User
			$uq = "SELECT `id`,`username` FROM `users` WHERE `id`=$createdBy;";
			$uob = $db->fetchObject($uq);
			$checked = "";
            if($isPublished == 1) $checked = "checked";
			$postArray[] = array(
				"title" => $shortTitle,
				"description" => $postDescription,
				"category" => $qob->categoryName,
				"createdBy" => $uob->username,
				"postDate" => $archiveDateFormatted,
				"action" => '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
							</button>
							<div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item view" href="post-view.php?id='.$id.'" data-id="'.$id.'" class="btn btn-secondary"><i class="fas fa-fw fa-eye"></i> View</a>
								<button class="dropdown-item undo" data-id="'.$id.'" class="btn btn-secondary"><i class="fas fa-fw fa-undo"></i> Undo</button>
								<a class="dropdown-item del" href="#" data-id="'.$id.'" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
							</div>'
			);
		}
		header("Content-type: application/json");
		echo json_encode(array("data"=>$postArray));
		
	} catch (Exception $e) {
		$message = $e->getMessage();
		$cl="danger";
		$fa="fa-exclamation-triangle";
	}

?>
