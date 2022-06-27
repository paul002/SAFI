<?php 
    include "inc/header.php";
    // include "scripts/post_add.php"; 
    include "config/dbconn.php";

    $db= new db_conn();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $postsQuery = "SELECT * FROM `posts` WHERE `id`=$id;";
        $postObj = $db->fetchObject($postsQuery);

    }

?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-book">&nbsp;&nbsp;</i><?=$postObj->title;?></h1>
            <!-- <span>Category here</span> -->
            <!-- Button trigger modal -->
            <a href="posts-page.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm text-white">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
            </a>
            </div>
            <div class="row">
                <div class="container">
                    <div class="mb-3">
                        <img src="../../images/posts/<?=$postObj->imagePath;?>" class="img-fluid">
                    </div>
                    <div class="mb-3">
                        <?=$postObj->content;?>
                    </div>
                    
                </div>
            </div>

<?php include "inc/footer.php"; ?>