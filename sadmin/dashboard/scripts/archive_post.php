<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

    if(isset($_POST['id'])){
        $postId = $_POST['id'];
        $response = array();
        $pquery = "SELECT * FROM `posts` WHERE `id` = $postId";
        $postObj = $dbo->fetchObject($pquery);

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

        $insert = save($dbo, $id ,$title, $description, $content,$category, $published, $image, $user,$createdBy, $dateCreated, $modifiedBy, $dateModified);
        if($insert == "OK"){
            $delquery = "DELETE FROM `posts` WHERE `id`=$postId";
            $result = $dbo->query($delquery);
            if($result){
                $response[] = array(
                    "status" => 1,
                    "message" => "Post has been archived successfully",
                    "cl" => "success",
                    "fa" => "fa-check"

                );
            }else{
                $response[] = array(
                "status" => -1,
                "message" => "Archived but not removed from posts",
                "cl" => "warning",
                "fa" => "fa-exclamation-triangle"
                );
            }
        }else{
            $response[] = array(
                "status" => 0,
                "message" => "Failed to achive this post",
                "cl" => "warning",
                "fa" => "fa-exclamation-triangle"
                );
        }

        echo json_encode($response);
    }
    if(isset($_POST['undo'])){
        $archiveId = $_POST['archiveId'];
        $response = array();
        $arcquery = "SELECT * FROM `post_archive` WHERE `id` = $archiveId";
        $arcObj = $dbo->fetchObject($arcquery);

        //  UNDO POST ARCHIVE
        $id = $arcObj->postId;
		$title = $arcObj->title;
		$description = $arcObj->postDescription;
		$content = $arcObj->content;
        $image = $arcObj->imagePath;
        $category = $arcObj->categoryId;
		$published = $arcObj->isPublished;
        $createdBy = $arcObj->createdBy;
        $dateCreated = $arcObj->dateCreated;
        $modifiedBy = $arcObj->modifiedBy;
        $dateModified = $arcObj->dateModified;
        $user = 1;

        $insert = saveIntoPosts($dbo, $id ,$title, $description, $content,$category, $published, $image, $createdBy, $dateCreated, $modifiedBy, $dateModified);
        if($insert == "OK"){
            $delquery = "DELETE FROM `post_archive` WHERE `id`=$archiveId";
            $result = $dbo->query($delquery);
            if($result){
                $response[] = array(
                    "status" => 1,
                    "message" => "Post has been retrieved successfully",
                    "cl" => "success",
                    "fa" => "fa-check"

                );
            }else{
                $response[] = array(
                "status" => -1,
                "message" => "Failed to remove post from archive. Contact your administrator!",
                "cl" => "warning",
                "fa" => "fa-exclamation-triangle"
                );
            }
        }else{
            $response[] = array(
                "status" => 0,
                "message" => "Failed to retrieve this post",
                "cl" => "warning",
                "fa" => "fa-exclamation-triangle"
                );
        }

        echo json_encode($response);
    }

    function save($db, $id ,$title, $description, $content,$category, $isPublished, $filePath, $user,$createdBy, $dateCreated, $modifiedBy, $dateModified){
		$query = "INSERT INTO `post_archive` SET `postId`=$id, `title` = '$title', `postDescription`='$description', `content`='$content', `categoryId`='$category', `isPublished`='$isPublished', `imagePath`='$filePath', `createdBy` = '$createdBy', `dateCreated`='$dateCreated', `modifiedBy` = '$modifiedBy', `dateModified` = '$dateModified',`archivedBy`='$user'";
		$que = $db->insert($query);
		return $que;
	}
    function saveIntoPosts($db, $id ,$title, $description, $content,$category, $isPublished, $filePath, $createdBy, $dateCreated, $modifiedBy, $dateModified){
		$query = "INSERT INTO `posts` SET `id`=$id, `title` = '$title', `postDescription`='$description', `content`='$content', `categoryId`='$category', `isPublished`='$isPublished', `imagePath`='$filePath', `createdBy` = '$createdBy', `dateCreated`='$dateCreated', `modifiedBy` = '$modifiedBy', `dateModified` = '$dateModified'";
		$que = $db->insert($query);
		return $que;
	}