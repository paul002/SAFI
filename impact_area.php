<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";
$id = 0;
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $impact_area = "SELECT * FROM `impact_areas` WHERE `id` = $id";
    $impact_area_Obj = $db->fetchObject($impact_area);

    //Fetch Region
    $rquery = "SELECT * FROM `region` WHERE `id` = $impact_area_Obj->region";
    $rObj = $db->fetchObject($rquery);

    //Fetch district
    $dquery = "SELECT * FROM `districts` WHERE `id` = $impact_area_Obj->district";
    $dObj = $db->fetchObject($dquery);

?>
    <!-- Start Page Header Section -->
    <section class="bg-page-header">
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="page-header">
                        <div class="page-title">
                            <h2><?= $impact_area_Obj->name; ?></h2>
                        </div>
                        <!-- .page-title -->
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="impact_areas.php">impact areas</a></li>
                                <li><?= $impact_area_Obj->name; ?></li>
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
    <!-- Start Single Events Section -->
    <section class="bg-single-blog">
        <div class="container">
            <div class="row">
                <div class="single-blog">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="blog-items">
                                <div class="blog-img">
                                    <a href="#"><img src="assets/images/impact areas/<?= $impact_area_Obj->featured_image; ?>" alt="blog-img-10" class="img-responsive" /></a>
                                </div>
                                <!-- .blog-img -->
                                <div class="blog-content-box">
                                    <div class="blog-content">
                                        <h4><?= $impact_area_Obj->name; ?></h4>
                                        <?= $impact_area_Obj->content_description; ?>
                                    </div>
                                    <!-- .blog-content -->
                                    <div class="single-blog-bottom">
                                        <ul class="tags">
                                            <li>Location :</li>
                                            <li><a href="#">Region: <?=$rObj->region;?></a></li>
                                            <li><a href="#">District: <?=$dObj->district;?></a></li>
                                        </ul>
                                        <!-- .author-option -->
                                    </div>
                                    <!-- .single-blog-bottom -->
                                </div>
                                <!-- .blog-content-box -->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="sidebar">
                                <div class="widget">
                                    <div class="widget-content">
                                        <form action="#" method="POST" class="sidebar-form">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="searchId" name="search" placeholder="Search...">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- .widget-content -->
                                </div>
                                <!-- .widget -->


                                <div class="widget">
                                    <h4 class="sidebar-widget-title">All Categores</h4>
                                    <div class="widget-content">
                                        <ul class="catagories">
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Brand Creation <span>05</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Company Analysis <span>06</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Corporate Identity<span>07</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Funding<span>08</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Medical<span>15</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Strategy Planning<span>20</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Uncategorized<span>25</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Video Production<span>30</span></a></li>

                                        </ul>
                                    </div>
                                    <!-- .widget-content -->
                                </div>
                                <!-- .widget -->
                                <div class="widget">
                                    <h4 class="sidebar-widget-title">Popular News</h4>
                                    <div class="widget-content">
                                        <ul class="popular-news-option">
                                            <li>
                                                <div class="popular-news-img">
                                                    <a href="#"><img src="assets/images/event/popular-news-img-1.jpg" alt="popular-news-img-1" /></a>
                                                </div>
                                                <!-- .popular-news-img -->
                                                <div class="popular-news-contant">
                                                    <h5><a href="#">Foulate revlunry a mihare awesome the theme.</a></h5>
                                                    <p>04 February 2016</p>
                                                </div>
                                                <!-- .popular-news-img -->
                                            </li>
                                            <li>
                                                <div class="popular-news-img">
                                                    <a href="#"><img src="assets/images/event/popular-news-img-2.jpg" alt="popular-news-img-2" /></a>
                                                </div>
                                                <!-- .popular-news-img -->
                                                <div class="popular-news-contant">
                                                    <h5><a href="#">Foulate revlunry a mihare awesome the theme.</a></h5>
                                                    <p>04 February 2016</p>
                                                </div>
                                                <!-- .popular-news-img -->
                                            </li>
                                            <li>
                                                <div class="popular-news-img">
                                                    <a href="#"><img src="assets/images/event/popular-news-img-3.jpg" alt="popular-news-img-3" /></a>
                                                </div>
                                                <!-- .popular-news-img -->
                                                <div class="popular-news-contant">
                                                    <h5><a href="#">Foulate revlunry a mihare awesome the theme.</a></h5>
                                                    <p>04 February 2016</p>
                                                </div>
                                                <!-- .popular-news-img -->
                                            </li>
                                        </ul>

                                    </div>
                                    <!-- .widget-content -->
                                </div>
                                <!-- .widget -->
                                <div class="widget">
                                    <h4 class="sidebar-widget-title">photo gallery</h4>
                                    <div class="widget-content">
                                        <div class="gallery-instagram">
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-1.jpg" alt="photo-gallery-small-img-1"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-2.jpg" alt="footer-instagram-img-2"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-3.jpg" alt="footer-instagram-img-3"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-4.jpg" alt="footer-instagram-img-4"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-5.jpg" alt="footer-instagram-img-5"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-6.jpg" alt="footer-instagram-img-6"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-7.jpg" alt="footer-instagram-img-7"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-8.jpg" alt="footer-instagram-img-8"></a>
                                            <a href="#"><img src="assets/images/event/photo-gallery-small-img-9.jpg" alt="footer-instagram-img-9"></a>

                                        </div>
                                        <!-- .gallery-instagram -->
                                    </div>
                                    <!-- .widget-content -->
                                </div>
                                <!-- .widget -->
                                <div class="widget">
                                    <h4 class="sidebar-widget-title">Popular Tags</h4>
                                    <div class="widget-content">
                                        <div class="tag-cloud">
                                            <a href="#" class="btn">children</a>
                                            <a href="#" class="btn">school</a>
                                            <a href="#" class="btn">shop</a>
                                            <a href="#" class="btn">water</a>
                                            <a href="#" class="btn">charity</a>
                                            <a href="#" class="btn">heaven</a>
                                            <a href="#" class="btn">Blog</a>
                                            <a href="#" class="btn">Contant</a>
                                            <a href="#" class="btn">Design</a>
                                        </div>
                                        <!-- .tag-cloud -->
                                    </div>
                                    <!-- .widget-content -->
                                </div>
                                <!-- .widget -->
                            </div>
                            <!-- .sidebar -->
                        </div>
                    </div>
                    <!-- .row -->
                </div>
                <!-- .single-blog -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- End Single Events Section -->
<?php
} else {
    require_once 'components/404.php';
}
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php";
?>