<?php 
require_once "includes/header.php"; 
require_once "config/dbconn.php";

$db = new db_conn();
$content = "";
if(isset($_GET['page'])){
    $pageId = $_GET['page'];

    $pageQuery = "SELECT * FROM `posts` WHERE `post_type` = 'page' AND `id` = $pageId";
    $pageObject = $db->fetchObject($pageQuery);

    if($pageObject == null){
        require_once "./components/404.php";
    }else{
        $content = $pageObject->content;
    }
}
?>
<?=$content;?>
<?php require_once "includes/footer.php"; ?>