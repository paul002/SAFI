<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

    if(isset($_POST['id'])){
        $postId = $_POST['id'];
        $pquery = "SELECT * FROM `posts` WHERE `id` = $postId";
        $postObj = $db->fetchObject($pquery);

        //  CREATE NEW POST ARCHIVE
        $id = $postObj->id;
		$title = $postObj->title;
		$description = $postObj->postDescription;
		$content = $postObj->content;
        $image = $postObj->imagePath;
        $category = $postObj->categoryId;
		$published = $postObj->isPublished;
        $createdBy = $postObj->createdBy;
        $dateCreated = $postObj->dateCreated;
        $modifiedBy = $postObj->modifiedBy;
        $dateModified = $postObj->dateModified;
        $user = 1;

        $insert = save($dbo, $id ,$title, $description, $content,$category, $isPublished, $filePath, $user,$createdBy, $dateCreated, $modifiedBy, $dateModified);
        if($insert == "OK")
            echo json_encode("Saved");
        else
            echo json_encode("Not Saved");
    }
    else{
        //  EDIT POST
        echo json_encode("hello without posting");
    }

    function save($db, $id ,$title, $description, $content,$category, $isPublished, $filePath, $user,$createdBy, $dateCreated, $modifiedBy, $dateModified){
		$query = "INSERT INTO `post_archive` SET `id`=$id, `title` = '$title', `postDescription`='$description', `content`='$content', `categoryId`='$category', `isPublished`='$isPublished', `imagePath`='$filePath', `createdBy` = '$createdBy', `dateCreated`='$dateCreated', `modifiedBy` = '$modifiedBy', `dateModified` = '$dateModified',`archivedBy`='$user'";
		$que = $db->insert($query);
		return $que;
	}