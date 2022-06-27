<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";

$impact_areas_query = "SELECT * FROM `impact_areas` ORDER BY `timestamp` DESC";
$impact_areas_array = $db->fetchQuery($impact_areas_query);

?>

<!-- Start Page Header Section -->
<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h2>Impact Area</h2>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li>Impact Areas</li>
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

<!-- STart Maps Section -->
<div id="map"></div>
<!-- End Maps Section -->

<!-- Start Blog Section -->
<section class="bg-blog-section">
    <div class="container">
        <div class="row">
            <div class="blog-section blog-page">
                <div class="row">
                    <?php foreach ($impact_areas_array as $row) {
                        extract($row);
                        //Fetch district
                        $dquery = "SELECT * FROM `districts` WHERE `id` = $district";
                        $dObj = $db->fetchObject($dquery);

                        $content = substr($content_description, 0, 200);
                    ?>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="blog-items">
                                <div class="blog-img">
                                    <a href="impact_area.php?id=<?= $id; ?>"><img src="assets/images/impact areas/<?= $featured_image; ?>" alt="<?= $name . "_image"; ?>" class="img-responsive" /></a>
                                </div>
                                <!-- .blog-img -->
                                <div class="blog-content-box">
                                    <div class="blog-content">
                                        <h4><a href="impact_area.php?id=<?= $id; ?>"><?= $name; ?></a></h4>
                                        <?= $content; ?>
                                    </div>
                                    <!-- .blog-content -->
                                    <div class="meta-box item-footer-flaticon">
                                        <ul class="meta-post">
                                            <li><i class="fa fa-map-marker"></i> <?= $dObj->district; ?>,</li>
                                            <li><?= "T/A: " . $traditional_authority; ?>,</a></li>
                                            <li><?= $name; ?></a></li>
                                        </ul>
                                    </div>
                                    <!-- .meta-box -->
                                </div>
                                <!-- .blog-content-box -->
                            </div>
                            <!-- .blog-items -->
                        </div>
                    <?php } ?>
                    <!-- .col-md-4 -->
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
            <!-- .blog-section -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-blog-section -->
</section>
<!-- End Blog Section -->


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php";
?>
<script>
    function initMap() {
        var map;
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        var styledMapType = new google.maps.StyledMapType(
            [{
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#65ac4c"
                }]
            }], {
                name: 'Impact Areas'
            });
        var mapOptions = {
            center: {
                lat: -14.378404,
                lng: 33.917650
            },
            mapTypeId: 'roadmap'
        };
        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        var bounds = new google.maps.LatLngBounds();
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var markers = [<?php foreach ($impact_areas_array as $row) {
                            extract($row);
                            echo "['$name', '$lat', '$lng'],";
                        } ?>]


        // Info window content
        var infoWindowContent = [
            <?php foreach ($impact_areas_array as $row) {
                extract($row);
                //Fetch district
                $dquery = "SELECT * FROM `districts` WHERE `id` = $district";
                $dObj = $db->fetchObject($dquery);
                //Fetch district
                $rquery = "SELECT * FROM `region` WHERE `id` = $region";
                $rObj = $db->fetchObject($rquery);

                $wrapOpen = '<div style="color: #000;">';
                $heading = '<h4>' . $name . '</h4>';
                $districtInfo = '<p>District: ' . $dObj->district . '</p>';
                $regionInfo = '<p>Region: ' . $rObj->region . '</p>';
                $link = '<br> <a href="impact_area.php?id='.$id.'">Read more</a>';
                $wrapEnd = '</div>';

                $html = $wrapOpen . $heading . $districtInfo . $regionInfo . $link . $wrapEnd;
                echo "['$html'],";
            } ?>
        ];

        // Add multiple markers to map
        var infoWindow = new google.maps.InfoWindow(),
            marker, i;

        var myLatlng = new google.maps.LatLng(-14.378404, 33.917650);
        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });
            marker.setMap(map);

            // Add info window to marker    
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Center the map to fit all markers on the screen
            map.fitBounds(bounds);
        }

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
    }
</script>

<!-- Map Api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6fHHip1i8AMWOSSiggOtEgk-skDbZpeI&callback=initMap" async defer></script>