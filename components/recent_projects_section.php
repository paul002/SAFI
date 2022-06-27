<?php 
$pQuery = "SELECT * FROM `projects` ORDER BY `timestamp` LIMIT 12";
$pArray = $db->fetchQuery($pQuery);
?>
<section class="bg-recent-project">
    <div class="container">
        <div class="row">
            <div class="recent-project">
                <div class="section-header">
                    <h2>recent project</h2>
                    <p>Professionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.</p>
                </div>
                <!-- .section-header -->

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
            </div>
            <!-- .recent-project -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>