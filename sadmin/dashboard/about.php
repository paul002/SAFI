<?php include "inc/header.php";
include "config/dbconn.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-info-circle">&nbsp;&nbsp;</i>About</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- Accordion -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#mission" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="mission">
        <h6 class="m-0 font-weight-bold text-primary">Mission</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse" id="mission">
        <div class="card-body">
            <div id="mission">
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#vision" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="vision">
        <h6 class="m-0 font-weight-bold text-primary">Vision</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse" id="vision">
        <div class="card-body">
            <div id="vision">
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#values" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="values">
        <h6 class="m-0 font-weight-bold text-primary">Values</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse" id="values">
        <div class="card-body">
            <div id="values">
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#contactInfo" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="contactInfo">
        <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse" id="contactInfo">
        <div class="card-body">
            <input type="hidden" name="companyId" id="companyId">
            <input type="hidden" name="action" id="action" value="postData">
            <div class="col-md-12 mb-2">
                <label for="compName" class="form-label">Company Name</label>
                <input type="text" class="form-control" name="companyName" id="companyName">
            </div>
            <div class="col-md-6 mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-md-6 mb-2">
                <label for="phoneNo" class="form-label">Phone No.</label>
                <input type="text" class="form-control" name="phoneNo" id="phoneNo">
            </div>
            <div class="col-12 mb-2">
                <label for="address" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>
            <div class="col-12 mb-2">
                <label for="address2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" name="address2" id="address2">
            </div>
            <div class="col-4 mb-2">
                <label for="physicalAddress" class="form-label">Physical Address</label>
                <input type="text" class="form-control" name="physicalAddress" id="physicalAddress">
            </div>
            <div class="col-md-4 mb-2">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" id="city">
            </div>
            <div class="col-md-4 mb-3">
                <label for="postalCode" class="form-label">Postal Code</label>
                <input type="text" class="form-control" name="postalCode" id="postalCode">
            </div>
            <div class="col-md-4 mb-3">
                <label for="lat" class="form-label">Latitude</label>
                <input type="number" class="form-control" name="lat" id="lat">
            </div>  
            <div class="col-md-4 mb-3">
                <label for="lon" class="form-label">Longitude</label>
                <input type="number" class="form-control" name="lon" id="lon">
            </div>          
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <div class="container" disabled>
        <form class="row g-3" id="aboutForm">
            <!-- action="scripts/about_script.php" method="post"> -->
            <div class="col-12 mb-3">
                <textarea class="form-control" name="aboutInfo" id="aboutInfo" rows="3"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-sm" id="btnSaveUpdate"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript">
    CKEDITOR.replace('aboutInfo');

    $(document).ready(function() {
        $('.alert').hide();
        loadContent();
    });

    $('#aboutForm').on('submit', function(e) {
        e.preventDefault();
        var dataData = new FormData(this);
        dataData.append('aboutInfo', CKEDITOR.instances['aboutInfo'].getData());
        $.ajax({
            url: "scripts/about_script.php",
            type: "POST",
            dataType: "JSON",
            data: dataData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];

                $('.alert').show();
                $('.alert').addClass('alert-' + cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;

                loadCompanyInfo();
            }
        });
    });

    function loadContent() {

        $.ajax({
            url: "scripts/about_script.php",
            type: "GET",
            dataType: "JSON",
            data: {
                page: "about"
            },
            success: function(data) {
                console.log(data);
                if (data != null) {
                    CKEDITOR.instances['aboutInfo'].setData(data.companyData[0]['description']);
                    let jsonData = JSON.parse(data.companyData[0]['principles']);
                    console.log(jsonData);
                    // SET Mission, Vision, Values
                    $('#mission').html(jsonData['mission']);
                    $('#vision').html(jsonData['vision']);
                    $('#values').html(jsonData['values']);
                    // SET Contacts Values
                    $('#companyId').val(data.companyData[0]['id']);
                    $('#companyName').val(data.companyData[0]['companyName']);
                    $('#email').val(data.companyData[0]['email']);
                    $('#phoneNo').val(data.companyData[0]['phone']);
                    $('#address').val(data.companyData[0]['address']);
                    $('#address2').val(data.companyData[0]['address2']);
                    $('#physicalAddress').val(data.companyData[0]['physicalAddress']);
                    $('#city').val(data.companyData[0]['town']);
                    $('#postalCode').val(data.companyData[0]['postalCode']);
                    $('#lat').val(data.companyData[0]['latitude']);
                    $('#lon').val(data.companyData[0]['longitude']);

                }
            }
        });
    }
</script>