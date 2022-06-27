<?php
require_once '../config/dbconn.php';
$postType = "page";
$db = new db_conn();
if (isset($_GET['id'])) {
	$postId = trim($_GET['id']);
	try {
		$postArray = array();
		$pageQuery = "SELECT * FROM `posts` WHERE `post_type` = '$postType' AND `id` = $postId";
		$pageObj = $db->fetchObject($pageQuery);

		$postArray[] = array(
			"pageId" => $pageObj->id,
			"pageTitle" => $pageObj->title,
			"description" => $pageObj->postDescription,
			"content" => $pageObj->content,
			"metaKey" => $pageObj->meta_key,
			"metaValue" => $pageObj->meta_value,
			"isPublished" => $pageObj->isPublished
		);

		header("Content-type: application/json");
		echo json_encode($postArray);
	} catch (Exception $e) {
		$message = $e->getMessage();
		$cl = "danger";
		$fa = "fa-exclamation-triangle";
	}
} else {
	try {
		$postArray = array();
		$query = "SELECT * FROM `posts` WHERE `post_type` = '$postType' ORDER BY `id` DESC";
		$que = $db->fetchQuery($query);
		foreach ($que as $rec) {
			extract($rec);
			$postRawDate = strtotime($dateCreated);
			$postDateFormatted = date("d/m/Y", $postRawDate);
			$shortTitle = substr($title, 0, 26) . "...";

			// Fetch Category
			$q = "SELECT `id`,`categoryName` FROM `postCategory` WHERE `id` =" . $categoryId . ";";
			$qob = $db->fetchObject($q);
			$catId = $qob != null ? $qob->id : 0;
			$catName = $qob != null ? $qob->categoryName : "None";


			// Fetch User
			$uq = "SELECT `id`,`username` FROM `users` WHERE `id`= $createdBy;";
			$uob = $db->fetchObject($uq);

			$uname = $uob != null ? $uob->username : "default";

			// Fetch PostTypes
			$postTypeQuery = "SELECT * FROM `posts` WHERE `post_type` = '$postType'";
			$postTypeObj = $db->fetchObject($postTypeQuery);
			$pType = $postTypeObj != null ? $postTypeObj->post_type : "None";

			$checked = "";
			if ($isPublished == 1) $checked = "checked";
			$postArray[] = array(
				"postTypeId" => $postType,
				"title" => $shortTitle,
				"description" => $postDescription,
				"category" => $catName,
				"isPublished" => '<input type="checkbox" ' . $checked . ' disabled/>',
				"createdBy" => $uname,
				"postDate" => $postDateFormatted,
				"action" => '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
								</button>
								<div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
									<button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
									<a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
								</div>'
			);
		}
		header("Content-type: application/json");
		echo json_encode(array("data" => $postArray));
	} catch (Exception $e) {
		$message = $e->getMessage();
		$cl = "danger";
		$fa = "fa-exclamation-triangle";
	}
}
