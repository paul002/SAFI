<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";

$eQuery = "SELECT * FROM `events` ORDER BY `timestamp` DESC LIMIT 12";
$eResults = $db->fetchQuery($eQuery);
?>

<!-- Start Page Header Section -->
<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h2>upcoming events</h2>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li>events</li>
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



<!-- Start Upcoming Events Section -->
<section class="bg-event-box">
    <div class="container">
        <div class="row">
            <div class="event-search-box-option">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="event-box">
                            <div class="form-group">
                                <label for="date">events from</label>
                                <input type="text" class="form-control" id="date" name="date" placeholder="Date">
                            </div>
                            <!-- .form-group -->
                        </div>
                        <!-- .search-box -->
                    </div>
                    <!-- .col-lg-3 col-sm-6 -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="event-box">
                            <div class="form-group">
                                <label for="search">search</label>
                                <input type="text" class="form-control" id="search" placeholder="Keyword">
                            </div>
                            <!-- .form-group -->
                        </div>
                        <!-- .search-box -->
                    </div>
                    <!-- .col-lg-3 col-sm-6 -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="event-box">
                            <div class="form-group">
                                <label for="location">location</label>
                                <input type="text" class="form-control" id="location" placeholder="Type to search">
                            </div>
                            <!-- .form-group -->
                        </div>
                        <!-- .search-box -->
                    </div>
                    <!-- .col-lg-3 col-sm-6 -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="event-box">
                            <a href="#" class="btn btn-default">find events</a>
                        </div>
                        <!-- .search-box -->
                    </div>
                    <!-- .col-lg-3 col-sm-6 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .event-search-box-option -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>


<section class="bg-upcoming-events">
    <div class="container">
        <div class="row">
            <div class="upcoming-events">
                <div class="row">
                    <?php 
                        foreach($eResults as $row){
                            extract($row);
                        
                    ?>
                    <div class="col-lg-6">
                        <div class="event-items">
                            <div class="event-img">
                                <a href="event_single.php?id=<?=$id;?>"><img src="assets/images/events/<?=$featured_image;?>" alt="<?=$featured_image;?>-img-1" class="img-responsive" /></a>
                                <div class="date-box">
                                    <h3>24</h3>
                                    <h5>july</h5>
                                </div>
                                <!-- .date-box -->
                            </div>
                            <!-- .event-img -->
                            <div class="events-content">
                                <h3><a href="event_single.php?id=<?=$id;?>"><?=$name;?></a></h3>
                                <ul class="meta-post">
                                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> 8:30am - 5:30pm</li>
                                    <li><i class="flaticon-placeholder"></i> <?=$location;?></li>
                                </ul>
                                <?=substr($description, 0, 150);?>
                                <a href="event_single.php?id=<?=$id;?>" class="btn btn-default">Read More</a>
                            </div>
                            <!-- .events-content -->
                        </div>
                        <!-- .events-items -->
                    </div>
                    <!-- .col-lg-6 -->
                    <?php }?>
                </div>
                <!-- .row -->

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
            <!-- .upcoming-events -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Upcoming Events Section -->



<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php";
?>