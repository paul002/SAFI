<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";

$pQuery = "SELECT * FROM `projects` ORDER BY `timestamp`";
$pArray = $db->fetchQuery($pQuery);
?>
<!-- Start Page Header Section -->
<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h2>our project</h2>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li>project</li>
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
<section class="bg-single-recent-project">
    <div class="container">
        <div class="row">
            <div class="recent-project">
                <div id="filters" class="button-group ">
                    <button class="button is-checked" data-filter="*">show all</button>
                    <?php foreach ($pArray as $row) {
                        extract($row);
                        $proj_cat = "SELECT p.category AS 'category_id', pc.category FROM `projects` p JOIN `project_category` pc ON pc.id = p.category WHERE p.id = $id";
                        $proj_catObj = $db->fetchObject($proj_cat);
                        $filter = strtolower($proj_catObj->category) . '-' . $proj_catObj->category_id;
                    ?>
                        <button class="button" data-filter=".<?= $filter; ?>"><?= $proj_catObj->category; ?></button>
                    <?php } ?>
                </div>
                <div class="portfolio-items">
                    <?php foreach ($pArray as $row) {
                        extract($row);
                        $proj_cat = "SELECT p.category AS 'category_id', pc.category FROM `projects` p JOIN `project_category` pc ON pc.id = p.category WHERE p.id = $id";
                        $proj_catObj = $db->fetchObject($proj_cat);
                        $filter = strtolower($proj_catObj->category) . '-' . $proj_catObj->category_id;
                    ?>
                        <div class="item <?= $filter; ?>" data-category="transition">
                            <div class="item-inner">
                                <div class="portfolio-img">
                                    <div class="overlay-project"></div>
                                    <!-- .overlay-project -->
                                    <img src="assets/images/projects/<?=$featured_image;?>" alt="<?=$featured_image;?>">
                                    <ul class="project-link-option">
                                        <li class="project-link"><a href="project_single.php?id=<?=$id;?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                        <li class="project-search"><a href="assets/images/projects/<?=$featured_image;?>" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /.portfolio-img -->
                                <div class="recent-project-content">
                                    <h4><a href="project_single.php?id=<?=$id;?>"><?=$name;?></a></h4>
                                </div>
                                <!-- .latest-port-content -->
                            </div>
                            <!-- .item-inner -->
                        </div>
                        <!-- .items -->
                    <?php } ?>

                </div>
                <!-- .isotope-items -->
                <div class="load-more-option">
                    <a href="#" class="btn btn-default">load more</a>
                </div>
                <!-- .load-more-option -->
            </div>
            <!-- .recent-project -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Recent Project Section -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php";
?>