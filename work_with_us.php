<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";
if (isset($_GET['_id'])) {
    $id = $_GET['_id'];

    $vQuery = "SELECT * FROM `vacancy` WHERE `id`=$id";
    $vObj = $db->fetchObject($vQuery);
    if($vObj ){
    //Fetch Category
    $vac_cat = "SELECT * FROM `vacancy_category` WHERE id = $vObj->category";
    $vac_catObj = $db->fetchObject($vac_cat);
?>

    <!-- Start Page Header Section -->
    <section class="bg-page-header">
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="page-header">
                        <div class="page-title">
                            <h2><?= $vObj->position; ?></h2>
                        </div>
                        <!-- .page-title -->
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="work_with_us.php">Work with us</a></li>
                                <li><?= $vObj->position; ?></li>
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
                                <!-- .blog-img -->
                                <div class="blog-content-box">
                                    <div class="blog-content">
                                        <h4><?= $vObj->position; ?></h4>
                                        <div class="single-date-option" style="float:unset">
                                            <ul class="single-date">
                                                <li>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <div class="h-adress-content">
                                                        <h6>closing date</h6>
                                                        <p><?= $vObj->closing_date; ?></p>
                                                    </div>
                                                    <!-- .h-adress-content -->
                                                </li>
                                                <li>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <div class="h-adress-content">
                                                        <h6>location</h6>
                                                        <p><?= $vObj->location; ?></p>
                                                    </div>
                                                    <!-- .h-adress-content -->
                                                </li>
                                                <li>
                                                    <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                                                    <div class="h-adress-content">
                                                        <h6>category</h6>
                                                        <p><?= $vac_catObj->category; ?></p>
                                                    </div>
                                                    <!-- .h-adress-content -->
                                                </li>
                                            </ul>
                                        </div>
                                        <?= $vObj->description; ?>
                                    </div>
                                    <!-- .blog-content -->
                                    <div class="single-blog-bottom"></div>
                                    <!-- .single-blog-bottom -->
                                </div>
                                <!-- .blog-content-box -->
                            </div>
                            <!-- .blog-items -->
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
    }else{
     include_once "components/404.php";
    }
} else {
    $vQuery = "SELECT * FROM `vacancy` ORDER BY `timestamp` DESC LIMIT 10";
    $vResult = $db->fetchQuery($vQuery);
?>

    <!-- Start Page Header Section -->
    <section class="bg-page-header">
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="page-header">
                        <div class="page-title">
                            <h2>Work with us</h2>
                        </div>
                        <!-- .page-title -->
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li>Work with us</li>
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
    <section class="bg-blog-style-2">
        <div class="container">
            <div class="row">
                <div class="blog-style-2">
                    <div class="row">
                        <div class="col-lg-8">
                            <?php
                            foreach ($vResult as $row) {
                                extract($row);

                                //Fetch Category
                                $vac_cat = "SELECT * FROM `vacancy_category` WHERE id = $category";
                                $vac_catObj = $db->fetchObject($vac_cat);
                            ?>
                                <div class="blog-items">
                                    <div class="blog-content-box">
                                        <div class="blog-content">
                                            <h4><a href="work_with_us.php?_id=<?= $id ?>"><?= $position; ?></a></h4>
                                            <ul class="meta-post">
                                                <li><i class="fa fa-calendar" aria-hidden="true"></i> Closing Date: <?= $closing_date; ?></li>
                                                <li><a href="#"><i class="fa fa-puzzle-piece " aria-hidden="true"></i> Category: <?= $vac_catObj->category; ?></a></li>
                                                <li><a href="#"><i class="fa fa-map-marker"></i> location: <?= $location; ?></a></li>
                                            </ul>
                                            <?= $description; ?>
                                            <a href="work_with_us.php?_id=<?= $id ?>">read more <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                        <!-- .blog-content -->
                                    </div>
                                    <!-- .blog-content-box -->
                                </div>
                            <?php } ?>
                            <!-- .blog-items -->
                            <div class="pagination-option">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li><a href="#">1</a></li>
                                        <li class="active"><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">5</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- .pagination_option -->
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
                <!-- .blog-style-2 -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- End Single Events Section -->

<?php }
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php";
?>