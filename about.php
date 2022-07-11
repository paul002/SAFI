<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safi/includes/header.php";
?>
<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h2>ABOUT US</h2>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li>ABOUT US</li>
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
<section class="bg-single-project">
    <div class="container">
        <div class="row">
            <div class="content-spacing">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-pro-main-content">
                            <div class="row">
                                <div class="col-lg-3">
                                    <?php require_once "./components/side_bar.php"; ?>
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="our-services-box" style="border:none">
                                                <div class="our-services-items">
                                                    <img src="assets/images/about/target.png" alt="target" style="width:100px" />
                                                    <div class="our-services-content">
                                                        <h4><a href="service_single.html">Mission</a></h4>
                                                        <?= $aboutObject->mission; ?>
                                                    </div>
                                                    <!-- .our-services-content -->
                                                </div>
                                                <!-- .our-services-items -->
                                            </div>
                                            <!-- .our-services-box -->
                                        </div>
                                        <!-- .col-md-4 -->
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="our-services-box" style="border:none">
                                                <div class="our-services-items">
                                                    <img src="assets/images/about/binoculars.png" alt="binoculars" style="width:100px" />
                                                    <div class="our-services-content">
                                                        <h4><a href="service_single.html">Vision</a></h4>
                                                        <?= $aboutObject->vision; ?>
                                                    </div>
                                                    <!-- .our-services-content -->
                                                </div>
                                                <!-- .our-services-items -->
                                            </div>
                                            <!-- .our-services-box -->
                                        </div>
                                        <!-- .col-md-4 -->
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="our-services-box" style="border:none">
                                                <div class="our-services-items">
                                                    <img src="assets/images/about/diamond.png" alt="diamond" style="width:100px" />
                                                    <div class="our-services-content">
                                                        <h4><a href="service_single.html">Values</a></h4>
                                                        <?= $aboutObject->core_values; ?>
                                                    </div>
                                                    <!-- .our-services-content -->
                                                </div>
                                                <!-- .our-services-items -->
                                            </div>
                                            <!-- .our-services-box -->
                                        </div>
                                        <!-- .col-md-4 -->
                                    </div>
                                    <!-- .row -->
                                    <div class="single-project-content">
                                        <?= $aboutObject->description; ?>
                                    </div>
                                    <!-- .single-left-content -->
                                </div>
                                <!-- .col-md-8 -->
                            </div>
                        </div>
                        <!-- .single-proj-main-content -->
                    </div>
                </div>
                <!-- .row -->
            </div>
            <!-- .single-project -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safi/components/sponsors_section.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/safi/includes/footer.php"; ?>