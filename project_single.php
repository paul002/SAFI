<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";

$id = 0;

if (isset($_GET['id']) != 0) {
    $id = $_GET['id'];
    $pQuery = "SELECT * FROM `projects` WHERE `id` = $id";
    $pObj = $db->fetchObject($pQuery);

    // Fetch Category
    $cQuery = "SELECT * FROM `project_category` WHERE `id` = $pObj->category";
    $cObj = $db->fetchObject($cQuery);
?>
    <!-- Start Page Header Section -->
    <section class="bg-page-header">
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="page-header">
                        <div class="page-title">
                            <h2><?=$pObj->name; ?></h2>
                        </div>
                        <!-- .page-title -->
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="project.php">Projects</a></li>
                                <li><?=$pObj->name; ?></li>
                            </ol>
                        </div>
                        <!-- .page-header-content -->
                    </div>
                    <!-- .page-header -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- .page-header-overlay -->
    </section>
    <!-- End Page Header Section -->


    <!-- Start Recent Project Section -->
    <section class="bg-single-project">
        <div class="container">
            <div class="row">
                <div class="single-project">
                    <div class="row">
                        <div class="col-lg-9">
                            <img src="assets/images/projects/<?=$pObj->featured_image;?>" alt="<?=$pObj->name.'-img';?>" class="img-responsive" />
                            <div class="single-pro-main-content">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul class="single-left-content">
                                            <li>
                                                <h4><?=$pObj->name;?></h4>
                                                <p>Business Template of Envato</p>
                                            </li>
                                            <li>
                                                <h4>Date:</h4>
                                                <p><?=$pObj->end_date; ?></p>
                                            </li>
                                            <li>
                                                <h4>Sponsor:</h4>
                                                <p><?=$pObj->sponsor;?></p>
                                            </li>
                                            <li>
                                                <h4>Category:</h4>
                                                <p><?=$cObj->category;?></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- .col-md-4 -->
                                    <div class="col-lg-8">
                                        <div class="single-project-content">
                                            <h3>Project Description</h3>
                                            <?=$pObj->description; ?>
                                            <p></p>
                                        </div>
                                        <!-- .single-left-content -->
                                    </div>
                                    <!-- .col-md-8 -->
                                </div>
                            </div>
                            <!-- .single-proj-main-content -->
                        </div>
                        <!-- .col-lg-9 -->
                        <div class="col-lg-3">
                            <div class="single-right-content">
                                <ul class="single-small-img">
                                    <li><img src="assets/images/project/single-project-img-2.jpg" alt="single-project-img-2" class="img-responsive" /></li>
                                    <li><img src="assets/images/project/single-project-img-3.jpg" alt="single-project-img-3" class="img-responsive" /></li>
                                    <li><img src="assets/images/project/single-project-img-4.jpg" alt="single-project-img-4" class="img-responsive" /></li>
                                </ul>
                                <div class="download-option">
                                    <h4>Download Brochures</h4>
                                    <a href="#" class="download-btn"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> DOWNLOAD.PDF <span><i class="fa fa-download" aria-hidden="true"></i></span></a>

                                    <a href="#" class="download-btn"> <i class="fa fa-file-image-o" aria-hidden="true"></i>DOWNLOAD.doc <span><i class="fa fa-download" aria-hidden="true"></i></span></a>

                                </div>
                                <!-- .download-option -->
                                <div class="social-option">
                                    <h4>Share this project :</h4>
                                    <ul class="social-icon-rounded">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <!-- .social-option -->
                            </div>
                            <!-- .single-right-content -->
                        </div>
                        <!-- .col-lg-3 -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .single-project -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- End Recent Project Section -->

<?php
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/components/404.php";
}
?>
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php"; ?>